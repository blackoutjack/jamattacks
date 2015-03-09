xmlhttp=new XMLHttpRequest();
xmlhttp.opennew = xmlhttp.open.bind(xmlhttp);
xmlhttp.opennew("GET", "#MALROOTsubmission?test=clone2", true);
xmlhttp.send(null);
