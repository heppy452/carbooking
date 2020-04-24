<?php defined('BASEPATH') OR exit('No direct script access allowed');

class L_data_user {

    function level($data)
    {
    	switch ($data) {
    		case '4':
    			return 'Supervisor';
    			break;
    		case '5':
    			return 'Admin';
    			break;
    		default:
    			return 'Uknown';
    			break;
    	}
    }

    function status($data)
    {
    	switch ($data) {
    		case '1':
    			return 'Aktif';
    			break;
    		case '2':
    			return 'Nonaktif';
    			break;
    		default:
    			return 'Uknown';
    			break;
    	}
    }

}