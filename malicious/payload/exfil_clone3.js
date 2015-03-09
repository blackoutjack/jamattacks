xmlhttp=new XMLHttpRequest();
xmlhttp.open.clone = function() {
  var that = this;
  var temp = function temporary() { return that.apply(this, arguments); };
  for(var key in this) {
    if (this.hasOwnProperty(key)) {
      temp[key] = this[key];
    }
  }
  return temp;
};
xmlhttp.opennew=xmlhttp.open.clone();
xmlhttp.opennew("GET", "#MALROOTsubmission?test=clone3", true);
xmlhttp.send(null);
