<?php
session_start();
include "connection.php";



// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: ../index.php");
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/styles.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

  <!-- Standard Favicon -->
  <link rel="icon" type="image/x-icon" href="../assets/favicon/favicon.ico">

  <!-- PNG Favicons -->
  <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicon/favicon-16x16.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon/favicon-32x32.png">

  <!-- Apple Touch Icon (for iPhones/iPads) -->
  <link rel="apple-touch-icon" sizes="180x180" href="../assets/favicon/apple-touch-icon.png">

  <!-- Android Chrome Icons -->
  <link rel="icon" type="image/png" sizes="192x192" href="../assets/favicon/android-chrome-192x192.png">
  <link rel="icon" type="image/png" sizes="512x512" href="../assets/favicon/android-chrome-512x512.png">

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

    input {
      padding: 10px;
    }
  </style>
</head>

<body>
  <?php include 'topnav.php'; 

  $task_id = isset($_GET['task_id']) ? intval($_GET['task_id']) : 0;
  $detail_check = $conn->prepare("SELECT * FROM task WHERE task_id = ?");
  $detail_check->bind_param("i", $task_id);
  $detail_check->execute();
  $detail_result = $detail_check->get_result();

  while ($task_row = $detail_result->fetch_assoc()) {
    $tasktitle = $task_row['task_title'];
    $taskdescription = $task_row['task_description'];
    $taskphoto = $task_row['task_photo'];
    $taskdate = $task_row['task_date'];
    $taskduration = preg_match('/\d+/', $task_row['task_duration'], $matches) ?  $matches[0] : 0;
    $tasklocation = $task_row['task_location'];
    $toolsrequired = $task_row['task_toolsRequired'];
    $pax = $task_row['task_pax'];
    $price = $task_row['task_price'];
    $dresscode = $task_row['task_dressCode'];
    $gender = $task_row['task_gender'];
    $nationality = $task_row['task_nationality'];
    $minAge = $task_row['task_minAge'];
    $maxAge = $task_row['task_maxAge'];
    $muslimfriendly = $task_row['task_muslimFriendly'];
    $foodProvision = $task_row['task_foodProvision'];
    $transportProvision = $task_row['task_transportProvision'];
    $userid = $task_row['user_id'];
  }
  ?>

  <div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
    <div id="profileUpdateToast" class="toast align-items-center text-bg-success border-0" role="alert"
      aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">
          <?php if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']); // Clear session message after displaying
          } ?>
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  </div>
  <main class="container mt-4 w-75">
    <h4 class="text-center mb-3">Edit Your Job Task</h4>

    <div class="mx-auto p-4 shadow-sm">
      <!-- Profile Picture Upload -->
      <div class="d-flex justify-content-end align-items-center gap-1 p-1 w-100">
        <div class="text-center d-flex align-items-end p-1">
          <p class="profile-text fw-bold w-100">Edit Task Picture <span class="fst-italic fw-light fs-0" style="font-size: 0.75em;">Click on the picture to edit: </span> </p>
        </div>
        <div class="profile-photo-form">
          <form action="taskphoto_process.php" method="POST" enctype="multipart/form-data"
            class="text-center d-flex justify-content-center align-items-center gap-4 p-1">
            <!-- Hidden input for task_id -->
            <input type="hidden" name="task_id" value="<?= $task_id ?>">
            <div class="my-1">
              <img id="task-photo" class="rounded border border-secondary" style="object-fit: contain; background-color: white;" width="500" height="300"
                src="<?= $taskphoto ?>" role="button">
            </div>
            <input type="file" id="task-photo-filename" name="task-photo-filename" accept="image/jpeg, image/png, image/jpg" hidden>
            <button type="submit" class="btn btn-primary btn-primary-style" id="upload-button" disabled>Upload</button>
          </form>
        </div>
      </div>

      <hr>

      <!-- Profile Edit Form -->
      <div class="profile-form mt-3">
        <form id="profileForm" action="editpost_process.php" method="POST" enctype="multipart/form-data"
          class="createpost-form needs-validation" novalidate>
          <!-- Hidden input for task_id -->
          <input type="hidden" name="task_id" value="<?= $task_id ?>">
          <input type="hidden" name="taskphoto" value="<?= $taskphoto ?>">
          <div class="form-row mb-3">
            <label for="tasktitle" class="form-label">Task Title <span style="color: red;">*</span></label>
            <input type="text" class="form-control" name="tasktitle" id="tasktitle" value="<?= $tasktitle ?>" required
              maxlength="100">
            <div class="invalid-feedback">Please enter a task title.</div>
          </div>

          <div class="form-row mb-3">
            <label for="taskdescription" class="form-label">Task Description<span style="color: red;">*</span></label>
            <textarea class="form-control" name="taskdescription" id="taskdescription" rows="4" required
              maxlength="1000"><?= htmlspecialchars($taskdescription) ?> </textarea>
            <div class="invalid-feedback">Please enter a task description.</div>
            <div class="field-feedback">
              <span id="descriptionCharCount">0</span>/1000 characters
            </div>
          </div>

          <div class="form-row mb-3">
            <label for="taskdate" class="form-label">Task Date <span style="color: red;">*</span></label>
            <input type="date" class="form-control" name="taskdate" id="taskdate" value="<?= $taskdate ?>" required>
            <div class="invalid-feedback">Please select a task date.</div>
          </div>

          <div class="form-row mb-3">
            <label for="taskduration" class="form-label">Task <span style="color: red;">*</span></label>
            <div class="task-duration-wrapper">
              <input type="number" class="form-control" name="taskduration" id="taskduration" value="<?= $taskduration ?>" required
                min="0.5" max="24" step="0.5">
              <span>hrs</span>
            </div>
            <div class="invalid-feedback">Please enter a valid duration (0.5-24 hours).</div>
          </div>

          <div class="form-row mb-3">
            <label for="tasklocation" class="form-label">Task Location <span style="color: red;">*</span></label>
            <input type="text" class="form-control" name="tasklocation" id="tasklocation" value="<?= $tasklocation ?>" required
              maxlength="200">
            <div class="invalid-feedback">Please enter a task location.</div>
          </div>

          <div class="form-row mb-3">
            <label for="toolsrequired" class="form-label">Tools Required <span style="color: red;">*</span></label>
            <input type="text" class="form-control" name="toolsrequired" id="toolsrequired" value="<?= $toolsrequired ?>" required
              maxlength="200">
            <div class="invalid-feedback">Please list tools required.</div>
          </div>

          <div class="form-row mb-3">
            <label for="pax" class="form-label">Pax <span style="color: red;">*</span></label>
            <input type="number" class="form-control" name="pax" id="pax" required min="1" max="100" value="<?= $pax ?>">
            <div class="invalid-feedback">Please enter a valid number of participants (1-100).</div>
          </div>

          <div class="form-row mb-3">
            <label for="price" class="form-label">Price <span style="color: red;">*</span></label>
            <input type="number" class="form-control" name="price" id="price" required min="1" step="0.01" value="<?= $price ?>">
            <div class="invalid-feedback">Please enter a valid price (min $1).</div>
          </div>

          <p class="additional-info fw-bold mt-4 mb-3">Additional Information</p>

          <div class="form-row mb-3">
            <label for="dresscode" class="form-label">Dress Code <span style="color: red;">*</span></label>
            <input type="text" class="form-control" name="dresscode" id="dresscode" required value="<?= $dresscode ?>"
              maxlength="100">
            <div class="invalid-feedback">Please specify a dress code.</div>
          </div>

          <div class="form-row mb-3">
            <label for="gender" class="form-label">Gender <span style="color: red;">*</span></label>
            <select class="form-select" name="gender" id="gender" required>
              <option value="" <?= $gender == "" ? 'selected' : '' ?>>Select gender</option>
              <option value="Any" <?= $gender == "Any" ? 'selected' : '' ?>>Any</option>
              <option value="Male" <?= $gender == "Male" ? 'selected' : '' ?>>Male</option>
              <option value="Female" <?= $gender == "Female" ? 'selected' : '' ?>>Female</option>
            </select>
            <div class="invalid-feedback">Please select a gender preference.</div>
          </div>

          <div class="form-row mb-3">
            <label for="nationality" class="form-label">Nationality <span style="color: red;">*</span></label>
            <select class="form-select" name="nationality" id="nationality" required>
              <option value="" <?= $nationality == "" ? 'selected' : '' ?>>Select nationality</option>
              <option value="Malaysian" <?= $nationality == "Malaysian" ? 'selected' : '' ?>>Malaysian</option>
              <option value="Non-Malaysian" <?= $nationality == "Non-Malaysian" ? 'selected' : '' ?>>Non-Malaysian</option>
              <option value="Any" <?= $nationality == "Any" ? 'selected' : '' ?>>Any</option>
            </select>
            <div class="invalid-feedback">Please select a nationality requirement.</div>
          </div>

          <div class="form-row mb-3">
            <label for="minAge" class="form-label">Age Range <span style="color: red;">*</span></label>
            <div class="age-range-container">
              <input type="number" class="form-control" name="minAge" id="minAge" placeholder="Min" value="<?= $minAge ?>"
                required min="18" max="99">
              <span class="age-label">to</span>
              <input type="number" class="form-control" name="maxAge" id="maxAge" placeholder="Max" value="<?= $maxAge ?>"
                required min="18" max="99">
            </div>
            <div class="invalid-feedback" id="ageRangeFeedback">Please specify a valid age range.</div>
            <input type="hidden" name="agerange" id="agerange">
          </div>

          <fieldset class="form-group mb-3">
            <legend class="col-form-label">Muslim Friendly</legend>
            <div class="form-check form-check-inline">
              <input class="form-check-input" <?= $muslimfriendly == "1" ? 'checked' : '' ?> type="radio" name="muslimfriendly" id="muslimfriendly1"
                value="1" required>
              <label class="form-check-label" for="muslimfriendly1">Yes</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" <?= $muslimfriendly == "0" ? 'checked' : '' ?> type="radio" name="muslimfriendly" id="muslimfriendly2"
                value="0">
              <label class="form-check-label" for="muslimfriendly2">No</label>
            </div>
            <div class="invalid-feedback">Please select an option.</div>
          </fieldset>

          <fieldset class="form-group mb-3">
            <legend class="col-form-label">Food Provided</legend>
            <div class="form-check form-check-inline">
              <input class="form-check-input" <?= $foodProvision == "1" ? 'checked' : '' ?> type="radio" name="foodprovision" id="foodprovision1"
                value="1" required>
              <label class="form-check-label" for="foodprovision1">Yes</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" <?= $foodProvision == "0" ? 'checked' : '' ?> type="radio" name="foodprovision" id="foodprovision2"
                value="0">
              <label class="form-check-label" for="foodprovision2">No</label>
            </div>
            <div class="invalid-feedback">Please select an option.</div>
          </fieldset>

          <fieldset class="form-group mb-4">
            <legend class="col-form-label">Transport Provided</legend>
            <div class="form-check form-check-inline">
              <input class="form-check-input" <?= $transportProvision == "1" ? 'checked' : '' ?> type="radio" name="transportprovision"
                id="transportprovision1" value="1" required>
              <label class="form-check-label" for="transportprovision1">Yes</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" <?= $transportProvision == "0" ? 'checked' : '' ?> type="radio" name="transportprovision"
                id="transportprovision2" value="0">
              <label class="form-check-label" for="transportprovision2">No</label>
            </div>
            <div class="invalid-feedback">Please select an option.</div>
          </fieldset>

          <div class="d-flex justify-content-center align-items-center gap-2 mb-4">
            <button type="button" class="btn btn-outline-danger" onclick="window.location.href='jobboard.php'">
              <i class="fas fa-arrow-left"></i> &nbsp; Go back
            </button>
            <button type="submit" name="editpost-submit" class="btn btn-success w-25">Update</button>
          </div>
        </form>
      </div>
    </div>
  </main>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const fileInput = document.getElementById("task-photo-filename");
      const uploadButton = document.getElementById("upload-button");
      const taskPicture = document.getElementById("task-photo");
      const formInputs = document.querySelectorAll("form input:not([disabled])");
      const submitButton = document.querySelector("button[type='submit']");

      uploadButton.disabled = true; // Ensure it's disabled on page load
      submitButton.disabled = true; // Disable submit  button initially

      // Enable the file input when clicking on the image
      taskPicture.addEventListener("click", function() {
        fileInput.click();
      });

      // Handle profile picture change
      fileInput.addEventListener("change", function(event) {
        const file = event.target.files[0];

        if (!file || !file.type.match("image.*")) {
          alert("Please select a valid image file.");
          uploadButton.disabled = true;
          return;
        }

        // Show preview before uploading
        const reader = new FileReader();
        reader.onload = function(e) {
          taskPicture.src = e.target.result;
        };
        reader.readAsDataURL(file);

        uploadButton.disabled = false; // Enable button when a file is selected
      });

      // Enable the submit button if any form field is changed
      /* formInputs.forEach(input => {
        input.addEventListener("input", function() {
          submitButton.disabled = false;
        });
      }); */

      const form = document.getElementById("profileForm");
      const confirmClearButton = document.getElementById("confirmClearForm");
      const taskPhotoContainer = document.getElementById("task-photo-container");
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

      // Character count for description
      descriptionField.addEventListener('input', function() {
        charCount.textContent = this.value.length;
      });

      // Clear form functionality
      confirmClearButton.addEventListener("click", function() {
        // Reset the form
        form.reset();
        form.classList.remove('was-validated');
        // Reset character count
        charCount.textContent = '0';

        // Clear localStorage
        localStorage.removeItem(formId);

        // Close the modal using Bootstrap's API
        const modalElement = document.getElementById("clearFormModal");
        const modal = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
        modal.hide();
        modalElement.addEventListener('hidden.bs.modal', function() {
          console.log('Modal completely hidden');
          // Remove modal backdrop and reset styles  
          document.querySelectorAll(".modal-backdrop").forEach(function(backdrop) {
            backdrop.classList.remove('show');
            backdrop.remove(); // This line explicitly removes backdrops rather than just hiding them  
          });
          document.body.style.overflow = '';
          document.body.style.paddingRight = '';
        });
      });
    });
  </script>

</body>

</html>