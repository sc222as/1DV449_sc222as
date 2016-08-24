# WHERE ARE YOU


Jag har gjort en Mashup-applikation som placerar ut en markör på en karta.
Applikationen är uppdelad på två sidor där den ena sidan endast har ett formulär där det finns möjlighet att skriva ett kort meddelande
som skall kopplas till markören samt en "Submit"-knapp.
Markörens plats bestäms av det första API:et som jag har använt som heter Geolocation.
Informationen placeras därefter i en SQLite databas och hämtas av det andra API:et som jag valt att använda, Google Maps.
När man har klickat på Submit-knappen skickar applikationen dig vidare till en karta där du kan se samtliga markörer som du
har valt att skicka in.
Varje markör har även en tidsstämpel så att man tydligt kan se när markören placerades ut.

För en schematisk bild över applikationsflödet se nedan:

![alt text](http://wpprojekt.se/schematics.png "Schematics")

Vad gällande säkerhet och prestandaoptimering så har jag implementerat skydd mot SQL-injections i SQLite databasen.
Där finns ingen direkt känslig data i databasen så att kryptera innehållet kändes överflödigt.
Prestandaoptimering kände jag inte att det fanns mycket att göra på den fronten.
Applikationen i sig är väldigt simpel så det finns inte speciellt mycket att optimera. 

Offline-First är ett spännande begepp som växer mer och mer inom IT-Världen.
Jag hade som tanke att man skulle kunna spara sina koordinater offline och sen när man väl kom online så skulle den ladda upp
dessa i databasen automatiskt.
Det största problemet som jag såg med det när jag satt och funderade över implementationen var hur jag skulle göra med tidsstämpeln.
Efter att jag hade suttit och spånat på lite lösningar så insåg jag att jag hade förbisett en viktig detalj i det hela.
För att få fram sina koordinator så måste man ha kontakt med Geolocation API:et. När jag insåg detta så insåg jag även en annan sak.
Offline-first är inget som går att implementera på ett intressant vis i just denna applikationen.
Jag funderade även över möjligheten att cachea den ouppdaterade kartan med de gamla markörerna men det kändes inte intressant.


Det finns flera potentiella risker med min applikation så som den är uppbyggd just nu.
Då det inte är implementerat någon loginfunktion så kan vem som helst gå in och se vart användaren har befunnit sig
vid ett visst klockslag.
Detta är dock inget som just jag ser som ett problem men t.ex. en lastbilschaufför, som var den tilltänkta användargruppen,
kanske inte vill avslöja sin exakta position för vem som helst (speciellt inte om någon känner till vad som är lastat).
Etiskt känner jag inga problem med applikationen då man rent fysiskt måste mata in sin position vid varje uppdatering.
Kanske hade det varit ett större etiskt dilemma om man hade implementerat kontinuerlig uppdatering av positionen.
De tekniska riskerna jag ser med applikationen är t.ex att det används en SQLite databas istället för en MySql.
Anledningen till att en SQLite databas används är tidsbrist i utvecklingen av applikationen. 

Projektet har på det stora hela gått bra tycker jag.
Som jag nämnde ovan så har det varit en ganska stor tidsbrist tyvärr så därför har projektet blivit ganska litet.
Det har dock blivit en väldigt intressant grund till andra projekt som man hade kunnat tänka sig att göra.
T.ex. så skulle man kunna använda den för att spåra flera olika Lastbilar och ge unika iconer till samtliga.
Som jag redan nämnt ovan så hade man kunnat implementera kontinuerlig uppdatering av användarens position och då hade man
kunnat använda den t.ex. när man är ute och vandrar så att om olyckan är framme så blir det enkelt för räddningstjänsten att hitta en.
En applikations idé som jag också hade var att man skulle kunna använda den kontinuerlig uppdatering i en "Gå hem sent från krogen" app.
Man skulle då även kunna implementera någon typ av funktion så att om man kände sig hotat skulle man kunna trycka på en knapp
så skickades kartbilden plus ett hjälpmeddelande till polisen. 

Jag anser inget vara betygshöjande i denna applikationen. Det är en "bare minimum" applikation tyvärr.
Hade jag haft mer tid så kanske man hade kunnat hitta på mer roliga saker men det är som det är. 

Länk till presentationen: https://youtu.be/GJVf-PYG33I