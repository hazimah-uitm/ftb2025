<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeDocLinkNullableOnRegistrationsTable extends Migration
{
    public function up()
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->string('doc_link', 255)->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->string('doc_link', 255)->nullable(false)->change();
        });
    }
}
