<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
    /* Style for the task photo container with a plus icon */
    #task-photo-container {
        position: relative;
        height: 150px;
        background-color: #f8f9fa;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        width: 100%;
    }

    #task-photo-container::before {
        content: "+";
        font-size: 50px;
        color: #6c757d;
        position: absolute;
        z-index: 1;
        opacity: 0.5;
        display: block;
    }

    #task-photo-container.has-image::before {
        display: none;
    }

    #task-photo-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 2;
    }

    .task-duration-wrapper {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .task-duration-wrapper input {
        width: 100%;
    }

    .task-duration-wrapper span {
        color: #6c757d;
        font-size: 14px;
    }

    .form-check {
        margin-bottom: 0.5rem;
    }

    .form-check-input {
        margin-right: 0.5rem;
    }

    .image-size-warning {
        color: #dc3545;
        font-size: 0.875rem;
        display: none;
    }

    .field-feedback {
        font-size: 0.875rem;
        color: #6c757d;
    }

    .age-range-container {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .age-range-container .age-label {
        margin: 0 4px;
        color: #6c757d;
    }
    </style>
</head>

<body>
    <?php
    // Start the session
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../index.php");
        exit();
    }
    
    include 'topnav.php';
    ?>

    <main id="profilemainid">
        <h4 class="mt-3 mb-4 text-center">Post a Task</h4>
        <section class="container mt-4 w-75 bg-white rounded">
            <?php
            if (isset($_SESSION['message'])) {
                echo "<div class='alert alert-primary mt-3'>" . $_SESSION['message'] . "</div>";
                unset($_SESSION['message']);
            }
            ?>
            <div class="profile-form mt-3">
                <form id="profileForm" action="createpost_process.php" method="post" enctype="multipart/form-data"
                    class="createpost-form needs-validation" novalidate>
                    <div class="form-row mb-3">
                        <label for="tasktitle" class="form-label">Task Title</label>
                        <input type="text" class="form-control" name="tasktitle" id="tasktitle" required
                            maxlength="100">
                        <div class="invalid-feedback">Please enter a task title.</div>
                    </div>

                    <div class="form-row mb-3">
                        <label for="taskdescription" class="form-label">Task Description</label>
                        <textarea class="form-control" name="taskdescription" id="taskdescription" rows="4" required
                            maxlength="1000"></textarea>
                        <div class="invalid-feedback">Please enter a task description.</div>
                        <div class="field-feedback">
                            <span id="descriptionCharCount">0</span>/1000 characters
                        </div>
                    </div>

                    <div class="form-row mb-3">
                        <label for="taskphoto" class="form-label">Task Photo</label>
                        <div id="task-photo-container" class="p-0 form-control" role="button">
                            <img id="task-photo-preview" alt="Click to upload task photo" style="display: none;">
                        </div>
                        <input type="file" id="task-photo" name="task-photo" accept="image/jpeg, image/png, image/jpg"
                            style="display: none;">
                        <div class="field-feedback">
                            Click to upload an image (JPEG, PNG, JPG - max 5MB)
                        </div>
                        <div class="image-size-warning" id="imageWarning">
                            Image size exceeds 5MB. Please choose a smaller image.
                        </div>
                    </div>

                    <div class="form-row mb-3">
                        <label for="taskdate" class="form-label">Task Date</label>
                        <input type="date" class="form-control" name="taskdate" id="taskdate" required>
                        <div class="invalid-feedback">Please select a task date.</div>
                    </div>

                    <div class="form-row mb-3">
                        <label for="taskduration" class="form-label">Task Duration</label>
                        <div class="task-duration-wrapper">
                            <input type="number" class="form-control" name="taskduration" id="taskduration" required
                                min="0.5" max="24" step="0.5">
                            <span>hrs</span>
                        </div>
                        <div class="invalid-feedback">Please enter a valid duration (0.5-24 hours).</div>
                    </div>

                    <div class="form-row mb-3">
                        <label for="tasklocation" class="form-label">Task Location</label>
                        <input type="text" class="form-control" name="tasklocation" id="tasklocation" required
                            maxlength="200">
                        <div class="invalid-feedback">Please enter a task location.</div>
                    </div>

                    <div class="form-row mb-3">
                        <label for="toolsrequired" class="form-label">Tools Required</label>
                        <input type="text" class="form-control" name="toolsrequired" id="toolsrequired" required
                            maxlength="200">
                        <div class="invalid-feedback">Please list tools required.</div>
                    </div>

                    <div class="form-row mb-3">
                        <label for="pax" class="form-label">Pax</label>
                        <input type="number" class="form-control" name="pax" id="pax" required min="1" max="100">
                        <div class="invalid-feedback">Please enter a valid number of participants (1-100).</div>
                    </div>

                    <div class="form-row mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" name="price" id="price" required min="1" step="0.01">
                        <div class="invalid-feedback">Please enter a valid price (min $1).</div>
                    </div>

                    <p class="additional-info fw-bold mt-4 mb-3">Additional Information</p>

                    <div class="form-row mb-3">
                        <label for="dresscode" class="form-label">Dress Code</label>
                        <input type="text" class="form-control" name="dresscode" id="dresscode" required
                            maxlength="100">
                        <div class="invalid-feedback">Please specify a dress code.</div>
                    </div>

                    <div class="form-row mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" name="gender" id="gender" required>
                            <option value="">Select gender</option>
                            <option value="Any">Any</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <div class="invalid-feedback">Please select a gender preference.</div>
                    </div>

                    <div class="form-row mb-3">
                        <label for="nationality" class="form-label">Nationality</label>
                        <select class="form-select" name="nationality" id="nationality" required>
                            <option value="">Select nationality</option>
                            <option value="Malaysian">Malaysian</option>
                            <option value="Non-Malaysian">Non-Malaysian</option>
                            <option value="Any">Any</option>
                        </select>
                        <div class="invalid-feedback">Please select a nationality requirement.</div>
                    </div>

                    <div class="form-row mb-3">
                        <label for="minAge" class="form-label">Age Range</label>
                        <div class="age-range-container">
                            <input type="number" class="form-control" name="minAge" id="minAge" placeholder="Min"
                                required min="18" max="99">
                            <span class="age-label">to</span>
                            <input type="number" class="form-control" name="maxAge" id="maxAge" placeholder="Max"
                                required min="18" max="99">
                        </div>
                        <div class="invalid-feedback" id="ageRangeFeedback">Please specify a valid age range.</div>
                        <input type="hidden" name="agerange" id="agerange">
                    </div>

                    <fieldset class="form-group mb-3">
                        <legend class="col-form-label">Muslim Friendly</legend>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="muslimfriendly" id="muslimfriendly1"
                                value="1" required>
                            <label class="form-check-label" for="muslimfriendly1">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="muslimfriendly" id="muslimfriendly2"
                                value="0">
                            <label class="form-check-label" for="muslimfriendly2">No</label>
                        </div>
                        <div class="invalid-feedback">Please select an option.</div>
                    </fieldset>

                    <fieldset class="form-group mb-3">
                        <legend class="col-form-label">Food Provided</legend>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="foodprovision" id="foodprovision1"
                                value="1" required>
                            <label class="form-check-label" for="foodprovision1">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="foodprovision" id="foodprovision2"
                                value="0">
                            <label class="form-check-label" for="foodprovision2">No</label>
                        </div>
                        <div class="invalid-feedback">Please select an option.</div>
                    </fieldset>

                    <fieldset class="form-group mb-4">
                        <legend class="col-form-label">Transport Provided</legend>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="transportprovision"
                                id="transportprovision1" value="1" required>
                            <label class="form-check-label" for="transportprovision1">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="transportprovision"
                                id="transportprovision2" value="0">
                            <label class="form-check-label" for="transportprovision2">No</label>
                        </div>
                        <div class="invalid-feedback">Please select an option.</div>
                    </fieldset>

                    <div class="d-flex justify-content-center align-items-center gap-2 mb-4">
                        <button type="submit" name="createpost-submit" class="btn btn-success w-25">Submit</button>
                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                            data-bs-target="#clearFormModal">
                            Clear Form
                        </button>
                    </div>
                </form>
            </div>
            <!-- Clear Form Confirmation Modal -->
            <div class="modal fade" id="clearFormModal" tabindex="-1" aria-labelledby="clearFormModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="clearFormModalLabel">Confirm Clear Form</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to clear all the fields? This action cannot be undone.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger" id="confirmClearForm">Clear Form</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Cache DOM elements
        const form = document.getElementById("profileForm");
        const confirmClearButton = document.getElementById("confirmClearForm");
        const taskPhotoContainer = document.getElementById("task-photo-container");
        const taskPhotoInput = document.getElementById("task-photo");
        const taskPhotoPreview = document.getElementById("task-photo-preview");
        const imageWarning = document.getElementById("imageWarning");
        const descriptionField = document.getElementById("taskdescription");
        const charCount = document.getElementById("descriptionCharCount");
        const taskDateInput = document.getElementById("taskdate");
        const minAgeInput = document.getElementById("minAge");
        const maxAgeInput = document.getElementById("maxAge");
        const ageRangeHidden = document.getElementById("agerange");
        const ageRangeFeedback = document.getElementById("ageRangeFeedback");

        // Set minimum date to today
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const dd = String(today.getDate()).padStart(2, '0');
        const todayFormatted = `${yyyy}-${mm}-${dd}`;
        taskDateInput.setAttribute('min', todayFormatted);

        // Age range validation and combination
        function validateAndCombineAgeRange() {
            const minAge = parseInt(minAgeInput.value);
            const maxAge = parseInt(maxAgeInput.value);

            if (isNaN(minAge) || isNaN(maxAge)) {
                return false;
            }

            if (minAge > maxAge) {
                ageRangeFeedback.textContent = "Minimum age cannot be greater than maximum age.";
                return false;
            }

            // Combine the age range into the hidden input
            ageRangeHidden.value = `${minAge}-${maxAge}`;
            return true;
        }

        minAgeInput.addEventListener('input', validateAndCombineAgeRange);
        maxAgeInput.addEventListener('input', validateAndCombineAgeRange);

        // Form validation
        form.addEventListener('submit', function(event) {
            if (!validateAndCombineAgeRange()) {
                event.preventDefault();
                event.stopPropagation();
            }

            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            form.classList.add('was-validated');
        });

        // Auto-save form data to localStorage
        const formFields = form.querySelectorAll('input, textarea, select');
        const formId = 'taskPostForm';

        // Load saved data if exists
        const savedData = localStorage.getItem(formId);
        if (savedData) {
            const formData = JSON.parse(savedData);
            formFields.forEach(field => {
                if (field.type === 'radio') {
                    if (field.value === formData[field.name]) {
                        field.checked = true;
                    }
                } else if (field.type === 'file') {
                    // Can't restore file inputs
                } else if (field.name === 'minAge' && formData['agerange']) {
                    // Extract min age from saved age range
                    const ageRange = formData['agerange'].split('-');
                    if (ageRange.length === 2) {
                        field.value = ageRange[0];
                    }
                } else if (field.name === 'maxAge' && formData['agerange']) {
                    // Extract max age from saved age range
                    const ageRange = formData['agerange'].split('-');
                    if (ageRange.length === 2) {
                        field.value = ageRange[1];
                    }
                } else {
                    field.value = formData[field.name] || '';
                }
            });

            // Update character count
            if (formData.taskdescription) {
                charCount.textContent = formData.taskdescription.length;
            }

            // Validate and combine age range on load
            validateAndCombineAgeRange();
        }

        // Save data on input change
        formFields.forEach(field => {
            if (field.type !== 'file') {
                field.addEventListener('input', saveFormData);
            }
        });

        function saveFormData() {
            const data = {};
            formFields.forEach(field => {
                if (field.type === 'radio') {
                    if (field.checked) {
                        data[field.name] = field.value;
                    }
                } else if (field.type !== 'file') {
                    data[field.name] = field.value;
                }
            });

            //  age range is combined
            if (minAgeInput.value && maxAgeInput.value) {
                data['agerange'] = `${minAgeInput.value}-${maxAgeInput.value}`;
            }

            localStorage.setItem(formId, JSON.stringify(data));
        }

        // Handle image preview and click to upload
        taskPhotoContainer.addEventListener("click", () => taskPhotoInput.click());
        taskPhotoInput.addEventListener("change", function() {
            const file = this.files[0];
            if (file) {
                // Check file size (max 5MB)
                const maxSize = 5 * 1024 * 1024; // 5MB in bytes
                if (file.size > maxSize) {
                    imageWarning.style.display = 'block';
                    taskPhotoInput.value = '';
                    return;
                }

                imageWarning.style.display = 'none';
                const reader = new FileReader();
                reader.onload = function(e) {
                    taskPhotoPreview.src = e.target.result;
                    taskPhotoPreview.style.display = "block"; // Show the image
                    taskPhotoContainer.classList.add("has-image"); // Add class to hide + icon
                };
                reader.readAsDataURL(file);
            }
        });

        // Character count for description
        descriptionField.addEventListener('input', function() {
            charCount.textContent = this.value.length;
        });

        // Clear form functionality
        confirmClearButton.addEventListener("click", function() {
            // Reset the form
            form.reset();
            form.classList.remove('was-validated');

            // Clear image preview
            taskPhotoPreview.style.display = "none";
            taskPhotoContainer.classList.remove("has-image");
            taskPhotoInput.value = "";
            imageWarning.style.display = 'none';

            // Reset character count
            charCount.textContent = '0';

            // Clear localStorage
            localStorage.removeItem(formId);

            // Close the modal using Bootstrap's API
            const modal = bootstrap.Modal.getInstance(document.getElementById("clearFormModal"));
            modal.hide();
        });
    });
    </script>
</body>

</html>