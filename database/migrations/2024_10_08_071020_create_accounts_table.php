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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password')->default('cmisid');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name');
            $table->smallInteger('is_admin')->default(0); //user role: 1 for project manager, 0 for devs
            $table->integer('is_active')->default(1); //1 is active, 0 is not
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};