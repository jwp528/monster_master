<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBattleStatsToCruds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cruds', function (Blueprint $table) {
            $table->text('description');
            $table->integer('hp');
            $table->integer('atk');
            $table->integer('def');
        });//end additional cruds
    }//end up

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cruds', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('hp');
            $table->dropColumn('atk');
            $table->dropColumn('def');
        });//end table rollback
    }//end down
}//end migration
