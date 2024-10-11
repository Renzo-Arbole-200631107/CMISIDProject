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
            $table->string('description', 500);
            $table->string('project_owner');
            $table->foreignId('account_id')->constrained('accounts')->cascadeOnDelete();
            $table->string('developer_name');
            $table->string('designation');
            $table->date('estimate_deployment');
            $table->date('deployment_date');
            $table->string('version');
            $table->string('status');
            $table->string('link');
            $table->string('attachment');
            $table->string('dev_remarks');
            $table->string('google_remarks');
            $table->string('seo_comments');
            $table->string('dpa_remarks');
            $table->string('remarks');
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
