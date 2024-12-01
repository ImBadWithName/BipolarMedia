<?php
$a= 12;
$b= 8;
$c= 10;
$d= 3;

if(($a+ $b+ $c+ $d) / 4 > 10  &&
 $a>= 8 && $b>=8 && $c>=8 && $d>=8)
{
    echo 'moyenne : '.($a+ $b+ $c+ $d) / 4 . '<br>';
    echo 'validation du s2';
} else {
    echo 'moyenne : '.($a+ $b+ $c+ $d) / 4 . '<br>';
    echo 'non validation du s2';
    echo 'coucou';
}
$a =2;
$a = $a+1;
$a +=1;