<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stat>
 */
class StatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statName = $this->faker->word;
        $statInfo = $this->faker->words(4, true);

        return [
            "info_json" => json_encode("\"$statName\": \"$statInfo\""),
            "created_at" => Carbon::now("UTC")->format("Y-m-d H:i:s"),
            "updated_at"=> Carbon::now("UTC")->format("Y-m-d H:i:s"),
            "active" => 1,
        ];
    }
}
