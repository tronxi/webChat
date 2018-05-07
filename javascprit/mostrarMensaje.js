addEventListener('load', inicializarEventos, false);
function inicializarEventos()
{

}
var actualizar = setInterval(function(){mostrarDatos()}, 500);
function mostrarDatos()
{
  var url = "../php/mostrarMensaje.php";
  mostrar(url);
}

var conexion1;

function mostrar(url)
{
  conexion1 = new XMLHttpRequest(url);
  conexion1.onreadystatechange = escribir;
  conexion1.open("GET", url, true);
  conexion1.send();
}

function escribir()
{
  var conversacion = document.getElementById('conversacion');
  if(conexion1.readyState == 4)
  {
    console.log(utf8Decode(conexion1.responseText));
    conversacion.value = conexion1.responseText;
    conversacion.scrollTop = conversacion.scrollHeight;
  }
}

function utf8Decode(utf8String) {
    if (typeof utf8String != 'string') throw new TypeError('parameter ‘utf8String’ is not a string');
    // note: decode 3-byte chars first as decoded 2-byte strings could appear to be 3-byte char!
    const unicodeString = utf8String.replace(
        /[\u00e0-\u00ef][\u0080-\u00bf][\u0080-\u00bf]/g,  // 3-byte chars
        function(c) {  // (note parentheses for precedence)
            var cc = ((c.charCodeAt(0)&0x0f)<<12) | ((c.charCodeAt(1)&0x3f)<<6) | ( c.charCodeAt(2)&0x3f);
            return String.fromCharCode(cc); }
    ).replace(
        /[\u00c0-\u00df][\u0080-\u00bf]/g,                 // 2-byte chars
        function(c) {  // (note parentheses for precedence)
            var cc = (c.charCodeAt(0)&0x1f)<<6 | c.charCodeAt(1)&0x3f;
            return String.fromCharCode(cc); }
    );
    return unicodeString;
}
