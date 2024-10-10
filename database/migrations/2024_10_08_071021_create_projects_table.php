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
            $table->string('project_title');
            $table->string('description');
            $table->foreignId('account_id')->constrained('accounts')->cascadeOnDelete();
            $table->string('designation');
            $table->date('estimated_deployment');
            $table->date('deployment');
            $table->string('version');
            $table->string('status');
            $table->string('link');

            $table->string('developer_remarks');
            $table->string('google_analytics');
            $table->string('seo_comments');
            $table->string('dpa_compliance');
            $table->foreignId('office_id')->constrained('offices')->cascadeOnDelete();
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
