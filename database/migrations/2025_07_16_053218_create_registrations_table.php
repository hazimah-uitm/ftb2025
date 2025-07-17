<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('group_name');
            $table->string('traditional_dance_name');
            $table->string('creative_dance_name');
            $table->string('koreografer_name');
            $table->string('assistant_koreografer_name')->nullable();
            $table->text('address');
            $table->text('sinopsis_traditional');
            $table->text('sinopsis_creative');
            $table->string('fax_no');
            $table->string('doc_link');
            $table->string('status')->default('Submitted & waiting for approval');
            $table->text('remarks_submitter')->nullable();
            $table->unsignedBigInteger('submitted_by')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->text('remarks_checker')->nullable();
            $table->unsignedBigInteger('checked_by')->nullable();
            $table->timestamp('checked_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrations');
    }
}
