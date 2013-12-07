#Laboration 2

##Uppgift 1

1. Komprimering JPEG-Bild
 - Teori: Bilden food.jpg är i formatet 2048x1536 och har en storlek på 1,96MB. Den visas bara i 293x220px. Om jag skalar ner bilden till samma storlek som den visas borde filen bli mindre och därför ladda snabbare. Referens: http://discover-devtools.codeschool.com/levels/5/challenges/12?locale=en 
 - Laddningstid före: 
 - Laddningstid efter:
 - Reflektion:
2. Komprimering Javascript
 - Teori: Det är tre olika Javascript-filer som laddas initiellt på sidan. Detta kan komprimeras ner till en fil samt att man kan ta bort en massa onödiga saker som whitespaces o.s.v. Referens: http://discover-devtools.codeschool.com/levels/5/challenges/5?locale=en 
 - Laddningstid före: 
 - Laddningstid efter:
 - Reflektion:
3. Ta bort resurser som inte laddas
 - Teori: Filen longpoll.js och ajax-minifield.js får felkod 404 och laddas inte. Jag väljer att kommentera bort dessa från koden då de ändå inte används. Referens: http://discover-devtools.codeschool.com/levels/5/challenges/8?locale=en
 - Laddningstid före: 
 - Laddningstid efter:
 - Reflektion:
4. Omorganisering
 - Teori: För att hemsidan skall laddas snabbare så behövs Css-filerna laddas så snabbt som möjligt (Framför allt snabbare än Javascriptet) Jag flyttar därför upp Css-anropen över Javascript-anropet samt gör Javascript-anropet Asynkront (Skjuter upp analyseringen av JavaScriptet). Referens: http://discover-devtools.codeschool.com/levels/5/challenges/8?locale=en 
 - Laddningstid före: 
 - Laddningstid efter:
 - Reflektion:
5. Nedzippning
 - Teori: Jag lade till koden "ob_start("ob_gzhandler");" i början på applikationen. I just denna applikationen så gör det inte så stor skillnad om man zippar ner delar av den eller inte men i större applikationer så kan det göra stor skillnad. Referens: http://orion.lnu.se/pub/education/course/1DV449/ht13/video/HTTP_02.mp4
 - Laddningstid före: 
 - Laddningstid efter:
 - Reflektion:
6. Cachening
 - Teori:
 - Laddningstid före: 
 - Laddningstid efter:
 - Reflektion:
