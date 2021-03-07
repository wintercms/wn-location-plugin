<?php namespace Winter\Location\Updates;

use Schema;
use Winter\Location\Models\Country;
use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Database\Updates\Migration;

class AddCountryPinnedFlag extends Migration
{
    public function up()
    {
        Schema::table('rainlab_location_countries', function(Blueprint $table) {
            $table->boolean('is_pinned')->default(false);
        });

        Country::whereIn('code', ['AU', 'CA', 'GB', 'US'])->update(['is_pinned' => 1]);
    }

    public function down()
    {
        Schema::table('rainlab_location_countries', function(Blueprint $table) {
            $table->dropColumn('is_pinned');
        });
    }
}
