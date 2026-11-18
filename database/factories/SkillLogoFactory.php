<?php

namespace Database\Factories;

use App\Models\SkillLogo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SkillLogo>
 */
class SkillLogoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image_url' => $this->faker->imageUrl(158, 48, 'technics'),
            'alt' => $this->faker->word().' logo',
            'order' => $this->faker->numberBetween(0, 100),
        ];
    }
}
