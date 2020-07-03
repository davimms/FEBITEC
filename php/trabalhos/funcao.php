<?php
    function verifica($nivel)
    {
        if($nivel == 'Fundamental' or $nivel == 'Médio')
        {
            return 1;
        }
        else
        {
            return 2;
        }
    }
	
?>