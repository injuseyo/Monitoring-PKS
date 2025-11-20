<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard - PKS Monitoring</title>
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
      transform: scale(1.02);
    }

    /*------------------------------- Main Content ---------------------------------*/
    .main-content {
      flex: 1;
      padding: 110px 40px 20px 40px;
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

    .header h1 {
      font-size: 26px;
      font-weight: 700;
      color: #222;
      margin: 0;
    }

    .header p {
      font-size: 14px;
      color: #666;
      margin: 5px 0 0 0;
    }

    .user-profile {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .user-profile img {
      width: 35px;
      height: 35px;
      border-radius: 50%;
    }

    /*------------------------------ Cards --------------------------------*/
    .cards {
      display: flex;
      gap: 20px;
      margin-bottom: 30px;
    }

    .card {
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
      flex: 1;
      text-align: left;
    }

    .card h3 {
      margin: 0;
      font-size: 16px;
      color: #000000ff;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }   

    .card h3 img {
      width: 22px;
      height: 22px;
      margin-left: 8px;
      vertical-align: middle;
    }

    .card .angka {
      font-size: 30px;
      font-weight: bold;
      margin: 10px 0 0;
    }

    .card .keterangan {
      font-size: 11px;
      margin: 2px 0 0 0;
      color: #666;
    }

    .filter-section, .table-section {
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
      margin-bottom: 25px;
    }

    .filter-row {
      display: flex;
      gap: 20px;
      flex-wrap: wrap;
      justify-content: flex-start;
    }

    .filter-row div {
      flex: 0 0 265px;
      min-width: 180px;
      color: #555;
      font-size: 14px;
    }

    select, input[type="date"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }

    th, td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #eee;
    }

    th {
      color: #555;
      font-size: 14px;
      text-align: center;
    }

    td {
      font-size: 14px;
      text-align: center;
    }

    .eye-icon {
      width: 20px;
      height: 20px;
      object-fit: contain;
      vertical-align: middle;
      cursor: pointer;
      filter: grayscale(100%);
    }

    .eye-icon:hover {
      filter: brightness(0) saturate(100%) invert(30%) sepia(100%) saturate(1000%) hue-rotate(200deg);
    }

  </style>
</head>
<body>
  <div class="sidebar">
    <h2>PKS Monitor</h2>
    <p>Admin</p>

    <div class="menu">
      <a href="#" class="active"><img src="icons/dashboard.png" alt="Dashboard Icon"> Dashboard</a>
      <a href="karyawan"><img src="icons/karyawan.png" alt="Karyawan Icon"> Karyawan</a>
      <a href="pekerjaan"><img src="icons/pekerjaan.png" alt="Pekerjaan Icon"> Pekerjaan</a>
      <a href="aktivitas"><img src="icons/aktivitas harian.png" alt="Aktivitas Harian Icon"> Aktivitas Harian</a>
      <a href="arsip"><img src="icons/arsip.png" alt="Arsip Icon"> Arsip</a>
      <div class="logout">
        <button type="button" onclick="logout()">
          <img src="icons/log out.png" alt="Log out Icon">Log Out
        </button>
      </div>
    </div>
  </div>

  <div class="main-content">
    <div class="header">
      <div>
        <h1>Dashboard</h1>
        <p>Ringkasan aktivitas karyawan</p>
      </div>
      <div class="user-profile">
        <img src="https://i.pravatar.cc/50" alt="User">
        <span>Princess</span>
      </div>
    </div>

    <div class="cards">
      <div class="card">
        <h3>Total Karyawan <img src="icons/total karyawan.png" alt="Total Karyawan Icon"></h3>
        <p class="angka"> 5</p>
        <p class="keterangan">Karyawan aktif</p>
      </div>
      <div class="card">    
        <h3>Aktivitas Hari Ini <img src="icons/aktivitas hari ini.png" alt="Aktivitas Hari Ini Icon"></h3>
        <p class="angka">2</p>
        <p class="keterangan">Aktivitas tercatat hari ini</p>
      </div>
      <div class="card">
        <h3>Pekerja Aktif <img src="icons/pekerja aktif.png" alt="Pekerja Aktif Icon"></h3>
        <p class="angka">5</p>
        <p class="keterangan">Total pekerjaan</p>
      </div>
    </div>

    <div class="filter-section">
      <h3>Filter Aktivitas</h3>
      <div class="filter-row">
        <div>
          <label style="font-weight: bold;">Nama</label>
          <select>
            <option>Semua karyawan</option>
          </select>
        </div>
        <div>
          <label style="font-weight: bold;">Pekerjaan</label>
          <select>
            <option>Semua pekerjaan</option>
          </select>
        </div>
        <div>
          <label style="font-weight: bold;">Waktu</label>
          <input type="date" />
        </div>
      </div>
    </div>

    <div class="table-section">
      <h3>Aktivitas Karyawan</h3>
      <table>
        <thead>
          <tr>
            <th>Pekerjaan</th>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>Tanggal</th>
            <th>Waktu</th>
            <th>Foto</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Satpam</td>
            <td>Yaya</td>
            <td>Patroli</td>
            <td>26-09-2025</td>
            <td>07.00</td>
            <td><img src="icons/foto.png" alt="foto Icon" class="eye-icon"></td>
          </tr>
          <tr>
            <td>Satpam</td>
            <td>Yaya</td>
            <td>Patroli</td>
            <td>26-09-2025</td>
            <td>07.00</td>
            <td><img src="icons/foto.png" alt="foto Icon" class="eye-icon"></td>
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
</script>
</body>
</html>
