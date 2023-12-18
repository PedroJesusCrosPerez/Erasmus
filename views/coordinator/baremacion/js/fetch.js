
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
                    // contenido.parentElement.classList.remove("showCrud");
                } else {
                    contenido.style.display = "flex";
                    // contenido.parentElement.classList.add("showCrud");
                }
            });
        });
    }

    function openModalBaremar (ev) {
        //ev.preventDefault();

        // Fondo modal
        var modal = document.createElement("div");
        modal.style.position = "fixed";
        modal.style.top = 0;
        modal.style.left = 0;
        modal.style.width = "100%";
        modal.style.height = "100%";
        modal.style.backgroundColor = "black";
        //modal.style.backgroundColor = "rgba(0,0,0,0,5)";
        modal.style.opacity = 0.5;
        modal.style.zIndex = 99;
        document.body.appendChild(modal);

        // Contenido modal
        var visualizador = document.createElement("div");
        visualizador.setAttribute("id","visualizador");
        visualizador.style.position = "fixed";
        visualizador.style.top = "10%";
        visualizador.style.left = "15%";
        visualizador.style.width = "70%";
        visualizador.style.height = "80%";
        visualizador.style.backgroundColor = "white";
        visualizador.style.zIndex = 100;
        document.body.appendChild(visualizador);

        var closer = document.createElement("span");
        closer.innerHTML = "X";
        closer.style.position = "fixed";
        closer.style.top = 0;
        closer.style.right = 0;
        closer.style.padding = "1em";
        closer.style.zIndex = 101;
        closer.style.backgroundColor = "darkblue";
        closer.style.cursor = "pointer";
        closer.style.color = "white";
        visualizador.appendChild(closer);

        closer.addEventListener("pointerover", function () { this.style.backgroundColor = "black"; })
        closer.addEventListener("mousedown", function () { this.style.backgroundColor = "darkred"; })
        closer.addEventListener("pointerout", function () { this.style.backgroundColor = "darkblue"; })
        closer.addEventListener("click", function () {
            document.body.removeChild(modal); //modal.parentElement
            document.body.removeChild(visualizador);
        })

        var btnCancel = document.createElement("button");
        btnCancel.type = "button";
        btnCancel.id = "btnCancel";
        btnCancel.innerHTML = "Cancelar";
        visualizador.appendChild(btnCancel);
        btnCancel.addEventListener("click", function () {
            document.body.removeChild(modal); //modal.parentElement
            document.body.removeChild(visualizador);
        })

        // Crear vista CRUD
        fetch("http://serverpedroerasmus/views/coordinator/baremacion/js/templates/baremando.html")
        .then(x=>x.text())
        .then(y=>{
            let form = document.createElement("div");
            form.setAttribute("id", "modal_baremar");
            form.innerHTML = y;
            form.style.display = "flex";
            form.style.justifyContent = "space-around";
            visualizador.appendChild(form);
        })
    }

    function openModalCrud(convocatory, project, requests) {
        // let convocatory = item.convocatory;
        // let project = item.project;
        // let requests = item.requests;

        //ev.preventDefault();
        // Fondo modal
        var modal = document.createElement("div");
        modal.style.position = "fixed";
        modal.style.top = 0;
        modal.style.left = 0;
        modal.style.width = "100%";
        modal.style.height = "100%";
        modal.style.backgroundColor = "black";
        //modal.style.backgroundColor = "rgba(0,0,0,0,5)";
        modal.style.opacity = 0.5;
        modal.style.zIndex = 99;
        document.body.appendChild(modal);

        // Contenido modal
        var visualizador = document.createElement("div");
        visualizador.setAttribute("id","visualizador");
        visualizador.style.position = "fixed";
        visualizador.style.top = "10%";
        visualizador.style.left = "15%";
        visualizador.style.width = "70%";
        visualizador.style.height = "80%";
        visualizador.style.backgroundColor = "white";
        visualizador.style.zIndex = 100;
        document.body.appendChild(visualizador);

        var closer = document.createElement("span");
        closer.innerHTML = "X";
        closer.style.position = "fixed";
        closer.style.top = 0;
        closer.style.right = 0;
        closer.style.padding = "1em";
        closer.style.zIndex = 101;
        closer.style.backgroundColor = "darkblue";
        closer.style.cursor = "pointer";
        closer.style.color = "white";
        visualizador.appendChild(closer);

        closer.addEventListener("pointerover", function () { this.style.backgroundColor = "black"; })
        closer.addEventListener("mousedown", function () { this.style.backgroundColor = "darkred"; })
        closer.addEventListener("pointerout", function () { this.style.backgroundColor = "darkblue"; })
        closer.addEventListener("click", function () {
            document.body.removeChild(modal); //modal.parentElement
            document.body.removeChild(visualizador);
        })

        // var btnCancel = document.createElement("button");
        // btnCancel.type = "button";
        // btnCancel.id = "btnCancel";
        // btnCancel.innerHTML = "Cancelar";
        // visualizador.appendChild(btnCancel);
        // btnCancel.addEventListener("click", function () {
        //     document.body.removeChild(modal); //modal.parentElement
        //     document.body.removeChild(visualizador);
        // })

        // Crear vista CRUD
        fetch("http://serverpedroerasmus/views/coordinator/baremacion/js/templates/crud.php")
        .then(x=>x.text())
        .then(y=>{
            let form = document.createElement("div");
            form.setAttribute("id", "modal_crud_convocatory");
            form.innerHTML = y;

            console.log(convocatory);
            console.log(project);
            console.log(requests);
            // Rellenar datos automáticamente de convocatoria
            form.querySelector("input[name='convocatory_id']").value = convocatory.id;
            form.querySelector("select[name='project']").value = convocatory.project_id;
            form.querySelector("input[name='country']").value = convocatory.country;
            form.querySelector("select[name='group']").value = requests[0].group;
            form.querySelector("input[name='movilities']").value = convocatory.movilities;
            form.querySelector("input[value='"+ convocatory.type +"']").checked = true;
            
            // Dates
            form.querySelector("input[name='date_requests_start']").value = convocatory.date_start_requests;
            form.querySelector("input[name='date_requests_end']").value = convocatory.date_end_requests;
            form.querySelector("input[name='date_baremation']").value = convocatory.date_baremation;
            form.querySelector("input[name='date_definitive_lists']").value = convocatory.date_definitive_lists;
            
            visualizador.appendChild(form);

            // form.querySelector("#btnConfirm").addEventListener("click", function () {
            //     let form = document.querySelector("form[name='create_item_baremable']");
            //     let formData = new FormData(form);
            //     let formDataObject = {};
            
            //     // Itera sobre todos los elementos del formulario
            //     for (const element of form.elements) {
            //         // Verifica si el elemento es un checkbox
            //         if (element.type === "checkbox") {
            //             // Almacena el estado del checkbox (marcado o no marcado)
            //             if (element.checked) {
            //                 formDataObject[element.name] = true;
            //             } else {
            //                 formDataObject[element.name] = false;
            //             }
            //         } else {
            //             // Almacena el valor del input en la clave correspondiente
            //             formDataObject[element.name] = element.value;
            //         }

            //         if (element.type === "select") {
            //             let options = element.children;
            //             for (const option of options) {
            //                 if (option.selected == true) {
            //                     formDataObject["nameValue"] = option.value;
            //                     formDataObject["name"] = option.innerHTML;
            //                 }
            //             }
            //         }
            //     }
            
            //     let datajson = JSON.stringify(formDataObject);
            //     /*localStorage.setItem("item", datajson );
            //     document.body.removeChild(modal); //modal.parentElement
            //     document.body.removeChild(visualizador);

            //     createTr(datajson);*/
            //     console.log(formDataObject["name"]);
            // });
        })
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
            // console.log(data);
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
                        convocatoryTemplate.convocatory_id = convocatory.id;
                        convocatoryTemplate.querySelector('.country').innerText                 = convocatory.country;
                        convocatoryTemplate.querySelector('.type').innerText                    = convocatory.type;
                        convocatoryTemplate.querySelector('.date_start_requests').innerText     = convocatory.date_start_requests;
                        convocatoryTemplate.querySelector('.date_end_requests').innerText       = convocatory.date_end_requests;
                        convocatoryTemplate.querySelector('.date_baremation').innerText         = convocatory.date_baremation;
                        convocatoryTemplate.querySelector('.date_definitive_lists').innerText   = convocatory.date_definitive_lists;

                        // DELETE
                        convocatoryTemplate.querySelector('.delete').addEventListener("click", function () {
                            fetch("http://serverpedroerasmus/api/apiConvocatory.php", {
                                method: "DELETE",
                                headers: {"Content-Type": "application/json"},
                                body: JSON.stringify(this.parentElement.convocatory_id)
                            })
                            .then(response => {
                                // Verificar si la respuesta está en el rango de códigos de éxito (200-299)
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                
                            })
                        });

                        // UPDATE
                        if (requests.length == 0) {
                            let divContenido = document.createElement("div");
                            divContenido.classList.add("contenido");
                            divContenido.innerHTML = "¡¡Esta convocatoria no tiene solicitudes!!";
                            let requests = [];
                            requests[0] = { group: "null" };                            
                            
                            convocatoryTemplate.querySelector('.showCrud').addEventListener("click", function () {
                                openModalCrud(convocatory, project, requests);
                            });
                            convocatoryTemplate.appendChild(divContenido);
                        } else {
                            convocatoryTemplate.querySelector('.showCrud').addEventListener("click", function () {
                                openModalCrud(convocatory, project, requests);
                            });

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

                                    requestTemplate.request_id = item.id;
                                    // requestTemplate.querySelector('.dni').innerHTML = item.dni;
                                    requestTemplate.querySelector('.dni').innerHTML = item.id;
                                    requestTemplate.querySelector('.surname').innerHTML = item.surname;
                                    requestTemplate.querySelector('.name').innerHTML = item.name;
                                    requestTemplate.querySelector('.birthdate').innerHTML = item.birthdate;
                                    requestTemplate.querySelector('.phone').innerHTML = item.phone;
                                    // requestTemplate.querySelector('img').src = item.photo;
                                    requestTemplate.querySelector('.baremar').addEventListener("click", openModalBaremar)
                                    requestTemplate.querySelector('.delete').addEventListener("click", function () {
                                        fetch("http://serverpedroerasmus/api/apiRequest.php", {
                                            method: "DELETE",
                                            headers: {"Content-Type": "application/json"},
                                            body: JSON.stringify(this.parentElement.parentElement.request_id)
                                        })
                                        .then(response => {
                                            // Verificar si la respuesta está en el rango de códigos de éxito (200-299)
                                            if (!response.ok) {
                                                throw new Error('Network response was not ok');
                                            }
                                            return response.json();
                                        })
                                        .then(data => {
                                            this.parentElement.parentElement.style.display = "none";
                                            alert("¡¡Solicitud se ha eliminado con éxito!!");
                                        })
                                    });

                                    divContainerRequests.appendChild(requestTemplate);
                                }
                                convocatoryTemplate.appendChild(divContainerRequests);
                            });
                        }


                        // convocatoryTemplate.querySelector('.files').innerHTML = baremation.files; // TODO
                        // convocatoryTemplate.addEventListener("click", cambiarColorRequests);
                        convocatory_container.appendChild(convocatoryTemplate);
                    });
                    cambiarColor();
                    ejecutarFuncionesMenuDesplegable();
            }
        })
    })

function toHover(item) {
    item.addEventListener("mouseover", function () {
        // item.classList.add("convocatoryHover");
        item.style.backgroundColor = "rgb(180, 180, 180)";
    });

    beforeBackground = item.style.backgroundColor;
    item.addEventListener("mouseout", function () {
        // item.classList.remove("convocatoryHover");
        item.style.backgroundColor = beforeBackground;
    });
}

function cambiarColor() {
    let divConvocatories = document.querySelector("#convocatories").children[1];
    if (divConvocatories) {
        let convocatoryItems = divConvocatories.children;

        for (let i = 0; i < convocatoryItems.length; i++) {
            // Check if the index is even
            // if (i % 2 === 0) {
            //     convocatoryItems[i].style.backgroundColor = "grey";
            //     // convocatoryItems[i].classList.add("backGrey");
            //     // convocatoryItems[i].style.color = "white";
            // }
            toHover(convocatoryItems[i]);
        }
    }
}



})

