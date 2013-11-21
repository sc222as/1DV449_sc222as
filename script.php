<!DOCTYPE html>
<html>
<head><meta http-equiv="content-type" content="text/html; charset=utf-8"></meta> </head>


<?php

curl_get_cookie("http://vhost3.lnu.se:20080/~1dv449/scrape/check.php"); // vilken URL man ska hämta hem
$data = curl_get_request("http://vhost3.lnu.se:20080/~1dv449/scrape/secure/producenter.php");


$dom = new DOMDocument();

if ($dom->LoadHTML($data)) {
    $xpath = new DOMXPath($dom);
    $items = $xpath->query('/html/body/div[@class = "container"]//a');    

    
    foreach ($items as $name) {
        $id = $name->getAttribute ("href");
        $namn = $name->nodeValue;
        
        $temp = curl_get_request("http://vhost3.lnu.se:20080/~1dv449/scrape/secure/$id");        
        
        $dom = new DOMDocument();
        
        $dom->LoadHTML($temp);
        $xpath = new DOMXPath($dom);
        $homepages = $xpath->query('/html/body/div[@class = "container"]//a');
        foreach ($homepages as $homepage){
        $hemsida = $homepage->nodeValue."<br />";
            }
        $dom = new DOMDocument();
        
        $dom->LoadHTML($temp);
        $xpath = new DOMXPath($dom);
        $locations = $xpath->query('/html/body//p/span[@class = "ort"]');
        foreach ($locations as $location){
        $stad = $location->nodeValue;
        
            }
            $removedChars = array("p","r","o","d","u","c","e","n","t","h","_",".");
            $producentID = str_replace ($removedChars,"", $id);        
        echo "Namn = ".$namn ." <br /> ". "Producent ID = ".$producentID ." <br /> ". "Hemsida = ".$hemsida, $stad ." <br /> "."=====================";     
        
    }

    }
    else {
        die("You have failed!! Feel the shame!");
        }









function curl_get_cookie($url) {

    $foo = curl_init();
    curl_setopt ($foo, CURLOPT_URL, $url); // här hämtar vi sidan
    curl_setopt ($foo, CURLOPT_RETURNTRANSFER, 1); // Säger att sidan inte skall skrivas ut
    curl_setopt($foo, CURLOPT_POST, 1); // Säger att vi ska göra en post
    
    $post_arr = array(
    "username" => "admin",
    "password" => "admin"    
    );                                  //Användarnamn och Lösenord
    
    curl_setopt ($foo, CURLOPT_POSTFIELDS, $post_arr);      // Skriver in användarnamn och lösenord i formuläret
    curl_setopt ($foo, CURLOPT_HEADER, 1);                  //Headerinformation
    //curl_setopt ($foo, CURLINFO_HEADER_OUT, 1);           //Headerinformation
    curl_setopt ($foo, CURLOPT_COOKIEJAR, dirname(__FILE__) ."/kaka.txt");      //Sparar Cookieinformationen i samma mapp som scriptet ligger i med filnamnet kaka.txt    
    $data = curl_exec($foo); // sparar all data vi har hämtat till variabeln data (Borde inte behöva vara kvar men skapas ingen cookie om jag tar bort den :S
    curl_close($foo); // stänger curl för att spara minne
    

}
function curl_get_request($url) {
    $foo2 = curl_init();
    curl_setopt ($foo2, CURLOPT_COOKIEFILE, dirname(__FILE__) ."/kaka.txt");
    curl_setopt ($foo2, CURLOPT_URL, $url); // här hämtar vi sidan
    
    curl_setopt ($foo2, CURLOPT_RETURNTRANSFER, 1); // Säger att sidan inte skall skrivas ut

    //curl_setopt ($foo2, CURLOPT_HEADER, 1); 
    
    
    $data2 = curl_exec($foo2); // sparar all data vi har hämtat till variabeln data
    
    curl_close($foo2); // stänger curl för att spara minne
    return $data2; // skriver ut det vi sparat i data
    

}
?>


</html>
