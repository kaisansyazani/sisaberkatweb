<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('wastes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('waste_type_id')->constrained()->onDelete('cascade');
        $table->float('weight');
        $table->decimal('price', 10, 2);
        $table->string('food_quality', 255)->nullable(); // or ->nullable(false) if required
        $table->text('description')->nullable();
        $table->string('image', 255)->nullable();
        $table->string('status')->default('posted'); // e.g., posted, collected
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wastes');
    }
};
