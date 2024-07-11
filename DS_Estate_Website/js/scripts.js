const hamburger =document.querySelector(".hamburger");  // Select the hamburger icon element 
const navMenu =document.querySelector(".navMenu");     // Select the navigation menu element 
const navLink =document.querySelectorAll(".navLink");  // Select all the navigation links within the navigation menu

hamburger.addEventListener("click",mobileMenu);              // Addss a click event listener to the hamburger icon where it calls the mobileMenu function
navLink.forEach(n=> n.addEventListener("click",closeMenu)); // for each navigation link add a click event listener

function mobileMenu() {                   // Function to toggle the mobile menu visibility
    hamburger.classList.toggle("active"); // Toggles the 'active' class on the hamburger icon
    navMenu.classList.toggle("active");   // Toggles the 'active' class on the navigation menu
}

function closeMenu() {                     // Function to close the mobile menu when a navigation link is clicked
    hamburger.classList.remove("active");  // Removes the 'active' class from the hamburger icon
    navMenu.classList.remove("active");    // Removes the 'active' class from the navigation menu in order to hide it
}