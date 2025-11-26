<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ringkasan Performa</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
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

    /*------------------------------- Cards & Stats --------------------------------*/
    .stats-row {
      display: flex;
      gap: 20px;
      margin-bottom: 30px;
      flex-wrap: wrap;
    }

    .stat-card {
      flex: 1;
      min-width: 200px;
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
    }

    .stat-card h3 {
      margin: 0 0 5px 0;
      color: #666;
      font-size: 14px;
      font-weight: 500;
    }

    .stat-card .number {
      font-size: 32px;
      font-weight: 700;
      color: #333;
      margin: 0;
    }

    .stat-card .subtitle {
      font-size: 12px;
      color: #888;
      margin: 5px 0 0 0;
    }

    .content-card {
      background: #fff;
      padding: 24px;
      border-radius: 12px;
      box-shadow: 0 3px 6px rgba(0, 0, 0, 0.08);
      margin-bottom: 32px;
    }

    .chart-row {
      display: flex;
      gap: 32px;
      flex-wrap: wrap;
    }

    .chart-col {
      flex: 1;
      min-width: 320px;
    }

    .chart-col h4 {
      margin: 0 0 20px 0;
      color: #333;
      font-size: 16px;
    }

    /* PERBAIKAN CHART CONTAINER */
    .chart-container {
      position: relative;
      height: 300px; /* TETAPKAN HEIGHT */
      width: 100%;
    }

    canvas {
      max-height: 300px !important; /* BATASI HEIGHT CANVAS */
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 16px;
    }

    th, td {
      border-bottom: 1px solid #eee;
      padding: 12px;
      text-align: left;
    }

    th {
      background: #f7f7fa;
      color: #555;
      font-weight: 600;
      text-align: center;
    }

    td {
      background: #fff;
      text-align: center;
    }

    .btn-detail {
      padding: 6px 16px;
      border-radius: 6px;
      border: none;
      background: #4573c2;
      color: #fff;
      cursor: pointer;
      font-size: 12px;
      transition: background-color 0.3s;
    }

    .btn-detail:hover {
      background: #3458a1;
    }

    .performance-icon {
      width: 16px;
      height: 16px;
      vertical-align: middle;
      margin-left: 5px;
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
        <button onclick="logout()">
          <img src="icons/log out.png" alt="Log out Icon" class="logout-icon">Log Out
        </button>
      </div>
    </div>
  </div>

  <div class="main-content">
    <div class="header">
      <div>
        <h1>Ringkasan Performa</h1>
        <p>Ringkasan komprehensif aktivitas karyawan</p>
      </div>
      <div class="user-profile">
        <img src="https://i.pravatar.cc/50" alt="User">
        <span>{{ Auth::user()->name ?? 'Admin' }}</span>
      </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-row">
      <div class="stat-card">
        <h3>Total Aktivitas</h3>
        <p class="number">{{ $totalAktivitas }}</p>
        <p class="subtitle">Karyawan aktif</p>
      </div>
      <div class="stat-card">
        <h3>Hari Ini</h3>
        <p class="number">{{ $aktivitasHariIni }}</p>
        <p class="subtitle">Aktivitas tercatat hari ini</p>
      </div>
      <div class="stat-card">
        <h3>Minggu Ini</h3>
        <p class="number">{{ $aktivitasMingguIni }}</p>
        <p class="subtitle">Total pekerjaan</p>
      </div>
    </div>

    <!-- Charts -->
    <div class="content-card">
      <div class="chart-row">
        <div class="chart-col">
          <h4>Total Aktivitas per Hari</h4>
          <div class="chart-container">
            <canvas id="lineChart"></canvas>
          </div>
        </div>
        <div class="chart-col">
          <h4>Distribusi Jobdesk/Jabatan</h4>
          <div class="chart-container">
            <canvas id="pieChart"></canvas>
          </div>
        </div>
      </div>
    </div>

    <!-- Table -->
    <div class="content-card">
      <h3>Aktivitas Karyawan</h3>
      <table>
        <thead>
          <tr>
            <th>Jabatan</th>
            <th>Nama</th>
            <th>Total Aktivitas</th>
            <th>Terakhir (7H)</th>
            <th>Gambar</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($aktivitasKaryawan as $act)
            <tr>
              <td>{{ $act->jabatan->nama_jabatan ?? '-' }}</td>
              <td>{{ $act->user->name ?? '-' }}</td>
              <td>{{ $act->total_aktivitas }}</td>
              <td>{{ \Carbon\Carbon::parse($act->terakhir_aktivitas)->format('d-m-Y') }}</td>
              <td>
                <img src="icons/chart.png" alt="Performance Icon" class="performance-icon">
              </td>
              <td><button class="btn-detail">Lihat Detail</button></td>
            </tr>
          @endforeach
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
          window.location.href = 'login'; 
        }, 1800);
      }
    });
  }

  // Chart.js Line Chart
  const lineLabels = @json($lineLabels);
  const lineData = @json($lineData);

  const lineCtx = document.getElementById('lineChart').getContext('2d');
  new Chart(lineCtx, {
    type: 'line',
    data: {
      labels: lineLabels,
      datasets: [{
        label: 'Total Aktivitas',
        data: lineData,
        borderColor: '#4573c2',
        backgroundColor: 'rgba(69,115,194,0.1)',
        fill: true,
        tension: 0.3,
        pointBackgroundColor: '#4573c2',
        pointBorderColor: '#4573c2',
        pointRadius: 4
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: true,
      aspectRatio: 2,
      plugins: { 
        legend: { display: false } 
      },
      scales: {
        y: { 
          beginAtZero: true,
          grid: { color: '#f0f0f0' }
        },
        x: {
          grid: { color: '#f0f0f0' }
        }
      }
    }
  });

  // Chart.js Pie Chart
  const pieLabels = @json($pieLabels);
  const pieData = @json($pieData);

  const pieCtx = document.getElementById('pieChart').getContext('2d');
  new Chart(pieCtx, {
    type: 'pie',
    data: {
      labels: pieLabels,
      datasets: [{
        data: pieData,
        backgroundColor: [
          '#4573c2','#c24d45','#f7b731','#4b7bec','#20bf6b','#8854d0','#fd9644','#a55eea'
        ],
        borderWidth: 2,
        borderColor: '#fff'
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: true,
      aspectRatio: 1,
      plugins: { 
        legend: { 
          position: 'bottom',
          labels: {
            usePointStyle: true,
            padding: 10,
            font: {
              size: 11
            }
          }
        }
      }
    }
  });
</script>
</body>
</html>