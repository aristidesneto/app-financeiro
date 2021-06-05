<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Resources\EntryResource;
use Carbon\Carbon;
use App\Models\Entry;

class EntryService implements ServiceInterface
{

    public function store(array $data) : bool
    {
        if ($data['type'] === 'expense') {
            return $this->saveExpense($data);
        }

        return $this->saveIncome($data);
    }

    public function entries(array $request)
    {
        $type = $request['type'] === 'expense' ? 'expense' : 'income';
        $date = Carbon::createFromFormat('Y-m', $request['month'])->format('Y-m');

        $year = explode('-', $date)[0];
        $month = explode('-', $date)[1];

        $query = Entry::with('user', 'bank_account', 'category', 'credit_card')
                    ->where('type', $type)
                    ->whereMonth('due_date', $month)
                    ->whereYear('due_date', $year)
                    ->orderBy('due_date')
                    ->get();

        return EntryResource::collection($query);
    }

    protected function getSequence()
    {
        return Entry::max('sequence');
    }

    protected function saveExpense(array $data): bool
    {
        $data['is_recurring'] = isset($data['is_recurring']) == '1' ? true : false;
        $due_date = $data['due_date'] = Carbon::createFromTimeString($data['due_date']);

        // Recorrente
        if ($data['is_recurring'] === true) {
            $sequence = $this->getSequence();
            $data['sequence'] = $sequence === null ? 1 : $sequence + 1;
            $data['bank_account_id'] = null;
            $data['credit_card_id'] = null;
            $data['parcel'] = 0;

            for ($i = 1; $i <= 120; $i++) { // 10 anos
                Entry::create($data);
                $data['due_date'] = $due_date->copy()->addMonthNoOverflow($i);
            }

            return true;
        }

        // dd($data);

        // Cartão de crédito
        if (! is_null($data['credit_card_id'])) {
            $totalParcel = ($data['parcel'] === null || $data['parcel'] === '0') ? '1' : $data['parcel'];

            $amountParcel = round($data['amount'] / $totalParcel, 2);
            $difference = round(($amountParcel * $totalParcel) - $data['amount'], 2);

            // dd($amountParcel, $data['amount']);

            $data['total_parcel'] = $totalParcel;
            $data['bank_account_id'] = null;

            for ($i = 1; $i <= $totalParcel; $i++) {
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

    protected function saveIncome(array $data) : bool
    {
        $data['is_recurring'] = isset($data['is_recurring']) == '1' ? true : false;
        $data['amount'] = formatMoney2Db($data['amount']);
        $start_date = $data['start_date'] = Carbon::createFromFormat('m/Y', $data['start_date'])->firstOfMonth();
        $data['parcel'] = 0;

        if ($data['is_recurring'] === true) {

            for ($i = 1; $i <= 120; $i++) { // 10 anos

                Entry::create($data);

                $data['start_date'] = $start_date->copy()->addMonthNoOverflow($i);
            }

            return true;
        }

        Entry::create($data);

        return true;
    }

}
