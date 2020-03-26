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
function musica(){
  	document.getElementById('btn').style.display = "none";
    document.getElementById('div-music').style.display = "block";
}
function iniciodj(){
    	document.getElementById('btn').style.display = "inline-grid";
      document.getElementById('div-music').style.display = "none";
}
