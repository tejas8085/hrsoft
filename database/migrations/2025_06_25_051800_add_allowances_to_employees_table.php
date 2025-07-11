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
    Schema::table('employees', function (Blueprint $table) {
        $table->decimal('incentives', 10, 2)->default(0)->after('salary');
        $table->decimal('bonus', 10, 2)->default(0)->after('incentives');
        $table->decimal('city_allowance', 10, 2)->default(0)->after('bonus');
    });
}

public function down()
{
    Schema::table('employees', function (Blueprint $table) {
        $table->dropColumn(['incentives', 'bonus', 'city_allowance']);
    });
}

};