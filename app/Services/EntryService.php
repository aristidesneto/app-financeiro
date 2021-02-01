<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Entry;
use App\Models\CreditCard;

class EntryService implements ServiceInterface
{

    public function store(array $data) : bool
    {
        // dd($data);
        $data['is_recurring'] = isset($data['is_recurring']) == '1' ? true : false;
        $data['amount'] = formatMoney2Db($data['amount']);


        // dd($data);

        // Recorrente
        if ($data['is_recurring'] === true) {
            $due_date = Carbon::createFromFormat('d/m/Y', $data['due_date']);
            $data['due_date'] = $due_date;

            $sequence = $this->getSequence();
            $data['bank_account_id'] = null;
            $data['credit_card_id'] = null;

            for ($i = 1; $i <= 120; $i++) { // 10 anos
                $data['parcel'] = 0;
                $data['sequence'] = $sequence === null ? 1 : $sequence + 1;

                Entry::create($data);

                $data['due_date'] = $due_date->copy()->addMonthNoOverflow($i);
            }

            return true;
        }


        // dd($data);
        // Cartão de crédito
        if ($data['type_payment'] === 'credit-card') {
            $credit_card = CreditCard::find($data['payment']);
            $due_date = Carbon::createFromDate(date('Y'), date('m'), $credit_card->due_date);
            $data['credit_card_id'] = $data['payment'] ?? null;
        } else {
            $due_date = Carbon::createFromFormat('d/m/Y', $data['due_date']);
            $data['bank_account_id'] = $data['payment'] ?? null;
        }


        $data['due_date'] = $due_date;
        $data['payday'] = isset($data['payday']) ? Carbon::createFromFormat('d/m/Y', $data['payday']) : null;
        $data['parcel'] = $data['parcel'] ?? 1;
        // dd($data);


        $totalParcel = $data['parcel'];



        // Verifica qtd de parcelas
        if ($totalParcel > 1 && $data['is_recurring'] === false) {

            $amountParcel = round($data['amount'] / $totalParcel, 2);
            $difference = round(($amountParcel * $totalParcel) - $data['amount'], 2);

            for ($i = 1; $i <= $totalParcel; $i++) {
                $data['parcel'] = $i;
                $data['amount'] = $i === (int) $totalParcel ? $amountParcel - $difference : $amountParcel;

                Entry::create($data);

                $data['due_date'] = $due_date->copy()->addMonthNoOverflow($i);

            }

            return true;
        }

        // dd($data);

        // Cria para 1 parcela
        Entry::create($data);

        return true;
    }

    public function getEntries(array $params)
    {
        $type = $params['type'] === 'expense' ? 'expense' : 'income';
        $isDataRange = ($params['period']['end_month'] !== null && $params['period']['end_year'] !== null) ? true : false;

        $query = Entry::with('bank_account', 'category', 'credit_card')
                ->where('type', $type);

        if ($isDataRange) {
            $query->where(function ($query) use ($params) {
                $query->whereMonth('due_date', '>=', $params['period']['start_month'])
                    ->whereMonth('due_date', '<=', $params['period']['end_month']);
            })
            ->where(function ($query) use ($params) {
                $query->whereYear('due_date', '>=', $params['period']['start_year'])
                    ->whereYear('due_date', '<=', $params['period']['end_year']);
            });
        }

        if (! $isDataRange) {
            $query->whereMonth('due_date', $params['period']['start_month'])
                ->whereYear('due_date', $params['period']['start_year']);
        }

        return $query->orderBy('due_date')
                ->get();
    }

    protected function getSequence()
    {
        return Entry::max('sequence');
    }

}
