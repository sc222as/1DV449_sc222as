function Ajax(url, callback) {

    var xhr = this.getXHR();

    xhr.onreadystatechange = function() {                                                   //Svarsfunktionen
        if (xhr.readyState === 4) {                                                         //kör kod 4 för det är i praktiken bara den som används
            if (xhr.status >= 200 && xhr.status <= 300 || xhr.status === 304) {             //allt som är större än 200 och mindre än 300 (eller än 304) tolkas som okej
                callback(xhr.responseText);                                                 //responsetext innehåller datan så den skickar vi tillbaka
                }
                else {
                    console.log("Läsfel, status:" + xhr.status);
                }
            }
        };

        xhr.open("get", url, true);                                                         //konfiguration av anropet.. asynkront anrop, url måste vara från samma site som skriptet körs från

        xhr.send(null);                                                                     //skickar.. vill inte skicka nått så skriver null
}
    Ajax.prototype.getXHR = function() {
        var xhr = null;
        try {
            xhr = new XMLHttpRequest();                                                     //skapar ett xhr-objekt
            }
            catch (error) {
                try {
                    xhr = new ActiveXObject("Microsoft.XMLHTTP");                           //ger stöd för IE 5 och 6
                    }
                catch (error) {
                    throw new Error("no XHR objects available.");                           //funkar det inte ändå så skiter vi i det :)
                    }
                }
                return xhr;
                };