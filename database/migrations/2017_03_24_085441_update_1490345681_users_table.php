<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1490345681UsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('door_key_id')->unsigned()->nullable();
                $table->foreign('door_key_id', 'fk_24726_door_door_key_id_user')->references('id')->on('doors')->onDelete('cascade');
                
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('fk_24726_door_door_key_id_user');
            $table->dropIndex('fk_24726_door_door_key_id_user');
            $table->dropColumn('door_key_id');
            
        });

    }
}
