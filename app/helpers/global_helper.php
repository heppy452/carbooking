<?php 
function date_time_now()
{
    date_default_timezone_set('UTC');
    return gmdate('Y-m-d H:i:s', time()+60*60*7);
}

function tanggal($tgl) {
    if($tgl != '0000-00-00' AND $tgl != null){
            $tanggal = substr($tgl, 8, 2);
            $bulan   = bulan(substr($tgl, 5, 2));
            $tahun   = substr($tgl, 0, 4);
            return $tanggal . ' ' . $bulan . ' ' . $tahun;
    }else{
            return '';
    }

}

function getAge($born,$died = null){ 

    if($born == '' || $born == '0000-00-00') return false;

    $birthDt = new DateTime($born);

    if($died){  
        if($died == '' || $died == '0000-00-00') return false;
        $today = new DateTime($died);
    }else{
        $today = new DateTime('today');
    }

    $y = $today->diff($birthDt)->y; 
    $m = $today->diff($birthDt)->m; 
    $d = $today->diff($birthDt)->d;

    $tahun = '';
    $bulan = '';
    $hari  = '';

    if($y!=0) $tahun = $y . " Tahun ";
    if($m!=0) $bulan = $m . " Bulan ";
    if($d!=0) $hari  = $d . " Hari ";

    return $tahun.$bulan.$hari;
}


function bulan($bln) {
    switch ($bln) {
        case 1:
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
}

function getRomawi($int) 
{
     $n = intval($int); $res = '';
     $roman_numerals = array(
        'M'  => 1000,
        'CM' => 900,
        'D'  => 500,
        'CD' => 400,
        'C'  => 100,
        'XC' => 90,
        'L'  => 50,
        'XL' => 40,
        'X'  => 10,
        'IX' => 9,
        'V'  => 5,
        'IV' => 4,
        'I'  => 1);

     foreach ($roman_numerals as $roman => $numeral) 
     {
          $matches = intval($n / $numeral);
          $res    .= str_repeat($roman, $matches);
          $n       = $n % $numeral;
     }
     return $res;
}

function set_null($value)
{
    if($value == '' || empty($value)){
        return NULL;
    }else{
        return $value;
    }
}

function dateDB($date) {
    if($date == "" OR $date == null){
        return null;
    }else{
        return date("Y-m-d",strtotime($date));
    }
    
}

function dateID($date) {
    if($date == '0000-00-00' || $date == '0000-00-00 00:00:00' || $date == null){
        return '';
    }else{
        return date("d-m-Y",strtotime($date));
    } 
}

function dateTimeID($datetime) {
    if($datetime == '0000-00-00 00:00:00' || $datetime == null){
        return '';
    }else{
        return date("d-m-Y H:i",strtotime($datetime));
    } 
}

function rupiah($angka) {
    $jadi = "Rp." . number_format($angka, 2, ',', '.');
    return $jadi;
}

function clear_upper($str)
{
    return strtoupper(trim($str));
}

function selected($str1,$str2)
{
    if($str1 == $str2){
        return "selected=''";
    }
}

function isDate($date)
{
    $regex = preg_match("/^\s*(3[01]|[12][0-9]|0?[1-9])\-(1[012]|0?[1-9])\-((?:19|20)\d{2})\s*$/", $date);
    return $regex; 
}

function cleanString($string) { 
   return preg_replace('/[^a-zA-Z0-9 ]/', '', $string); // Removes special chars.
}

?>