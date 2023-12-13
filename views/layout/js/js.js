window.addEventListener("load", function () {

    // let navItem_home = document.getElementsByClassName("fa-home")[0];
    // let navItem_user = document.getElementsByClassName("fa-user")[0];
    // let navItem_settings = document.getElementsByClassName("fa-settings")[0];
    // function changeImages() 
    // {
    //     console.log(this);
    //     if (navItem_home.parentElement.parentElement.getAttribute("class") == "nav-item active") {
    //         navItem_home.style.backgroundImage = "url(../src/home.svg)";
    //     } else {
    //         navItem_home.style.backgroundImage = "url(../src/home-active.svg)";
    //     }
        
    //     if (navItem_user.parentElement.parentElement.getAttribute("class") == "nav-item active") {
    //         navItem_user.style.backgroundImage = "url(../src/settings.svg)";
    //     } else {
    //         navItem_user.style.backgroundImage = "url(../src/settings-active.svg)";
    //     }
        
    //     if (navItem_settings.parentElement.parentElement.getAttribute("class") == "nav-item active") {
    //         navItem_settings.style.backgroundImage = "url(../src/userLoged.svg)";
    //     } else {
    //         navItem_settings.style.backgroundImage = "url(../src/userNotLoged.svg)";
    //     }
    // }

    const navItems = document.querySelectorAll(".nav-item");

    navItems.forEach((navItem, i) => {
    navItem.addEventListener("click", () => {
        navItems.forEach((item, j) => {
        item.className = "nav-item";
        });
        navItem.className = "nav-item active";
    });
    });
    
    const links = document.querySelectorAll(".nav-item a");

    links.forEach(item => {
        item.addEventListener("click", function () { changeImages })
    });

    // console.log(links);
    // console.log(changeImages);
})