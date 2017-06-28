// Ajout du sprite SVG
var goliathAsmlRequest = new XMLHttpRequest();
goliathAsmlRequest.open("GET", scripts_l10n.svgSpriteUrl, true);
goliathAsmlRequest.send();
goliathAsmlRequest.onload = function(e) {
    var div = document.createElement("div");
    div.classList.add('screen-reader-text');
    div.innerHTML = goliathAsmlRequest.responseText;
    document.body.insertBefore(div, document.body.childNodes[0]);
};