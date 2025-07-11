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
    Schema::create('certificates', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('employee_id');
        $table->enum('type', ['offer', 'appointment']);
        $table->longText('content'); // HTML content
        $table->unsignedBigInteger('generated_by')->nullable();
        $table->timestamps();

        $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        $table->foreign('generated_by')->references('id')->on('users')->onDelete('set null');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
