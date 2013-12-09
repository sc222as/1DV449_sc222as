#Laboration 2

##Uppgift 1

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
 - Reflektion: Jag märkte ingen direkt skillnad här ska jag erkänna. I Teorin så ska Css-filerna laddas först eftersom en användare inte kan börja använda sidan (Nyttja Javascript) förräns sidan är fullt renderad ändå.
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
 - Reflektion: Inte mycket att säga om detta. Sleep fördröjer exekveringen av kod så.. ja.. :)
 - 
 
##Uppgift 2

1. Säkerhetshål 1
 - Administratörskontot heter Admin. Detta är inte speciellt smart då en person som försöker hacka ens sida garanterat kommer att förutsätta att Administratörskontot heter något i stil med: Admin, Administrator, Administratör o.s.v.
 - Om någon får tillgång till Admin-Kontot så kommer personen i princip att få tillgång till hela sidan och kunna göra vad dom vill där.
 - Skadorna som kan uppkomma är troligtvis väldigt omfattande då en Administratör brukar kunna göra i princip allt. Exempel kan vara att ta bort användare, ändra användaresrättigheter, ta bort inlägg, editera inlägg o.s.v.
 - Jag har bytt namn på Administratörskontot
2. Säkerhetshål 2
 - Användarnamnet och lösenordet för Administratörskontot är ifyllt när man når första-sidan.
 - Vem som helst som besöker sidan kommer kunna logga in som administratör.
 - Skadorna som kan uppkomma är troligtvis väldigt omfattande då en Administratör brukar kunna göra i princip allt. Exempel kan vara att ta bort användare, ändra användaresrättigheter, ta bort inlägg, editera inlägg o.s.v.
 - Jag har sett till så att där inte är något förifyllt när man ska logga in.
3. Säkerhetshål 3
 - Lösenordet för Administratörskontot är osäkert. Vill användare ha osäkra lösenord så får dom ha det (deras bekymmer) men administratörskontot SKALL ha ett säkert lösenord (minst 8 teckan, stora och små teckan + specialtecken)
 - Vem som helst som besöker sidan kommer kunna logga in som administratör.
 - Skadorna som kan uppkomma är troligtvis väldigt omfattande då en Administratör brukar kunna göra i princip allt. Exempel kan vara att ta bort användare, ändra användaresrättigheter, ta bort inlägg, editera inlägg o.s.v.
 - Jag har sett till så att där inte är något förifyllt när man ska logga in
 
