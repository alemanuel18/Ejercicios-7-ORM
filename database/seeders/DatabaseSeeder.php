<?php

namespace Database\Seeders;

use App\Models.*;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
public function run(): void
{
    // 1. Crear Géneros base
    $genres = ['Rock', 'Pop', 'Techno', 'Jazz', 'Reggaeton', 'Metal', 'Classical'];
    foreach ($genres as $g) {
        \App\Models\Genre::create(['name' => $g]);
    }

    // 2. Crear 100 Usuarios con su Perfil y Suscripción (300 registros)
    \App\Models\User::factory(100)->create()->each(function ($user) {
        $user->profile()->create([
            'bio' => 'Melómano desde el día 1.',
            'avatar_url' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=' . $user->id
        ]);
        
        $user->subscription()->create([
            'plan' => collect(['free', 'premium', 'family'])->random(),
            'expires_at' => now()->addMonths(6)
        ]);
    });

    // 3. Crear Artistas, Álbumes y Canciones (El grueso de los datos)
    // 200 artistas * 5 álbumes * 8 canciones = 8,000 registros de canciones
    \App\Models\Artist::factory(200)->create()->each(function ($artist) {
        \App\Models\Album::factory(5)->create(['artist_id' => $artist->id])->each(function ($album) {
            \App\Models\Song::factory(8)->create([
                'album_id' => $album->id,
                'genre_id' => \App\Models\Genre::all()->random()->id
            ]);
        });
    });

    // 4. Crear Historial de Escucha (Resto de registros para superar los 10,000)
    // Creamos 2,000 registros de historial aleatorios
    $users = \App\Models\User::all();
    $songs = \App\Models\Song::all();

    for ($i = 0; $i < 2000; $i++) {
        \App\Models\Listen::create([
            'user_id' => $users->random()->id,
            'song_id' => $songs->random()->id,
            'listened_at' => now()->subDays(rand(1, 30))
        ]);
    }
}
}