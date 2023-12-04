window.addEventListener("load", function () {
    const navItems = document.querySelectorAll(".nav-item");

    function changeImages() {
        navItems.forEach((navItem, index) => {
            const icon = navItem.querySelector(".fa");
            if (navItem.classList.contains("active")) {
                // Obtener el parámetro del GET de la URL actual
                const urlParams = new URLSearchParams(window.location.search);
                const menuParam = urlParams.get("menu");
    
                // Utilizar el parámetro del GET para construir el nombre del icono activo
                icon.style.backgroundImage = `url(views/src/icon-${menuParam}-active.svg)`;
            } else {
                // Utilizar el parámetro del GET para construir el nombre del icono inactivo
                icon.style.backgroundImage = `url(views/src/icon-${menuParam}.svg)`;
            }
        });
    }
    

    navItems.forEach((navItem, i) => {
        navItem.addEventListener("click", () => {
            navItems.forEach((item, j) => {
                item.classList.remove("active");
            });
            navItem.classList.add("active");
            changeImages();
        });
    });
});
