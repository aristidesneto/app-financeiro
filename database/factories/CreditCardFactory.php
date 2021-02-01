<?php

namespace Database\Factories;

use App\Models\CreditCard;
use Illuminate\Database\Eloquent\Factories\Factory;

class CreditCardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CreditCard::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $due_data = $this->faker->numberBetween(1, 28);

        return [
            'user_id' => '1',
            'name' => $this->faker->name,
            'number' => $this->faker->numberBetween(1000, 9999),
            'best_date' => $due_data - 7,
            'due_date' => $due_data,
            'limit' => $this->faker->numberBetween(100, 10000),
        ];
    }
}
