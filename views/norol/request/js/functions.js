
// Inicializo web

function inicializarWeb() {
    // Seleccionar primer botón superior
    topButtonBackgroundColor(); // Coloreo botones superiores de [ Domicilio | UploadFiles ] 

    btnIdentificacion.classList.add('btnSeleccionado');

    ocultarErrores(); // Inicializo errores visibility a false
    v_domicilio.classList.add('eliminar');
    v_uploadFiles.classList.add('eliminar');
    aplicarFeedback(false);

    let currenMenuOption = document.querySelector(".main-menu > ul > li:nth-child(3)");
    currenMenuOption.classList.add("active");
    currenMenuOption.querySelector(".nav-text").innerHTML = "Listar<br>> rellenar solicitud";
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
// ================================== Contacto ================================
// ============================================================================
// SIGUIENTE - Pasar de Contacto a UploadFiles
function domicilio_uploadFiles() {
    v_domicilio.classList.add('eliminar');
    v_uploadFiles.classList.remove('eliminar');
    v_uploadFiles.classList.add('flex'); // TODO cuidado
    estadoFormulario = false;

    h2Titulo.innerHTML = h2UploadFiles;
    siguienteBoton(btnDomicilio, btnUploadFiles);
}

// ANTERIOR - Pasar de Contacto a Identificación
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
    v_uploadFiles.classList.remove('flex'); // TODO cuidado
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






window.addEventListener("load", function () {

    // document.querySelector("input[type='file'][name='file[photo]']").addEventListener("change", function () {
    //     this.style.gridColumn = "1 / 2";
    //     let seePdfIcon = document.createElement("div");
    //     seePdfIcon.classList.add("lupa");
    //     seePdfIcon.addEventListener("click", function () {
    //         // TODO ABRIR MODAL PARA QUE SE VISUALICE LA FOTO :D, hacer los mismo en el mismo formulario con los PDF'S
    //     });
    //     document.querySelector("#identificacion").appendChild(seePdfIcon);
    // });


        document.querySelector("input[type='file'][name='file[photo]']").style.gridColumn = "1 / 2";
        let seePdfIcon = document.createElement("div");
        seePdfIcon.style.width = "100%";
        seePdfIcon.style.height = "80px";
        seePdfIcon.innerHTML = "Vista previa de foto";
        seePdfIcon.style.border = "1px solid black";
        seePdfIcon.style.backgroundColor = "lightgrey";
        // seePdfIcon.classList.add("lupa");
        // seePdfIcon.addEventListener("click", function (ev) {
        //     //ev.preventDefault();

        //     // Fondo modal
        //     var modal = document.createElement("div");
        //     modal.style.position = "fixed";
        //     modal.style.top = 0;
        //     modal.style.left = 0;
        //     modal.style.width = "100%";
        //     modal.style.height = "100%";
        //     modal.style.backgroundColor = "black";
        //     //modal.style.backgroundColor = "rgba(0,0,0,0,5)";
        //     modal.style.opacity = 0.5;
        //     modal.style.zIndex = 99;
        //     document.body.appendChild(modal);

        //     // Contenido modal
        //     var visualizador = document.createElement("div");
        //     visualizador.setAttribute("id","visualizador");
        //     visualizador.style.position = "fixed";
        //     visualizador.style.top = "10%";
        //     visualizador.style.left = "15%";
        //     visualizador.style.width = "70%";
        //     visualizador.style.height = "80%";
        //     visualizador.style.backgroundColor = "white";
        //     visualizador.style.zIndex = 100;
        //     document.body.appendChild(visualizador);

        //     var closer = document.createElement("span");
        //     closer.innerHTML = "X";
        //     closer.style.position = "fixed";
        //     closer.style.top = 0;
        //     closer.style.right = 0;
        //     closer.style.padding = "1em";
        //     closer.style.zIndex = 101;
        //     closer.style.backgroundColor = "darkblue";
        //     closer.style.cursor = "pointer";
        //     closer.style.color = "white";
        //     visualizador.appendChild(closer);

        //     closer.addEventListener("pointerover", function () { this.style.backgroundColor = "black"; })
        //     closer.addEventListener("mousedown", function () { this.style.backgroundColor = "darkred"; })
        //     closer.addEventListener("pointerout", function () { this.style.backgroundColor = "darkblue"; })
        //     closer.addEventListener("click", function () {
        //         document.body.removeChild(modal); //modal.parentElement
        //         document.body.removeChild(visualizador);
        //     })

        //     var btnCancel = document.createElement("button");
        //     btnCancel.type = "button";
        //     btnCancel.id = "btnCancel";
        //     btnCancel.innerHTML = "Cancelar";
        //     visualizador.appendChild(btnCancel);
        //     btnCancel.addEventListener("click", function () {
        //         document.body.removeChild(modal); //modal.parentElement
        //         document.body.removeChild(visualizador);
        //     })

        //     // Crear vista CRUD
        //     fetch("http://serverpedroerasmus/views/norol/request/js/templates/show_image.html")
        //     .then(x=>x.text())
        //     .then(y=>{
        //         let form = document.createElement("div");
        //         form.setAttribute("id", "modal_crud_convocatory");
        //         form.innerHTML = y;
        //         form.style.display = "flex";
        //         form.style.justifyContent = "space-around";
        //         visualizador.appendChild(form);
        //     })
        // });
        document.querySelector("#identificacion").appendChild(seePdfIcon);

});

