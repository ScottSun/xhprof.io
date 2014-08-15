<?php
// CLI environment is currently not supported
if(php_sapi_name() == 'cli')
{
	return;
}

if (!isset($post_params['prof']) || $post_params['prof']) {
    register_shutdown_function(function(){
        // by registering register_shutdown_function at the end of the file
        // I make sure that all execution data, including that of the earlier
        // registered register_shutdown_function, is collected.

        $xhprof_data	= xhprof_disable();

        if(function_exists('fastcgi_finish_request'))
        {
            fastcgi_finish_request();
        }

        if ($_SERVER['HTTP_HOST'] == 'dw-dev.socialgamenet.com'
            && (substr($_SERVER['REQUEST_URI'], 1, 4) == 'api')) {
            // xhprof
            $XHPROF_ROOT = '/sgn/htdocs/dev-dw/dragon-server-code/docroot/xhprof/';
            include_once $XHPROF_ROOT . "/xhprof_lib/utils/xhprof_lib.php";
            include_once $XHPROF_ROOT . "/xhprof_lib/utils/xhprof_runs.php";
            $xhprof_runs = new XHProfRuns_Default();
            global $run_id;
            $run_id = $xhprof_runs->save_run($xhprof_data, "xhprof_dw_dev");

            // xhprof.io
            $config			= require __DIR__ . '/../xhprof/includes/config.inc.php';
            require_once __DIR__ . '/../xhprof/classes/data.php';
            $xhprof_data_obj	= new \ay\xhprof\Data($config['pdo']);
            $xhprof_data_obj->save($xhprof_data);

        }
        
    });
}
