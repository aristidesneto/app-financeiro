<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Resources\EntryResource;
use App\Models\Entry;
use Aristides\Helpers\Helpers;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class EntryService implements ServiceInterface
{
    public function store(array $data): bool
    {
        if ('expense' === $data['type']) {
            return $this->saveExpense($data);
        }

        return $this->saveIncome($data);
    }

    public function entries(array $request): AnonymousResourceCollection
    {
        $type = $request['type'] === 'expense' ? 'expense' : 'income';

        $isDateRange = (! is_null($request['period']['start']) && ! is_null($request['period']['end'])) ? true : false;

        $startDate = Carbon::createFromFormat('Y-m-d', $request['period']['start']);

        $query = Entry::with('bankAccount', 'category', 'creditCard')->where('type', $type);

        if ($isDateRange) {
            $endDate = Carbon::createFromFormat('Y-m-d', $request['period']['end']);

            $query->where(function ($query) use ($startDate, $endDate) {
                $query->whereMonth('due_date', '>=', $startDate)
                    ->whereMonth('due_date', '<=', $endDate);
            })
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereYear('due_date', '>=', $startDate)
                    ->whereYear('due_date', '<=', $endDate);
            });
        }

        if (! $isDateRange) {
            $query->whereMonth('due_date', $startDate)
                ->whereYear('due_date', $startDate);
        }

        return EntryResource::collection($query->orderBy('due_date')->get());
    }

    protected function getSequence(): int
    {
        return Entry::max('sequence');
    }

    protected function saveExpense(array $data): bool
    {
        $data['is_recurring'] = '1' == isset($data['is_recurring']) ? true : false;
        $due_date = $data['due_date'] = Carbon::createFromTimeString($data['due_date']);

        // Recorrente
        if (true === $data['is_recurring']) {
            $sequence = $this->getSequence();
            $data['sequence'] = $sequence ? 1 : $sequence + 1;
            $data['bank_account_id'] = null;
            $data['credit_card_id'] = null;
            $data['parcel'] = 0;

            for ($i = 1; $i <= 120; ++$i) { // 10 anos
                Entry::create($data);
                $data['due_date'] = $due_date->copy()->addMonthNoOverflow($i);
            }

            return true;
        }

        // dd($data);

        // Cartão de crédito
        if (!is_null($data['credit_card_id'])) {
            $totalParcel = (null === $data['parcel'] || '0' === $data['parcel']) ? '1' : $data['parcel'];

            $amountParcel = round($data['amount'] / $totalParcel, 2);
            $difference = round(($amountParcel * $totalParcel) - $data['amount'], 2);

            // dd($amountParcel, $data['amount']);

            $data['total_parcel'] = $totalParcel;
            $data['bank_account_id'] = null;

            for ($i = 1; $i <= $totalParcel; ++$i) {
                $data['parcel'] = $i;
                $data['amount'] = $i === (int) $totalParcel ? $amountParcel - $difference : $amountParcel;
                // dd($data);
                Entry::create($data);

                $data['due_date'] = $due_date->copy()->addMonthNoOverflow($i);
            }

            return true;
        }

        $data['bank_account_id'] = null;
        $data['credit_card_id'] = null;
        $data['parcel'] = '0';

        // Cria para 1 parcela
        Entry::create($data);

        return true;
    }

    protected function saveIncome(array $data): bool
    {
        $data['is_recurring'] = '1' == isset($data['is_recurring']) ? true : false;
        $data['amount'] = Helpers::formatMoneyToDatabase($data['amount']);
        $start_date = $data['start_date'] = Carbon::createFromFormat('m/Y', $data['start_date'])->firstOfMonth();
        $data['parcel'] = 0;

        if (true === $data['is_recurring']) {
            for ($i = 1; $i <= 120; ++$i) { // 10 anos
                Entry::create($data);

                $data['start_date'] = $start_date->copy()->addMonthNoOverflow($i);
            }

            return true;
        }

        Entry::create($data);

        return true;
    }
}
