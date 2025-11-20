<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Manajemen Pekerjaan</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body {
      margin: 0;
      font-family: "Segoe UI", Arial, sans-serif;
      background-color: #eaebf3a4;
      display: flex;
      height: 100vh;
    }

 /*------------------------------- Sidebar --------------------------------*/
    .sidebar {
      width: 240px;
      background: linear-gradient(to bottom, #122954ff, #4573c2ff);
      color: #fff;
      display: flex;
      flex-direction: column;
      padding: 20px;
      position: fixed;
      height: 100%; 
    }

    .sidebar h2 {
      font-size: 22px;
      margin-bottom: 5px;
    }

    .sidebar p {
      font-size: 13px;
      color: #c7d3ff;
      margin-bottom: 40px;
    }

    .menu a {
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
      color: #fff;
      padding: 12px 15px;
      border-radius: 8px;
      margin-bottom: 10px;
      transition: 0.3s;
    }

    .menu img {
      width: 22px;
      height: 22px;
      object-fit: contain;
    }

    .menu a:hover, .menu a.active {
      background-color: rgba(255, 255, 255, 0.2);
      transform: scale(1.04);
    }

    .logout {
      margin-top: auto;
      text-align: center;
      padding-top: 80px;
    }

    .logout-icon{
      width: 18px;
      height: 18px;
    }

    .logout button {
      width: 100%;
      background-color: rgba(255, 255, 255, 0.87);
      color: #6d6666ec;
      border: none;
      padding: 10px;
      border-radius: 8px;
      font-size: 14px;
      cursor: pointer;
      transition: background-color 0.3s, transform 0.1s;

      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }

    .logout button:hover {
      background-color: rgba(255, 255, 255, 0.73);
      transform: scale(1.07);
    }

    /*----------------------------------- Main content -----------------------------*/
    .main {
      flex: 1;
      padding: 110px 40px 35px 60px;
      margin-left: 280px;
      overflow-y: auto;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      /* margin-bottom: 20px; */
      position: fixed;
      top: 0;
      left: 280px;
      right: 0;
      height: 80px;
      background-color: white;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      padding: 0 40px;
      z-index: 1000;
    }

    .header h2 {
      margin: 0;
      font-size: 26px;
      font-weight: bold;
      font-weight: 700;
      margin-top: 15px;
    }

    .header p {
      color: #666;
      margin-top: 5px;
      font-size: 14px;
    }

    .btn-add {
      background-color: #1e3a8a;
      color: white;
      padding: 10px 18px;
      border: none;
      border-radius: 8px;
      font-weight: 500;
      cursor: pointer;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      transition: background 0.2s;
    }

    .btn-add:hover {
      background-color: #1d4ed8;
    }

    /*--------------------------- Table ----------------------------*/
    .table-container {
      background-color: white;
      border-radius: 16px;
      padding: 20px;
      box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      border-radius: 12px;
      overflow: hidden;
      
    }

    th, td {
      text-align: left;
      padding: 14px 16px;
      vertical-align: middle;
    }

    th {
      border-bottom: 2px solid #ddd;
      color: #444;
    }

    th.aksi-header {
      text-align: center;
    }

    tr:not(:last-child) {
      border-bottom: 1px solid #eee;
    }

    td.action-cell {
      text-align: center;
      vertical-align: middle;
    }

    .action-btn {
      background: none;
      border: none;
      cursor: pointer;
      margin-right: 8px;
      font-size: 16px;
      transition: color 0.2s;
      object-fit: contain;
      vertical-align: middle;
    }

    .action-btn img {
      width: 25px;
      height: 25px;
      vertical-align: middle;
    }

    .edit {
      transition: transform 0.2s;
      color: #374151;
    }

    .edit:hover {
      color: #2563eb;
    }

    .delete {
      transition: transform 0.2s;
      color: #dc2626;
    }

    .delete:hover {
      color: #b91c1c;
    }
  </style>
</head>
<body>

  <!------------------------------------------ Sidebar ----------------------------------->
  <div class="sidebar">
    <h2>PKS Monitor</h2>
    <p>Admin</p>
    
    <div class="menu">
      <a href="dashboard"><img src="icons/dashboard.png" alt="Dashboard Icon"> Dashboard</a>
      <a href="karyawan.blade.php"><img src="icons/karyawan.png" alt="Karyawan Icon"> Karyawan</a>
      <a href="#" class="active"><img src="icons/pekerjaan.png" alt="Pekerjaan Icon"> Pekerjaan</a>
      <a href="aktivitas"><img src="icons/aktivitas harian.png" alt="Aktivitas Harian Icon"> Aktivitas Harian</a>
      <a href="arsip"><img src="icons/arsip.png" alt="Arsip Icon"> Arsip</a>
      <div class="logout">
        <button onclick="logout()">
          <img src="icons/log out.png" alt="Log out Icon">Log Out</button>
      </div>
    </div>
  </div>

  <!-------------------------- Main Content----------------------------->
  <div class="main">
    <div class="header">
      <div>
        <h2>Manajemen Pekerjaan</h2>
        <p>Kelola pekerjaan dan tugas</p>
      </div>
      <button class="btn-add">+ Tambah Pekerjaan</button>
    </div>

    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Pekerjaan</th>
            <th>Deskripsi Tugas</th>
            <th class="aksi-header">Aksi</th>
          </tr>
        </thead>
        <tbody id="jobTable">
          <tr>
            <td>satpam</td>
            <td>jagapagi</td>
            <td class="action-cell">
              <button class="action-btn edit"><img src="icons/Edit.png" alt="Edit Icon"></button>
              <button class="action-btn delete" onclick="deleteRow(this)"><img src="icons/delete.png" alt="Delete Icon"></button>
            </td>
          </tr>
          <tr>
            <td>supir</td>
            <td>mengantar apa</td>
            <td class="action-cell">
              <button class="action-btn edit"><img src="icons/Edit.png" alt="Edit Icon"></button>
              <button class="action-btn delete" onclick="deleteRow(this)"><img src="icons/delete.png" alt="Delete Icon"></button>
            </td>
          </tr>
          <tr>
            <td>cleaning service</td>
            <td>bersihin toilet</td>
            <td class="action-cell">
              <button class="action-btn edit"><img src="icons/Edit.png" alt="Edit Icon"></button>
              <button class="action-btn delete" onclick="deleteRow(this)"><img src="icons/delete.png" alt="Delete Icon"></button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <script>
    function logout() {
      Swal.fire({
        title: 'Yakin ingin keluar?',
        text: 'Kamu akan kembali ke halaman login.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Logout',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: 'Berhasil Logout!',
            text: 'Anda akan dialihkan ke halaman login...',
            icon: 'success',
            showConfirmButton: false,
            timer: 1800
          });

          setTimeout(() => {
            window.location.href = "login"; 
          }, 1800);
        }
      });
    }

    function deleteRow(btn) {
      if (confirm("Yakin mau hapus pekerjaan ini?")) {
        btn.closest("tr").remove();
      }
    }
  </script>
</body>
</html>
