<?php
/*
   These problems shows the fundamentals of regular expression:
   Namely: matches, grouping, look ahead, and look begind
 */

$r="123 Main Street St. Louisville OH 43071,432 Main Long Road St. Louisville OH 43071,786 High Street Pollocksville NY 56432,54 Holy Grail Street Niagara Town ZP 32908,3200 Main Rd. Bern AE 56210,1 Gordon St. Atlanta RE 13000,10 Pussy Cat Rd. Chicago EX 34342,10 Gordon St. Atlanta RE 13000,58 Gordon Road Atlanta RE 13000,22 Tokyo Av. Tedmondville SW 43098,674 Paris bd. Abbeville AA 45521,10 Surta Alley Goodtown GG 30654,45 Holy Grail Al. Niagara Town ZP 32908,320 Main Al. Bern AE 56210,14 Gordon Park Atlanta RE 13000,100 Pussy Cat Rd. Chicago EX 34342,2 Gordon St. Atlanta RE 13000,5 Gordon Road Atlanta RE 13000,2200 Tokyo Av. Tedmondville SW 43098,67 Paris St. Abbeville AA 45521,11 Surta Avenue Goodtown GG 30654,45 Holy Grail Al. Niagara Town ZP 32918,320 Main Al. Bern AE 56215,14 Gordon Park Atlanta RE 13200,100 Pussy Cat Rd. Chicago EX 34345,2 Gordon St. Atlanta RE 13222,5 Gordon Road Atlanta RE 13001,2200 Tokyo Av. Tedmondville SW 43198,67 Paris St. Abbeville AA 45522,11 Surta Avenue Goodville GG 30655,2222 Tokyo Av. Tedmondville SW 43198,670 Paris St. Abbeville AA 45522,114 Surta Avenue Goodville GG 30655,2 Holy Grail Street Niagara Town ZP 32908,3 Main Rd. Bern AE 56210,77 Gordon St. Atlanta RE 13000";
$zipcode = "RE 13000";

function parseAddresses($r, $zipcode)
{
    //Return house numbers in one array, street addresseses in another
    //matches[0] contains Full Match
    //matches[1] contains the first group match namely (\d+)
    //matches[2] contains the second group match namely ([^,]+)?
    preg_match_all("/(\d+) ([^,]+)? {$zipcode},/", "{$r},", $matches);
    return $matches;
}

var_dump(parseAddresses($r, $zipcode));

// Name Validator
function validate($domain)
{
    $regex = "/(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9](?(?=[a-z0-9]*-[a-z0-9]*)([a-z0-9-]{0,61}[a-z0-9])|([a-z0-9]{0,62}))/i";
    if (strlen($domain) > 253) {
        return false;
    }
    if (substr_count($domain, ".") > 127) {
        return false;
    }
    if (preg_match("/\.\d*$/im", $domain)) {
        return false;
    }

    return ""==preg_replace($regex, "", $domain);
}

var_dump(
    validate("codewars"),
    validate("codewars.com"),
    validate("a.b.c")
);
