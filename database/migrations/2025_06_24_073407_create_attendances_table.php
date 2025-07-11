<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_attendances_table.php
public function up()
{
    Schema::create('attendances', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->foreignId('employee_id')->constrained()->onDelete('cascade');
        $table->date('attendance_date');
        $table->enum('status', ['Present', 'Absent', 'On Leave']);
        $table->time('in_time')->nullable();
        $table->time('out_time')->nullable();
        $table->timestamps();
    });
}


public function down()
{
    Schema::dropIfExists('attendances');
}

};
