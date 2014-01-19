#Projekt

##Inledning

Jag har gjort en applikation som placerar ut samtliga lägenheter som Ängelholmshem har på sin hemsida på en karta. Om man klickar på någon av lägenheterna så zoomar kartan in på denna och det visas de tre billigaste elleverantörerna för den lägenheten samt prister per KwH. All data uppdateras dagligen

##Schematisk bild

se Schematisk bild

##Serversidan

Jag har två script som kör på serversidan. Det första scriptet går in på Ängelholmshem och skrapar samtliga lediga lägenheter och sparar undan dessa i en databas. Mitt andra script går in på Elpriser.se och hämtar aktuella elpriser för lägenheter inom Ängelholmsområdet. Även detta sparas i en databas. Dessa script körs en gång om dagen då Ängelholmshem bara lägger upp nya lägenheter en gång om dagen. Bägge skraperna är skrivna i php. För att översätta adresser till longitud/latitud så använder jag mig av Googles Geocoder. Det sista jag gör är att förvandla databaserna till JSON i data.php och energidata.php. Enkel felhantering finns.

##Klientsidan

Jag har använt mig av Googles kart-API. På klientsidan är allt kodat i Javascript och HTML. Mitt Kart-API hämtar all data från min skrapade data (data.php och energidata.php) som är översatt till JSON. Det första som sker är att den placerar ut Markers på alla longituder och latituder som anges i data.php. Om man hovrar över dessa markers så framgår det vilken adress det är i ett infowindow. Om man senare klickar så får man ett nytt infowindow där elpriserna presenteras.

##Egenreflektion kring projektet

Projektet har på det stora hela gått bra känner jag. Jag har lärt mig otroligt mycket på väldigt kort tid med detta projektet. Jag har bl.a lärt mig att skrapa aspx-hemsidor (Fruktansvärt), hur besviken man blir på många API:er, hur man skapar JSON-Formaterad data, flera sätt att använda sig av googles map-API.
 - Problem
Ja var ska man börja. Det första stora problemet jag stötte på var att jag hade ingen aning om hur man skulle skrapa en aspx-hemsida. Efter mycket MYCKET googlande så lyckades jag dock till slut tack och lov. Mitt nästa problem var att googles geolocation inte ville fungera. Från början gjorde jag som så att jag använde den på klientsidan nämligen men då kunde den bara sätta ut tio adresser sen ansåg den att det var för många anrop för snabbt. Lösningen på detta var att köra på serversidan, hämta Long/Latitud och därefter placera ut markers med hjälp av det istället. Nästa roliga problem var att vissa av markersen hamnade i Göteborg och Stockholm o.s.v. Oturligt nog för mig så fanns Sofierogatan på fler ställen än i Munka Ljungby. Lösning på detta var att man satte en bounds med google geocoder. Förutom detta har det varit lite småbuggar här och var. En bugg som jag tyvärr inte kan lösa är att Google-Maps API inte har kartlagt Sverige speciellt nogrannt. Detta skapar problem då den tycker att Sofierogatan 15, 17 och 19 ligger på samma long/latitud. När jag då placerar ut en marker så placerar den ju då såklart över föregående marker. Min "lösning" på detta är att jag kommer att försöka använda mig av Eniros API istället i framtiden.

 - Funktioner jag hade viljat implementera
Om man läser i min Projektbeskrivning och Seminarie 3 så ser man att det finns en hel drös med funktioner som jag vill implementera. Anledningen till att dessa inte är implementerade är inte att det inte funnits tid utan att de API:er som jag trodde skulle göra vissa saker verkligen inte gör det. T.ex. mitt API för att kontrollera elpriser. Kontrollerade det Elpriser? Nej. Vad det gjorde var att man skrev in sin adress och därefter skrev den ut vilket elområde man bor i. Det finns fyra elområden i Sverige. Ett är norrland, det andra är typ norrland, det tredje är mellansverige och det fjärde är södra sverige. Sådär spännande att det står på varje lägenhet att den (och alla andra lägenheter inom 40 mils-radie) befinner sig i område 4. Det finns fler funktioner som jag vill implementera i mitt projekt men jag tror att jag kommer göra det med hjälp av webbskrapor istället för API:er (Om jag inte hittar något väldigt intressant).

 - Vidare arbete
Jag kommer att göra om min applikation till att använda sig av Eniros API istället för google. Jag kommer att tala med de på Ängelholmshem och fråga vad dom vill se i applikationen (Har redan fått tips om att de vill se hur stadsbussen går). 

##Risker

 - Om Angelholmshem.se eller Elpriser.se omstrukturerar sin hemsida så kommer webbscraporna att sluta att fungera men det är förhoppningsvis inte något svårt att justera
 - Jag gör ingen kontroll av datan som läggs in i databasen (Förhoppningsvis gör Angelholmshem.se och Elpriser.se det) Jag störs dock inte jättemycket över detta då databaserna är så små så om någon skulle göra en SQL-Injektion och droppa alla databaser så kan jag bara scrapa om det (tar 10 sec). Där är ingen känslig data heller för den delen då jag inte sysslar med någon typ av autentisering.
 - Jag känner inte att jag tar några etiska risker heller. Applikationen är till Ängelholmshem och jag skrapar data från deras sida. Jag nämner i InfoWindow:et med elpriser att priserna är hämtade från Elpris.se. Tvärtom så känner jag mig väldigt nöjd med det etiska.
 - Risken finns att API:erna inte fungerar men jag känner att risken är väldigt liten då det är världens största IT-företags API.
 
##Betygshöjande

Tror inte att jag gör något speciellt här. Det enda jag kände var på en helt annan nivå än en trea var att skrapa Ängelholmshem hemsida.

