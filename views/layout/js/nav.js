window.addEventListener("load", function () {
    const navItems = document.querySelectorAll(".nav-item");

    function changeImages() {
        navItems.forEach((navItem) => {
            const icon = navItem.querySelector(".fa");
            const href = navItem.querySelector("a").getAttribute("href");

            // Extraer el valor después de "?menu="
            const menuParam = href.split("?menu=")[1];
            const coordinatorParam = href.split("?coordinator=")[1];

            if (navItem.classList.contains("active")) {
                // icon.style.backgroundImage = `url(views/src/icons/${menuParam}-active.png)`;
                icon.style.backgroundImage = `url(views/src/icons/${menuParam}.png)`;
            } else {
                icon.style.backgroundImage = `url(views/src/icons/${menuParam}.png)`;
            }

            // Cambiar el color si el parámetro 'coordinator' está presente
            if (coordinatorParam) {
                navItem.style.backgroundColor = "your-desired-color";
            } else {
                navItem.style.backgroundColor = ""; // Restablecer el color predeterminado si no hay 'coordinator' en la URL
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

    // Obtener el parámetro 'menu' de la URL
    const params = new URLSearchParams(window.location.search);
    const menuParam = params.get('menu');
    const coordinatorParam = params.get('coordinator');

    // Activar el enlace correspondiente según el parámetro 'menu'
    if (menuParam) {
        const activeNavItem = document.getElementById(`menu-${menuParam}`);
        if (activeNavItem) {
            activeNavItem.classList.add("active");
            changeImages();
        }
    }

    // Activar el enlace correspondiente según el parámetro 'coordinator'
    if (coordinatorParam) {
        const activeNavItem = document.getElementById(`coordinator-${coordinatorParam}`);
        if (activeNavItem) {
            activeNavItem.classList.add("active");
            changeImages();
        }
    }
});


// window.addEventListener("load", function () {
//     const navItems = document.querySelectorAll(".nav-item");

//     function changeImages() {
//     navItems.forEach((navItem) => {
//         const icon = navItem.querySelector(".fa");
//         const href = navItem.querySelector("a").getAttribute("href");
        
//         // Extraer el valor después de "?menu="
//         const menuParam = href.split("?menu=")[1];

//         if (navItem.classList.contains("active")) {
//             // icon.style.backgroundImage = `url(views/src/icons/${menuParam}-active.png)`;
//             icon.style.backgroundImage = `url(views/src/icons/${menuParam}.png)`;
//         } else {
//             icon.style.backgroundImage = `url(views/src/icons/${menuParam}.png)`;
//         }
//     });
// }


//     navItems.forEach((navItem, i) => {
//         navItem.addEventListener("click", () => {
//             navItems.forEach((item, j) => {
//                 item.classList.remove("active");
//             });
//             navItem.classList.add("active");
//             changeImages();
//         });
//     });

//     // Obtener el parámetro 'menu' de la URL
//     const params = new URLSearchParams(window.location.search);
//     const menuParam = params.get('menu');

//     // Activar el enlace correspondiente según el parámetro 'menu'
//     if (menuParam) {
//         const activeNavItem = document.getElementById(`menu-${menuParam}`);
//         if (activeNavItem) {
//             activeNavItem.classList.add("active");
//             changeImages();
//         }
//     }
// });