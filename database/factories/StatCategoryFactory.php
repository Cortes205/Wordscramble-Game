<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StatCategory>
 */
class StatCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => $this->faker->word . " " . $this->faker->word,
            "created_at" => Carbon::now("UTC")->format("Y-m-d H:i:s"),
            "updated_at" => Carbon::now("UTC")->format("Y-m-d H:i:s"),
            "active" => 1,
        ];
    }
}
