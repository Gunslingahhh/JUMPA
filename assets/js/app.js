document.addEventListener("DOMContentLoaded", function () {
    // Auto-scroll categories
    function autoScrollCategories() {
        const container = document.querySelector('.categories-container');
        if (container) {
            setInterval(() => {
                container.scrollBy({ left: 2, behavior: 'smooth' });
            }, 7);
        } else {
            console.error("Categories container not found!");
        }
    }
    setTimeout(autoScrollCategories, 500);

    // Navbar toggler and click outside functionality
    const navbarToggler = document.querySelector(".navbar-toggler");
    const navbarCollapse = document.querySelector(".navbar-collapse");
    const navList = document.querySelector('.navbar-nav');
    const body = document.body;

    if (navbarToggler && navbarCollapse) {
        navbarToggler.addEventListener("click", function (event) {
            navbarCollapse.classList.toggle("show");
            navbarToggler.classList.toggle("collapsed");
            event.stopPropagation();
        });

        body.addEventListener("click", function (event) {
            if (!navbarCollapse.contains(event.target) && !navbarToggler.contains(event.target) && navbarCollapse.classList.contains("show")) {
                navbarCollapse.classList.remove("show");
            }
        });
    } else {
        console.error("Navbar elements not found!");
    }

    // Tab indicator functionality
    const tabs = document.querySelectorAll(".custom-nav-tabs .nav-link");
    const indicator = document.querySelector(".tab-indicator");

    function updateIndicator(activeTab) {
        const tabWidth = activeTab.offsetWidth;
        const tabLeft = activeTab.offsetLeft;
        indicator.style.width = `${tabWidth}px`;
        indicator.style.left = `${tabLeft}px`;
    }

    const activeTab = document.querySelector(".custom-nav-tabs .nav-link.active");
    if (activeTab) updateIndicator(activeTab);

    tabs.forEach(tab => {
        tab.addEventListener("click", (e) => updateIndicator(e.target));
    });

    // Task photo upload
    const taskPhoto = document.getElementById("task-photo");
    const taskPhotoPreview = document.getElementById("task-photo-preview");

    if (taskPhoto && taskPhotoPreview) {
        taskPhoto.addEventListener("change", function (event) {
            const file = event.target.files[0];
            if (!file.type.match('image.*')) {
                alert("Please select an image file.");
                return;
            }
            const reader = new FileReader();
            reader.onload = (e) => taskPhotoPreview.src = e.target.result;
            reader.readAsDataURL(file);
        });
    } else {
        console.error("Task photo elements not found!");
    }
});