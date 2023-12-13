// document.addEventListener("DOMContentLoaded", function () {

    // Manejar clic en elementos con clase "desplegable"
    var desplegables = document.querySelectorAll(".desplegable > span");
    desplegables.forEach(function (desplegable) {
        desplegable.addEventListener("click", function () {
            var contenido = this.nextElementSibling;
            if (contenido.style.display === "block") {
                contenido.style.display = "none";
            } else {
                contenido.style.display = "block";
            }
        });
    });

    // Función para encontrar el padre LI de un elemento
    function findParentLi(element) {
        var parent = element.parentNode;
        while (parent && parent.tagName !== "LI") {
            parent = parent.parentNode;
        }
        return parent;
    }

// });
