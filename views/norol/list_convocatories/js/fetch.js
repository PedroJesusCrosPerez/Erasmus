window.addEventListener("load", function () {

    document.getElementById("slctGroup").addEventListener("change", function () {
        fetch("http://serverpedroerasmus/views/norol/list_convocatories/js/templates/convocatory.html")
        .then(x => x.text())
        .then(y => {
            // Crear un contenedor div y asignarle el HTML de la plantilla
            var contenedor = document.createElement("div");
            contenedor.innerHTML = y;

            // Obtener la primera pregunta del contenedor
            var pregunta = contenedor.firstChild;

            let api = this.value == "all" ? "http://serverpedroerasmus/api/apiConvocatory.php?convocatory=findByGroup&group=findAll" : 
                                            "http://serverpedroerasmus/api/apiConvocatory.php?convocatory=findByGroup&group=findById&id="+this.value;

            // Obtener convocatorias según grupo del servidor mediante una solicitud GET a la API (apiConvocatory.php)
            fetch(api, {
                method: "GET",
                headers: {"Content-Type": "application/json"}
            })
            .then(response => {
                // Verificar si la respuesta está en el rango de códigos de éxito (200-299)
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Obtener elementos del DOM relevantes
                let convocatory_container = document.getElementById("convocatories_container");
                convocatory_container.innerHTML = "";

                if (data != null && data.convocatories != null) {
                    var length = data.convocatories.length;
                    var group = data.group;
                    // Iterar sobre las preguntas y crear elementos para cada una
                    for (var i = 0; i < length; i++) 
                    {
                        var convocatory = data.convocatories[i];
                        var convoAux = pregunta.cloneNode(true);

                        // Agregar clases y asignar contenido
                        convoAux.id = convocatory.id;
                        convoAux.getElementsByClassName("convocatory_name")[0].innerHTML = convocatory.id;
                        convoAux.getElementsByClassName("group_name")[0].innerHTML = group.name || "Default Statement";//convocatory.statement;

                        // Agregar la pregunta al contenedor y ocultarla
                        convocatory_container.appendChild(convoAux);
                    }
                    }
                })
            
        })
    })

})