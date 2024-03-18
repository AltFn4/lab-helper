<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('desc')->nullable();
            $table->string('code')->nullable();
            $table->string('link')->nullable();
            $table->foreignId('student_id')->constrained(
                table: 'users',
            )->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('assistant_id')->nullable()->constrained(
                table: 'users',
            )->cascadeOnUpdate()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
