<?php
// currently not supported
if(php_sapi_name() == 'cli')
{
	return;
}

$post_params = json_decode(file_get_contents('php://input'), TRUE);
if ($_SERVER['HTTP_HOST'] == 'dw-dev.socialgamenet.com'
            && substr($_SERVER['REQUEST_URI'], 1, 3) == 'api'
            && (!isset($post_params['prof']) || $post_params['prof'])) {
    xhprof_enable(XHPROF_FLAGS_MEMORY | XHPROF_FLAGS_CPU);
}

