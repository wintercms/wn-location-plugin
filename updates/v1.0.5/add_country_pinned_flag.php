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

        Country::extend(function ($model) {
            $model->setTable('rainlab_location_countries');
        });

        Country::whereIn('code', ['AU', 'CA', 'GB', 'US'])->update(['is_pinned' => 1]);

        Country::extend(function ($model) {
            $model->setTable('winter_location_countries');
        });
    }

    public function down()
    {
        Schema::table('rainlab_location_countries', function(Blueprint $table) {
            $table->dropColumn('is_pinned');
        });
    }
}
