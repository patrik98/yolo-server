<?php

namespace Database\Factories;

use App\Models\ViewType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ViewTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ViewType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name
        ];
    }
}
