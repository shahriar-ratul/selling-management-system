<?php
/**
*  Function:   convert_number
*
*  Description:
*  Converts a given integer (in range [0..1T-1], inclusive) into
*  alphabetical format ("one", "two", etc.)
*
*  @int
*
*  @return string
*
*/
class money_convert{

    function convert_number($number)
    {
        $my_number = $number;

        if (($number < 0) || ($number > 999999999))
        {
        throw new Exception("Number is out of range");
        }
        $Kt = floor($number / 10000000); /* Koti */
        $number -= $Kt * 10000000;
        $Gn = floor($number / 100000);  /* lakh  */
        $number -= $Gn * 100000;
        $kn = floor($number / 1000);     /* Thousands (kilo) */
        $number -= $kn * 1000;
        $Hn = floor($number / 100);      /* Hundreds (hecto) */
        $number -= $Hn * 100;
        $Dn = floor($number / 10);       /* Tens (deca) */
        $n = $number % 10;               /* Ones */

        $res = "";

        if ($Kt)
        {
            $res .= convert_number($Kt) . " Crore ";
        }
        if ($Gn)
        {
            $res .= convert_number($Gn) . " Lakh";
        }

        if ($kn)
        {
            $res .= (empty($res) ? "" : " ") .
                convert_number($kn) . " Thousand";
        }

        if ($Hn)
        {
            $res .= (empty($res) ? "" : " ") .
                convert_number($Hn) . " Hundred";
        }

        $ones = array("", "One", "Two", "Three", "Four", "Five", "Six",
            "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen",
            "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen",
            "Nineteen");
        $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty",
            "Seventy", "Eigthy", "Ninety");

        if ($Dn || $n)
        {
            if (!empty($res))
            {
                $res .= " and ";
            }

            if ($Dn < 2)
            {
                $res .= $ones[$Dn * 10 + $n];
            }
            else
            {
                $res .= $tens[$Dn];

                if ($n)
                {
                    $res .= "-" . $ones[$n];
                }
            }
        }

        if (empty($res))
        {
            $res = "zero";
        }

        return $res;


    }
}

$cheque_amt = 87474840;
try
    {
    echo $cheque_amt ." = ". convert_number($cheque_amt);
    }
catch(Exception $e)
    {
    echo $e->getMessage();
    }


?>