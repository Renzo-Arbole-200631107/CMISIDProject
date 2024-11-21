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
        Schema::create('project_modules', function (Blueprint $table) {
            $table->id('project_module_id');
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->string('module_name');
            $table->string('version_level');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('module_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_modules');
    }
};
