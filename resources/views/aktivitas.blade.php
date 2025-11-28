<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Aktivitas Harian</title>
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

    .btn-add {
      background-color: #1e3a8a;
      color: white;
      padding: 8px 16px;
      border: none;
      border-radius: 8px;
      font-size: 14px;
      cursor: pointer;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .btn-add:hover {
      background-color: #1d4ed8;
    }

    /*------------------------------ Cards --------------------------------*/

    .filter-section, .table-section {
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
      margin-bottom: 25px;
    }

    .filter-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 15px;
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

    select, input[type="date"], input[type="time"] {
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

    /* ============ MODAL TAMBAH AKTIVITAS ============= */
    .modal {
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.25);
      display: none;
      align-items: center;
      justify-content: center;
      z-index: 1500;
    }

    .modal.show {
      display: flex;
    }

    .modal-content {
      background: #ffffff;
      padding: 20px 24px;
      border-radius: 12px;
      width: 430px;
      max-width: 95%;
      box-shadow: 0 4px 12px rgba(0,0,0,0.18);
    }

    .modal-content h3 {
      margin: 0 0 16px 0;
      font-size: 18px;
      font-weight: 600;
    }

    .modal-content label {
      display: block;
      font-size: 14px;
      font-weight: 600;
      margin-bottom: 6px;
    }

    .modal-content input,
    .modal-content select,
    .modal-content textarea {
      width: 100%;
      box-sizing: border-box;
      padding: 10px 12px;
      margin-bottom: 12px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-family: inherit;
      font-size: 14px;
    }

    .modal-content textarea {
      resize: vertical;
      min-height: 70px;
    }

    .modal-actions {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      margin-top: 5px;
    }

    .btn-primary {
      background-color: #1e3a8a;
      color: #fff;
      border: none;
      padding: 8px 14px;
      border-radius: 8px;
      cursor: pointer;
      font-size: 14px;
    }

    .btn-primary:hover {
      background-color: #1d4ed8;
    }

    .btn-secondary {
      background-color: #e5e7eb;
      color: #374151;
      border: none;
      padding: 8px 14px;
      border-radius: 8px;
      cursor: pointer;
      font-size: 14px;
    }

    .btn-secondary:hover {
      background-color: #d1d5db;
    }

  </style>
</head>
<body>
  <div class="sidebar">
    <h2>PKS Monitor</h2>
    <p>Admin</p>

    <div class="menu">
      <a href="/dashboard"><img src="icons/dashboard.png" alt="Dashboard Icon"> Dashboard</a>
      <a href="/karyawan"><img src="icons/karyawan.png" alt="Karyawan Icon"> Karyawan</a>
      <a href="/pekerjaan"><img src="icons/pekerjaan.png" alt="Pekerjaan Icon"> Pekerjaan</a>
      <a href="/aktivitas" class="active"><img src="icons/aktivitas harian.png" alt="Aktivitas Harian Icon"> Aktivitas Harian</a>
      <a href="/arsip"><img src="icons/arsip.png" alt="Arsip Icon"> Arsip</a>
      <div class="logout">
        <button onclick="logout()">
          <img src="icons/log out.png" alt="Log out Icon">Log Out
        </button>
      </div>
    </div>
  </div>

  <div class="main-content">
    <div class="header">
      <div>
        <h1>Aktivitas Harian</h1>
        <p>Lihat dan kelola semua aktivitas karyawan</p>
      </div>
      <div class="user-profile">
        <img src="https://i.pravatar.cc/50" alt="User">
        <span>Princess</span>
      </div>
    </div>

    {{-- ================= FILTER AKTIVITAS ================= --}}
    <div class="filter-section">
      <div class="filter-header">
        <h3>Filter Aktivitas</h3>
        <button type="button" class="btn-add" id="openModalBtn">+ Tambah Aktivitas</button>
      </div>

      <form method="GET" action="{{ route('aktivitas.index') }}">
        <div class="filter-row">
          <div>
            <label style="font-weight: bold;">Nama</label>
            <select name="karyawan_id">
              <option value="">Semua karyawan</option>
              @foreach ($karyawans as $karyawan)
                <option value="{{ $karyawan->id }}"
                  {{ request('karyawan_id') == $karyawan->id ? 'selected' : '' }}>
                  {{ $karyawan->nama }}
                </option>
              @endforeach
            </select>
          </div>

          <div>
            <label style="font-weight: bold;">Pekerjaan</label>
            <select name="pekerjaan_id">
              <option value="">Semua pekerjaan</option>
              @foreach ($pekerjaans as $pekerjaan)
                <option value="{{ $pekerjaan->id }}"
                  {{ request('pekerjaan_id') == $pekerjaan->id ? 'selected' : '' }}>
                  {{ $pekerjaan->nama }}
                </option>
              @endforeach
            </select>
          </div>

          <div>
            <label style="font-weight: bold;">Waktu</label>
            <input type="date"
                   name="tanggal"
                   value="{{ request('tanggal') }}" />
          </div>
        </div>

        <div style="margin-top: 15px;">
          <button type="submit" class="btn-primary">Tampilkan</button>
        </div>
      </form>
    </div>

    {{-- ================= TABEL AKTIVITAS ================= --}}
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
          @forelse ($aktivitas as $item)
            <tr>
              <td>{{ $item->pekerjaan->nama ?? '-' }}</td>
              <td>{{ $item->karyawan->nama ?? '-' }}</td>
              <td>{{ $item->deskripsi }}</td>
              <td>
                @if($item->tanggal)
                  {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                @else
                  -
                @endif
              </td>
              <td>{{ $item->waktu ?? '-' }}</td>
              <td>
                @if(!empty($item->foto))
                  <img src="{{ asset($item->foto) }}" alt="foto Icon" class="eye-icon">
                @else
                  <img src="icons/foto.png" alt="foto Icon" class="eye-icon">
                @endif
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6">Belum ada aktivitas yang tercatat.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  {{-- ============ MODAL TAMBAH AKTIVITAS ============ --}}
  <div id="aktivitasModal" class="modal">
    <div class="modal-content">
      <h3>Tambah Aktivitas</h3>

      <form id="aktivitasForm"
            action="{{ route('aktivitas.store') }}"
            method="POST"
            enctype="multipart/form-data">
        @csrf

        <label for="karyawanSelect">Nama Karyawan</label>
        <select id="karyawanSelect" name="karyawan_id" required>
          <option value="">-- Pilih karyawan --</option>
          @foreach ($karyawans as $karyawan)
            <option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>
          @endforeach
        </select>

        <label for="pekerjaanSelect">Pekerjaan</label>
        <select id="pekerjaanSelect" name="pekerjaan_id" required>
          <option value="">-- Pilih pekerjaan --</option>
          @foreach ($pekerjaans as $pekerjaan)
            <option value="{{ $pekerjaan->id }}">{{ $pekerjaan->nama }}</option>
          @endforeach
        </select>

        <label for="deskripsiInput">Deskripsi</label>
        <textarea id="deskripsiInput"
                  name="deskripsi"
                  placeholder="Contoh: Patroli pagi, cek area parkir"
                  required></textarea>

        <label for="tanggalInput">Tanggal</label>
        <input type="date" id="tanggalInput" name="tanggal" required>

        <label for="waktuInput">Waktu</label>
        <input type="time" id="waktuInput" name="waktu" required>

        <label for="fotoInput">Foto (opsional)</label>
        <input type="file" id="fotoInput" name="foto" accept="image/*">

        <div class="modal-actions">
          <button type="button" class="btn-secondary" id="closeModalBtn">Batal</button>
          <button type="submit" class="btn-primary">Simpan</button>
        </div>
      </form>
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
          window.location.href = "/login";
        }, 1800);
      }
    });
  }

  // ==== LOGIKA MODAL TAMBAH AKTIVITAS ====
  const modal = document.getElementById('aktivitasModal');
  const openModalBtn = document.getElementById('openModalBtn');
  const closeModalBtn = document.getElementById('closeModalBtn');

  openModalBtn.addEventListener('click', () => {
    document.getElementById('aktivitasForm').reset();
    modal.classList.add('show');
  });

  closeModalBtn.addEventListener('click', () => {
    modal.classList.remove('show');
  });

  modal.addEventListener('click', (e) => {
    if (e.target === modal) {
      modal.classList.remove('show');
    }
  });
</script>
</body>
</html>
