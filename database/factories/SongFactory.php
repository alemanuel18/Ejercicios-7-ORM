<?php

namespace Database\Factories;

use App\Models\Album;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

class SongFactory extends Factory
{
public function definition(): array {
    return [
        'title' => $this->faker->sentence(3),
        'duration_seconds' => $this->faker->numberBetween(120, 400),
        'album_id' => Album::factory(), // Crea un álbum si no existe
        'genre_id' => Genre::all()->random()->id,
    ];
}
}