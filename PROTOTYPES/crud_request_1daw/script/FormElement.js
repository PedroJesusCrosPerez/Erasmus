
// FORMULARIOS
var v_identificacion = document.getElementById("identificacion");
var v_domicilio = document.getElementById("domicilio");
var v_otros = document.getElementById("otros");

var v_inputError = document.getElementsByClassName("inputError"); // errores de input
var v_topButton = document.getElementsByClassName("topButton");

// Botones superiores
var btnIdentificacion = document.getElementById("btnIdentificacion");
var btnDomicilio = document.getElementById("btnDomicilio");
var btnOtros = document.getElementById("btnOtros");
// Texto título (h2) superior
var h2Titulo = document.getElementById('h2Titulo');
var h2Identificacion    = "Identificación";
var h2Domicilio         = "Domicilio";
var h2Otros             = "Otros";

// ============================================================================
// ============================== IDENTIFICACIÓN ==============================
// ============================================================================
// Botón
var btnIdentificacionSiguiente = document.getElementById("ideSiguiente");


// ===========================================================================
// ================================ DOMICILIO ================================
// ===========================================================================
// Botones
var btnDomiAnterior = document.getElementById("btnDomiAnterior");
var btnDomiSiguiente = document.getElementById("btnDomiSiguiente");

// ===========================================================================
// ================================== OTROS ==================================
// ===========================================================================
// Botones
var btnOtrosAnterior = document.getElementById("btnOtrosAnterior");
var btnOtrosEnviar = document.getElementById("btnOtrosEnviar");