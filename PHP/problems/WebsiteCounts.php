<?php

/*
   You are in charge of a display advertising program. Your ads are displayed on websites all over the internet. You have some CSV input data that counts how many times that users have clicked on an ad on each individual domain. Every line consists of a click count and a domain name, like this:

   counts = [ "900,google.com",
   "60,mail.yahoo.com",
   "10,mobile.sports.yahoo.com",
   "40,sports.yahoo.com",
   "300,yahoo.com",
   "10,stackoverflow.com",
   "20,overflow.com",
   "2,en.wikipedia.org",
   "1,m.wikipedia.org",
   "1,mobile.sports",
   "1,google.co.uk"]

   Write a function that takes this input as a parameter and returns a data structure containing the number of clicks that were recorded on each domain AND each subdomain under it. For example, a click on "mail.yahoo.com" counts toward the totals for "mail.yahoo.com", "yahoo.com", and "com". (Subdomains are added to the left of their parent domain. So "mail" and "mail.yahoo" are not valid domains. Note that "mobile.sports" appears as a separate domain near the bottom of the input.)

   Sample output (in any order/format):

   calculateClicksByDomain(counts)
   1340    com
   900    google.com
   10    stackoverflow.com
   20    overflow.com
   410    yahoo.com
   60    mail.yahoo.com
   10    mobile.sports.yahoo.com
   50    sports.yahoo.com
   3    org
   3    wikipedia.org
   2    en.wikipedia.org
   1    m.wikipedia.org
   1    mobile.sports
   1    sports
   1    uk
   1    co.uk
   1    google.co.uk

   n: number of domains in the input
   (subdomains within a domain are constant)
 */

$counts = [
    "900,google.com",
    "60,mail.yahoo.com",
    "10,mobile.sports.yahoo.com",
    "40,sports.yahoo.com",
    "300,yahoo.com",
    "10,stackoverflow.com",
    "20,overflow.com",
    "2,en.wikipedia.org",
    "1,m.wikipedia.org",
    "1,mobile.sports",
    "1,google.co.uk"
];

function endsWith($string, $endString)
{
    $len = strlen($endString);
    if ($len == 0) {
        return true;
    }
    return (substr($string, -$len) === $endString);
}

function getSubdomainCount($subdomain, $countsArray){
    $sum=0;

    foreach($countsArray as $fqdn=>$count){
        if( !endsWith($fqdn, $subdomain) ){
            continue;
        }
        else{
            $sum += $count;
        }
    }

    return $sum;
}

function getSubdomains($domain){
    $subs = explode(".", $domain);
    $subdomains = array( $subs[sizeof($subs)-1] );

    $count=0;
    for($i=sizeof($subs)-2; $i>0; $i--){
        $subdomains[]= $subs[$i] . "." . $subdomains[$count];
        $count++;
    }

    return $subdomains;
}

function clicksByFQDN($counts){
    $clicksByDomain = [];

    foreach($counts as $count){
        $row = explode(",", $count);

        $clicksByDomain[$row[1]] = (int)$row[0];
    }

    return $clicksByDomain;
}

function calculateClicksByDomain($counts){
    /*
       Steps:
       Convert current array into associative array with domain as key and count as value
       Make a copy of the current array
       Get subdomains from each FQDN
       Add missing subdomains to array copy
       Calculate counts for each row based off original array
     */

    //Convert current array into associative array with domain as key and count as value
    $countsArray = clicksByFQDN($counts);
    $subdomainAggregateCountsArray = $countsArray;

    foreach($countsArray as $fqdn=>$count){
        //Get subdomains from each FQDN
        $subdomains = getSubdomains($fqdn);

        //Add missing subdomains to list
        foreach($subdomains as $subdomain){
            if( !isset( $subdomainAggregateCountsArray[$subdomain]) ){
                $subdomainAggregateCountsArray[$subdomain]=NULL;
            }
        }
    }

    //Calculate counts for each row
    foreach($subdomainAggregateCountsArray as $key=>$row){
        $subdomainAggregateCountsArray[$key] = getSubdomainCount($key, $countsArray);
    }

    return $subdomainAggregateCountsArray;
}

var_dump( calculateClicksByDomain($counts) );
?>
