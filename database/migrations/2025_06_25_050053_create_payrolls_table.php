// database/migrations/xxxx_xx_xx_create_payrolls_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollsTable extends Migration
{
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->string('month'); // Format: YYYY-MM
            $table->integer('working_days');
            $table->integer('present_days');
            $table->integer('paid_leaves')->default(0);
            $table->decimal('basic_salary', 10, 2);
            $table->decimal('hra', 10, 2)->default(0);
            $table->decimal('pf', 10, 2)->default(0);
            $table->decimal('esic', 10, 2)->default(0);
            $table->decimal('incentives', 10, 2)->default(0);
            $table->decimal('bonus', 10, 2)->default(0);
            $table->decimal('city_allowance', 10, 2)->default(0);
            $table->decimal('labour_welfare_fund', 10, 2)->default(0);
            $table->decimal('income_tax', 10, 2)->default(0);
            $table->decimal('net_salary', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payrolls');
    }
}