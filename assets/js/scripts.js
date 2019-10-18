// Ajout du sprite SVG
var arnaudbanAsmlRequest = new XMLHttpRequest();
arnaudbanAsmlRequest.open("GET", scripts_l10n.svgSpriteUrl, true);
arnaudbanAsmlRequest.send();
arnaudbanAsmlRequest.onload = function(e) {
    var div = document.createElement("div");
    div.classList.add('screen-reader-text');
    div.innerHTML = arnaudbanAsmlRequest.responseText;
    document.body.insertBefore(div, document.body.childNodes[0]);
};