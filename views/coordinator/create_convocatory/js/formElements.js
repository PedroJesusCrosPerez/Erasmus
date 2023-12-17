
// FORMULARIOS
let form = document.forms[0];
form.status = false;
let v_information = document.getElementById("information");
let v_dates = document.getElementById("dates");
let v_items = document.getElementById("items");

let v_inputError = document.getElementsByClassName("inputError"); // errores de input
let v_topButton = document.getElementsByClassName("topButton");

// VALIDATOR
// const val = new Validator();

// Botones superiores
let btnInformation =document.getElementById("btnInformation");
let btnDates =      document.getElementById("btnDates");
let btnItems =      document.getElementById("btnItems");
// Texto título (h2) superior
let h2Titulo =      document.getElementById('h2Titulo');
let h2Information = "Información";
let h2Dates       = "Fechas";
let h2Items       = "Items baremables";

// ============================================================================
// ============================== INFORMATION =================================
// ============================================================================
// Elementos del formulario
// select
let slctProjects =          document.querySelector("select[name='project']");
let lblError_slctProjects = document.querySelector("#projectError");
let slctGroups =            document.querySelector("select[name='group']");
let lblError_slctGroups =   document.querySelector("#groupError");
// input:text
const inputCountry =          document.querySelector("input[name='country']");
let lblError_inputCountry = document.querySelector("#countryError");
// input:number
let inputMovilities =           document.querySelector("input[name='movilities']");
let lblError_inputMovilities =  document.querySelector("#movilitiesError");
// input:radio
let inputLong =             document.querySelector("input[name='type'][value='long']");
let inputshort =            document.querySelector("input[name='type'][value='short']");
let lblError_inputType =    document.querySelector("#typeError");
// Botón
let btnInformationNext =    document.getElementById("btnInformationNext");




// ============================================================================
// ================================== DATES ===================================
// ============================================================================
// Elementos del formulario
// input:date
let inputDateRequestsStart =            document.querySelector("input[name='date_requests_start']");
let lblError_inputDateRequestsStart =   document.querySelector("#date_requests_startError");
let inputDateRequestsEnd =              document.querySelector("input[name='date_requests_end']");
let lblError_inputDateRequestsEnd =     document.querySelector("#date_requests_endError");
let inputDateBaremation =               document.querySelector("input[name='date_baremation']");
let lblError_inputDateBaremation =      document.querySelector("#date_baremationError");
let inputDateDefinitiveLists =          document.querySelector("input[name='date_definitive_lists']");
let lblError_inputDateDefinitiveLists = document.querySelector("#date_definitive_listsError");
// Botones
let btnDatesBefore =    document.getElementById("btnDatesBefore");
let btnDatesNext =      document.getElementById("btnDatesNext");

// ============================================================================
// ========================== ITEMS BAREMABLES ================================
// ============================================================================
// Tabla
let tbody =             document.getElementById("tbody_items_batemable");
let tLanguageLvls =     document.querySelector("table[name='language_levels']");
// Botones
let btnItemsBefore =    document.getElementById("btnItemsBefore");
let btnSubmit =         document.getElementById("btnItemsSend");




// ============================================================================
// ============================= ERROR MESSAGES ===============================
// ============================================================================

// ============================================================================
// ============================== INFORMATION =================================
// ============================================================================
let msgError_slctProjects =      "Es obligatorio pertenecer a un proyecto.";
let msgError_slctGroups =        "Debes seleccionar el grupo al que va dirigida.";
let msgError_inputCountry =      "Debes escribir un país de destino válido.";
let msgError_inputMovilities =   "Debes seleccionar al menos 1 movilidad.";
let msgError_inputType =         "Debes seleccionar al menos un tipo de convocatoria.";

// ============================================================================
// ================================== DATES ===================================
// ============================================================================


// ============================================================================
// ========================== ITEMS BAREMABLES ================================
// ============================================================================




// ============================================================================
// ========================== INPUTS TO OBJECTS ===============================
// ============================================================================
// inputCountry.msgError = msgError.json;
// inputCountry.status = false;
// inputCountry.lblError = lblError_slctProjects;
// console.log(inputCountry.lblError);
// inputCountry.lblError = "lblError_slctProjects";

const msgErrorjsonFilePath = '/helpersJS/msgError.json';
