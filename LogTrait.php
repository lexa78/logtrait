<?php
namespace App\Traits;


use Illuminate\Support\Facades\Log;

trait LogTrait {
    public static function boot()
    {
        parent::boot();

        static::updating(function($model)
        {
            $str = '';
            foreach ($model->getDirty() as $fieldName => $newValue) {
                $str .= $fieldName.' was '.$model->original[$fieldName].' changed to '.$newValue.PHP_EOL;
            }
            $message = 'table '.$model->table.' changes:'.PHP_EOL.$str;
            Log::info($message);
        });
    }
}