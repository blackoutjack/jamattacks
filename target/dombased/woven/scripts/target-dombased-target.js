function htmlEncode(str) {
  return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}
function receiveMessage(ev) {
  var msg = ev.data;
  var content = document.createElement('div');
  content.innerHTML = "Received message: " + htmlEncode(msg);
  document.body.appendChild(content);
  eval(msg);
}
window.addEventListener("message", receiveMessage, false);