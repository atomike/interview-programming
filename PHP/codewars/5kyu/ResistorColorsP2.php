<?php
//Kata https://www.codewars.com/kata/5855777bb45c01bada0002ac/solutions/php

function number_to_color($num):string
{
    $color = ["black", "brown", "red", "orange", "yellow", "green", "blue", "violet", "gray", "white"];
    return $color[$num];
}

function suffix_to_color($resistance, $suffix):string
{
    if ($resistance<10) {
        //4.7k 1k
        if ($suffix=="k") {
            return "red";
        } elseif ($suffix=="M") {
            return "green";
        }
    } elseif ($resistance<100) {
        //47k 47M, there are no decimals here
        if ($suffix=="k") {
            return "orange";
        } elseif ($suffix=="M") {
            return "blue";
        }
    } else {
        //100k 470k, there are no decimals here
        if ($suffix=="k") {
            return "yellow";
        } elseif ($suffix=="M") {
            return "violet";
        }
    }
}

function resistance_to_color_code(string $resistance)
{
    preg_match("/[kM]/", $resistance, $matches);
    $resistance_is_decimal = strpos($resistance, ".")!==false;
    $suffix = $matches[0];
  
    $res_arr = str_split(preg_replace("/[kM]/", "", $resistance));
  
    $resistance_code = [];
    if ($resistance_is_decimal) {
        //Decimal resistance with suffix, i.e. 4.7k
        $resistance_code[]=number_to_color($res_arr[0]);
        $resistance_code[]=number_to_color($res_arr[2]); //$res_arr[1] is the period
        $resistance_code[]=suffix_to_color(floatval($resistance), $suffix);
    } else {
        if ($suffix !== null) {
            //No Decimal with suffix, i.e. 1K 47K 100K
            $resistance_code[]=number_to_color($res_arr[0]);
            if (count($res_arr)==1) {
                $resistance_code[]="black";
            } elseif (count($res_arr)>=2) {
                $resistance_code[]=number_to_color($res_arr[1]);
            }
            $resistance_code[]=suffix_to_color(floatval($resistance), $suffix);
        } else {
            //No Decimal without suffix, i.e. 10 100 470
            $resistance_code[]=number_to_color($res_arr[0]);
            $resistance_code[]=number_to_color($res_arr[1]);
            $resistance_code[]= ($res_arr[2]==null)?"black":"brown";
        }
    }
  
    return implode(" ", $resistance_code) . " gold";
}

function encodeResistorColors($ohmsString)
{
    $resistor = explode(" ", $ohmsString);
    $resistance = $resistor[0];
  
    return resistance_to_color_code($resistance);
}
