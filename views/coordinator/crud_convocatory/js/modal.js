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

        // Crear formulario form
        //fetch("views/rol/coodinator/js/template/form.html")
        fetch("http://serverpedroerasmus/views/rol/coordinator/crud_convocatory/js/template/form.html")
        .then(x=>x.text())
        .then(y=>{
            var form = document.createElement("div");
            form.setAttribute("id", "form_container");
            form.innerHTML = y;
            visualizador.appendChild(form);
        })


        // //let form = document.getElementById("form_convocatory");
        
        // debugger;
        // visualizador.addEventListener("load", function () 
        // {
        //     debugger;
        //     function sendFormData()
        //     {
        //         ev.preventDefault();
        //         let formData = formData(form);
        
        //         fetch("http://serverpedroerasmus/api/apiConvocatory.php", {
        //             method: "PUT",
        //             headers: {"Content-Type": "application/json"},
        //             body: formData
        //         })
        //         .then(response => {
        //             // Verificar si la respuesta está en el rango de códigos de éxito (200-299)
        //             if (!response.ok) {
        //                 throw new Error('Network response was not ok');
        //             }
        //             return response.json();
        //         })
        //         .then(jsonData => {
        //             console.log(jsonData);
        //         })
        //         // Si existe un error, lo captura con el método .catch()
        //         .catch(error => {
        //             // Console.error cambia la forma de imprimir mensajes por consola, a modo error
        //             console.error('Error during fetch operation:', error);
        //         });
        //     }
            
        //     alert(document.forms[0]);
        //     document.forms[0].addEventListener("submit", function (ev) {
        //         ev.preventDefault();
        //         alert("Holaaaa");
        //     })
        //     //sendFormData();
        // })

    })

})