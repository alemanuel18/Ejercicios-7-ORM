<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// Importamos cada modelo específicamente
use App\Models\User;
use App\Models\Genre;
use App\Models\Artist;
use App\Models\Album;
use App\Models\Song;
use App\Models\Profile;
use App\Models\Subscription;
use App\Models\Listen;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        // 1. Crear Géneros base
        $genreNames = ['Rock', 'Pop', 'Techno', 'Jazz', 'Reggaeton', 'Metal', 'Classical'];
        $genres = collect($genreNames)->map(function ($name) {
            return Genre::create(['name' => $name]);
        });

        // 2. Crear 100 Usuarios con su Perfil y Suscripción (300 registros)
        User::factory(100)->create()->each(function ($user) {
            $user->profile()->create([
                'bio' => 'Melómano de UVG.',
                'avatar_url' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=' . $user->id
            ]);
            
            $user->subscription()->create([
                'plan' => collect(['free', 'premium'])->random(),
                'expires_at' => now()->addMonths(6)
            ]);
        });

        // 3. Crear Artistas, Álbumes y Canciones (Aprox 9,000 registros)
        // 150 artistas * 4 álbumes * 15 canciones = 9,000
        Artist::factory(150)->create()->each(function ($artist) use ($genres) {
            Album::factory(4)->create(['artist_id' => $artist->id])->each(function ($album) use ($genres) {
                Song::factory(15)->create([
                    'album_id' => $album->id,
                    'genre_id' => $genres->random()->id
                ]);
            });
        });

        // 4. Crear Historial de Escucha (700 registros adicionales)
        $users = User::all();
        $songs = Song::all();

        for ($i = 0; $i < 700; $i++) {
            Listen::create([
                'user_id' => $users->random()->id,
                'song_id' => $songs->random()->id,
                'listened_at' => now()->subDays(rand(1, 30))
            ]);
        }

        // 5. Crear Playlists y asignarles canciones
$allSongs = Song::all();

User::all()->take(20)->each(function ($user) use ($allSongs) {
    // Crear 2 playlists por cada uno de estos 20 usuarios
    $user->playlists()->createMany([
        ['name' => 'Mis favoritas de UVG', 'is_public' => true],
        ['name' => 'Para estudiar', 'is_public' => false],
    ])->each(function ($playlist) use ($allSongs) {
        // Asignar entre 5 y 10 canciones aleatorias a cada playlist
        $playlist->songs()->attach(
            $allSongs->random(rand(5, 10))->pluck('id')
        );
    });
});

    }
}