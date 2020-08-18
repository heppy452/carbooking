<?php defined('BASEPATH') or exit('No direct script access allowed');

class L_data_lokasi
{

    function kategori_lokasi($data)
    {
        switch ($data) {
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
}
