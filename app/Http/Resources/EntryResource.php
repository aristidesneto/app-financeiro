<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EntryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'title' => $this->title,
            'amount' => $this->amount,
            'parcel' => $this->parcel,
            'total_parcel' => $this->total_parcel,
            'due_date' => $this->due_date,
            'payday' => is_null($this->payday) ? null : $this->payday,
            'is_recurring' => $this->is_recurring,
            'start_date' => is_null($this->start_date) ? null : $this->start_date,
            'sequence' => $this->sequence,
            'user' => new UserResource($this->user),
            'bank_account' => new BankAccountResource($this->bank_account),
            'category' => new CategoryResource($this->category),
            'credit_card' => new CreditCardResource($this->credit_card)
        ];
    }
}
