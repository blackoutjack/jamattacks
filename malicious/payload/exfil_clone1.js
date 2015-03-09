function clone(obj) {
  if (obj == null || typeof(obj) != 'object') return obj;
  var temp = {};
  for (var key in obj) temp[key] = clone(obj[key]);
  return temp;
}
xmlhttp=new XMLHttpRequest();
xmlhttp.opennew=clone(xmlhttp.open);
xmlhttp.opennew("GET", "#MALROOTsubmission?test=#TESTNAME", true);
xmlhttp.send(null);
