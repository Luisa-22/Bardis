/**
 * Se crea una función llamada submenu con la cual se perimitirá hacer que el menú visible para el usuario
 */
function submenu(){
  /**
   * se obtiene el elemento de id 'section-opc' y se pone visible.
  */
  document.getElementById('section-opc').style.display = "block";
  /**
   * se obtiene el elemento de id 'icon-2' que es un icono de una flecha hacia arriba y se pone visible.
  */
  document.getElementById('icon-2').style.display = "inline-flex";
  /**
   * se obtiene el elemento de id 'icon-1' que es un icono de una flecha hacia abajo y se pone invisible.
  */
  document.getElementById('icon-1').style.display = "none";
}
/** 
 * se crea la función quitarsubmenu para que se coulte el menú
*/
function quitarsubmenu(){/**
  * se obtiene el elemento de id 'section-opc' y se pone invisible para el usuario.
 */
  document.getElementById('section-opc').style.display = "none";
  /**
   * se obtiene el elemento de id 'icon-2' que es un icono de una flecha hacia arriba y se pone invisible para el usuario.
  */
  document.getElementById('icon-2').style.display = "none";
  /**
   * se obtiene el elemento de id 'icon-1' que es un icono de una flecha hacia abajo y se pone visible para el usuario.
  */
  document.getElementById('icon-1').style.display = "inline-flex";
}