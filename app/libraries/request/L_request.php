<?php defined('BASEPATH') OR exit('No direct script access allowed');

class L_request {

    function jenis_kebutuhan($param)
    {
    	switch ($param) {
    		case '1':
    			return 'Operasioanl Kantor';
    			break;
    		case '2':
    			return 'Perjalanan Dinas';
    			break;
    		case '3':
    			return 'Pribadi';
    			break;
    		default:
    			return 'Uknown';
    			break;
    	}
    }

    function jenis_lokasi($param)
    {
    	switch ($param) {
    		case '1':
    			return 'Internal';
    			break;
    		case '2':
    			return 'External';
    			break;
    		default:
    			return 'Uknown';
    			break;
    	}
    }

    function action($param)
    {
        switch ($param) {
            case '0':
                return '<span class="badge badge-secondary">Request</span>';
                break;
            case '1':
                return '<span class="badge badge-info">Approved</span>';
                break;
            case '2':
                return '<span class="badge badge-danger">Dennied</span>';
                break;
            case '3':
                return '<span class="badge badge-success">Finish</span>';
                break;
            default:
                return 'Uknown';
                break;
        }
    }

}