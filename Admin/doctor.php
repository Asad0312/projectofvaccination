<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Doctor | Hospital Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/doctor.css">
</head>
<body>

  <aside class="sidebar">
    <div class="brand">
      <div class="logo">VB</div>
      <h1>Hospital Panel</h1>
    </div>

    <nav>
      <a href="./dashboard.php"><i class='bx bx-home'></i> <span>Dashboard</span></a>
      <a href="./children.php"><i class='bx bx-user'></i> <span>All Child Details</span></a>
      <a href="./datetime.php"><i class='bx bx-calendar'></i> <span>Date & Time of Vaccination</span></a>
      <a href="./report.php"><i class='bx bx-bar-chart'></i> <span>Vaccination Reports</span></a>
      <a href="./vaccine.php"><i class='bx bx-qr-scan'></i> <span>Vaccine List</span></a>
      <a href="./parent.php"><i class='bx bx-message-dots'></i> <span>Parent Requests</span></a>
      <a href="./doctor.php" class="active"><i class='bx bx-plus-medical'></i> <span>Add Doctor</span></a>
      <a href="./update.php"><i class='bx bx-edit'></i> <span>Update/Delete Doctor</span></a>
      <a href="./list.php"><i class='bx bx-building-house'></i> <span>List of Doctors</span></a>
      <a href="./booking.php"><i class='bx bx-book-open'></i> <span>Booking Details</span></a>
    </nav>

    <div class="logout">
      <a href="../login.php">
        <i class='bx bx-log-out'></i> <span>Logout</span>
      </a>
    </div>
  </aside>

  <main>
    <header>
      <div class="title">Add New Doctor</div>
      <div class="search">
        <i class='bx bx-search'></i>
        <input type="text" placeholder="Search...">
      </div>
    </header>

    <div class="form-container">
      <div class="form-header">
        <h2><i class='bx bx-plus-medical'></i> Doctor Information</h2>
        <p>Fill in the details below to add a new doctor to the system</p>
      </div>

      <form id="addDoctorForm" method="post">
        <div class="form-grid">
          <div class="form-group">
            <label for="doctorName" class="required">Full Name</label>
            <input type="text" id="doctorName" name="doctorName" placeholder="Enter doctor's full name" required>
          </div>

          <div class="form-group">
            <label for="specialization" class="required">Specialization</label>
            <select id="specialization" name="specialization" required>
              <option value="">Select Specialization</option>
              <option value="Pediatrics">Pediatrics</option>
              <option value="Cardiology">Cardiology</option>
              <option value="Neurology">Neurology</option>
              <option value="Orthopedics">Orthopedics</option>
              <option value="Dermatology">Dermatology</option>
              <option value="Gynecology">Gynecology</option>
              <option value="Oncology">Oncology</option>
              <option value="Psychiatry">Psychiatry</option>
              <option value="Other">Other</option>
            </select>
          </div>

          <div class="form-group">
            <label for="email" class="required">Email Address</label>
            <input type="email" id="email" name="email" placeholder="Enter email address" required>
          </div>

          <div class="form-group">
            <label for="phone" class="required">Phone Number</label>
            <input type="tel" id="phone" name="phone" placeholder="Enter phone number" required>
          </div>

          <div class="form-group">
            <label for="experience" class="required">Years of Experience</label>
            <input type="number" id="experience" name="experience" min="0" max="50" placeholder="Enter years of experience" required>
          </div>

          <div class="form-group">
            <label for="qualification" class="required">Qualification</label>
            <input type="text" id="qualification" name="qualification" placeholder="e.g., MBBS, MD, etc." required>
          </div>

          <div class="form-group full-width">
            <label for="doctorImage">Doctor Photo</label>
            <div class="image-upload-container" id="imageUploadArea">
              <i class='bx bx-cloud-upload'></i>
              <p>Click to upload doctor's photo</p>
              <span>PNG, JPG up to 5MB</span>
              <input type="file" id="doctorImage" name="doctorImage" accept="image/*" style="display: none;">
            </div>
            <div class="image-preview" id="imagePreview">
              <img id="previewImage" src="#" alt="Preview">
              <button type="button" class="btn-remove" id="removeImage">Remove Image</button>
            </div>
          </div>

          <div class="form-group full-width">
            <label for="address">Clinic Address</label>
            <textarea id="address" name="address" rows="3" placeholder="Enter clinic address"></textarea>
          </div>

          <div class="form-group full-width">
            <label for="bio">Professional Bio</label>
            <textarea id="bio" name="bio" rows="4" placeholder="Enter professional biography"></textarea>
          </div>
        </div>

        <div class="form-actions">
          <button type="button" class="btn btn-outline">Cancel</button>
          <button type="submit" class="btn btn-primary" name="btn">
            <i class='bx bx-save'></i> Add Doctor
          </button>
        </div>
      </form>
    </div>
  </main>

  <!-- <script>
    // Image Upload Functionality
    document.getElementById('imageUploadArea').addEventListener('click', function() {
      document.getElementById('doctorImage').click();
    });

    document.getElementById('doctorImage').addEventListener('change', function(event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById('previewImage').src = e.target.result;
          document.getElementById('imagePreview').classList.add('active');
        }
        reader.readAsDataURL(file);
      }
    });

    document.getElementById('removeImage').addEventListener('click', function() {
      document.getElementById('doctorImage').value = '';
      document.getElementById('imagePreview').classList.remove('active');
    });

    // Form Submission
    document.getElementById('addDoctorForm').addEventListener('submit', function(event) {
      event.preventDefault();
      
      // Simple validation
      const doctorName = document.getElementById('doctorName').value;
      const specialization = document.getElementById('specialization').value;
      const email = document.getElementById('email').value;
      
      if (!doctorName || !specialization || !email) {
        alert('Please fill in all required fields');
        return;
      }
      
      // In a real application, you would send the form data to the server here
      alert('Doctor added successfully!');
      // this.reset();
      // document.getElementById('imagePreview').classList.remove('active');
    });
  </script> -->

  <?php

  include "../DBConnection.php";

  if(isset($_POST['btn'])) {
  $name = $_POST['doctorName'];
  $specialization = $_POST['specialization'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $experience = $_POST['experience'];
  $qualification = $_POST['qualification'];
  // $doctorImage = $_POST['doctorImage'];
  $address = $_POST['address'];
  $bio = $_POST['bio'];

  $query = "INSERT INTO `doctordetail`( `name`, `specilization`, `email`, `phone`, `experence`, `qulification`, `address`, `bio`) VALUES ('$name','$specialization','$email','$phone','$experience','$qualification','$address','$bio')";
  $_result = mysqli_query($connection,$query);

  }
  
  
  ?>

</body>
</html>