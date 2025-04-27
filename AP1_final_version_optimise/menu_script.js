document.addEventListener("DOMContentLoaded", function() {
    // Récupère tous les liens du menu
    const navLinks = document.querySelectorAll(".nav-link");
    // Récupère le chemin complet de la page actuelle
    const currentPage = window.location.pathname.split("/").pop() || "index.html"; // Si vide, met "index.html"

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    navLinks.forEach(link => {
        // Récupère le href du lien sans le domaine
        const linkPage = link.getAttribute("href").split("/").pop();

        if (linkPage === currentPage) {
            link.classList.add("active");
        }
    });

});