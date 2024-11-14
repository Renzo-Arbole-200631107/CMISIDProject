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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password')->default(Hash::make('cmisid'));
            $table->boolean('password_changed')->default(false);
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->integer('is_active')->default(1); //1 is active, 0 is not
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
