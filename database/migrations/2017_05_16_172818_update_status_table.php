<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('stautuses', function($table) {
            $table->tinyInteger('action')->nullable()->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('stautuses', function($table) {

            if(Schema::hasTable('stautuses')) {
                if (Schema::hasColumn('stautuses', 'action')) {
                    $table->dropColumn('action');

                }
            }
        });
    }
}
