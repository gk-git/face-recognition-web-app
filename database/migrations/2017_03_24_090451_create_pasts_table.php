<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('pasts')) {
            Schema::create('pasts', function (Blueprint $table) {
                $table->increments('id');
                $table->string('action')->nullable();
                $table->string('name')->nullable();
                $table->integer('door_id')->unsigned()->nullable();
                $table->foreign('door_id', 'fk_24726_door_door_id_past')->references('id')->on('doors')->onDelete('cascade');
                $table->tinyInteger('intruder')->nullable()->default(1);
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', 'fk_24724_user_user_id_past')->references('id')->on('users')->onDelete('cascade');
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pasts');
    }
}
