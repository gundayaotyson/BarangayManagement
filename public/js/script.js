console.log('Script.js is loaded!');

document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM fully loaded and parsed');

    let menuIcon = document.querySelector('#menu-icon');
    let navbar = document.querySelector('.navbar');

    // Toggle menu icon and navbar
    menuIcon.onclick = () => {
        menuIcon.classList.toggle('bx-x');
        navbar.classList.toggle('active');
    };

    let sections = document.querySelectorAll('section');
    let navLinks = document.querySelectorAll('header nav a');

    // Handle scrolling and highlight nav links
    window.onscroll = () => {
        sections.forEach(sec => {
            let top = window.scrollY;
            let offset = sec.offsetTop - 150;
            let height = sec.offsetHeight;
            let id = sec.getAttribute('id');

            if (top >= offset && top < offset + height) {
                navLinks.forEach(links => {
                    links.classList.remove('active');
                    let currentLink = document.querySelector(`header nav a[href*="${id}"]`);
                    if (currentLink) currentLink.classList.add('active');
                });
            }
        });

        let header = document.querySelector('header');
        header.classList.toggle('sticky', window.scrollY > 100);

        // Close menu on scroll
        menuIcon.classList.remove('bx-x');
        navbar.classList.remove('active');
    };

    // ScrollReveal animations
    ScrollReveal({
        reset: true,
        distance: '80px',
        duration: 2000,
        delay: 200
    });

    ScrollReveal().reveal('.home-content, .heading', { origin: 'top' });
    ScrollReveal().reveal('.home-img, .products-container, .more-box, .contact form', { origin: 'bottom' });
    ScrollReveal().reveal('.home-content h1, .products-img', { origin: 'left' });
    ScrollReveal().reveal('.home-content p, .products-content', { origin: 'right' });

    // Typed.js animations
    const typed = new Typed('.multiple-text', {
        strings: ['Purok 1', 'Purok 2', 'Purok 3'],
        typeSpeed: 100,
        backSpeed: 100,
        backDelay: 1000,
        loop: true
    });

    const type = new Typed('.multiple-text1', {
        strings: ['Us'],
        typeSpeed: 100,
        backSpeed: 100,
        backDelay: 1000,
        loop: true
    });

    const typ = new Typed('.multiple-text2', {
        strings: ['Services!'],
        typeSpeed: 100,
        backSpeed: 100,
        backDelay: 1000,
        loop: true
    });

    const ty = new Typed('.multiple-text3', {
        strings: ['Project'],
        typeSpeed: 100,
        backSpeed: 100,
        backDelay: 1000,
        loop: true
    });

    const t = new Typed('.multiple-text4', {
        strings: ['Me!'],
        typeSpeed: 100,
        backSpeed: 100,
        backDelay: 1000,
        loop: true
    });
});
