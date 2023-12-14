window.addEventListener("load", function () {

    fetch("http://serverpedroerasmus/views/norol/list_convocatories/js/templates/convocatory.html")
    .then(x => x.text())
    .then(y => {
        // Crear un contenedor div y asignarle el HTML de la plantilla
        var contenedor = document.createElement("div");
        contenedor.innerHTML = y;

        // Obtener la primera pregunta del contenedor
        var pregunta = contenedor.firstChild;

        let api = "http://serverpedroerasmus/api/apiConvocatory.php?convocatory=findByGroup&group=findAll";

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
            console.log(data);
            // Obtener elementos del DOM relevantes
            let convocatory_container = document.getElementById("convocatories_container");
            convocatory_container.innerHTML = "";
            // Mensaje de error en el caso de que no haya convocatorias disponibles
            var msgNoConvocatories = "¡¡No hay convocatorias disponibles para este grupo!!";
            let p = document.createElement("p");
            p.innerHTML = msgNoConvocatories;

            if ( Array.isArray(data) ) 
            {
                var length = data.length;

                // Iterar sobre las preguntas y crear elementos para cada una
                for (var i = 0; i < length; i++) 
                {
                    if (data[i] != null) 
                    {
                        var convocatory = data[i].convocatories[0];
                        var group = data[i].group;
                        var convoAux = pregunta.cloneNode(true);

                        // Asignar contenido
                        this.convocatory_id = convocatory.id;
                        // Agregar clases
                        convoAux.querySelector(".country").innerHTML =              convocatory.country;
                        convoAux.querySelector(".movilities").innerHTML =           convocatory.movilities;
                        convoAux.querySelector(".date_end_requests").innerHTML =    convocatory.date_end_requests;
                        convoAux.querySelector(".group_name").innerHTML =           group.name;
                        // Enlace para acceder a rellenar la solicitud correspondiente
                        convoAux.querySelector("a").href = "?menu=complete_request&id="+convocatory.id;
                        
                        // Agregar la convocatoria y añadirla al contenedor
                        convocatory_container.appendChild(convoAux);
                    }
                }
            }
        })
        
    })

})