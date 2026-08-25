<li class="nav-item">
    <a href="{{ url('/admin/dashboard') }}" class="nav-link">
        <i class="nav-icon bi bi-speedometer"></i>
        <p>Dashboard</p>
    </a>
</li>

<li class="nav-header">Data Master</li>
<li class="nav-item">
    <a href="{{ url('/admin/instansi') }}" class="nav-link">
        <i class="nav-icon bi bi-building"></i>
        <p>Instansi</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('/admin/user') }}" class="nav-link">
        <i class="nav-icon bi bi-person"></i>
        <p>User</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('/admin/asesor') }}" class="nav-link">
        <i class="nav-icon bi bi-person-badge"></i>
        <p>Asesor</p>
    </a>
</li>

<!-- Evaluasi Section -->
<li class="nav-header">Evaluasi</li>
<li class="nav-item">
    <a href="{{ url('/admin/monitoring-penilaian') }}" class="nav-link">
        <i class="nav-icon bi bi-journal-text"></i>
        <p>Monitoring Penilaian</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('/admin/hasil-verifikasi') }}" class="nav-link">
        <i class="nav-icon bi bi-person-check"></i>
        <p>Hasil Verifikasi</p>
    </a>
</li>

<!-- Hasil Section -->
<li class="nav-header">Hasil</li>
<li class="nav-item">
    <a href="{{ url('/admin/hasil-evaluasi') }}" class="nav-link">
        <i class="nav-icon bi bi-file-earmark-text"></i>
        <p>Hasil Evaluasi</p>
    </a>
</li>

<!-- Sistem Section -->
<li class="nav-header">Sistem</li>
<li class="nav-item">
    <a href="{{ url('/admin/pengaturan') }}" class="nav-link">
        <i class="nav-icon bi bi-gear"></i>
        <p>Pengaturan</p>
    </a>
</li>

<li class="nav-item mt-4 px-3">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-danger w-100 d-flex align-items-center justify-content-center gap-2 py-2" style="background-color: #fff5f5; color: #dc3545; border: 1px solid #ffe3e3;">
            <i class="bi bi-box-arrow-right"></i>
            <span class="fw-semibold">Keluar</span>
        </button>
    </form>
</li>