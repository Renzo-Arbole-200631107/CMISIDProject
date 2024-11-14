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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->string('description', 500)->nullable();
            $table->foreignId('office_id')->constrained('offices')->cascadeOnDelete(); //office_name
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); //developer name
            $table->date('start_sad')->nullable();
            $table->date('start_dev')->nullable();
            $table->date('estimate_deployment')->nullable();
            $table->date('deployment_date')->nullable();
            $table->string('version')->nullable();
            $table->string('status')->nullable();
            $table->string('link')->nullable();
            $table->string('attachment')->nullable();

            $table->string('dev_remarks')->nullable();
            $table->string('google_remarks')->nullable();
            $table->string('seo_comments')->nullable();
            $table->string('dpa_remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
