public function up(): void {
    Schema::create('albums', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->year('release_year');
        $table->foreignId('artist_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
}
public function down(): void { Schema::dropIfExists('albums'); }