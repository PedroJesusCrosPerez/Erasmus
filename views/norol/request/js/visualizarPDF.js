window.addEventListener("load", function () {

    //var url = "requisitos.pdf";
    const contenedor = document.getElementById("contenedor");
    const abrirPDF = document.getElementsByClassName("abrirPDF");

    for (const item of abrirPDF) {
        item.addEventListener("click", function (ev) {
            ev.preventDefault();
            const documento = this.parentElement.firstElementChild;

            if (documento.files.length == 1 && documento.files[0].type == "application/pdf") {
                var url = documento.files[0].value;

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
                visualizador.style.position = "fixed";
                visualizador.style.top = "15%";
                visualizador.style.left = "15%";
                visualizador.style.width = "70%";
                visualizador.style.height = "70%";
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

                closer.addEventListener("pointerover", function () {
                    this.style.backgroundColor = "black";
                })
                
                closer.addEventListener("mousedown", function () {
                    this.style.backgroundColor = "darkred";
                })

                closer.addEventListener("pointerout", function () {
                    this.style.backgroundColor = "darkblue";
                })

                closer.addEventListener("click", function () {
                    document.body.removeChild(modal); //modal.parentElement
                    document.body.removeChild(visualizador);
                })

                var iframe = document.createElement("iframe");
                //iframe.src = url;
                iframe.style.width = "100%";
                iframe.style.height = "100%";
                visualizador.appendChild(iframe);

                // // Leer fichero **NO FUNCIONA**
                // var reader = new FileReader();
                // reader.addEventListener("load", function () {
                //     iframe.src = reader.result;
                // });
                // reader.readAsDataURL(documento.files[0]);

                // Leer fichero
                iframe.src = URL.createObjectURL(documento.files[0]);

            } else {
                alert("Debes subir un fichero para poder visualizarlo.");
            }
        })
    }

})