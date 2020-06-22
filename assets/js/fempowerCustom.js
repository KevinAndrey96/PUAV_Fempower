//Funciones generales
function cerrar(ventana) {
  var modal = ventana;
  modal.style.display = "none";
}
function abrir(ventana) {
  var theModal = ventana;
  theModal.style.display = "block";
}
//funciones rel_menusByRol
function seleccionarCodigo(var00) {
  document.frmCodigo.id.value = var00;
  document.frmCodigo.btnGuardar.style.visibility = 'hidden';
  document.frmCodigo.btnModificar.style.visibility = 'block';
  document.frmCodigo.btnEliminar.style.visibility = 'block';
  document.frmCodigo.btnCancelar.style.visibility = 'block';
  abrir(document.getElementById("MdlCodigo"));
}
function agregarCodigo() {
  document.frmCodigo.id.value = "";
  document.frmCodigo.idMenu.value = "";
  document.frmCodigo.btnModificar.style.visibility = 'hidden';
  document.frmCodigo.btnEliminar.style.visibility = 'hidden';
  document.frmCodigo.btnGuardar.style.visibility = 'block';
  document.frmCodigo.btnCancelar.style.visibility = 'block';
  abrir(document.getElementById("MdlCodigo"));
}








//funciones rel_menusByRol
function seleccionarRol(var00) {
  document.frmRel_menusByRol.idRol.value = var00;
  document.frmRel_menusByRol.btnGuardar.style.visibility = 'hidden';
  document.frmRel_menusByRol.btnModificar.style.visibility = 'block';
  document.frmRel_menusByRol.btnEliminar.style.visibility = 'block';
  document.frmRel_menusByRol.btnCancelar.style.visibility = 'block';
  abrir(document.getElementById("MdlRel_menusByRol"));
}
function agregarRel_menusByRol() {
  document.frmRel_menusByRol.idRol.value = "";
  document.frmRel_menusByRol.idMenu.value = "";
  document.frmRel_menusByRol.btnModificar.style.visibility = 'hidden';
  document.frmRel_menusByRol.btnEliminar.style.visibility = 'hidden';
  document.frmRel_menusByRol.btnGuardar.style.visibility = 'block';
  document.frmRel_menusByRol.btnCancelar.style.visibility = 'block';
  abrir(document.getElementById("MdlRel_menusByRol"));
}
//funciones oferentes_experiencia
function empleoActual() {
  if (document.getElementById("empleo_actual").checked) {
    document.expOferente.fecha_salida.value = "";
    document.expOferente.fecha_salida.disabled = true;
  } else {
    document.expOferente.fecha_salida.disabled = false;
  }
}
function seleccionarExperiencia(var00, var01, var02, var03, var04, var05, var06, var07, var08, var09, var10, var11) {
  document.expOferente.id.value = var00;
  document.expOferente.empresa.value = var01;
  document.expOferente.telefono.value = var02;
  document.expOferente.municipio.value = var03;
  document.expOferente.fecha_ingreso.value = var05;
  document.expOferente.fecha_salida.value = var07;
  document.expOferente.ocupacion.value = var08;
  document.expOferente.cargo.value = var09;
  document.expOferente.logros.value = var10;
  document.expOferente.id_archivo.value = var11;
  if (var04 === '0') {
    document.expOferente.pasantia.checked = false;
  } else {
    document.expOferente.pasantia.checked = true;
  }
  if (var06 === '0') {
    document.expOferente.empleo_actual.checked = false;
    document.expOferente.fecha_salida.disabled = false;
  } else {
    document.expOferente.empleo_actual.checked = true;
    document.expOferente.fecha_salida.disabled = true;
  }
  document.expOferente.btnGuardar.style.visibility = 'hidden';
  document.expOferente.btnModificar.style.visibility = 'block';
  document.expOferente.btnEliminar.style.visibility = 'block';
  document.expOferente.btnCancelar.style.visibility = 'block';
  abrir(document.getElementById("MdlExperiencia"));
}
function agregarExperiencia() {
  document.expOferente.id.value = "";
  document.expOferente.empresa.value = "";
  document.expOferente.telefono.value = "";
  document.expOferente.municipio.value = "";
  document.expOferente.fecha_ingreso.value = "";
  document.expOferente.fecha_salida.value = "";
  document.expOferente.ocupacion.value = "";
  document.expOferente.cargo.value = "";
  document.expOferente.logros.value = "";
  document.expOferente.id_archivo.value = "";
  document.expOferente.pasantia.checked = false;
  document.expOferente.empleo_actual.checked = false;
  document.expOferente.btnModificar.style.visibility = 'hidden';
  document.expOferente.btnEliminar.style.visibility = 'hidden';
  document.expOferente.btnGuardar.style.visibility = 'block';
  document.expOferente.btnCancelar.style.visibility = 'block';
  abrir(document.getElementById("MdlExperiencia"));
}
//funciones roles
function seleccionarRol(var00, var01, var02, var03) {
  document.FrmRol.btnGuardar.style.visibility = 'visible';
  document.FrmRol.btnModificar.style.visibility = 'visible';
  document.FrmRol.btnEliminar.style.visibility = 'visible';
  document.FrmRol.btnCancelar.style.visibility = 'visible';
  document.FrmRol.id.value = var00;
  document.FrmRol.nombre.value = var01;
  document.FrmRol.descripcion.value = var02;
  document.FrmRol.estado.value = var03;
  document.FrmRol.btnGuardar.style.visibility = 'hidden';
  abrir(document.getElementById("MdlRol"));
}
function agregarRol() {
  document.FrmRol.btnGuardar.style.visibility = 'visible';
  document.FrmRol.btnModificar.style.visibility = 'visible';
  document.FrmRol.btnEliminar.style.visibility = 'visible';
  document.FrmRol.btnCancelar.style.visibility = 'visible';
  document.FrmRol.id.value = "";
  document.FrmRol.nombre.value = "";
  document.FrmRol.descripcion.value = "";
  document.FrmRol.estado.value = "";
  document.FrmRol.btnModificar.style.visibility = 'hidden';
  document.FrmRol.btnEliminar.style.visibility = 'hidden';
  abrir(document.getElementById("MdlRol"));
}
//funciones menus
function seleccionarMenu(var00, var01, var02, var03, var04, var05) {
  document.FrmMenu.btnGuardar.style.visibility = 'visible';
  document.FrmMenu.btnModificar.style.visibility = 'visible';
  document.FrmMenu.btnEliminar.style.visibility = 'visible';
  document.FrmMenu.btnCancelar.style.visibility = 'visible';
  document.FrmMenu.id.value = var00;
  document.FrmMenu.etiqueta.value = var01;
  document.FrmMenu.url.value = var02;
  document.FrmMenu.librerias.value = var03;
  document.FrmMenu.estilos.value = var04;
  document.FrmMenu.estado.value = var05;
  document.FrmMenu.btnGuardar.style.visibility = 'hidden';
  abrir(document.getElementById("MdlMenu"));
}
function agregarMenu() {
  document.FrmMenu.btnGuardar.style.visibility = 'visible';
  document.FrmMenu.btnModificar.style.visibility = 'visible';
  document.FrmMenu.btnEliminar.style.visibility = 'visible';
  document.FrmMenu.btnCancelar.style.visibility = 'visible';
  document.FrmMenu.id.value = "";
  document.FrmMenu.etiqueta.value = "";
  document.FrmMenu.url.value = "";
  document.FrmMenu.librerias.value = "";
  document.FrmMenu.estilos.value = "";
  document.FrmMenu.estado.value = "";
  document.FrmMenu.btnModificar.style.visibility = 'hidden';
  document.FrmMenu.btnEliminar.style.visibility = 'hidden';
  abrir(document.getElementById("MdlMenu"));
}
function libretaMilitar() {
  if (document.frmOferentes_bi.generoCodigo.value !== 20) {
    document.frmOferentes_bi.lm.visibility = 'hidden';
  } else {
    document.frmOferentes_bi.lm.visibility = 'visible';
  }
}
function paisExtranjero() {
  if (document.frmOferentes_bi.extranjeroCodigo.value === 0) {
    document.frmOferentes_bi.paisCodigo0.visibility = 'hidden';
  } else {
    document.frmOferentes_bi.paisCodigo0.visibility = 'visible';
  }
}
function cambio1() {
  if (document.frmOferentes_bi.discapacidad.value == 1) {
    document.frmOferentes_bi.discapacidades.visibility = 'visible';
    alert("Dijo que si y entró a mostrar");
  }
}
function cambio0() {
  if (document.frmOferentes_bi.discapacidad.value == 0) {
    document.frmOferentes_bi.discapacidades.visibility = 'hidden';
    alert("Dijo que no y entró a ocultar");
  }
}