
// Listeners

// Inicializar web
document.body.addEventListener("load", inicializarWeb());


// ============================================================================
// ============================== IDENTIFICACIÓN ==============================
// ============================================================================
// Inputs
    // Siguiente
    btnIdentificacionSiguiente.addEventListener("click", identificacion_domicilio);


// ===========================================================================
// ================================ DOMICILIO ================================
// ===========================================================================
// Input and selects
    // Anterior. Pasar de Domicilio a Identificación
    btnDomiAnterior.addEventListener("click", domicilio_identificacion);
    // Siguiente
    btnDomiSiguiente.addEventListener("click", domicilio_uploadFiles);


// ===========================================================================
// ================================== OTROS ==================================
// ===========================================================================
// Inputs
    // Anterior. Pasar de UploadFiles a Domicilio
    btnUploadFilesAnterior.addEventListener("click", uploadFiles_domicilio);
    // Siguiente. Pasar de UploadFiles a Domicilio
    btnUploadFilesAnterior.addEventListener("click", uploadFiles_domicilio);