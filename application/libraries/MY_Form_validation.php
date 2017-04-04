<?php
class MY_Form_validation extends CI_Form_validation
{



public function valida_url($url){

    if(filter_var($url, FILTER_VALIDATE_URL))

    {

        return true;

    }else

    {

        return false;

    }

}
public function validaSelect($valor)
{
    if($valor==0)
    {
        return false;
    }else
    {
        return true;
    }
}

public function validaSelectTexto($valor)
{
    if($valor== null)
    {
        return false;
    }else
    {
        return true;
    }
}
	
    
}
