#Laboration 2

##Uppgift 1
Ni är fria att välja sätt att läsa in och extrahera data ur webbsidorna. Motivera ditt val!
 - Jag vet inte riktigt hur jag ska motivera det. Jag valde nog den bekväma vägen och valde det sättet som John använder eftersom han går igenom allt väldigt grundligt. Det fungerade bra till slut så jag känner att jag valt rätt :). 
 
## Uppgift 2
Vad finns det för risker med applikationer som innefattar automatisk skrapning av webbsidor? Nämn minst tre stycken!
 - Jag vet inte vad det körs för validering på den webbsida jag skrapar så har jag otur så kanske jag skrapar illasinnad kod som exekveras på min server.
 - Beroende på hur ofta man skrapar sidan så vet man inte om den informationen man skrapar är 100% aktuell.
 - Om jag inte kontrollerar datan jag skrapar så vet man inte riktigt vad som kommer upp på ens hemsida. Det kan vara som så att någon skriver "Julen är inte en mysig tid". Helt plötsligt säger min hemsida att Julen inte är en mysig tid och det är bara hemskt. Ännu roligare blir det om en annan person skrapar min hemsida och kanske då också hävdar att Julen inte är en mysig tid. Det känns lite som ett skvallertåg.
 - Om sidan man skrapar omstruktureras så måste man troligtvis skriva om sina skrapor annars vet man inte riktigt vad man skrapar.
 - Om man skrapar en hemsida på väldigt mycket information väldigt ofta så kan man utsätta deras server för stora belastningar (nästan som en DDOS-Attack).
 
## Uppgift 3
 Tänk dig att du skulle skrapa en sida gjord i ASP.NET WebForms. Vad för extra problem skulle man kunna få då?
 
 - Jag har ju inte läst kursen ASP.NET WebForms så jag har fått googla runder lite på svaret och det jag hittar är att det kan bli problem med VIEWSTATE och gömda fält. 
 
## Uppgift 4
Har du gjort något med din kod för att vara "en god webbskrapare" med avseende på hur du skrapar sidan?

 - Ja jag har ju blivit mer eller mindre tvingad till att vara det :). Då mitt script inte fungerar att köra på mitt webbhotell (se Tillägg) så måste man köra scriptet lokalt. Eftersom scriptet inte körs så ofta så belastar jag inte deras hemsida så mycket men en person kan fortfarande besöka min hemsida så mycket dom vill. Annars så vet jag inte om jag har gjort något speciellt.. Jag hämtar ju inte så mycket saker och framförallt inte stora saker (Bilder o.s.v.) så jag tror inte att ägaren till hemsidan skulle irritera sig så mycket på mig :).
 
## Uppgift 5
 
 - Massor :). Det har varit en väldigt rolig uppgift trots lite krångel här och där :). Jag känner att jag börjar få ganska bra koll på detta med webscraping nu och jag kommer att använda det till mitt projekt i denna kursen som jag för övrigt har stora förhoppningar på :). Har även lärt mig att använda sqlite-databaser i php och det är ju inte fy skam :).
 
##Tillägg
 
- Jag hade en chattkonversation med de som driver webbhotellet jag använder (one.com) där de säger att de inte har stöd för CURLOPT_COOKIEJAR. Skamligt men jag har inte råd att byta webbhotell för tillfället så jag får dras med detta. Jag tog en screenshot på chattkonversationen och sparade den som Bild1.jpg i Laboration 1 mappen.
