<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStautusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('stautuses')) {
            Schema::create('stautuses', function (Blueprint $table) {
                $table->increments('id');
                $table->tinyInteger('status')->nullable()->default(1);
                $table->tinyInteger('action_open')->nullable()->default(1);
                $table->tinyInteger('action_black')->nullable()->default(1);
                $table->tinyInteger('action_wait')->nullable()->default(1);
                $table->tinyInteger('action_else')->nullable()->default(1);
                $table->integer('door_id')->unsigned()->nullable();
                $table->foreign('door_id', 'fk_24726_door_door_id_stautus')->references('id')->on('doors')->onDelete('cascade');
                
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
        Schema::dropIfExists('stautuses');
    }
}
