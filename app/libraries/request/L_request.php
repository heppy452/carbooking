<?php defined('BASEPATH') OR exit('No direct script access allowed');

class L_request {

    function jenis_kebutuhan($param)
    {
    	switch ($param) {
    		case '1':
    			return 'Operasioanl Kantor';
    			break;
    		case '2':
    			return 'Kebutuhan Pribadi';
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

    function approve($param)
    {
        switch ($param) {
            case '0':
                return '<span class="badge badge-secondary">Request</span>';
                break;
            case '1':
                return '<span class="badge badge-success">Approved</span>';
                break;
            case '2':
                return '<span class="badge badge-danger">Denied</span>';
                break;
            default:
                return 'Uknown';
                break;
        }
    }

    function status($param)
    {
        switch ($param) {
            case '0':
                return '<span class="badge badge-secondary">Request</span>';
                break;
            case '1':
                return '<span class="badge badge-info">On Progress</span>';
                break;
            case '2':
                return '<span class="badge badge-warning">Denied</span>';
                break;
            case '3':
                return '<span class="badge badge-success">Finished</span>';
                break;
            case '4':
                return '<span class="badge badge-danger">Cancel</span>';
                break;
            default:
                return 'Uknown';
                break;
        }
    }

    function jenis_mobil($param)
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