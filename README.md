# 🎵 Music Streaming Management System (Laravel + Docker)

Este proyecto es una implementación de un sistema de gestión de música desarrollado para el laboratorio de Bases de Datos. Utiliza **Laravel 11**, **PostgreSQL 15** y **Docker** para garantizar un entorno de desarrollo aislado y reproducible.

## 🚀 Requisitos Previos

Antes de comenzar, asegúrate de tener instalado en tu sistema (Fedora u otro):
- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/)

---

## 🛠️ Guía de Instalación y Ejecución

Sigue estos pasos en orden para levantar el entorno desde cero:

### 1. Clonar y configurar el entorno
Copia el archivo de ejemplo de variables de entorno:
```
cp .env.example .env
```
### 2. Levantar Contenedores

Construye la imagen de la aplicación e inicia los servicios de PHP y PostgreSQL:
```
docker-compose up -d --build
```
### 3. Instalar Dependencias (Composer)

Instala las librerías necesarias de Laravel dentro del contenedor:
```
docker-compose exec app composer install
```
### 4. Configuración Final de Laravel

Genera la clave de la aplicación y prepara la base de datos:
```
docker-compose exec app php artisan key:generate
docker-compose exec app migrate:fresh --seed
```

    Nota: El comando --seed poblará la base de datos con más de 10,000 registros coherentes (Artistas, Álbumes, Canciones, Usuarios, etc.).

## 📊 Modelo de Datos

El sistema consta de 10 tablas interconectadas:

    users: Usuarios de la plataforma.

    profiles: Información extendida (1:1 con User).

    artists: Artistas musicales.

    genres: Categorías (Rock, Pop, etc.).

    albums: Colecciones de canciones (1:N con Artist).

    songs: Pistas individuales (1:N con Album y Genre).

    playlists: Listas creadas por usuarios.

    playlist_song: Tabla pivote (N:N entre Playlist y Song).

    subscriptions: Estado premium de usuarios.

    listens: Historial de reproducciones.

## 🔍 Consultas Eloquent (Demostración)

Para probar las consultas requeridas por el laboratorio, puedes usar Laravel Tinker, una consola interactiva:
```
docker-compose exec app php artisan tinker
```
Dentro de la consola, puedes copiar y pegar estos ejemplos:
### A. Eager Loading (Solución al problema N+1)

Carga 20 álbumes y sus artistas en solo 2 consultas SQL en lugar de 21.
```
$albums = App\Models\Album::with('artist')->take(20)->get();
```
### B. Filtro y Ordenamiento

Canciones de Rock (ID 1) que duran más de 4 minutos, ordenadas alfabéticamente.
```
App\Models\Song::where('genre_id', 1)->where('duration_seconds', '>', 240)->orderBy('title', 'asc')->get();
```
### C. Uso de Relaciones (WhereHas)

Usuarios con suscripción activa de tipo 'premium'.
```
App\Models\User::whereHas('subscription', fn($q) => $q->where('plan', 'premium'))->get();
```
### 4.Relación Muchos a Muchos (Playlists)

Obtener todas las canciones que pertenecen a una lista de reproducción específica.
```
$playlist = Playlist::find(1);
$songsInPlaylist = $playlist->songs()->orderBy('duration_seconds', 'desc')->get();
```
### 5. Relación Avanzada (HasManyThrough)

Obtener todas las canciones de un artista específico sin pasar manualmente por la tabla de álbumes.
```
$artist = Artist::find(5);
$allArtistSongs = $artist->songs()->get();
```
📁 Estructura del Proyecto

    app/Models/: Definición de lógica, $fillable, $casts y relaciones.

    database/migrations/: Estructura física de las 10 tablas (métodos up y down).

    database/seeders/: Lógica para la generación masiva de datos.

    Dockerfile & docker-compose.yml: Configuración del entorno de contenedores.