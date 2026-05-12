<?php

namespace Database\Factories;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Genre>
 */
class GenreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $generos = [
            'Rock', 'Pop', 'Hip Hop', 'Jazz', 'Blues', 
            'Reggaeton', 'Heavy Metal', 'Techno', 'Indie', 
            'Salsa', 'Flamenco', 'Classical', 'Lo-fi'
        ];
        return [
            // Selecciona un género aleatorio de la lista
            'name' => $this->faker->unique()->randomElement($generos),
            
            // Si tu tabla tiene descripción (opcional)
            'description' => $this->faker->sentence(),
            
            // Si usas slugs para las URLs (opcional)
            'slug' => fn (array $attributes) => str($attributes['name'])->slug(),
        ];
    }
}
