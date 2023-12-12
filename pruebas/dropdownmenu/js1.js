    // Manejar clic en elementos con clase "desplegable"
    var desplegables = document.querySelectorAll(".desplegable");
    desplegables.forEach(function (desplegable) {
        desplegable.addEventListener("click", function () {
            // var contenido = this.nextElementSibling;
            var contenido = this.lastElementChild;
            if (contenido.style.display === "block") {
                contenido.style.display = "none";
            } else {
                contenido.style.display = "block";
            }
        });
    });

    var contenido = document.querySelectorAll(".contenido");
    for (const item of contenido) {
        item.style.visibility = "hidden";
    }