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
        Schema::table('employees', function (Blueprint $table) {
            //
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('uan')->nullable();
            $table->string('pf')->nullable();
            $table->string('pan')->nullable();
            $table->date('dob')->nullable();
            $table->string('esic')->nullable();
            $table->text('paddress')->nullable();
            $table->text('caddress')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn([
                'mobile', 'email', 'uan', 'pf', 'pan', 'dob', 'esic', 'paddress', 'caddress'
            ]);
        });
    }

};
