<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Manajemen Karyawan</title>
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

    .logout button {
      width: 100%;
      background-color: rgba(255, 255, 255, 0.87);
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
      transition: 0.3s;
    }

    .logout button:hover {
      background-color: rgba(255, 255, 255, 0.73);
      transform: scale(1.07);
    }

    /*--------------------------- MAIN ------------------------------*/
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
      font-size: 26px;
      margin: 0;
      margin-top: 15px;
      font-weight: 700;
    }

    .header p {
      font-size: 14px;
      color: #666;
      margin-top: 5px;
    }

    .btn-add {
      background-color: #1e3a8a;
      color: white;
      padding: 10px 18px;
      border: none;
      border-radius: 8px;
      font-weight: 500;
      cursor: pointer;
      transition: 0.2s;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .btn-add:hover {
      background-color: #1d4ed8;
    }

    /*--------------------------- TABLE ------------------------------*/
    .table-container {
      background-color: white;
      border-radius: 16px;
      padding: 20px;
      box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      text-align: left;
      padding: 14px 16px;
    }

    th {
      border-bottom: 2px solid #ddd;
      color: #444;
    }

    tr:not(:last-child) {
      border-bottom: 1px solid #eee;
    }

    td.action-cell {
      text-align: center;
    }

    .action-btn {
      background: none;
      border: none;
      cursor: pointer;
      padding: 0;
      margin: 0 4px;
    }

    .action-btn img {
      width: 25px;
      height: 25px;
    }

    /* =============== MODAL TAMBAH / EDIT KARYAWAN ============= */
    .modal {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.25);
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
      width: 400px;
      max-width: 90%;
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
    .modal-content select {
      width: 100%;
      box-sizing: border-box;
      padding: 10px 12px;
      margin-bottom: 12px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-family: inherit;
      font-size: 14px;
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

  <!-------------------------------- Sidebar --------------------------------->
  <div class="sidebar">
    <h2>PKS Monitor</h2>
    <p>Admin</p>

    <div class="menu">
      <a href="/dashboard"><img src="/icons/dashboard.png"> Dashboard</a>
      <a href="/karyawan" class="active"><img src="/icons/karyawan.png"> Karyawan</a>
      <a href="/pekerjaan"><img src="/icons/pekerjaan.png"> Pekerjaan</a>
      <a href="/aktivitas"><img src="/icons/aktivitas harian.png"> Aktivitas Harian</a>
      <a href="/arsip"><img src="/icons/arsip.png"> Arsip</a>

      <div class="logout">
        <button onclick="logout()">
          <img src="/icons/log out.png"> Log Out
        </button>
      </div>
    </div>
  </div>


  <!--------------------------- MAIN CONTENT ------------------------------>
  <div class="main">

    <div class="header">
      <div>
        <h2>Manajemen Karyawan</h2>
        <p>Kelola data karyawan</p>
      </div>
      <button class="btn-add">+ Tambah Karyawan</button>
    </div>

    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Nama</th>
            <th>Pekerjaan</th>
            <th class="aksi-header" style="text-align:center">Aksi</th>
          </tr>
        </thead>

        <tbody>
          @foreach ($karyawans as $karyawan)
            <tr>
              <td>{{ $karyawan->nama }}</td>
              <td>{{ $karyawan->pekerjaan }}</td>
              <td class="action-cell">

                {{-- TOMBOL EDIT --}}
                <button
                  type="button"
                  class="action-btn edit-btn"
                  data-id="{{ $karyawan->id }}"
                  data-nama="{{ $karyawan->nama }}"
                  data-pekerjaan="{{ $karyawan->pekerjaan }}"
                >
                  <img src="/icons/Edit.png" alt="Edit">
                </button>

                {{-- FORM HAPUS --}}
                <form
                  action="{{ route('karyawan.destroy', $karyawan->id) }}"
                  method="POST"
                  style="display:inline"
                  onsubmit="return confirm('Yakin ingin hapus karyawan ini?')"
                >
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="action-btn">
                    <img src="/icons/delete.png" alt="Hapus">
                  </button>
                </form>

              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- ========= MODAL TAMBAH / EDIT KARYAWAN ========= -->
    <div id="karyawanModal" class="modal">
      <div class="modal-content">
        <h3 id="modalTitle">Tambah Karyawan</h3>

        <form id="karyawanForm" action="{{ route('karyawan.store') }}" method="POST">
          @csrf
          {{-- ini untuk spoof PUT saat edit --}}
          <input type="hidden" name="_method" id="methodField" value="POST">

          <label for="namaInput">Nama</label>
          <input type="text" id="namaInput" name="nama" placeholder="Nama lengkap" required>

          <label for="pekerjaanSelect">Pekerjaan</label>
          <select id="pekerjaanSelect" name="pekerjaan" required>
            <option value="">-- Pilih pekerjaan --</option>
            <option value="Driver">Driver</option>
            <option value="Pesuruh">Pesuruh</option>
            <option value="Operator">Operator</option>
            <option value="Teknisi">Teknisi</option>
            <option value="Cleaning Service">Cleaning Service</option>
            <option value="Perawat Taman">Perawat Taman</option>
            <option value="Satpam">Satpam</option>
          </select>

          <div class="modal-actions">
            <button type="button" id="cancelModalBtn" class="btn-secondary">Batal</button>
            <button type="submit" class="btn-primary" id="submitBtn">Simpan</button>
          </div>
        </form>
      </div>
    </div>

  </div>


  <script>
    function logout() {
      Swal.fire({
        title: 'Yakin ingin keluar?',
        text: 'Anda akan kembali ke halaman login.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Logout',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: 'Logout berhasil!',
            icon: 'success',
            showConfirmButton: false,
            timer: 1500
          });

          setTimeout(() => window.location.href = "/login", 1500);
        }
      });
    }

    // ==== LOGIKA MODAL TAMBAH / EDIT KARYAWAN ====
    const modal          = document.getElementById('karyawanModal');
    const modalTitle     = document.getElementById('modalTitle');
    const addBtn         = document.querySelector('.btn-add');
    const cancelModalBtn = document.getElementById('cancelModalBtn');
    const form           = document.getElementById('karyawanForm');
    const methodField    = document.getElementById('methodField');
    const namaInput      = document.getElementById('namaInput');
    const pekerjaanSelect= document.getElementById('pekerjaanSelect');
    const submitBtn      = document.getElementById('submitBtn');

    const baseUpdateUrl  = "{{ url('/karyawan') }}";

    let editId = null;  // null = mode tambah, isi angka = mode edit

    // ========= MODE TAMBAH =========
    addBtn.addEventListener('click', () => {
      editId = null;
      modalTitle.textContent = 'Tambah Karyawan';
      submitBtn.textContent  = 'Simpan';

      // action kembali ke store
      form.action = "{{ route('karyawan.store') }}";
      methodField.value = 'POST'; // biar tetap POST biasa

      form.reset();
      modal.classList.add('show');
      namaInput.focus();
    });

    // ========= MODE EDIT =========
    document.querySelectorAll('.edit-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        editId = btn.dataset.id;

        modalTitle.textContent = 'Edit Karyawan';
        submitBtn.textContent  = 'Update';

        // set action ke /karyawan/{id}
        form.action = baseUpdateUrl + '/' + editId;
        methodField.value = 'PUT';

        // isi field dari data-*
        namaInput.value       = btn.dataset.nama;
        pekerjaanSelect.value = btn.dataset.pekerjaan;

        modal.classList.add('show');
        namaInput.focus();
      });
    });

    // tutup modal
    cancelModalBtn.addEventListener('click', () => {
      modal.classList.remove('show');
    });

    // klik area gelap di luar modal → tutup
    modal.addEventListener('click', (e) => {
      if (e.target === modal) {
        modal.classList.remove('show');
      }
    });
  </script>

</body>
</html>
