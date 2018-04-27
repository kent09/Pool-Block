<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropTimestampUtcToNewThirties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('new_thirties', function (Blueprint $table) {
            $table->dropColumn('timestamps_utc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('new_thirties', function (Blueprint $table) {
            $table->integer('timestamps_utc');
        });
    }
}
