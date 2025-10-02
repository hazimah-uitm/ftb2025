<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPaymentsNullable extends Migration
{
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->string('payment_type')->nullable()->change();
            $table->date('date')->nullable()->change();
            $table->string('payment_file')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->string('payment_type')->nullable(false)->change();
            $table->date('date')->nullable(false)->change();
            $table->string('payment_file')->nullable(false)->change();
        });
    }
}
