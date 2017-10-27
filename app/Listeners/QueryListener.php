<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Events\QueryExecuted;

class QueryListener
{
    public function handle(QueryExecuted $event)
    {
        if (config('app.debug')) {
            $log = '';
            $sql = $event->sql;
            $bindings = $event->bindings;

            foreach (explode('?', $sql) as $key => $value) {
                if (isset($bindings[$key])) {
                    if (is_numeric($bindings[$key])) {
                        $log .= $value . $bindings[$key];
                    } else {
                        $log .= $value . "'" .$bindings[$key] . "'";
                    }
                } else {
                    $log .= $value;
                }
            }

            Log::info('[' . ($event->time / 1000) . ']:' . $log);
        }
    }
}
