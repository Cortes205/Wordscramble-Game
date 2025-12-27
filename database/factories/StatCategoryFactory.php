<?php
/**
 * Factory for Stat Category creation
 * 
 * @author      Alan Cortes
 * @version     1.0.0
 */

namespace Database\Factories;

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
            "created_at" => (new \DateTime())->format("Y-m-d H:i:s"),
            "updated_at" => (new \DateTime())->format("Y-m-d H:i:s"),
            "active" => 1,
        ];
    }
}
