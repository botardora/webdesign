// const hamburger = document.querySelector(".hamburger");
// const navLinks = document.querySelector(".nav-links");
// const links = document.querySelectorAll(".nav-links li");

// hamburger.addEventListener('click', () => {
//     //Animate Links
//     navLinks.classList.toggle("open");
//     links.forEach(link => {
//         link.classList.toggle("fade");
//     });

//     //Hamburger Animation
//     hamburger.classList.toggle("toggle");
// });

// const hamburgerMenu = document.querySelector('.hamburger-menu');
// const navigationPanel = document.querySelector('.navigation-panel');

// hamburgerMenu.addEventListener('click', function() {
//   navigationPanel.classList.toggle('open');
// });

// const hamburger = document.querySelector('.hamburger');
// const navLinks = document.querySelector('.nav-links');

// hamburger.addEventListener('click', () => {
//   navLinks.style.display = navLinks.style.display === 'none' ? 'block' : 'none';
// });

// hamburger.js

const hamburger = document.querySelector('.hamburger');
const navLinks = document.querySelector('.nav-links');
const links = document.querySelectorAll('.nav-links li');

hamburger.addEventListener('click', () => {
    navLinks.classList.toggle('open');
    links.forEach(link => {
        link.classList.toggle('fade');
    });
    hamburger.classList.toggle("toggle");
});
