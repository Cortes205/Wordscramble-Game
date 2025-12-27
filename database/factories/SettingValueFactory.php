<?php
/**
 * Factory for Setting Value creation
 * 
 * @author      Alan Cortes
 * @version     1.0.0
 */
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SettingValue>
 */
class SettingValueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "created_at" => (new \DateTime())->format("Y-m-d H:i:s"),
            "updated_at" => (new \DateTime())->format("Y-m-d H:i:s"),
        ];
    }
}
