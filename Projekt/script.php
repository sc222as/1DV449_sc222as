﻿<!DOCTYPE html>
<html lang="sv">
  <head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> </head>


<?php

$data = WholePage("http://www.angelholmshem.se/HSS/Object/object_list.aspx?cmguid=4e6e781e-5257-403e-b09d-7efc8edb0ac8&objectgroup=1");  // vilken URL man ska hämta hem (all HTML data)


$dom = new DOMDocument();       //Här skapar vi ett nytt DOMDocument

if (@$dom->LoadHTML($data)) {       //Vi slänger in datan som vi har hämtat Jag lägger detta i en If-Sats så om det inte skulle retunerar true så får vi ett felmeddelande
    $xpath = new DOMXPath($dom);    // skapar en ny xpath för det gör det ganska enkelt att hämta ut specifika saker (querys)
    $items = $xpath->query('//div[@id = "ctl00_ctl01_div_content"]//a');    
    $id = "1";
    
    foreach ($items as $name) {
        
        
        
        
        $namn = $name->nodeValue;           
       if ($namn == "Adress" || $namn == "Område" || $namn == "Rum" || $namn == "Storlek" || $namn == "Hyra" || $namn == "" || $namn == "1" || $namn == "2" || $namn == "3"){}
       else{
           
           $address = $namn; 
           $prepAddr = str_replace(' ','+',$address);
           $geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?&address='.$prepAddr.'&bounds=56.212915,12.875697|56.303617,13.061042&sensor=false');
           $output= json_decode($geocode);
           $latitude = $output->results[0]->geometry->location->lat;
           $longitude = $output->results[0]->geometry->location->lng;
           echo $namn;
           echo $latitude;
           echo $longitude;
           echo " <br /> ";
           
           
           
           
           echo "Namn = ".$namn ." <br /> ". $id;     //Testning
           addToDB($namn, $id, $latitude, $longitude);
           $id++;
       };
    }

    }
    else {
        die("You have failed!! Feel the shame!");       //Om scriptet avbryts så visas detta.
        }


function addToDB($namn, $id, $latitude, $longitude) {
    $db = null;
	
    try {
        $db = new PDO("sqlite:db.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOEception $e) {
        die("Something went wrong -> " .$e->getMessage());
    }
    $q = "INSERT INTO adresser (adresser, key, lat, long) VALUES('$namn', '$id', '$latitude', '$longitude')";
	
    try {
        if(!$db->query($q)) {
            die("Fel vid insert");
        }
    }
    catch(PDOException $e) {
        die("Something went wrong -> " .$e->getMessage());
    }
}

function WholePage($url) {
    $viewstate = "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";
    $eventval = "/wEdAA/qQQSLy0n7lbzDTz27OogX5N1QdMyplFji0DYbTI9AoOJbrCerrcmx/HiMqFqaMeVmz2MkTyED6FoTbVhVUKKRMfewOyGp6uWT+zzfROyRrbOD5LAe3ELv6VvlVA0uRtfUd0Y3NruHuxYHXoErpaeoLGWAjTZxSCovq2i3SxhuWYgE+FHijZpaSqp0HeDcAM/uex55BJL/vjt4mZu5vdYLa7zpkssRD/SHq/zeqt66dgVM7NqZwOwmroCjE6MFyW1+FECLRbS7TaFZ5poOB36X0XqUzhBAMmdAL712DbBOK2wXHusJq51DMjQZN7rSGtP5zMMCmtnrAWve+gkP1peUoIRPpw==";
    $viewstate2 = "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";
    $eventval2 = "/wEdAA90tdpVHdkCs9bRznJY8RKg5N1QdMyplFji0DYbTI9AoOJbrCerrcmx/HiMqFqaMeVmz2MkTyED6FoTbVhVUKKRMfewOyGp6uWT+zzfROyRrbOD5LAe3ELv6VvlVA0uRtfUd0Y3NruHuxYHXoErpaeoLGWAjTZxSCovq2i3SxhuWYgE+FHijZpaSqp0HeDcAM/uex55BJL/vjt4mZu5vdYLa7zpkssRD/SHq/zeqt66dgVM7NqZwOwmroCjE6MFyW1+FECLRbS7TaFZ5poOB36X0XqUzhBAMmdAL712DbBOK2wXHusJq51DMjQZN7rSGtN04G80Vmq23tSsoWDA77WzWgWPpw==";
    
    
    
    
    $postData = '__VIEWSTATE='.rawurlencode($viewstate2)
          .'&__EVENTVALIDATION='.rawurlencode($eventval2)
          ;
    
    $foo2 = curl_init();
    curl_setOpt($foo2, CURLOPT_POST, TRUE);
    curl_setopt($foo2, CURLOPT_POSTFIELDS, $postData);
    curl_setopt ($foo2, CURLOPT_URL, $url); // här hämtar vi sidan
    
    curl_setopt ($foo2, CURLOPT_RETURNTRANSFER, 1); // Säger att sidan inte skall skrivas ut

    
    
    
    $data2 = curl_exec($foo2); // sparar all data vi har hämtat till variabeln data
    
    curl_close($foo2); // stänger curl för att spara minne
    return $data2; // skriver ut det vi sparat i data
    

}





//function curl_get_cookie($url) {

//    $foo = curl_init();
//    curl_setopt ($foo, CURLOPT_URL, $url); // här hämtar vi sidan
//    curl_setopt ($foo, CURLOPT_RETURNTRANSFER, 1); // Säger att sidan inte skall skrivas ut
//    curl_setopt($foo, CURLOPT_POST, 1); // Säger att vi ska göra en post
    
//    $post_arr = array(
//    "username" => "admin",
//    "password" => "admin"    
//    );                                  //Användarnamn och Lösenord
    
//    curl_setopt ($foo, CURLOPT_POSTFIELDS, $post_arr);      // Skriver in användarnamn och lösenord i formuläret
//    curl_setopt ($foo, CURLOPT_HEADER, 1);                  //Headerinformation
    
//    curl_setopt ($foo, CURLOPT_COOKIEJAR, dirname(__FILE__) ."/kaka.txt");      //Sparar Cookieinformationen i samma mapp som scriptet ligger i med filnamnet kaka.txt    
//    $data = curl_exec($foo); // sparar all data vi har hämtat till variabeln data (Borde inte behöva vara kvar men skapas ingen cookie om jag tar bort den :S)
    
//    curl_close($foo); // stänger curl för att spara minne
    

//}
//echo '<script type="text/javascript" src="js/jquery.js">'

////     , 'var clickButton = document.getElementById("ctl00_ctl01_DefaultSiteContentPlaceHolder1_Col1_ucNavBar_btnNavNext")'
////     , 'clickButton.click();'
//, '$("ctl00$ctl01$DefaultSiteContentPlaceHolder1$Col1$ucNavBar$btnNavNext").trigger("click");'
////, 'javascript:__doPostBack("ctl00_ctl01_DefaultSiteContentPlaceHolder1_Col1_ucNavBar_btnNavNext", "")'

//, '</script>';


//$_POST          This Could be it
//foo2("http://www.angelholmshem.se/HSS/Object/object_list.aspx?cmguid=4e6e781e-5257-403e-b09d-7efc8edb0ac8&objectgroup=1");
//function curl_get_request($url) {
//    $foo2 = curl_init();
//    curl_setopt ($foo2, CURLOPT_COOKIEFILE, dirname(__FILE__) ."/kaka.txt");
//    curl_setopt ($foo2, CURLOPT_URL, $url); // här hämtar vi sidan
    
//    curl_setopt ($foo2, CURLOPT_RETURNTRANSFER, 1); // Säger att sidan inte skall skrivas ut

//    //curl_setopt ($foo2, CURLOPT_HEADER, 1); 
    
    
//    $data2 = curl_exec($foo2); // sparar all data vi har hämtat till variabeln data
    
//    curl_close($foo2); // stänger curl för att spara minne
//    return $data2; // skriver ut det vi sparat i data
    

//}




//function foo() {
//    $postdata = "__VIEWSTATE=/wEPDwUKMTMwNjUyMjc4MQ8WAh4JUGFnZVRpdGxlBRJMZWRpZ2EgbMOkZ2VuaGV0ZXIWAmYPZBYCZg9kFgICAw9kFgxmD2QWBGYPDxYEHgRUZXh0BQ7DhG5nZWxob21sc2hlbR4HVmlzaWJsZWhkZAIBDw8WBh4ISW1hZ2VVcmwFJ34vUmVzL1RoZW1lcy9BbmdlbGhvbG1zaGVtL0ltZy9sb2dvLnBuZx4NQWx0ZXJuYXRlVGV4dAUOw4RuZ2VsaG9tbHNoZW0fAmdkZAIBDw8WBB8BBQhMb2dnYSBpbh4LTmF2aWdhdGVVcmwFFy9Vc2VyL015UGFnZXNMb2dpbi5hc3B4ZGQCAg9kFgICAw8WAh4FdmFsdWUFBFPDtmtkAgQPZBYEZg88KwAJAQAPFgQeCERhdGFLZXlzFgAeC18hSXRlbUNvdW50AgNkFgZmD2QWAgIBDw8WAh8FBQ0vRGVmYXVsdC5hc3B4ZBYCZg8VAQVTdGFydGQCAg9kFgICAQ8PFgIfBQU9L0hTUy9EZWZhdWx0LmFzcHg/Y21ndWlkPWRlZTliMTZkLTdiMzAtNDcwZC1hODBhLTUwODU3ZTRjMGM2MWQWAmYPFQELU8O2ayBib3N0YWRkAgQPZBYCAgEPDxYCHwVlZBYCZg8VARk8Yj5MZWRpZ2EgbMOkZ2VuaGV0ZXI8L2I+ZAICDxYCHwJoZAIGD2QWBAIBDw8WAh8BBRJMZWRpZ2EgbMOkZ2VuaGV0ZXJkZAIDD2QWBgIDDxcAZAIHDw8WAh8CaGRkAgkPZBYCAgEPZBYIAgMPZBYIAgEPFgIfAmhkAgMPFgIfAmgWAmYPDxYCHwEFCFAtRGlyZWt0ZGQCBQ8WAh8CZxYCZg8PFgIfAQUOVmlzYSBww6Uga2FydGFkZAIJDxYCHwJoZAIFD2QWBAIBDw8WDB4LVGVtcGxhdGVYbWwFNi9SZXMvVGVtcGxhdGVzL1htbC9PYmplY3RMaXN0X0hTT19PQkpFQ1RfQVBBUlRNRU5ULnhtbB4IQ3NzQ2xhc3MFCGdyaWRsaXN0HgVXaWR0aBsAAAAAAABZQAcAAAAeC0JvcmRlcldpZHRoGwAAAAAAAAAAAQAAAB4LQ2VsbFNwYWNpbmdmHgRfIVNCAqKCEGQWFmYPZBYKAgEPZBYCZg8PFgQfCmUfDgICZGQCAg9kFgJmDw8WBB8KZR8OAgJkZAIDD2QWAmYPDxYGHg9Db21tYW5kQXJndW1lbnQFI2dyaWRMaXN0X1NvcnRDb21tYW5kOmhvYmpfbm9vZnJvb21zHwoFB3NlbC1hc2MfDgICZGQCBA9kFgJmDw8WBB8KZR8OAgJkZAIFD2QWAmYPDxYEHwplHw4CAmRkAgEPZBYCZg9kFgICAQ9kFgJmD2QWAmYPZBYCAgEPDxYCHgxJc1JlZ2lzdGVyZWRnZGQCAg9kFgJmD2QWAgIBD2QWAmYPZBYCZg9kFgICAQ8PFgIfEGdkZAIDD2QWAmYPZBYCAgEPZBYCZg9kFgJmD2QWAgIBDw8WAh8QZ2RkAgQPZBYCZg9kFgICAQ9kFgJmD2QWAmYPZBYCAgEPDxYCHxBnZGQCBQ9kFgJmD2QWAgIBD2QWAmYPZBYCZg9kFgICAQ8PFgIfEGdkZAIGD2QWAmYPZBYCAgEPZBYCZg9kFgJmD2QWAgIBDw8WAh8QZ2RkAgcPZBYCZg9kFgICAQ9kFgJmD2QWAmYPZBYCAgEPDxYCHxBnZGQCCA9kFgJmD2QWAgIBD2QWAmYPZBYCZg9kFgICAQ8PFgIfEGdkZAIJD2QWAmYPZBYCAgEPZBYCZg9kFgJmD2QWAgIBDw8WAh8QZ2RkAgoPZBYCZg9kFgICAQ9kFgJmD2QWAmYPZBYCAgEPDxYCHxBnZGQCAw9kFgJmDw8WAh8BBSxTw7ZrbmluZ2VuIHJlc3VsdGVyYWRlIGVqIGkgbsOlZ3JhIHRyw6RmZmFyLmRkAgcPMuUBAAEAAAD/////AQAAAAAAAAAMAgAAAEVwb3J0YWwsIFZlcnNpb249My40Ni40ODY0LjE4MjUzLCBDdWx0dXJlPW5ldXRyYWwsIFB1YmxpY0tleVRva2VuPW51bGwFAQAAACpWaXRlYy5Db3JlLldlYi5VSS5Db250cm9scy5OYXZCYXJWaWV3U3RhdGUEAAAADV9kaXNwbGF5UGFnZXMMX2N1cnJlbnRQYWdlDF9yZWNvcmRDb3VudA9fcmVjb3Jkc1BlclBhZ2UAAAAACAgICAIAAAAFAAAAAgAAABkAAAAKAAAACxYOAgEPDxYGHwoFCWJ0bl9maXJzdB4HRW5hYmxlZGcfDgICZGQCAw8PFgYfCgUIYnRuX3ByZXYfEWcfDgICZGQCBw8PFgIfAQUBMmRkAgsPDxYCHwEFATNkZAINDxYCHwgCAxYGZg9kFgICAQ8PFgYfAQUBMR8KZR8OAgJkZAIBD2QWAgIBDw8WBh8BBQEyHwoFCHNlbGVjdGVkHw4CAmRkAgIPZBYCAgEPDxYGHwEFATMfCmUfDgICZGQCDw8PFgYfCgUIYnRuX25leHQfDgICHxFnZGQCEQ8PFgYfCgUIYnRuX2xhc3QfDgICHxFnZGQCCg8PFgIfAQUOaG9ial9ub29mcm9vbXNkZAIMD2QWAmYPDxYCHwEFd0FCIMOEbmdlbGhvbG1zaGVtLCBCb3ggMTExMSwgMjYyIDIyIMOEbmdlbGhvbG0sIEJlc8O2a3NhZHJlc3M6IFTDpXN0cnVwc2dhdGFuIDIsIFRlbDogMDQzMS00NCA5OSA2MCwgRmF4OiAwNDMxLTQ0IDk5IDc5ZGRkHnu0/OwgvJHflGkejl4K+FJT4K0=";
//    $postdata .= "&__EVENTVALIDATION=/wEdAA/qQQSLy0n7lbzDTz27OogX5N1QdMyplFji0DYbTI9AoOJbrCerrcmx/HiMqFqaMeVmz2MkTyED6FoTbVhVUKKRMfewOyGp6uWT+zzfROyRrbOD5LAe3ELv6VvlVA0uRtfUd0Y3NruHuxYHXoErpaeoLGWAjTZxSCovq2i3SxhuWYgE+FHijZpaSqp0HeDcAM/uex55BJL/vjt4mZu5vdYLa7zpkssRD/SHq/zeqt66dgVM7NqZwOwmroCjE6MFyW1+FECLRbS7TaFZ5poOB36X0XqUzhBAMmdAL712DbBOK2wXHusJq51DMjQZN7rSGtP5zMMCmtnrAWve+gkP1peUoIRPpw==";
//    $postdata = urlencode($postdata);
//    $host = 'www.angelholmshem.se';
//    $path = '/HSS/Object/object_list.aspx?cmguid=4e6e781e-5257-403e-b09d-7efc8edb0ac8&objectgroup=1';

//    $fp1 = fsockopen($host,80,$errno,$errstr,30);
//    if(!$fp1) 
//        die($_err.$errstr.$errno); 
//    else 
//    {
//        fputs($fp1, "POST $path HTTP/1.1\r\n");
//        fputs($fp1, "Host: $host\r\n");
//        fputs($fp1, "User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2.15) Gecko/20110303 Firefox/3.6.15 ( .NET CLR 3.5.30729)\r\n");
//        fputs($fp1, "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\r\n");
//        fputs($fp1, "Accept-Language: en-us,en;q=0.5\r\n");
//        fputs($fp1, "Accept-Encoding: gzip,deflate\r\n");
//        fputs($fp1, "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7\r\n");
        
//        fputs($fp1, "Connection: close\r\n");
//        fputs($fp1, "Content-length: ".strlen($postdata)."\r\n\r\n");
//        fputs($fp1, $postdata."\r\n\r\n");
        
//        $response = '';
//        while(!feof($fp1)) $response .= fgets($fp1,2000);
//        fclose($fp1);
//        echo $response;
//    } 
//}





?>


</html>