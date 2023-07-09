const hamburger = document.querySelector(".hamburger");
const navMenu = document.querySelector(".nav-menu-container");

hamburger.addEventListener("click", ()=>{
    hamburger.classList.toggle("active");
    navMenu.classList.toggle("active");
    navMenu.style.flexDirection = "column";
})
