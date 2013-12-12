#Seminarie 3

## Del 1 - Projektidé 

1. Läs igenom dokumentationen till de API:er du använder. Vad är dina tankar om den?
 - Jag har planerat att använda en hel del olika API:er och jag får både positiva och negativa intryck av dem. Officiella API:er från stora legitima företag (Systembolaget, Skånetrafiken, Eniro o.s.v.) ger väldigt positiva intryck medans mindre okända företag (loceo, ica-inofficiellt) gör mig lite mer ifrågasättande. T.ex. Loceo´s webbsajt hänvisar bara tillbaka till apikatalogen och documentationen hittas inte...
2. Vilket/vilka dataformat kan dina valda API:er leverera?
 - Det är allt möjligt från JSON till XML till XLS (Excel). Det känns som att jag kommer få jobba med flera olika för att skapa en ordentlig mashup men det känns bara bra och lärorikt. Förhoppningsvis så kommer det inte ställa till för stora problem trots att idealet hade varit att alla använder samma.
3. Finns det några speciella krav för att använda de API:er du valt? Kostnad, begränsningar e.c.t 
 - Vissa av API:erna sätter begränsningar med mänged anrop står det i dokumentationen. Jag hittar dock inte hur många anrop det skulle vara med jag ser inte att det ska vara något stort problem med min applikation. En del kräver att jag ska skapa en API-Nyckel, Jag hittade någon API som ville att jag skulle betala 300kr för att få använda den och Eniro verkar ha både en betal-variant och en free-variant men jag hittar inte var som är skillnaden på dom.. 
4. Vilka risker ser du med att bygga en tjänst kring de API:er du valt?
 - En risk är ju att man kanske gör allt för många anrop så att delar av applikationen slutar att fungera. En annan risk är med de mindre API:erna (Framför allt Loceo oroar mig) att dom helt enkelt känner att "Nä jag pallar inte detta längre" och då stänger ner sin API helt enkelt. De flesta av mina applikationer hämtar data från stora kända företag så jag tror inte att datan jag får därifrån kommer att vara korrupt eller felaktig så det är något som jag slipper oroa mig för iallafall :).
 
## Del 2 - Fallstudie - Exempel på en bra befintlig mashup-applikation

- Jag valde http://trendsmap.com/

1. Varför är denna applikation ett bra exempel på mashup-applikation?
 - Jag tycker att det är en smart rolig applikation. Som många andra Mashups så tror jag att skaparen tänkte såhär: "Okej, jag har en karta. Vad vill jag se på denna kartan?" Det känns som en väldigt typisk Mashup och vill man förklara för någon vad en Mashup är så är detta ett bra exempel.
2. På vilket sätt kombineras datakällorna och vilken ny effekt får dessa tillsammans?
 - Du har "Twitter Trending Topics" och "Google Maps". Ensamma så visar den ena Twitter och den andra en karta. Tillsammans kan visa de mest tweetade ämnena i en specifik region på en världskarta.  
