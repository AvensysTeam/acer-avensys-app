<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMonitoringColumnInSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitoring', function (Blueprint $table) {
            $table->id();
            $table->boolean('monitor_new_user')->default(true);
            $table->boolean('monitor_logged_in_user')->default(true);
            $table->integer('new_user_monitoring_level')->default(1)->comment('email => 0,sma => 1,both => 2');
            $table->integer('logged_in_monitoring_level')->default(1)->comment('email => 0,sma => 1,both => 2');
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
        Schema::dropIfExists('monitoring');
    }
}
