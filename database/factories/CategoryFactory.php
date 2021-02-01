<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types = ['expense', 'income'];

        return [
            'user_id' => '1',
            'name' => $this->faker->name,
            'description' => $this->faker->word(3),
            'color' => '#CCCAEE',
            'type' => Arr::random($types),
        ];
    }
}
