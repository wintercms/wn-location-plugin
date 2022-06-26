<?php namespace Winter\Location\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class RenameTables extends Migration
{
    const TABLES = [
        'countries',
        'states',
    ];

    public function up()
    {
        foreach (self::TABLES as $table) {
            $from = 'rainlab_location_' . $table;
            $to   = 'winter_location_' . $table;
            if (Schema::hasTable($from) && !Schema::hasTable($to)) {
                Schema::rename($from, $to);
            }
        }
    }

    public function down()
    {
        foreach (self::TABLES as $table) {
            $from = 'winter_location_' . $table;
            $to   = 'rainlab_location_' . $table;
            if (Schema::hasTable($from) && !Schema::hasTable($to)) {
                Schema::rename($from, $to);
            }
        }
    }
}
