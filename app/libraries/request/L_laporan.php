<?php defined('BASEPATH') OR exit('No direct script access allowed');

class L_laporan {

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

}