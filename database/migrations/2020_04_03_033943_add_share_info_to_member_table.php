<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShareInfoToMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->string('prefix_share')->after('approved_date')->nullable();
            $table->string('code_share')->after('prefix_share')->nullable();
            $table->unsignedBigInteger('share_type_id')->after('code_share')->nullable();
            $table->foreign('share_type_id')->references('id')->on('share_types')->onDelete('cascade');
            $table->string('share_rate')->after('share_type_id')->nullable();
            $table->string('interest_intervel')->after('share_rate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('members', function (Blueprint $table) {
            //
        });
    }
}
