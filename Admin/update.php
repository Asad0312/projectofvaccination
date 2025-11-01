<?php
session_start();
include "../DBConnection.php";

// ✅ Only allow hospital admin
// if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "hospital") {
//   header("Location: ../auth/login.php");
//   exit;
// }

// Delete doctor functionality
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM doctordetail WHERE id = '$delete_id'";
    if (mysqli_query($connection, $delete_query)) {
        $successMessage = "Doctor deleted successfully!";
    } else {
        $errorMessage = "Error deleting doctor: " . mysqli_error($connection);
    }
}

// Update doctor functionality
if (isset($_POST['update_btn'])) {
    $id = $_POST['id'];
    $name = $_POST['doctorName'];
    $specialization = $_POST['specialization'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $experience = $_POST['experience'];
    $qualification = $_POST['qualification'];
    $address = $_POST['address'];
    $bio = $_POST['bio'];

    $update_query = "UPDATE doctordetail SET 
                    name = '$name', 
                    specilization = '$specialization', 
                    email = '$email', 
                    phone = '$phone', 
                    experence = '$experience', 
                    qulification = '$qualification', 
                    address = '$address', 
                    bio = '$bio' 
                    WHERE id = '$id'";
    
    if (mysqli_query($connection, $update_query)) {
        $successMessage = "Doctor updated successfully!";
    } else {
        $errorMessage = "Error updating doctor: " . mysqli_error($connection);
    }
}

// Fetch all doctors
$doctors_query = "SELECT * FROM doctordetail ORDER BY id DESC";
$doctors_result = mysqli_query($connection, $doctors_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update/Delete Doctor | Hospital Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/doctor.css">
  <style>
    /* Additional styles for update page */
    .doctors-table {
      background: var(--card);
      border-radius: 12px;
      box-shadow: var(--shadow);
      overflow: hidden;
      margin-top: 20px;
    }
    
    .table-header {
      padding: 20px;
      border-bottom: 1px solid var(--border);
    }
    
    .table-header h3 {
      color: var(--blue);
      display: flex;
      align-items: center;
      gap: 10px;
    }
    
    table {
      width: 100%;
      border-collapse: collapse;
    }
    
    th, td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid var(--border);
    }
    
    th {
      background: var(--bg);
      font-weight: 600;
      color: var(--text);
    }
    
    tr:hover {
      background: #f8faff;
    }
    
    .action-buttons {
      display: flex;
      gap: 8px;
    }
    
    .btn-edit {
      background: var(--blue);
      color: white;
      border: none;
      padding: 6px 12px;
      border-radius: 6px;
      cursor: pointer;
      font-size: 12px;
      display: flex;
      align-items: center;
      gap: 4px;
    }
    
    .btn-delete {
      background: var(--error);
      color: white;
      border: none;
      padding: 6px 12px;
      border-radius: 6px;
      cursor: pointer;
      font-size: 12px;
      display: flex;
      align-items: center;
      gap: 4px;
    }
    
    .btn-edit:hover {
      background: #0a56b8;
    }
    
    .btn-delete:hover {
      background: #dc2626;
    }
    
    /* Modal Styles */
    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.5);
    }
    
    .modal-content {
      background-color: var(--card);
      margin: 5% auto;
      padding: 0;
      border-radius: 12px;
      width: 90%;
      max-width: 600px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }
    
    .modal-header {
      padding: 20px;
      border-bottom: 1px solid var(--border);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .modal-header h3 {
      color: var(--blue);
      margin: 0;
    }
    
    .close {
      color: var(--muted);
      font-size: 24px;
      font-weight: bold;
      cursor: pointer;
    }
    
    .close:hover {
      color: var(--error);
    }
    
    .modal-body {
      padding: 20px;
      max-height: 70vh;
      overflow-y: auto;
    }
    
    .no-doctors {
      text-align: center;
      padding: 40px;
      color: var(--muted);
    }
    
    .no-doctors i {
      font-size: 48px;
      margin-bottom: 15px;
    }
  </style>
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
      <a href="./doctor.php"><i class='bx bx-plus-medical'></i> <span>Add Doctor</span></a>
      <a href="./update.php" class="active"><i class='bx bx-edit'></i> <span>Update/Delete Doctor</span></a>
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
      <div class="title">Update/Delete Doctors</div>
      <div class="search">
        <i class='bx bx-search'></i>
        <input type="text" id="searchInput" placeholder="Search doctors...">
      </div>
    </header>

    <?php if (isset($successMessage)): ?>
      <div class="alert alert-success">
        <?php echo $successMessage; ?>
      </div>
    <?php endif; ?>

    <?php if (isset($errorMessage)): ?>
      <div class="alert alert-error">
        <?php echo $errorMessage; ?>
      </div>
    <?php endif; ?>

    <div class="doctors-table">
      <div class="table-header">
        <h3><i class='bx bx-list-ul'></i> All Doctors (<?php echo mysqli_num_rows($doctors_result); ?>)</h3>
      </div>

      <?php if (mysqli_num_rows($doctors_result) > 0): ?>
        <table id="doctorsTable">
          <thead>
            <tr>
              <th>ID</th>
              <th>name</th>
              <th>specilization</th>
              <th>email</th>
              <th>phone</th>
              <th>experence</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($doctor = mysqli_fetch_assoc($doctors_result)): ?>
              <tr>
                <td><?php echo $doctor['ID']; ?></td>
                <td><?php echo htmlspecialchars($doctor['name']); ?></td>
                <td><?php echo htmlspecialchars($doctor['specilization']); ?></td>
                <td><?php echo htmlspecialchars($doctor['email']); ?></td>
                <td><?php echo htmlspecialchars($doctor['phone']); ?></td>
                <td><?php echo htmlspecialchars($doctor['experence']); ?> years</td>
                <td>
                  <div class="action-buttons">
                    <button class="btn-edit" onclick="openEditModal(<?php echo $doctor['ID']; ?>)">
                      <i class='bx bx-edit'></i> Edit
                    </button>
                    <button class="btn-delete" onclick="confirmDelete(<?php echo $doctor['ID']; ?>, '<?php echo htmlspecialchars($doctor['name']); ?>')">
                      <i class='bx bx-trash'></i> Delete
                    </button>
                  </div>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      <?php else: ?>
        <div class="no-doctors">
          <i class='bx bx-user-x'></i>
          <h3>No Doctors Found</h3>
          <p>Add some doctors to get started.</p>
          <a href="./doctor.php" class="btn btn-primary" style="margin-top: 15px;">
            <i class='bx bx-plus-medical'></i> Add First Doctor
          </a>
        </div>
      <?php endif; ?>
    </div>
  </main>

  <!-- Edit Doctor Modal -->
  <div id="editModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h3><i class='bx bx-edit'></i> Edit Doctor</h3>
        <span class="close">&times;</span>
      </div>
      <div class="modal-body">
        <form id="editDoctorForm" method="POST">
          <input type="hidden" id="edit_id" name="id">
          <div class="form-grid">
            <div class="form-group">
              <label for="edit_doctorName" class="required">Full Name</label>
              <input type="text" id="edit_doctorName" name="doctorName" placeholder="Enter doctor's full name" required>
            </div>

            <div class="form-group">
              <label for="edit_specialization" class="required">Specialization</label>
              <select id="edit_specialization" name="specialization" required>
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
              <label for="edit_email" class="required">Email Address</label>
              <input type="email" id="edit_email" name="email" placeholder="Enter email address" required>
            </div>

            <div class="form-group">
              <label for="edit_phone" class="required">Phone Number</label>
              <input type="tel" id="edit_phone" name="phone" placeholder="Enter phone number" required>
            </div>

            <div class="form-group">
              <label for="edit_experience" class="required">Years of Experience</label>
              <input type="number" id="edit_experience" name="experience" min="0" max="50" placeholder="Enter years of experience" required>
            </div>

            <div class="form-group">
              <label for="edit_qualification" class="required">Qualification</label>
              <input type="text" id="edit_qualification" name="qualification" placeholder="e.g., MBBS, MD, etc." required>
            </div>

            <div class="form-group full-width">
              <label for="edit_address">Clinic Address</label>
              <textarea id="edit_address" name="address" rows="3" placeholder="Enter clinic address"></textarea>
            </div>

            <div class="form-group full-width">
              <label for="edit_bio">Professional Bio</label>
              <textarea id="edit_bio" name="bio" rows="4" placeholder="Enter professional biography"></textarea>
            </div>
          </div>

          <div class="form-actions">
            <button type="button" class="btn btn-outline" onclick="closeEditModal()">Cancel</button>
            <button type="submit" class="btn btn-primary" name="update_btn">
              <i class='bx bx-save'></i> Update Doctor
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    // Modal functionality
    const modal = document.getElementById('editModal');
    const closeBtn = document.querySelector('.close');
    
    function openEditModal(doctorId) {
      // Fetch doctor data and populate form
      fetch(`get_doctor.php?id=${doctorId}`)
        .then(response => response.json())
        .then(doctor => {
          document.getElementById('edit_id').value = doctor.id;
          document.getElementById('edit_doctorName').value = doctor.name;
          document.getElementById('edit_specialization').value = doctor.specilization;
          document.getElementById('edit_email').value = doctor.email;
          document.getElementById('edit_phone').value = doctor.phone;
          document.getElementById('edit_experience').value = doctor.experence;
          document.getElementById('edit_qualification').value = doctor.qulification;
          document.getElementById('edit_address').value = doctor.address || '';
          document.getElementById('edit_bio').value = doctor.bio || '';
          
          modal.style.display = 'block';
        })
        .catch(error => {
          console.error('Error fetching doctor data:', error);
          alert('Error loading doctor data');
        });
    }
    
    function closeEditModal() {
      modal.style.display = 'none';
    }
    
    closeBtn.onclick = closeEditModal;
    
    window.onclick = function(event) {
      if (event.target == modal) {
        closeEditModal();
      }
    }
    
    // Delete confirmation
    function confirmDelete(doctorId, doctorName) {
      if (confirm(`Are you sure you want to delete Dr. ${doctorName}?`)) {
        window.location.href = `?delete_id=${doctorId}`;
      }
    }
    
    // Search functionality
    document.getElementById('searchInput').addEventListener('input', function() {
      const searchTerm = this.value.toLowerCase();
      const rows = document.querySelectorAll('#doctorsTable tbody tr');
      
      rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
      });
    });
  </script>

</body>
</html>