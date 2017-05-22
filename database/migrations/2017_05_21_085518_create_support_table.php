<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('supports')) {
            Schema::create('supports', function (Blueprint $table) {
                $table->increments('id');
                $table->string('email');
                $table->longText('message');
                $table->integer('door_id')->unsigned()->nullable();
                $table->foreign('door_id', 'fk_24726_door_door_id_supports')->references('id')->on('doors')->onDelete('cascade');

                $table->timestamps();

            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return voidphp
     */
    public function down()
    {
        Schema::dropIfExists('supports');
    }
}
