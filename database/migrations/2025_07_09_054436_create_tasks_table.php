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
       Schema::create('tasks', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('assigned_by'); // PM user_id
    $table->unsignedBigInteger('assigned_to'); // Employee user_id
    $table->string('title');
    $table->text('description')->nullable();
    $table->enum('status', ['Pending', 'In Progress', 'Completed'])->default('Pending');
    $table->date('due_date')->nullable();
    $table->timestamps();

    $table->foreign('assigned_by')->references('id')->on('users')->onDelete('cascade');
    $table->foreign('assigned_to')->references('id')->on('users')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
