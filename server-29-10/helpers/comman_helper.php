<?php
/**
 * -------------------------------------------------------------------
 * Developed and maintained by Jay
 * -------------------------------------------------------------------
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


if (!function_exists('commanPostArray')) {

    function commanPostArray($action){

    	if($action == 'create'){

            $out['create_by'] 	= login_user;
    		$out['update_by'] 	= 0; 
            $out['create_date'] = date('Y-m-d');
    	} 
    	else{

    		$out['create_by'] = 0; 
    		$out['update_by'] = login_user; 
    		$out['update_date'] = date('Y-m-d');
    	}
    	return $out;
    }

}

