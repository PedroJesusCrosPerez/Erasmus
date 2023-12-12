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

    // Manejar clic en elementos con clase "triCheckbox"
    var triCheckboxes = document.querySelectorAll(".triCheckbox");
    triCheckboxes.forEach(function (triCheckbox) {
        triCheckbox.addEventListener("click", function () {
            var estado = Number(this.getAttribute("data-estado"));
            if (estado === 1) {
                estado = -2;
            }

            estado += 1;

            // Comprobar si estamos en padre o en hijo.
            var liPadre = findParentLi(this);

            if (liPadre && liPadre.querySelectorAll('ul').length >= 2) {
                // Entonces el elemento es un hijo

                // Si estamos en el hijo dando permisos, dárselos al padre.
                var permisoPadre = liPadre.closest('ul').closest('li').querySelector('.triCheckbox');
                if (estado !== -1 && permisoPadre.getAttribute("data-estado") == -1) {
                    permisoPadre.setAttribute("data-estado", 0);
                }

            } else {
                // Si estamos quitando permisos, quitar a los hijos
                if (estado == -1) {
                    var hijosCheckbox = liPadre.querySelectorAll(".triCheckbox");
                    hijosCheckbox.forEach(function (hijoCheckbox) {
                        hijoCheckbox.setAttribute("data-estado", estado);
                    });
                }
            }

            this.setAttribute("data-estado", estado);
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
