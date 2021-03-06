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
            'user_id' => $this->user_id,
            'type' => $this->type,
            'title' => $this->title,
            'amount' => number_format($this->amount, 2, ',', '.'),
            'parcel' => $this->parcel,
            'total_parcel' => $this->total_parcel,
            'due_date' => $this->due_date->format('d/m/Y'),
            'payday' => is_null($this->payday) ? null : $this->payday->format('d/m/Y'),
            'is_recurring' => $this->is_recurring,
            'start_date' => is_null($this->start_date) ? null : $this->start_date->format('d/m/Y'),
            'sequence' => $this->sequence,
            'category' => new CategoryResource($this->category),
            'credit_card' => new CreditCardResource($this->credit_card)
        ];
    }
}
