// Function to auto-scroll the container
function autoScrollCategories() {
    const container = document.querySelector('.categories-container');

    if (container) {
        setInterval(function () {
            container.scrollBy({
                left: 2,
                behavior: 'smooth'
            });
        }, 7);
    } else {
        console.error("Categories container not found!");
    }
}

// Tab indicator functionality
document.addEventListener("DOMContentLoaded", () => {
    const navList = document.querySelector('.navbar-nav');
    const profileItem = document.createElement('li');
    profileItem.className = 'nav-item';
    profileItem.innerHTML = '<a class="nav-link" href="editprofile.php">Profile</a>';

    const logoutItem = document.createElement('li');
    logoutItem.className = 'nav-item';
    logoutItem.innerHTML = '<a class="nav-link" href="logout.php">Log out</a>';

    const tabs = document.querySelectorAll(".custom-nav-tabs .nav-link");
    const indicator = document.querySelector(".tab-indicator");

    const navbarToggler = document.querySelector(".navbar-toggler");
    const navbarCollapse = document.querySelector(".navbar-collapse");

    if (navbarToggler && navbarCollapse) {
        navbarToggler.addEventListener("click", () => {
            navbarCollapse.classList.toggle("show");
        });
    } else {
        console.error("Navbar elements not found!");
    }

    function updateIndicator(activeTab) {
        const tabWidth = activeTab.offsetWidth;
        const tabLeft = activeTab.offsetLeft;

        indicator.style.width = `${tabWidth}px`;
        indicator.style.left = `${tabLeft}px`;
    }

    // Initialize the indicator on page load
    const activeTab = document.querySelector(".custom-nav-tabs .nav-link.active");
    if (activeTab) {
        updateIndicator(activeTab);
    }

    // Add click event listener to tabs
    tabs.forEach((tab) => {
        tab.addEventListener("click", (e) => {
            updateIndicator(e.target);
        });
    });

    function adjustNavItems() {
        if (window.innerWidth < 992) {
            // Add to horizontal navigation
            if (!navList.contains(profileItem)) navList.appendChild(profileItem);
            if (!navList.contains(logoutItem)) navList.appendChild(logoutItem);
        } else {
            // Remove from horizontal navigation
            if (navList.contains(profileItem)) navList.removeChild(profileItem);
            if (navList.contains(logoutItem)) navList.removeChild(logoutItem);
        }
    }

    // Initial adjustment
    adjustNavItems();

    // Adjust on window resize
    window.addEventListener('resize', adjustNavItems);
});

// Trigger the auto-scroll after a delay
setTimeout(function () {
    autoScrollCategories();
}, 500);

// Profile picture upload functionality
document.addEventListener('DOMContentLoaded', () => {
    const fileInput = document.getElementById("user-photo-filename");
    const profilePicture = document.getElementById("user-photo");

    if (fileInput && profilePicture) {
        profilePicture.addEventListener("click", function () {
            fileInput.click();
        });

        fileInput.addEventListener('change', function (event) {
            const file = event.target.files[0];

            if (!file.type.match('image.*')) {
                alert("Please select an image file.");
                return;
            }

            const reader = new FileReader();
            reader.onload = function (e) {
                profilePicture.src = e.target.result;
            };

            reader.readAsDataURL(file);
        });
    } else {
        console.error("Profile picture or file input element not found!");
    }
});

// Navbar and click outside functionality
document.addEventListener("DOMContentLoaded", function () {
    // Select the necessary elements
    const navbarToggler = document.querySelector(".navbar-toggler");
    const navbarCollapse = document.querySelector(".navbar-collapse");
    const body = document.body; // To detect clicks outside the navbar
    const navList = document.querySelector('.navbar-nav');
    const profileItem = document.createElement('li');
    profileItem.className = 'nav-item';
    profileItem.innerHTML = '<a class="nav-link" href="editprofile.php">Profile</a>';

    const logoutItem = document.createElement('li');
    logoutItem.className = 'nav-item';
    logoutItem.innerHTML = '<a class="nav-link" href="logout.php">Log out</a>';

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

        navbarCollapse.addEventListener("click", function (event) {
            event.stopPropagation();
        });
    } else {
        console.error("Navbar elements not found!");
    }

    // Adjust navigation items for small screens
    function adjustNavItems() {
        if (window.innerWidth < 992) {
            // Add Profile and Logout items for small screens
            if (!navList.contains(profileItem)) navList.appendChild(profileItem);
            if (!navList.contains(logoutItem)) navList.appendChild(logoutItem);
        } else {
            // Remove Profile and Logout items for larger screens
            if (navList.contains(profileItem)) navList.removeChild(profileItem);
            if (navList.contains(logoutItem)) navList.removeChild(logoutItem);
        }
    }

    // Initial adjustment
    adjustNavItems();

    // Adjust on window resize
    window.addEventListener('resize', adjustNavItems);
});