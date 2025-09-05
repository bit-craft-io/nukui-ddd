<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';


// @note xhprof を入れれず
//$xhprof_data = xhprof_disable();

//$XHPROF_ROOT = __DIR__.'/../';
//include_once $XHPROF_ROOT . "xhprof_lib/config.php";
//include_once $XHPROF_ROOT . "xhprof_lib/utils/xhprof_lib.php";
//include_once $XHPROF_ROOT . "xhprof_lib/utils/xhprof_runs.php";

// TODO 20250312
//function __xhprof_save() {
//    $data = xhprof_disable();
////    /** @var AppLibXHProfRuns $runs */
////    $runs = app(XHProfRuns_Default::class);
//    $runs = new XHProfRuns_Default();
//    $runs->save_run($data, config('app.name'));
//}
//xhprof_enable();

// Bootstrap Laravel and handle the request...
(require_once __DIR__.'/../bootstrap/app.php')
    ->handleRequest(Request::capture());

// TODO 20250312
//register_shutdown_function('__xhprof_save');
