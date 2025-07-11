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
    Schema::table('leave_requests', function (Blueprint $table) {
        $table->unsignedBigInteger('employee_id')->after('id');

        // Optional: add foreign key if `employees` table exists
        $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('leave_requests', function (Blueprint $table) {
        $table->dropForeign(['employee_id']);
        $table->dropColumn('employee_id');
    });
}

};
