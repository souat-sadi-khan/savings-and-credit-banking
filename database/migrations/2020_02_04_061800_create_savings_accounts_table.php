<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSavingsAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('savings_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid')->nullable();
            $table->string('prefix')->nullable();
            $table->integer('code')->nullable();
            $table->unsignedBigInteger('member_id')->nullable();
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->string('nomenee_name')->nullable();
            $table->string('nomenee_fathers_name')->nullable();
            $table->string('nomenee_husbands_name')->nullable();
            $table->string('nomenee_present_address')->nullable();
            $table->string('nomenee_permanent_address')->nullable();
            $table->string('nomenee_age')->nullable();
            $table->string('nomenee_relation_with_member')->nullable();

            $table->string('identifier_name')->nullable();
            $table->string('identifier_fathers_name')->nullable();
            $table->string('identifier_husbands_name')->nullable();
            $table->string('identifier_present_address')->nullable();
            $table->string('identifier_permanent_address')->nullable();
            $table->string('identifier_age')->nullable();

            $table->string('created_by')->nullable();
            $table->string('verified_by')->nullable();
            $table->string('approved_by')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('savings_accounts');
    }
}
