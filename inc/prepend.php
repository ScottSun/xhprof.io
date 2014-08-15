<?php
// currently not supported
if(php_sapi_name() == 'cli')
{
	return;
}

$post_params = json_decode(file_get_contents('php://input'));
if (!isset($post_params['prof']) || $post_params['prof']) {
    xhprof_enable(XHPROF_FLAGS_MEMORY | XHPROF_FLAGS_CPU);
}

