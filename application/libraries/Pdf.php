<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');
 // Incluimos el archivo fpdf
    require_once dirname(__FILE__) . '/fpdf/tcpdf.php';
 
    //Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
class Pdf extends TCPDF
{
    function __construct()
    {
        parent::__construct();
    }
}