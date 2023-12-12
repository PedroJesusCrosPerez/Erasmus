
window.addEventListener("load", function () {
    // function cambiarColorRequests() {
    //     let divContenido = document.querySelectorAll(".list_requests");
    //     let length = divContenido.length;
        
    //     for (let i = 0; i < length; i++) {
    //         if (i % 2 === 0) {
    //             divContenido[i].style.backgroundColor = "black";
    //             divContenido[i].style.color = "white";
    //         }
    //         console.log(divContenido[i]);
    //     }
    // }

    function ejecutarFuncionesMenuDesplegable() {
        var desplegables = document.querySelectorAll(".desplegable");
        desplegables.forEach(function (desplegable) {
            desplegable.addEventListener("click", function () {
                var contenido = this.lastElementChild;
                if (contenido.style.display === "flex") {
                    contenido.style.display = "none";
                } else {
                    contenido.style.display = "flex";
                }
            });
        });
    }

    fetch("http://serverpedroerasmus/views/coordinator/baremacion/js/templates/convocatory.html")
    .then(x => x.text())
    .then(y => {
        // Crear un contenedor div y asignarle el HTML de la plantilla
        var contenedor = document.createElement("div");
        contenedor.innerHTML = y;
        contenedor.classList.add("convocatory");
        contenedor.classList.add("desplegable");

        let api = "http://serverpedroerasmus/api/apiConvocatory.php?convocatory=findAllAll";

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
            let convocatory_container = document.getElementById("convocatories").children[1];
            convocatory_container.innerHTML = "";
            // Mensaje de error en el caso de que no haya convocatorias disponibles
            var msgNoConvocatories = "¡¡No existen convocatorias todavía!!";
            let p = document.createElement("p");
            p.innerHTML = msgNoConvocatories;

            if (data != null ) {
                // if (!Array.isArray(data)) {
                    data.forEach(item => {
                        let convocatoryTemplate = contenedor.cloneNode(true);

                        let convocatory = item.convocatory;
                        let project = item.project;
                        let requests = item.requests;

                        // Project
                        convocatoryTemplate.querySelector('.project').innerText                 = project.name;

                        // Convocatory
                        convocatoryTemplate.querySelector('.country').innerText                 = convocatory.country;
                        convocatoryTemplate.querySelector('.type').innerText                    = convocatory.type;
                        convocatoryTemplate.querySelector('.date_start_requests').innerText     = convocatory.date_start_requests;
                        convocatoryTemplate.querySelector('.date_end_requests').innerText       = convocatory.date_end_requests;
                        convocatoryTemplate.querySelector('.date_baremation').innerText         = convocatory.date_baremation;
                        convocatoryTemplate.querySelector('.date_definitive_lists').innerText   = convocatory.date_definitive_lists;

                        fetch("http://serverpedroerasmus/views/coordinator/baremacion/js/templates/request.html")
                        .then(x => x.text())
                        .then(y => {
                            var request = document.createElement("ul");
                            request.innerHTML = y;
                            request.classList.add("list_requests");


                            let divContainerRequests = document.createElement("div");
                            divContainerRequests.classList.add("contenido");
                            // Request
                            for (const item of requests) {
                                let requestTemplate = request.cloneNode(true);

                                requestTemplate.querySelector('.dni').innerHTML = item.dni;
                                requestTemplate.querySelector('.surname').innerHTML = item.surname;
                                requestTemplate.querySelector('.name').innerHTML = item.name;
                                requestTemplate.querySelector('.birthdate').innerHTML = item.birthdate;
                                requestTemplate.querySelector('.phone').innerHTML = item.phone;
                                // requestTemplate.querySelector('img').src = item.photo;

                                divContainerRequests.appendChild(requestTemplate);
                            }
                            convocatoryTemplate.appendChild(divContainerRequests);
                        });

                        // convocatoryTemplate.querySelector('.files').innerHTML = baremation.files; // TODO
                        // convocatoryTemplate.addEventListener("click", cambiarColorRequests);
                        convocatory_container.appendChild(convocatoryTemplate);
                    });
                    cambiarColor();
                    ejecutarFuncionesMenuDesplegable();
                // } else {
                //     length = data.length;

                //     for (var i = 0; i < length; i++) {
                //         var item = data[i];
                //         var convocatories = item.convocatories;
                    
                //         if (convocatories) {
                //             var length_j = convocatories.length;
                    
                //             for (var j = 0; j < length_j; j++) {
                //                 var convocatory = convocatories[j];
                //                 if (convocatory != null) {
                //                     var convoAux = pregunta.cloneNode(true);
                        
                //                     // Agregar clases y asignar contenido
                //                     convoAux.id = convocatory.id;
                //                     convoAux.getElementsByClassName("convocatory_name")[0].innerHTML = convocatory.id;
                //                     convoAux.getElementsByClassName("group_name")[0].innerHTML = item.group.name || "Default Statement";
                //                     convoAux.querySelector("a").href = "?menu=complete_request&convocatory_id="+convocatory.id;
                        
                //                     // Agregar la pregunta al contenedor y ocultarla
                //                     convocatory_container.appendChild(convoAux);
                //                 } else {
                //                     convocatory_container.appendChild(p);
                //                 }
                //             }
                //         }
                //     }
                    
                // }
            }
        })
    })

function cambiarColor() {
    let divConvocatories = document.querySelector("#convocatories").children[1];
    if (divConvocatories) {
        let convocatoryItems = divConvocatories.children;

        for (let i = 0; i < convocatoryItems.length; i++) {
            // Check if the index is even
            if (i % 2 === 0) {
                convocatoryItems[i].style.backgroundColor = "black";
                convocatoryItems[i].style.color = "white";
            }
        }
    }
}



})

