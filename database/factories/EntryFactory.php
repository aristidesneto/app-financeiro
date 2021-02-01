<?php

namespace Database\Factories;

use App\Models\Entry;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class EntryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Entry::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types = ['expense', 'income'];

        $due_date = Carbon::now()->addDays(random_int(1,30));

        return [
            'user_id' => '1',
            'category_id' => random_int(1, 10),
            'credit_card_id' => random_int(1, 2),
            'bank_account_id' => random_int(1, 5),
            'type' => Arr::random($types),
            'title' => $this->faker->name,
            'amount' => $this->faker->numberBetween(10, 200),
            'parcel' => 1,
            'due_date' => $due_date,
            'payday' => Carbon::parse($due_date)->addDay(),
            'is_recurring' => false,
            'start_date' => Carbon::now(),
        ];
    }
}
