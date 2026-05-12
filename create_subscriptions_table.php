public function up(): void {
    Schema::create('subscriptions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->enum('plan', ['free', 'premium', 'family']);
        $table->date('expires_at')->nullable();
        $table->timestamps();
    });
}
public function down(): void { Schema::dropIfExists('subscriptions'); }