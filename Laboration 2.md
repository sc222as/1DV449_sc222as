#Laboration 2

##Uppgift 1

Förklaring på punkterna:
Teori: Identifierat fel och vad som ska göras och vad som borde hända
Laddningstid före:
Laddningstid efter:
Reflektion:

1. Komprimering JPEG-Bild
 - Teori: Bilden food.jpg är i formatet 2048x1536 och har en storlek på 1,96MB. Den visas bara i 293x220px. Om jag skalar ner bilden till samma storlek som den visas borde filen bli mindre och därför ladda snabbare. Referens: http://discover-devtools.codeschool.com/levels/5/challenges/12?locale=en 
 - Laddningstid före: 1.24s
 - Laddningstid efter: 39ms
 - Reflektion: Precis som väntat så gick det snabbare att ladda en mindre bild. Tror inte jag behöver reflektera mer än så över detta.
2. Komprimering Javascript
 - Teori: Det är tre olika Javascript-filer som laddas initiellt på sidan. Detta kan komprimeras ner till en fil samt att man kan ta bort en massa onödiga saker som whitespaces o.s.v. Referens: http://discover-devtools.codeschool.com/levels/5/challenges/5?locale=en 
 - Laddningstid före: 227ms
 - Laddningstid efter: 47ms
 - Reflektion: Trots att det inte tar så lång tid att läsa whitespaces för datorn så är visar det sig ändå här att många bäckar små blir en flod. 180ms kan tyckas vara lite men i datorvärlden är det en hel del
3. Ta bort resurser som inte laddas
 - Teori: Filen longpoll.js och ajax-minifield.js får felkod 404 och laddas inte. Jag väljer att kommentera bort dessa från koden då de ändå inte används. Referens: http://discover-devtools.codeschool.com/levels/5/challenges/8?locale=en
 - Laddningstid före: 1.6s
 - Laddningstid efter: 0ms
 - Reflektion: 1.6s är väldigt stor skillnad (störst av de "riktiga" optimeringarna jag gjorde). man märkte en markant skillnad. Det är viktigt att man kontrollerar sin sida så att det inte läggs en massa onödig kraft på saker som ändå inte gör något (T.ex. hämtar saker som inte finns). 
4. Omorganisering
 - Teori: För att hemsidan skall laddas snabbare så behövs Css-filerna laddas så snabbt som möjligt (Framför allt snabbare än Javascriptet) Jag flyttar därför upp Css-anropen över Javascript-anropet samt gör Javascript-anropet Asynkront (Skjuter upp analyseringen av JavaScriptet). Referens: http://discover-devtools.codeschool.com/levels/5/challenges/8?locale=en 
 - Laddningstid före: 39ms
 - Laddningstid efter: 39ms
 - Reflektion: Jag märkte ingen direkt skillnad här ska jag erkänna. I Teorin så ska Css-filerna laddas först eftersom en användare inte kan börja använda sidan (Nyttja Javascript) förräns sidan är fullt renderad ändå. (Jag var tvungen att göra så att javascript-anropet inte blev asynkront i slutändan ändå då det strulade till det med Ajax-anropet =/)
5. Nedzippning
 - Teori: Jag lade till koden "ob_start("ob_gzhandler");" i början på applikationen. Vad den gör är att den komprimerar textfilen som sedan expanderas av webbläsaren. Referens: http://orion.lnu.se/pub/education/course/1DV449/ht13/video/HTTP_02.mp4
 - Laddningstid före: 38ms
 - Laddningstid efter: 29ms
 - Reflektion: I just denna applikationen så gör det inte så stor skillnad om man zippar ner delar av den eller inte men i större applikationer så kan det göra stor skillnad.
6. Förflyttning av Css
 - Teori: Min tanke var att eftersom det är Css-filerna Grid1 och Grid2 som tar längst tid att ladda nu så kanske man bara kan göra som så att man kopierar allt som finns i filerna och lägger det på samma ställe som övriga Css-filer istället.
 - Laddningstid före: 1.2s
 - Laddningstid efter: 100ms
 - Reflektion: Jag hade föredragit att Cachea den Css som hämtas från en extern server men eftersom jag inte kommer åt min Htaccess-fil på mitt webbhotell så kändes detta som en fullgod alternativ lösning (Jag sparade ändå 1.1s)
7. Finputsning av kod
 - Teori: I filen middle.php var det någon som hade skrivit "sleep(2);". Detta känns som en väldigt dum sak om man nu vill att sidan ska ladda snabbare :). Referens: http://php.net/manual/en/function.sleep.php
 - Laddningstid före: 2s
 - Laddningstid efter: 0s
 - Reflektion: Inte mycket att säga om detta. Sleep fördröjer exekveringen av kod så.. ja.. :) (Faktum är att när jag jobbade med Uppgift 2 i laborationen så irriterade det mig bara att middle.php existerade så jag bortsåg från den helt istället. Ett mindre anrop är väl alltid en positiv sak antar jag.)

 
##Uppgift 2

1. Säkerhetshål 1
 - Administratörskontot heter Admin. Detta är inte speciellt smart då en person som försöker hacka ens sida garanterat kommer att förutsätta att Administratörskontot heter något i stil med: Admin, Administrator, Administratör o.s.v.
 - Om någon får tillgång till Admin-Kontot så kommer personen i princip att få tillgång till hela sidan och kunna göra vad dom vill där.
 - Skadorna som kan uppkomma är troligtvis väldigt omfattande då en Administratör brukar kunna göra i princip allt. Exempel kan vara att ta bort användare, ändra användaresrättigheter, ta bort inlägg, editera inlägg o.s.v.
 - Jag har bytt namn på Administratörskontot
2. Säkerhetshål 2
 - Lösenordet för Administratörskontot är osäkert. Vill användare ha osäkra lösenord så får dom ha det (deras bekymmer) men administratörskontot SKALL ha ett säkert lösenord (minst 8 teckan, stora och små teckan + specialtecken)
 - Vem som helst som besöker sidan kommer kunna logga in som administratör.
 - Skadorna som kan uppkomma är troligtvis väldigt omfattande då en Administratör brukar kunna göra i princip allt. Exempel kan vara att ta bort användare, ändra användaresrättigheter, ta bort inlägg, editera inlägg o.s.v.
 - Jag har bytt lösenord på Administratörskontot
3. Säkerhetshål 3
 - Användarnamnet och lösenordet för Administratörskontot är ifyllt när man når första-sidan.
 - Vem som helst som besöker sidan kommer kunna logga in som administratör.
 - Skadorna som kan uppkomma är troligtvis väldigt omfattande då en Administratör brukar kunna göra i princip allt. Exempel kan vara att ta bort användare, ändra användaresrättigheter, ta bort inlägg, editera inlägg o.s.v.
 - Jag har sett till så att där inte är något förifyllt när man ska logga in.
4. Säkerhetshål 4
 - Lösenorden sparas i klartext i databasen
 - Om databasen komprimeras så kommer hackaren att ha tillgång till alla användarnamn samt ohashade lösenord
 - Då majoriteten av användare på internet använder samma lösenord på flera ställen så är de inte bara våran sajt som har komprimerats utan flera andra sajter också. Ännu roligare blir det om vi tvingar användare att fylla i sin E-Post adress för då är dom helt rökta
 - Jag har sett till så att alla lösenord blir hashade. Jag vill gärna kommentera och skriva att hashningen inte går till så som jag skulle önska men då mitt webbhotell inte stödjer php 5.5.0 så kan jag inte använde mig av password_hash funktionen. Vad jag gör nu istället är att jag hashar användarnamnet, lösenordet och sen de två tillsammans. Tillåter man inte att flera personer har samma användarnamn så kommer man aldrig få en likadan hash på två olika konton om jag har tänkt rätt. Inte optimalt med som Leitet sade: "Bättre än 90%" :).

## Uppgift 3

 - Efter att ha suttit med detta några timmar så upptäcker jag till min (fasa(?), lättnad(?)) att där finns ju redan en Ajax-Funktion "färdig" i systemet. Så det var ut med allt arbete jag hade gjort och börja om på nytt :). Efter lite googlande så hittade jag en som löste att meddelandet kommer först i listan, jag bytte helt enkelt ut append mot prepend och så var det fixat :). om man googlar på append så ser man t.om. under tips att det står:
"The prepend() method inserts specified content at the beginning of the selected elements.
Tip: To insert content at the end of the selected elements, use the append() method."
Jag funderade på att lägga till tidsangivelser som det står i labbrapporten men då tiden är knappt så tolkar jag det bokstavligt att man gärna får göra det, d.v.s. det är inget krav :). Om jag har fel så påpeka gärna detta så ska jag fixa till det :). 

## Reflektion

 - Detta var en väldigt underhållande och intressant lab på många vis. Jag personligen älskar laborationer som handlar om säkerthet (Dock så var säkerhetsföreläsningen nästan exakt densamma som jag hade i Nätverkssäkerhet för ca: 1 år sedan :)).
 
Optimering var också väldigt roligt då man verkligen märkte av skillnaden i det man gjorde. Man vill alltid kunna visa upp vad man har gjort för vänner och familj men i de flesta fallen brukar de sitta som fågelholkar när man visar. Denna gången kunde man visa klart och tydligt hur sidan laddade före och efter man hade optimerat den och det var tydliga resultat.

Ajax anropet var ingen direkt favorit hos mig men det är bra att den var med för den slår mot min personliga akilleshäl, att sätta sig in i andras kod (huu!). 

För en körbar version så gå till http://wpprojekt.se/webbteknikII/1DV449_L02/


 
