<!DOCTYPE html>
<html lang="sv">
  <head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> </head>


<?php

curl_get_cookie("http://vhost3.lnu.se:20080/~1dv449/scrape/check.php"); // Kakan :)
$data = curl_get_request("http://vhost3.lnu.se:20080/~1dv449/scrape/secure/producenter.php");  // vilken URL man ska hämta hem (all HTML data)


$dom = new DOMDocument();       //Här skapar vi ett nytt DOMDocument

if ($dom->LoadHTML($data)) {        //Vi slänger in datan som vi har hämtat Jag lägger detta i en If-Sats så om det inte skulle retunerar true så får vi ett felmeddelande
    $xpath = new DOMXPath($dom);    // skapar en ny xpath för det gör det ganska enkelt att hämta ut specifika saker (querys)
    $items = $xpath->query('/html/body/div[@class = "container"]//a');  //Här skapar vi oss en lista med "Items". Det jag hämtar här är det som ligger i html/body i div-klassen container ([filterclass]) så hämtar jag alla a-taggar (// hämtar alla)  

    
    foreach ($items as $name) {
        $id = $name->getAttribute ("href"); // för att hämta ut producentents id så hämtar jag Href:en och sen tar jag bort lite saker senare. (t.ex. producent_8.php)
        
        $namn = $name->nodeValue;           // Här hämtar jag ut värdet på a-taggen vilket råkar vara namnet på producenten
        
        $temp = curl_get_request("http://vhost3.lnu.se:20080/~1dv449/scrape/secure/$id");   // Jag väljer sedan här att göra en ny curl_get_request för jag vill hämta saker inne på varje länk        
        $url = "http://vhost3.lnu.se:20080/~1dv449/scrape/secure/$id";        
        $check = get_headers($url);
        foreach ($check as $check)
        {
            if (strpos($check,'HTTP/1.1 404 Not Found') !== false) {             // Jag gör här en kontroll och kontrollerar så att hemsidan jag försöker att skrapa från existerar. Gör den inte det så sätter jag N/A
            $hemsida = "N/A";                                                   // på hemsida och stad och hoppar över de två stegen i scriptet.
            $stad = "N/A";
        
        }
        
        

        else {
            
            $dom = new DOMDocument();           //Här skapar vi ett nytt DOMDocument
            
            $dom->LoadHTML($temp);              //Vi slänger in datan som vi har hämtat
            $xpath = new DOMXPath($dom);         // skapar en ny xpath för det gör det ganska enkelt att hämta ut specifika saker (querys)
            $homepages = $xpath->query('/html/body/div[@class = "container"]//a | /html/body/div[@class = "container"]//p');      //Eftersom sidorna är ganska lika uppbyggda så gör jag ett likadant anrop här.
            foreach ($homepages as $homepage){
                $hemsida = $homepage->nodeValue;            // Här tilldelar jag variabeln hemsida sitt värde. 
                if (strpos($hemsida,'http') !== false) {}   // Här kontrollerar jag att hemsidan innehåller strängen http. Gör den inte det får hemsida värdet N/A
                
                else {$hemsida = "N/A";}
                
            }
            $dom = new DOMDocument();
            
            $dom->LoadHTML($temp);
            $xpath = new DOMXPath($dom);
            $locations = $xpath->query('/html/body//p/span[@class = "ort"]');       //gör ett query och går in och hämtar det som ligger i klassen "ort"
            foreach ($locations as $location){
                $stad = $location->nodeValue;               // Här tilldelar variabeln stad sitt värde
                
            }
        }
        }
            $removedChars = array("p","r","o","d","u","c","e","n","t","h","_",".","l","/","w");     //Här väljer jag vilka tecken som skall skalas bort från $ID
            $producentID = str_replace ($removedChars,"", $id);                                     //Här byter jag ut alla valda variabler mot ingenting och sparar resultatet i $producentID
            $å = "å";
            $ä = "ä";
            $ö = "ö";
            $så = "Å";
            $sä = "Ä";                                      // Här gjorde jag en liten lösning för att det skulle sparas läsligt
            $sö = "Ö";
            $é = "é";
            $sé = "É";
            
            
            $namn = str_replace ("Ã¥", $å, $namn);
            $namn = str_replace ("Ã¤", $ä, $namn);
            $namn = str_replace ("Ã¶", $ö, $namn);          // Byter ut lite bokstäver.. 
            $namn = str_replace ("Ã", $sö, $namn);
            $namn = str_replace ("Ö©", $é, $namn);
            
            $stad = str_replace ("Ã¥", $å, $stad);
            $stad = str_replace ("Ã¤", $ä, $stad);
            $stad = str_replace ("Ã¶", $ö, $stad);
            $stad = str_replace ("Ort:", "", $stad);        // Ser till så att det inte står Ort: innan ortsnamnet. 
            
            $hemsida = str_replace ("Ã¤", $ä, $hemsida);
            $hemsida = str_replace ("<br />", "", $hemsida);    // Tar bort <br /> från $hemsida.
            
            
            //echo "Namn = ".$namn ." <br /> ". "Producent ID = ".$producentID ." <br /> ". "Hemsida = ".$hemsida, $stad ." <br /> "."=====================" ." <br /> "; //Bara en liten koll som jag har använt
            addToDB($namn, $producentID, $hemsida, $stad); //Lägger till allt i databasen.

    }
        

    }
    else {
        die("You have failed!! Feel the shame!");       //Om scriptet avbryts så visas detta.
        }

function addToDB($namn, $producentID, $hemsida, $stad) {
    $db = null;
	
    try {
        $db = new PDO("sqlite:db.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOEception $e) {
        die("Something went wrong -> " .$e->getMessage());
    }
    $q = "INSERT INTO scraped (namn, id, hemsida, stad) VALUES('$namn', '$producentID', '$hemsida', '$stad')";
	
    try {
        if(!$db->query($q)) {
            die("Fel vid insert");
        }
    }
    catch(PDOException $e) {
        die("Something went wrong -> " .$e->getMessage());
    }
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
    
    curl_setopt ($foo, CURLOPT_COOKIEJAR, dirname(__FILE__) ."/kaka.txt");      //Sparar Cookieinformationen i samma mapp som scriptet ligger i med filnamnet kaka.txt    
    $data = curl_exec($foo); // sparar all data vi har hämtat till variabeln data (Borde inte behöva vara kvar men skapas ingen cookie om jag tar bort den :S)
    
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