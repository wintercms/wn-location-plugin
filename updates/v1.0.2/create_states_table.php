<?php namespace Winter\Location\Updates;

use Schema;
use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Database\Updates\Migration;

class CreateStatesTable extends Migration
{

    public function up()
    {
        /*
         * The states table was previously owned by Winter.User
         * so this occurance is detected and the table renamed.
         * @deprecated Safe to remove if year >= 2017
         */
        if (Schema::hasTable('winter_user_states')) {
            Schema::rename('winter_user_states', 'winter_location_states');
            return;
        }

        Schema::create('winter_location_states', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('country_id')->unsigned()->index();
            $table->string('name')->index();
            $table->string('code');
        });
    }

    public function down()
    {
        Schema::dropIfExists('winter_location_states');
    }

}
