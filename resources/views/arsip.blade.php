<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Arsip</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body {
      margin: 0;
      font-family: "Segoe UI", Arial, sans-serif;
      background-color: #eaebf3a4;
      display: flex;
      height: 100vh;
    }

    .sidebar {
      width: 240px;
      background: linear-gradient(to bottom, #122954ff, #4573c2ff);
      color: #fff;
      display: flex;
      flex-direction: column;
      padding: 20px;
    }

    .sidebar h2 { font-size: 22px; margin-bottom: 5px; }
    .sidebar p { font-size: 13px; color: #c7d3ff; margin-bottom: 40px; }

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

    .menu img { width: 22px; height: 22px; object-fit: contain; }

    .menu a:hover, .menu a.active {
      background-color: rgba(255,255,255,0.2);
      transform: scale(1.04);
    }

    .logout { margin-top: auto; text-align: center; padding-top: 80px; }
    .logout button {
      width: 100%;
      background-color: rgba(255,255,255,0.87);
      color: #6d6666ec;
      border: none;
      padding: 10px;
      border-radius: 8px;
      font-size: 14px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      transition: background-color 0.3s, transform 0.1s;
    }
    .logout button:hover { background-color: rgba(255,255,255,0.73); transform: scale(1.02); }

    .main-content {
      flex: 1;
      padding: 110px 40px 30px 40px;
      overflow-y: auto;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: fixed;
      top: 0;
      left: 280px;
      right: 0;
      height: 80px;
      background-color: white;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      padding: 0 40px;
      z-index: 1000;
    }

    .header h1 { font-size: 26px; font-weight: 700; margin: 0; }
    .header p { font-size: 14px; color: #666; margin: 5px 0 0; }

    .content-card {
      background: #fff;
      padding: 24px;
      border-radius: 12px;
      box-shadow: 0 3px 6px rgba(0,0,0,0.08);
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <h2>PKS Monitor</h2>
    <p>Admin</p>
    <div class="menu">
      <a href="dashboard"><img src="icons/dashboard.png" alt="Dashboard Icon"> Dashboard</a>
      <a href="karyawan"><img src="icons/karyawan.png" alt="Karyawan Icon"> Karyawan</a>
      <a href="pekerjaan"><img src="icons/pekerjaan.png" alt="Pekerjaan Icon"> Pekerjaan</a>
      <a href="aktivitas"><img src="icons/aktivitas harian.png" alt="Aktivitas Harian Icon"> Aktivitas Harian</a>
      <a href="arsip" class="active"><img src="icons/arsip.png" alt="Arsip Icon"> Arsip</a>
      <div class="logout">
        <button onclick="logout()"><img src="icons/log out.png" alt="Log out Icon">Log Out</button>
      </div>
    </div>
  </div>

  <div class="main-content">
    <div class="header">
      <div>
        <h1>Arsip</h1>
        <p>Kumpulan data terdokumentasi</p>
      </div>
    </div>

    <div class="content-card">
      <h3>Data Arsip</h3>
      <p>Tambahkan tabel / daftar arsip di sini.</p>
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
        setTimeout(()=>{ window.location.href='login'; },1800);
      }
    });
  }
</script>
</body>
</html>