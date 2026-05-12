public function up(): void {
    Schema::create('artists', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('country')->nullable();
        $table->timestamps();
    });
}
public function down(): void { Schema::dropIfExists('artists'); }