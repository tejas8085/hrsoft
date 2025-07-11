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
    Schema::table('payrolls', function (Blueprint $table) {
        $table->decimal('professional_tax', 10, 2)->default(0)->after('income_tax');
    });
}

public function down()
{
    Schema::table('payrolls', function (Blueprint $table) {
        $table->dropColumn('professional_tax');
    });
}

};