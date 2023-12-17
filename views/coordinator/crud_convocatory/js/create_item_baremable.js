document.getElementById("btnCreate").addEventListener("click", function () {

    document.getElementById("btnCancel").addEventListener("click", function () {
        document.body.removeChild(modal); //modal.parentElement
        document.body.removeChild(visualizador);
    })

    document.getElementById("btnConfirm").addEventListener("click", function () {
        let form =document.querySelector("form[name='create_item_baremable']");
        let formdata = new FormData(form);
        let formDataObject = {};
    
        for (const [key, value] of formData.entries()) {
            formDataObject[key] = value;
        }
        
        console.log(formDataObject);
        console.log(document.getElementsByTagName("table")[0]);
    })
});