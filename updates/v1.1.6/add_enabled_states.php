<?php namespace Winter\Location\Updates;

use Schema;
use Winter\Location\Models\Country;
use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Database\Updates\Migration;

class AddEnabledStates extends Migration
{
    public function up()
    {
        Schema::table('rainlab_location_states', function(Blueprint $table) {
            $table->boolean('is_enabled')->after('country_id')->default(true);
        });
    }

    public function down()
    {
        Schema::table('rainlab_location_states', function(Blueprint $table) {
            $table->dropColumn('is_enabled');
        });
    }
}
