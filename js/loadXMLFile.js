function loadXMLFile(file)
{
    try{
        xmlDoc = new ActiveXObject("Microsoft.XMLDOM");
    }catch(e){
        try{
            xmlDoc = document.implementation.createDocument("","",null);
        }catch(e){
            alert(e.message);
        }
    }

    try{
        var xmlhttp = new window.XMLHttpRequest();
        xmlhttp.open("GET",file,false);
        xmlhttp.send(null);
        var xmlDoc = xmlhttp.responseXML.documentElement;
        return(xmlDoc);
    }catch(e){
        alert(e.message);
    }
}
