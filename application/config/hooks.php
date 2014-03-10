<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
*/

$config['system_hooks'] = array(
		"pre_menu_generate", // Before the html menu gets generated (params: $menu_manager)
		"post_menu_generate" // After the html gets generated (params: $html)
);

/* End of file hooks.php */
/* Location: ./application/config/hooks.php */