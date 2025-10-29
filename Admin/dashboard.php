<?php
session_start();

// // ✅ Only allow hospital admin
// if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "hospital") {
//   header("Location: ../auth/login.php");
//   exit;
// }
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Hospital Dashboard | Vaccination Management</title>

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="../css/dashboard.css">

</head>
<body>

  <aside class="sidebar">
    <div class="brand">
      <div class="logo">VB</div>
      <h1>Hospital Panel</h1>
    </div>

    <nav>
      <a href="./dashboard.php" class="active"><i class='bx bx-home'></i> Dashboard</a>
      <a href="./children.php"><i class='bx bx-user'></i> All Child Details</a>
      <a href="./datetime.php"><i class='bx bx-calendar'></i> Date & Time of Vaccination</a>
      <a href="./report.php"><i class='bx bx-bar-chart'></i> Vaccination Reports</a>
      <a href="./vaccine.php"><i class='bx bx-qr-scan'></i> Vaccine List</a>
      <a href="./parent.php"><i class='bx bx-message-dots'></i> Parent Requests</a>
      <a href="./doctor.php"><i class='bx bx-plus-medical'></i> Add Doctor</a>
      <a href="./update.php"><i class='bx bx-edit'></i> Update/Delete Doctor</a>
      <a href="./list.php"><i class='bx bx-building-house'></i> List of Doctors</a>
      <a href="./booking.php"><i class='bx bx-book-open'></i> Booking Details</a>
    </nav>

    <!-- ✅ Logout Button -->
    <div class="logout">
      <a href="../login.php">
        <i class='bx bx-log-out'></i> Logout
      </a>
    </div>
  </aside>

  <main>
    <header>
      <div class="title">Welcome, Hospital Admin</div>
      <div class="search">
        <i class='bx bx-search'></i>
        <input type="text" placeholder="Search...">
      </div>
    </header>

    <section class="cards">
      <div class="card"><h3>Children Registered</h3><p>1248</p></div>
      <div class="card"><h3>Upcoming Today</h3><p>72</p></div>
      <div class="card"><h3>Vaccines Available</h3><p>12</p></div>
      <div class="card"><h3>Pending Requests</h3><p>6</p></div>
    </section>

    <section>
      <table>
        <thead>
          <tr>
            <th>Child Name</th>
            <th>Vaccine</th>
            <th>Hospital</th>
            <th>Date</th>
            <th>Status</th>
            <th style="text-align:right;">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Ayaan Khan</td>
            <td>Polio</td>
            <td>City Hospital</td>
            <td>2025-11-03</td>
            <td>Upcoming</td>
            <td style="text-align:right;">
              <button class="btn btn-primary" onclick="markDone()">Mark Done</button>
            </td>
          </tr>
        </tbody>
      </table>
    </section>
  </main>

  <script>
    // ✅ Mark Done Alert
    function markDone(){
      Swal.fire({
        icon:'success',
        title:'Marked Vaccinated',
        text:'Child vaccination marked successfully!',
        confirmButtonColor:'#0b63d6'
      })
    }
  </script>

</body>
</html>