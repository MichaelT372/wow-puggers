<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRaidSignupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raid_signups', function (Blueprint $table) {
            $table->id();
            $table->string('character_name');
            $table->string('class');
            $table->string('spec');
            $table->string('soft_reserve')->nullable();
            $table->boolean('douse')->default(false)->nullable();
            $table->text('note')->nullable();
            $table->boolean('confirmed')->default(false);
            $table->bigInteger('raid_id')->unsigned();
            $table->timestamps();

            $table->foreign('raid_id')
                ->references('id')
                ->on('raids')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('raid_signups');
    }
}
