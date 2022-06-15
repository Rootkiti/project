<?php
$number = 'A-9999';
$prefix = substr($number, 0,-5);
$sfix= (int)substr($number, 2, null);
$sfix = str_pad($sfix,4,0,STR_PAD_LEFT) ;
echo $sfix .'<br>';
echo $prefix .'<br>';
$a = $prefix;
if($sfix == 9999)
{
    $prefix++;
    $sfix = 0001;
    $sfix = str_pad($sfix,4,0,STR_PAD_LEFT) ;
    echo $prefix.'-'.$sfix;

    
}
else
{
    $sfix++;
    echo $prefix.'-'.$sfix;
}

?>