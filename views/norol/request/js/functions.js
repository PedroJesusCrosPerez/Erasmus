
// Inicializo web

function inicializarWeb() {
    // Seleccionar primer botón superior
    topButtonBackgroundColor(); // Coloreo botones superiores de [ Domicilio | UploadFiles ] 

    btnIdentificacion.classList.add('btnSeleccionado');

    ocultarErrores(); // Inicializo errores visibility a false
    v_domicilio.classList.add('eliminar');
    v_uploadFiles.classList.add('eliminar');
    aplicarFeedback(false);
}




// ===========================================================================
// ============================== IDENTIFICACIÓN =============================
// ===========================================================================

// SIGUIENTE - Pasar de Identificación a Domicilio
function identificacion_domicilio() {
    v_identificacion.classList.add('eliminar');
    v_domicilio.classList.remove('eliminar');
    
    h2Titulo.innerHTML = h2Domicilio;
    siguienteBoton(btnIdentificacion, btnDomicilio);
}


// ============================================================================
// ================================= DOMICILIO ================================
// ============================================================================
// SIGUIENTE - Pasar de Domicilio a UploadFiles
function domicilio_uploadFiles() {
    v_domicilio.classList.add('eliminar');
    v_uploadFiles.classList.remove('eliminar');
    estadoFormulario = false;

    h2Titulo.innerHTML = h2UploadFiles;
    siguienteBoton(btnDomicilio, btnUploadFiles);
}

// ANTERIOR - Pasar de Domicilio a Identificación
function domicilio_identificacion() {
    v_domicilio.classList.add('eliminar');
    v_identificacion.classList.remove('eliminar');

    h2Titulo.innerHTML = h2Identificacion;
    siguienteBoton(btnDomicilio, btnIdentificacion);
    
}


// =============================================================================
// =================================== OTROS ===================================
// =============================================================================
// ANTERIOR - Pasar de UploadFiles a Domicilio
function uploadFiles_domicilio() {
    v_uploadFiles.classList.add('eliminar');
    v_domicilio.classList.remove('eliminar');

    h2Titulo.innerHTML = h2Domicilio;
    siguienteBoton(btnUploadFiles, btnDomicilio);
}
function uploadFiles_identificacion() {
    v_uploadFiles.classList.add('eliminar');
    v_identificacion.classList.remove('eliminar');

    h2Titulo.innerHTML = h2Identificacion;
    siguienteBoton(btnUploadFiles, btnIdentificacion);
}



// =============================================================================
// ================================== METHODS ==================================
// =============================================================================
function topButtonBackgroundColor() {
    for (let i = 1; i < v_topButton.length; i++) {
        v_topButton[i].classList.add('btnDeseleccionado');
    }
}

function ocultarErrores() {
    for (let i = 0; i < v_inputError.length; i++) {
        v_inputError[i].classList.add('oculto');
    }
}

function siguienteBoton(actual, siguiente) {
    deseleccionarBoton(actual);
    seleccionarBoton(siguiente);
    /*actual.classList.remove('btnSeleccionado');
    actual.classList.add('btnDeseleccionado');
    siguiente.classList.remove('btnDeseleccionado');
    siguiente.classList.add('btnSeleccionado');*/
}
function deseleccionarBoton(boton) {
    boton.classList.remove('btnSeleccionado');
    boton.classList.add('btnDeseleccionado');
}
function seleccionarBoton(boton) {
    boton.classList.remove('btnDeseleccionado');
    boton.classList.add('btnSeleccionado');
}
function mostrarMensajeError(mensaje, input) {
    mensaje.classList.remove('oculto'); // Mostrar el mensaje de error
    input.classList.add('error'); // Mostrar borde rojo
}
function ocultarMensajeError(mensaje, input) {
    mensaje.classList.add('oculto'); // Ocultar el mensaje de error
    input.classList.remove('error'); // Ocultar borde rojo
}


function resetearFormulario()
{
    aplicarFeedback(false);
    uploadFiles_identificacion();
    limpiar();
    //setTimeout( aplicarFeedback(true), 3000 );
    aplicarFeedback(true);
    aplicarFeedbackRetardo(3000);
    //prueba();
}
function aplicarFeedback(estado)
{
    if ( estado )
    document.getElementById('feedback').classList.remove('eliminar');
    else
    document.getElementById('feedback').classList.add('eliminar');
}

function aplicarFeedbackRetardo(time)
{
    setTimeout( aplicarFeedback, time );
}

function limpiar()
{
    setNombre("");
    setPassword("");
    setEmail("");
    setDireccion("");
    if ( getFechaNacimiento() != "" )
        setFechaNacimiento("");
    if ( getDni() != "" )
        setDni("");
    if ( getTelefono() != "" )
        setTelefono("");
    if ( getRBFemenino() == true )
        setRBFemenino(false);
    if ( getRBMasculino() == true )
        setRBMasculino(false);
    if ( getCBCine() == true )
        setCBCine(false);
    if ( getCBMusica() == true )
        setCBMusica(false);
    if ( getCBLectura() == true )
        setCBLectura(false);
}






window.addEventListener("DOMContentLoaded", function () {

    document.querySelector("input[type='file'][name='file[photo]']").addEventListener("change", function () {
        this.style.gridColumn = "1 / 2";
        let seePdfIcon = document.createElement("div");
        seePdfIcon.classList.add("lupa");
        seePdfIcon.addEventListener("click", function () {
            // TODO ABRIR MODAL PARA QUE SE VISUALICE LA FOTO :D, hacer los mismo en el mismo formulario con los PDF'S
        });
        document.querySelector("#identificacion").appendChild(seePdfIcon);
    });

});

