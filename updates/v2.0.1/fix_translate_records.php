<?php namespace Winter\Location\Updates;

use Db;
use Schema;
use Winter\Storm\Database\Updates\Migration;

class FixTranslateRecords extends Migration
{
    const MODELS = [
        'Country',
        'State',
    ];

    public function up()
    {
        $this->fix_records('RainLab', 'Winter');
    }

    public function down()
    {
        $this->fix_records('Winter', 'RainLab');
    }

    public function fix_records($from, $to)
    {
        $tables = ['indexes', 'attributes'];

        if (Schema::hasTable('rainlab_translate_indexes')) {
            $tables = preg_filter('/^/', 'rainlab_translate_', $tables);
        } else if (Schema::hasTable('rainlab_translate_indexes')) {
            $tables = preg_filter('/^/', 'rainlab_translate_', $tables);
        } else {
            return;
        }

        foreach ($tables as $table) {
            foreach (self::MODELS as $model) {
                $fromModel = $from . '\\Location\\Models\\' . $model;
                $toModel = $to . '\\Location\\Models\\' . $model;
                Db::table($table)
                    ->where('model_type', $fromModel)
                    ->update(['model_type' => $toModel]);
            }
        }
    }
}
