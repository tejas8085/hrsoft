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
    Schema::table('users', function (Blueprint $table) {
        $table->unsignedBigInteger('employee_id')->nullable()->after('role');
        // Optionally add foreign key constraint:
        // $table->foreign('employee_id')->references('id')->on('employees')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('employee_id');
    });
}

};
