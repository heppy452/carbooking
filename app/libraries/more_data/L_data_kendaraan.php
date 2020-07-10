<?php defined('BASEPATH') OR exit('No direct script access allowed');

class L_data_kendaraan {

    function type_kendaraan($param)
    {
    	switch ($param) {
    		case '1':
    			return 'Avanza';
    			break;
    		case '2':
    			return 'Xenia';
    			break;
    		case '3':
    			return 'Hilux';
    			break;
    		case '4':
    			return 'Panther';
    			break;
            case '5':
                return 'Innova';
                break;
            case '6':
                return 'Hino';
                break;
            case '7':
                return 'Izusu';
                break;
    		default:
    			return 'Uknown';
    			break;
    	}
    }

}