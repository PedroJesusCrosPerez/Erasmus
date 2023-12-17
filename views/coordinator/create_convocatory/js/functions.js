// Inicializo web


function inicializarWeb() {
    // Seleccionar primer botón superior
    topButtonBackgroundColor(); // Coloreo botones superiores de [ Dates | Items ] 

    btnInformation.classList.add('btnSeleccionado');
    // tLanguageLvls.style.display="none";
    tLanguageLvls.style.visibility="hidden";
    ocultarErrores(); // Inicializo errores visibility a false
    v_dates.classList.add('none');
    v_items.classList.add('none');
    aplicarFeedback(false);
    uploadMsgError();


    function toggleBackgroundColor() {
        this.parentElement.parentElement.classList.toggle("item_selected");
    }
    const itemsRequired = document.getElementsByName("baremable[]");
    for (const item of itemsRequired) {
        item.addEventListener("click", toggleBackgroundColor);
    }
    // document.forms[0].val = val;


    // class HTMLFormElement extends Validator {
    //     constructor(form) {
    //         super();
    //         this.form = form;
    //     }

    //     // Método para validar el formulario
    //     validar() {
    //         return this.validateForm(this.form);
    //     }

    //     hablar() {
    //         alert("Hoalaaa, estoy hablandooo");
    //     }
    // }

    // // Crea una instancia de FormValidator y asigna al formulario
    // const miFormulario = new FormValidator(document.getElementById('miFormulario'));
}





// ===========================================================================
// ========================== ENVÍO DE FORMULARIO ============================
// ===========================================================================
function submit(event) {
    // Lógica de validación
    const val = new Validator();


    if ( !this.status && !val.isError() ) {
        // Si no están todos rellenados, evita que se envíe el formulario
        event.preventDefault();
        alert("Por favor, completa todos los campos de texto.");
    }
}


// ===========================================================================
// ================================ VALIDAR ==================================
// ===========================================================================
function hide_error(input, status) {
    // Asegurarse de que input no es null o undefined
    if (input) {
        let lblError = input.lblError;
        let msgError = input.msgError;

        // Asegurarse de que lblError no es null o undefined
        if (lblError) {
            if (status == true) {
                lblError.innerHTML = msgError;
                lblError.classList.remove("hide");
                console.log("FALSE");
            } else {
                lblError.innerHTML = "";
                lblError.classList.add("hide");
                console.log("TRUE");
            }
        } else {
            console.error('lblError is ==> '+lblError);
            console.error('lblError is undefined or null');
        }
    } else {
        console.error('input is undefined or null');
    }
}


let val = new Validator();
/* Inicializar inputs y selects */
function uploadMsgError() {
    fetch(msgErrorjsonFilePath)
    .then(response => response.json())
    .then(data => {
        let fieldNames = Array.from(new FormData(form).keys());
        console.log(fieldNames);

        for (const fieldName of fieldNames) {
            let inputElement = form.querySelector(`[name="${fieldName}"]`);
            if (inputElement) {
                inputElement.msgError = data[fieldName] || '';
                inputElement.status = false;
                // inputElement.lblError = inputElement.labels[1];
                // inputElement.lblError = document.getElementById(data[fieldName]+"Error");
                
                switch (fieldName) {
                    case "project":
                        // let valProject = new Validator();
                        // inputElement.validar = function () {
                        //     valProject.isNull(this.value,fieldName,"Debes seleccionar un proyecto");
                        // };
                        inputElement.addEventListener("change", function () {
                            // this.validar();
                            let inputError = document.querySelector("#"+fieldName+"Error");
                            if (this.value == "null") {
                                inputError.classList.remove("hide");
                                this.classList.add("lblError");
                                inputError.innerHTML = this.msgError;
                                // console.log(valProject.getErrors());
                                this.status = false;
                            } else {
                                this.classList.remove("lblError");
                                inputError.classList.add("hide");
                                inputError.innerHTML = "";
                                this.status = true;
                            }
                        })
                        break;

                    case "country":
                        let valCountry = new Validator();
                        inputElement.validar = function validar() {
                            valCountry.isEmpty(this.value,fieldName,"El campo se encuentra vacío");
                        };
                        inputElement.addEventListener("change", function () {
                            this.validar();
                            let inputError = document.querySelector("#"+fieldName+"Error");
                            if (valCountry.isError()) {
                                inputError.classList.toggle("hide");
                                this.classList.toggle("lblError");
                                inputError.innerHTML = this.msgError;
                                console.log(valCountry.getErrors());
                                this.status = false;
                            } else {
                                this.classList.remove("lblError");
                                inputError.classList.add("hide");
                                inputError.innerHTML = "";
                                this.status = true;
                            }
                        })
                        break;

                    case "group":
                        // let valGroup = new Validator();
                        // inputElement.validar = function validar() {
                        //     valGroup.isNull(this.value,fieldName,"Debes seleccionar un grupo");
                        // };
                        inputElement.addEventListener("change", function () {
                            // this.validar();
                            let inputError = document.querySelector("#"+fieldName+"Error");
                            if (this.value == "null") {
                                inputError.classList.remove("hide");
                                this.classList.add("lblError");
                                inputError.innerHTML = this.msgError;
                                // console.log(valGroup.getErrors());
                                this.status = false;
                            } else {
                                this.classList.remove("lblError");
                                inputError.classList.add("hide");
                                inputError.innerHTML = "";
                                this.status = true;
                            }
                        })
                        break;
                        
                    case "movilities":
                        // let valMovilities = new Validator();
                        // inputElement.validar = function validar() {
                        //     valMovilities.intRange(this.value,fieldName,"El campo se encuentra vacío", 1, 30);
                        // };
                        inputElement.addEventListener("change", function () {
                            // this.validar();
                            let inputError = document.querySelector("#"+fieldName+"Error");
                            // if (valMovilities.isError()) {
                            if ( !(this.value >= 1 && this.value <= 30) ) {
                                inputError.classList.remove("hide");
                                this.classList.add("lblError");
                                inputError.innerHTML = this.msgError;
                                // console.log(valMovilities.getErrors());
                                this.status = false;
                            } else {
                                this.classList.remove("lblError");
                                inputError.classList.add("hide");
                                inputError.innerHTML = "";
                                this.status = true;
                            }
                        })
                        break;
                    
                    default:
                        inputElement.validar = function validar() { alert("Si"); };
                        break;
                }
            }
                   
            let inputsRadio = document.querySelectorAll("input[name='type']");
            let inputError = document.querySelector("#typeError");
            let lblType = document.querySelector("div[name='divType']");

            function checkRadioButtons() {
                if ( inputsRadio[0].checked || inputsRadio[1].checked ) {
                    lblType.classList.remove("lblError");
                    inputError.classList.add("hide");
                    inputError.innerHTML = "";
                    inputsRadio[0].status = true;
                    inputsRadio[1].status = true;
                } else {
                    lblType.classList.add("lblError");
                    inputError.classList.remove("hide");
                    inputError.innerHTML = "Debes seleccionar al menos 1 tipo de movilidad";
                    inputsRadio[0].status = false;
                    inputsRadio[1].status = false;
                }
                
            }

            inputsRadio[0].addEventListener("change", function () {
                checkRadioButtons();
            })
        }
    })
    .catch(error => console.error('Error al cargar el archivo JSON (msgError.json):', error));  
}

function uploadMsgErrorDates() {
    // fetch(msgErrorjsonFilePath)
    // .then(response => response.json())
    // .then(data => {
        // let fieldNames = Array.from(new FormData(form).keys());
        let fieldNames = ["date_requests_start", "date_requests_end", "date_baremation", "date_definitive_lists"];
        // console.log(fieldNames);
        
        for (const fieldName of fieldNames) {
            let inputElement = form.querySelector('input[name="'+fieldName+'"]');
            if (inputElement) {
                inputElement.status = false;
                
                switch (fieldName) {
                    case "date_requests_start":
                        inputElement.addEventListener("change", function () {
                            let inputError = document.querySelector("#"+fieldName+"Error");
                            let nextDate = document.querySelector("#date_requests_end");
                            if ( this.value == "" ) {
                                inputError.classList.remove("hide");
                                this.classList.add("lblError");
                                inputError.innerHTML = "Debes elegir una fecha para recibir solicitudes";
                                this.status = false;
                                nextDate.classList.add("inputDisabled");
                            } else {
                                this.classList.remove("lblError");
                                inputError.classList.add("hide");
                                inputError.innerHTML = "";
                                this.status = true;
                                nextDate.classList.remove("inputDisabled");
                            }
                        })
                        break;
                    
                    case "date_requests_end":
                        inputElement.classList.add("inputDisabled");
                        inputElement.addEventListener("change", function () {
                            let inputError = document.querySelector("#"+fieldName+"Error");
                            let beforeDate = document.querySelector("#date_requests_start");
                            let nextDate = document.querySelector("#date_baremation");
                            if ( this.value <= beforeDate.value ) {
                                inputError.classList.remove("hide");
                                this.classList.add("lblError");
                                inputError.innerHTML = "Esta fecha debe ser mayor que la de inicio de solicitudes";
                                this.status = false;
                                nextDate.classList.add("inputDisabled");
                            } else {
                                this.classList.remove("lblError");
                                inputError.classList.add("hide");
                                inputError.innerHTML = "";
                                this.status = true;
                                nextDate.classList.remove("inputDisabled");
                            }
                        })
                        inputElement.classList.add("inputDisabled");
                        break;
                    
                    case "date_baremation":
                        inputElement.classList.add("inputDisabled");
                        inputElement.addEventListener("change", function () {
                            let inputError = document.querySelector("#"+fieldName+"Error");
                            let beforeDate = document.querySelector("#date_requests_end");
                            let nextDate = document.querySelector("#date_definitive_lists");
                            if ( this.value <= beforeDate.value ) {
                                inputError.classList.remove("hide");
                                this.classList.add("lblError");
                                inputError.innerHTML = "Esta fecha debe ser mayor que fin de solicitudes";
                                this.status = false;
                                nextDate.classList.add("inputDisabled");
                            } else {
                                this.classList.remove("lblError");
                                inputError.classList.add("hide");
                                inputError.innerHTML = "";
                                this.status = true;
                                nextDate.classList.remove("inputDisabled");
                            }
                        })
                        inputElement.classList.add("inputDisabled");
                        break;
                    
                    case "date_definitive_lists":
                        inputElement.classList.add("inputDisabled");
                        inputElement.addEventListener("change", function () {
                            let inputError = document.querySelector("#"+fieldName+"Error");
                            let beforeDate = document.querySelector("#date_baremation");
                            if ( this.value <= beforeDate.value ) {
                                inputError.classList.remove("hide");
                                this.classList.add("lblError");
                                inputError.innerHTML = "Esta fecha debe ser mayor que baremación";
                                this.status = false;
                            } else {
                                this.classList.remove("lblError");
                                inputError.classList.add("hide");
                                inputError.innerHTML = "";
                                this.status = true;
                            }
                        })
                        inputElement.classList.add("inputDisabled");
                        break;
                }
            }
        }
    // })
    // .catch(error => console.error('Error al cargar el archivo JSON (msgError.json):', error));  
}

// window.addEventListener("load", function () {
    

document.forms[0].addEventListener("submit", function (ev) {
    
    if (val.isError()) {
        ev.preventDefault();
        let errors = val.gerErrors();

        for (const error of errors) {
            console.log(error);
        }
        alert("Error en la creación de la convocatoria");
    } else {
        alert("¡¡Convocatoria creada con éxito!!");
        // ev.preventDefault();
        console.log(val);
        // alert(val);
    }
})
// })


btnInformationNext.addEventListener("click", function () {
    
    let fieldNames = [
        "project",
        "country",
        "group",
        "movilities"
    ]
    // let fieldNames = Array.from(new FormData(form).keys());
    // console.log(fieldNames);
    // let i = 0;
    for (const fieldName of fieldNames) {
        // if (i > 3) {
            
        let inputElement = form.querySelector(`[name="${fieldName}"]`);
        let inputError = document.querySelector("#"+fieldName+"Error");

        if (inputElement && inputElement.status == true) {
            inputElement.style.border = "none";
            inputElement.classList.remove("lblError");
            inputError.classList.add("hide");
            inputError.innerHTML = "";
            this.status = true;
            information_dates();
        } else {
            inputElement.classList.add("lblError");
            inputError.classList.remove("hide");
            inputError.innerHTML = inputElement.msgError;
            this.status = false;
        }
        // } else { break; }
        // i++;
        
    }

})


function inicialiceItemsBaremables() {
    let itemEntrevista = document.querySelectorAll("[name='baremable[]'")[2];
    itemEntrevista.checked = true;
    itemEntrevista.classList.add("inputDisabled");
    // itemEntrevista.parentElement.parentElement.classList.add = "item_selected";
    itemEntrevista.parentElement.parentElement.style.backgroundColor = "grey";

    itemEntrevista.parentElement.parentElement.children[2].firstChild.checked = true;
    itemEntrevista.parentElement.parentElement.children[3].firstChild.value = 1;
    itemEntrevista.parentElement.parentElement.children[4].firstChild.value = 2;
}




// ===========================================================================
// ============================ INFORMATION ==================================
// ===========================================================================
let itemStatus = false;
// let lblError_aux = document.querySelector("#projectError");
// debugger;
slctProjects.lblError = lblError_slctProjects;

function validateSlctProject() {
    // console.log("THIS.lblError ==> " + this.lblError);
    // console.log("THIS ==> " + this);
    itemStatus = this.value == "null" ? false : true;
    hide_error(this, itemStatus);
    this.innerHTML = "Holdlfaslfd";
    debugger
}


window.addEventListener("load", function () {
    
})
// function validateInputCountry() {
//     itemStatus = false;
//     itemStatus = this.value == "null" ? false : true;
//     hide_error(lblError_slctProjects, msgError_slctProjects, itemStatus);
// }


// function areTextInputsFilled() {
//     // Obtiene todos los campos de texto dentro del formulario
//     var textInputs = document.querySelectorAll("input[type='text']");
    
//     // Verifica si todos los campos de texto están rellenados
//     for (var i = 0; i < textInputs.length; i++) {
//         if (textInputs[i].value.trim() === "") {
//             return false;
//         }
//     }
//     return true;
// }



// ===========================================================================
// ======================= NAVEGACIÓN DE FORMULARIO ==========================
// ===========================================================================
// ===========================================================================
// ================================= INFORMATION =============================
// ===========================================================================

// SIGUIENTE - Pasar de Identificación a Dates
function information_dates() {
    v_information.classList.add('none');
    v_dates.classList.remove('none');
    
    h2Titulo.innerHTML = h2Dates;
    siguienteBoton(btnInformation, btnDates);
    uploadMsgErrorDates();
}


// ============================================================================
// ===================================== DATES ================================
// ============================================================================
// SIGUIENTE - Pasar de Dates a Items
function dates_items() {
    v_dates.classList.add('none');
    v_items.classList.remove('none');
    estadoFormulario = false;

    h2Titulo.innerHTML = h2Items;
    siguienteBoton(btnDates, btnItems);
    inicialiceItemsBaremables();
}

// ANTERIOR - Pasar de Dates a Identificación
function dates_information() {
    v_dates.classList.add('none');
    v_information.classList.remove('none');

    h2Titulo.innerHTML = h2Information;
    siguienteBoton(btnDates, btnInformation);
    
}


// =============================================================================
// =================================== ITEMS ===================================
// =============================================================================
// ANTERIOR - Pasar de Items a Dates
function items_dates() {
    v_items.classList.add('none');
    v_dates.classList.remove('none');

    h2Titulo.innerHTML = h2Dates;
    siguienteBoton(btnItems, btnDates);
}
function items_information() {
    v_items.classList.add('none');
    v_information.classList.remove('none');

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
        v_inputError[i].classList.add('hide');
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
    mensaje.classList.remove('hide'); // Mostrar el mensaje de error
    input.classList.add('error'); // Mostrar borde rojo
}
function ocultarMensajeError(mensaje, input) {
    mensaje.classList.add('hide'); // Ocultar el mensaje de error
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
    document.getElementById('feedback').classList.remove('none');
    else
    document.getElementById('feedback').classList.add('none');
}

function aplicarFeedbackRetardo(time)
{
    setTimeout( aplicarFeedback, time );
}



document.querySelector("input[value='4']").addEventListener("change", function () {
    // tLanguageLvls.style.display = this.checked ? "" : "none";
    tLanguageLvls.style.visibility = this.checked ? "" : "hidden";
})




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