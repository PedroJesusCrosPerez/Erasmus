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
                        for (const convocatory of data[i].convocatories) {
                            // var convocatory = data[i].convocatories[0];
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
                            convoAux.querySelector("a").href = "?menu=complete_request&convocatory_id="+convocatory.id;
                            
                            // Agregar la convocatoria y añadirla al contenedor
                            convocatory_container.appendChild(convoAux);
                        }
                    }
                }
            }
        })
        
    })

    function formatear(cadena) {
        return cadena.charAt(0).toUpperCase() + cadena.slice(1).toLowerCase();
    }

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
                console.log(data);
                // Obtener elementos del DOM relevantes
                let convocatory_container = document.getElementById("convocatories_container");
                convocatory_container.innerHTML = "";
                // Mensaje de error en el caso de que no haya convocatorias disponibles
                var msgNoConvocatories = "¡¡No existen convocatorias disponibles para este grupo!!";
                let p = document.createElement("p");
                p.innerHTML = msgNoConvocatories;

                if (data != null ) {
                    if (!Array.isArray(data)) {
                        if (data.convocatories && data.convocatories != null) {
                            var length = data.convocatories.length;
                            var group = data.group;
                            // Iterar sobre las preguntas y crear elementos para cada una
                            for (var i = 0; i < length; i++) 
                            {
                                var convocatory = data.convocatories[i];
                                var convoAux = pregunta.cloneNode(true);
        
                                // Agregar clases y asignar contenido
                                convoAux.id = convocatory.id;
                                convoAux.getElementsByClassName("country")[0].innerHTML = convocatory.country;
                                convoAux.getElementsByClassName("group_name")[0].innerHTML = group.name || "Default Statement";//convocatory.statement;
                                // convoAux.getElementsByClassName("a")[0].setAtributte("href", window.location.host+"?menu=complete_request&id="+convocatory.id);
                                // convoAux.getElementsByClassName("a")[0].setAtributte("href", window.location.host+"?menu=complete_request&id="+convocatory.id);
                                convoAux.querySelector("a").href = "?menu=complete_request&convocatory_id="+convocatory.id;
        
                                // Agregar la pregunta al contenedor y ocultarla
                                convocatory_container.appendChild(convoAux);
                            }
                        } else {
                            p.style.color = "white";
                            p.style.fontSize = "2.5em";
                            convocatory_container.appendChild(p);
                        }
                    } else {
                        length = data.length;

                        for (var i = 0; i < length; i++) {
                            if ( data[i] != null ) {
                                
                                var item = data[i];
                                var convocatories = item.convocatories;
                            
                                if (convocatories) {
                                    var length_j = convocatories.length;
                            
                                    for (var j = 0; j < length_j; j++) {
                                        var convocatory = convocatories[j];
                                        if (convocatory != null) {
                                            var convoAux = pregunta.cloneNode(true);
                                
                                            // Agregar clases y asignar contenido
                                            convoAux.id = convocatory.id;
                                            convoAux.getElementsByClassName("convocatory_name")[0].innerHTML = convocatory.id;
                                            convoAux.getElementsByClassName("group_name")[0].innerHTML = item.group.name || "Default Statement";
                                
                                            // Agregar la pregunta al contenedor y ocultarla
                                            convocatory_container.appendChild(convoAux);
                                        } else {
                                            convocatory_container.appendChild(p);
                                        }
                                    }
                                }

                            }
                        }
                        
                    }
                }

                if (data != null) {
                    
                }
            })
            
        })
    })

})