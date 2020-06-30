<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');  
 
require_once "Excel_xml/php-excel.class.php";
 
class ExcelXml extends Excel_xml {
    public function __construct() {
        parent::__construct();
    }
}
?>