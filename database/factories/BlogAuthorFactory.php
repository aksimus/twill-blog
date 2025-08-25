<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogAuthor>
 */
class BlogAuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $firstName = $this->faker->firstName();
        $lastName = $this->faker->lastName();
        $fullName = $firstName . ' ' . $lastName;
        
        return [
            'published' => true,
            'position' => $this->faker->numberBetween(1, 100),
            'email' => $this->faker->unique()->safeEmail(),
            'website' => $this->faker->optional()->url(),
            'twitter' => $this->faker->optional()->userName(),
            'linkedin' => $this->faker->optional()->userName(),
            'github' => $this->faker->optional()->userName(),
            'avatar' => null,
        ];
    }

    /**
     * Indicate that the author is unpublished.
     */
    public function unpublished(): static
    {
        return $this->state(fn (array $attributes) => [
            'published' => false,
        ]);
    }

    /**
     * Indicate that the author is a developer.
     */
    public function developer(): static
    {
        return $this->state(fn (array $attributes) => [
            'github' => $this->faker->userName(),
            'website' => $this->faker->url(),
        ]);
    }

    /**
     * Indicate that the author is a business professional.
     */
    public function business(): static
    {
        return $this->state(fn (array $attributes) => [
            'linkedin' => $this->faker->userName(),
            'website' => $this->faker->url(),
        ]);
    }
}
