public function up(): void {
    Schema::create('playlists', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->boolean('is_public')->default(true);
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
}
public function down(): void { Schema::dropIfExists('playlists'); }