public function up(): void {
    Schema::create('playlist_song', function (Blueprint $table) {
        $table->id();
        $table->foreignId('playlist_id')->constrained()->onDelete('cascade');
        $table->foreignId('song_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
}
public function down(): void { Schema::dropIfExists('playlist_song'); }