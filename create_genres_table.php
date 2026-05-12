public function up(): void {
    Schema::create('genres', function (Blueprint $table) {
        $table->id();
        $table->string('name')->unique();
        $table->timestamps();
    });
}
public function down(): void { Schema::dropIfExists('genres'); }