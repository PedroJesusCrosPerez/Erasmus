window.addEventListener("load", function () {

    const openModal = document.getElementById("btnCreate");

    openModal.addEventListener("click", function (ev) {
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

        // Crear formulario form
        fetch("http://serverpedroerasmus/PROTOTYPES/create_convocatory/js/template/form_item_baremable.html")
        .then(x=>x.text())
        .then(y=>{
            let form = document.createElement("div");
            form.setAttribute("id", "form_container");
            form.innerHTML = y;
            visualizador.appendChild(form);

            form.querySelector("#btnConfirm").addEventListener("click", function () {
                let form = document.querySelector("form[name='create_item_baremable']");
                let formData = new FormData(form);
                let formDataObject = {};
            
                // Itera sobre todos los elementos del formulario
                for (const element of form.elements) {
                    // Verifica si el elemento es un checkbox
                    if (element.type === "checkbox") {
                        // Almacena el estado del checkbox (marcado o no marcado)
                        if (element.checked) {
                            formDataObject[element.name] = true;
                        } else {
                            formDataObject[element.name] = false;
                        }
                    } else {
                        // Almacena el valor del input en la clave correspondiente
                        formDataObject[element.name] = element.value;
                    }
                }
            
                localStorage.setItem("item", JSON.stringify(formDataObject) );
            });
        })
    })
})