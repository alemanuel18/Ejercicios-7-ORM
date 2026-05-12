public function up(): void {
    Schema::create('profiles', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
        $table->string('avatar_url')->nullable();
        $table->text('bio')->nullable();
        $table->timestamps();
    });
}
public function down(): void { Schema::dropIfExists('profiles'); }