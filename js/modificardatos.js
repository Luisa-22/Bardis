function submenu(){
  document.getElementById('section-opc').style.display = "block";
  document.getElementById('icon-2').style.display = "inline-flex";
  document.getElementById('icon-1').style.display = "none";
}
function quitarsubmenu(){
  document.getElementById('section-opc').style.display = "none";
  document.getElementById('icon-2').style.display = "none";
  document.getElementById('icon-1').style.display = "inline-flex";
}
function cambiarcontraseña(){
	document.getElementById('cambiarcontraseña').style.display="block";
	document.getElementById('enlace').style.display="none";
	return false;
}
function actualizardatos(){
	document.getElementById('cambiarcontraseña').style.display="none";
	document.getElementById('enlace').style.display="inline-block";
	alert("Datos cambiados exitosamente")
}
