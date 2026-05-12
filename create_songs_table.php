public function up(): void
{
    Schema::create('songs', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->integer('duration_seconds');
        $table->foreignId('album_id')->constrained()->onDelete('cascade');
        $table->foreignId('genre_id')->constrained();
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('songs');
}