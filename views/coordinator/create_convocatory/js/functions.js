
// Inicializo web

function inicializarWeb() {
    // Seleccionar primer botón superior
    topButtonBackgroundColor(); // Coloreo botones superiores de [ Dates | Items ] 

    btnInformation.classList.add('btnSeleccionado');

    ocultarErrores(); // Inicializo errores visibility a false
    v_dates.classList.add('eliminar');
    v_items.classList.add('eliminar');
    aplicarFeedback(false);
}



// ===========================================================================
// ================================= INFORMATION =============================
// ===========================================================================

// SIGUIENTE - Pasar de Identificación a Dates
function information_dates() {
    v_information.classList.add('eliminar');
    v_dates.classList.remove('eliminar');
    
    h2Titulo.innerHTML = h2Dates;
    siguienteBoton(btnInformation, btnDates);
}


// ============================================================================
// ===================================== DATES ================================
// ============================================================================
// SIGUIENTE - Pasar de Dates a Items
function dates_items() {
    v_dates.classList.add('eliminar');
    v_items.classList.remove('eliminar');
    estadoFormulario = false;

    h2Titulo.innerHTML = h2Items;
    siguienteBoton(btnDates, btnItems);
}

// ANTERIOR - Pasar de Dates a Identificación
function dates_information() {
    v_dates.classList.add('eliminar');
    v_information.classList.remove('eliminar');

    h2Titulo.innerHTML = h2Information;
    siguienteBoton(btnDates, btnInformation);
    
}


// =============================================================================
// =================================== ITEMS ===================================
// =============================================================================
// ANTERIOR - Pasar de Items a Dates
function items_dates() {
    v_items.classList.add('eliminar');
    v_dates.classList.remove('eliminar');

    h2Titulo.innerHTML = h2Dates;
    siguienteBoton(btnItems, btnDates);
}
function items_information() {
    v_items.classList.add('eliminar');
    v_information.classList.remove('eliminar');

    h2Titulo.innerHTML = h2Information;
    siguienteBoton(btnItems, btnInformation);
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
    items_information();
    limpiar(); // TODO
    //setTimeout( aplicarFeedback(true), 3000 );
    aplicarFeedback(true);
    aplicarFeedbackRetardo(3000);
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




// TODO todo esto ya no sirve prq el formulario se lee en php desde $_POST[]
// TODO este código se puede reutilizar para el formulario de solicitud
// ===========================================================================
// ========================== ENVÍO DE FORMULARIO ============================
// ===========================================================================
// function getTableData() {
//     // Obtén todas las filas de la tabla
//     const tableRows = document.querySelectorAll("table tbody tr");

//     // Itera sobre cada fila
//     for (const row of tableRows) {
//         // Obtén todas las celdas de la fila actual
//         const cells = row.querySelectorAll("td");

//         // Objeto para almacenar los valores de cada fila
//         const rowData = {};

//         // Itera sobre cada celda de la fila
//         for (const cell of cells) {
//             // Busca el primer input dentro de la celda actual
//             const input = cell.querySelector("input");

//             // Verifica si hay un input presente
//             if (input) {
//                 // Verifica si el input es un checkbox
//                 if (input.type === "checkbox") {
//                     // Almacena el estado del checkbox (marcado o no marcado)
//                     rowData[input.name] = input.checked;
//                 } else {
//                     // Almacena el valor del input en la celda actual
//                     rowData[input.name] = input.value;
//                 }
//             }
//         }
//     }

//     return rowData;
// }

// HTMLFormElement.prototype.getFormData = function () {
//     let formData = new FormData(this);
//     let formDataObject = {};

//     for (const [key, value] of formData.entries()) {
//         formDataObject[key] = value;
//     }

//     formDataObject["item"] = JSON.parse(localStorage.getItem("item"));
// }


// document.getElementById("btnItemsSend").addEventListener("click", function (ev) {
//     ev.preventDefault();
    
//     let formDataObject = document.forms["request"].getFormData();
// });


// function createTbody() {
//     var jsonData = [
//         { id: 1, name: 'Expediente' },
//         { id: 2, name: 'Idiomas' },
//         { id: 3, name: 'Entrevista' },
//         { id: 4, name: 'Idoneidad' }
//     ];
    
//     var length = jsonData.length;
//     for (let i = 0; i < length; i++) {
//         let tdName = document.createElement("td");
//         tdName.id = jsonData[i].id;
        
//     }
//     console.log(JSON.parse(jsonText));
// }

// function createTr(data) {
//     let tr = document.createElement("tr");
    
//     var tdName = document.createElement("td");
//     var selectName = document.createElement("select");

//     inputName.type = "text";
//     inputName.name = "item_baremable_name";
//     inputName.disabled = true;
//     inputName.value = data["name"];
//     tdName.appendChild(inputName);
        
//     var tdRequired = document.createElement("td");
//     var inputRequired = document.createElement("input");
//     inputRequired.type = "checkbox";
//     inputRequired.name = "required";
//     inputRequired.disabled = true;
//     inputRequired.checked = data["required"];
//     tdRequired.appendChild(inputRequired);

//     var tdMin_value = document.createElement("td");
//     var inputMin_value = document.createElement("input");
//     inputMin_value.type = "number";
//     inputMin_value.name = "min_value";
//     inputMin_value.disabled = true;
//     inputMin_value.value = data["min_value"];
//     tdMin_value.appendChild(inputMin_value);
    
//     var tdMax_value = document.createElement("td");
//     var inputMax_value = document.createElement("input");
//     inputMax_value.type = "number";
//     inputMax_value.name = "min_value";
//     inputMax_value.disabled = true;
//     inputMax_value.value = data["max_value"];
//     tdMax_value.appendChild(inputMax_value);

//     tr.appendChild(tdName);
//     tr.appendChild(tdRequired);
//     tr.appendChild(tdMin_value);
//     tr.appendChild(tdMax_value);
// }