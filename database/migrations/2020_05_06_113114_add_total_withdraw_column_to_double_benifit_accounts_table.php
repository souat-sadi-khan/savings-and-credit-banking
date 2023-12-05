<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTotalWithdrawColumnToDoubleBenifitAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('double_benifit_accounts', function (Blueprint $table) {
            $table->string('total_withdraw')->after('completion_date')->nullable();
            // $table->foreign('sundry_id')->references('id')->on('sundries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('double_benifit_accounts', function (Blueprint $table) {
        });
    }
}
