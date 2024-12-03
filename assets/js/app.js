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

document.addEventListener('DOMContentLoaded', () => {
    const fileInput = document.getElementById("user-photo-filename");

    const profilePicture = document.getElementById("user-photo");

    profilePicture.addEventListener("click", function() {
        fileInput.click();
    });

    fileInput.addEventListener('change', function(event) {
        const file = event.target.files[0];   


        // Validate file type (optional)
        if (!file.type.match('image.*')) {
            alert("Please select an image file.");
            return;
        }

        const reader = new FileReader();

        reader.onload = function(e) {
            profilePicture.src = e.target.result;
        };

        reader.readAsDataURL(file);
    });
});