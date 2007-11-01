function mostrar(objeto){		
    document.all(objeto).style.visibility = 'visible';
}

function ocultar(objeto){
    document.all(objeto).style.visibility = 'hidden';
}

function cambiarVisibilidad(objeto){
    if ( document.all(objeto).style.visibility == 'hidden' ) {
        mostrar(objeto);
    } else {
        ocultar(objeto);
    }
}

function getBrowser()
{
  IE4 = (document.all && !document.getElementById) ? true : false;
  NS4 = (document.layers) ? true : false;
  IE5 = (document.all && document.getElementById) ? true : false;
  N6  = (document.getElementById && !document.all) ? true : false;
}

function toggle(objeto) {
  getBrowser();

  if(IE5 || N6)
  {
    var elem = document.getElementById(objeto);
    if(elem)
    {
      if ( elem.style.display == "none" )
        elem.style.display = "";
      else
        elem.style.display = "none";
    }
  }
}
