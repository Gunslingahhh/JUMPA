// Function to auto-scroll the container
function autoScrollCategories() {
    const container = document.querySelector('.categories-container');
    setInterval(function () {
        container.scrollBy({
            left: 1,
            behavior: 'smooth'
        });
    }, 7);
}

// Trigger the auto-scroll after 3 seconds
setTimeout(function () {
    autoScrollCategories();
}, 2000);