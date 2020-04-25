<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRaidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raids', function (Blueprint $table) {
            $table->id();
            $table->string('faction');
            $table->string('location');
            $table->text('description');
            $table->text('loot_rules');
            $table->boolean('open')->default(true);
            $table->boolean('soft_reserves')->default(false);
            $table->timestamp('start_at');
            $table->bigInteger('leader_id')->unsigned();
            $table->timestamps();

            $table->foreign('leader_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('raids');
    }
}
