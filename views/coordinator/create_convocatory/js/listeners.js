
// Listeners

// Inicializar web
document.body.addEventListener("load", inicializarWeb());


// ============================================================================
// =============================== FORM =======================================
// ============================================================================
form.addEventListener("submit", submit);


// ============================================================================
// ============================== IDENTIFICACIÓN ==============================
// ============================================================================
// select
slctProjects.addEventListener("change", validateSlctProject);

// Inputs
    // Next
    btnInformationNext.addEventListener("click", information_dates);


// ============================================================================
// ================================= FECHAS ===================================
// ============================================================================
// Input and selects
    // Before. Pasar de Dates a Identificación
    btnDatesBefore.addEventListener("click", dates_information);
    // Next
    btnDatesNext.addEventListener("click", dates_items);


// ============================================================================
// ============================ ITEMS BAREMABLES ==============================
// ============================================================================
// Inputs:button
    // Before. Pasar de Items a Dates
    btnItemsBefore.addEventListener("click", items_dates);
// input:submit
