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
        Schema::create('project_manager_teams', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('project_manager_id'); // user_id of PM
    $table->unsignedBigInteger('employee_id'); // user_id of employee
    $table->timestamps();

    $table->foreign('project_manager_id')->references('id')->on('users')->onDelete('cascade');
    $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_manager_teams');
    }
};
