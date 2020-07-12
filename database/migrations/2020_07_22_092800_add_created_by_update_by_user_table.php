<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreatedByUpdateByUserTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('created_by')->unsigned()->nullable(true)->default(null);
            $table->bigInteger('updated_by')->unsigned()->nullable(true)->default(null);
            $table->foreign('created_by','user_FK_1')->references('id')->on('users');
            $table->foreign('updated_by','user_FK_2')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['user_FK_1']);
            $table->dropForeign(['user_FK_2']);
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
        });
    }

}
