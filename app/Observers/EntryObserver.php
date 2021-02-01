<?php

namespace App\Observers;

use App\Models\Entry;

class EntryObserver
{
    public function creating(Entry $entry)
    {
        $entry->user_id = auth()->user()->id;
    }
}
