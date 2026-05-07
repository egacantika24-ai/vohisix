<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <title>Dashboard VOHISIX - SMKN 6 Malang</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard-siswa.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Button styling di card */
        .btn {
            display: inline-block;
            padding: 10px 16px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: all 0.3s;
            font-size: 0.95rem;
            text-align: center;
            margin-top: 8px;
        }

        .btn-primary {
            background-color: #003056;
            color: white;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #1a4a7a;
            transform: translateY(-2px);
        }

        /* Company name ellipsis */        .company-name {            display: block;            width: 100%;            text-overflow: ellipsis;            white-space: nowrap;            overflow: hidden;            max-width: 100%;        }        .company-info {            min-width: 0;        }        .company-location {            display: block;            width: 100%;            text-overflow: ellipsis;            white-space: nowrap;            overflow: hidden;            max-width: 100%;            font-size: 0.9rem;            color: #64748b;            margin-top: 4px;        }
    </style>
</head>
<body>
    <!-- Navbar -->
    @include('siswa.partials.navbar')

    <!-- Main Content -->
    <main class="main-content">
        <div class="dashboard-card">
            <!-- Section Rekomendasi DUDI -->
            <div class="section">
                <div class="section-header">
                    <h2><i class="fas fa-building"></i> Rekomendasi DUDI</h2>
                    <a href="{{ route('siswa.dudi.index') }}" class="btn-lihat">
                        <i class="fas fa-arrow-right"></i> Lihat Semua
                    </a>
                </div>
                <div class="scrollable-row">
                    @forelse($dudiRekomendasi as $dudi)
                        @php
                            $jumlahPendaftar = \App\Models\Booking::where('id_dudi', $dudi->id_dudi)->whereIn('status', ['Direview', 'Diterima'])->count();
                            $kuotaTersisa = max($dudi->kuota - $jumlahPendaftar, 0);
                        @endphp
                        <div class="company-card">
                            <div class="card-header">
                                <div class="image-placeholder">
                                    @if($dudi->logo)
                                        <img src="{{ asset('storage/' . $dudi->logo) }}" alt="{{ $dudi->nama_dudi }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 12px;">
                                    @else
                                        <i class="fas fa-building"></i>
                                    @endif
                                </div>
                                <div class="company-info">
                                    <div class="company-name">{{ $dudi->nama_dudi }}</div>
                                    <div class="company-location"><i class="fas fa-map-marker-alt"></i> {{ substr($dudi->alamat, 0, 25) }}{{ strlen($dudi->alamat) > 25 ? '...' : '' }}</div>
                                </div>
                            </div>
                            <div class="detail-item"><i class="fas fa-user-tie"></i> {{ $dudi->pembimbing_dudi ?? '-' }}</div>
                            <div class="detail-item"><i class="fas fa-clock"></i> {{ $dudi->jam_masuk ?? '-' }} - {{ $dudi->jam_pulang ?? '-' }}</div>
                            <div class="kuota-highlight">
                                <i class="fas fa-users"></i>
                                <span><span class="kuota-angka">{{ $kuotaTersisa }}</span> dari <span class="kuota-angka">{{ $dudi->kuota ?? '-' }}</span> kuota tersisa</span>
                            </div>
                            <a href="{{ route('siswa.dudi.index') }}" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    @empty
                        <p style="color: #94a3b8;">Tidak ada DUDI yang tersedia saat ini.</p>
                    @endforelse
                </div>
            </div>

            <!-- Section Panduan PKL -->
            <div class="section">
                <div class="section-header">
                    <h2><i class="fas fa-book-open"></i> Panduan PKL & Dokumen Pendukung</h2>
                </div>
                <div class="panduan-row">
                    <div class="panduan-card" onclick="openModal('modalPedoman')">
                        <h4><i class="fas fa-scroll"></i> Pedoman PKL</h4>
                        <div class="panduan-image-empty">
                            <!-- ganti nama file icon-pedoman.png di folder public/images -->
                            <img src="{{ asset('images/icon-pedoman.png') }}" alt="Pedoman PKL" class="panduan-icon">
                        </div>
                    </div>
                    <div class="panduan-card" onclick="openModal('modalSuratPermohonan')">
                        <h4><i class="fas fa-file-alt"></i> Surat Permohonan</h4>
                        <div class="panduan-image-empty">
                            <img src="{{ asset('images/icon-surat-permohonan.png') }}" alt="Surat Permohonan" class="panduan-icon">
                        </div>
                    </div>
                    <div class="panduan-card" onclick="openModal('modalSuratPerizinan')">
                        <h4><i class="fas fa-user-check"></i> Surat Perizinan Orangtua</h4>
                        <div class="panduan-image-empty">
                            <img src="{{ asset('images/icon-surat-perizinan.png') }}" alt="Surat Perizinan" class="panduan-icon">
                        </div>
                    </div>
                    <div class="panduan-card" onclick="openModal('modalKtpKia')">
                        <h4><i class="fas fa-id-card"></i> KTP / KIA</h4>
                        <div class="panduan-image-empty">
                            <img src="{{ asset('images/icon-ktp-kia.png') }}" alt="KTP/KIA" class="panduan-icon">
                        </div>
                    </div>
                    <div class="panduan-card" onclick="openModal('modalSuratSehat')">
                        <h4><i class="fas fa-notes-medical"></i> Surat Keterangan Sehat</h4>
                        <div class="panduan-image-empty">
                            <img src="{{ asset('images/icon-surat-sehat.png') }}" alt="Surat Sehat" class="panduan-icon">
                        </div>
                    </div>
                    <div class="panduan-card" onclick="openModal('modalBpjs')">
                        <h4><i class="fas fa-briefcase-medical"></i> Kartu BPJS Ketenagakerjaan</h4>
                        <div class="panduan-image-empty">
                            <img src="{{ asset('images/icon-bpjs.png') }}" alt="BPJS Ketenagakerjaan" class="panduan-icon">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modals -->

    <div id="modalPedoman" class="modal" onclick="closeModal('modalPedoman')">
        <div class="modal-content" onclick="event.stopPropagation()">
            <div class="modal-header">
                <h3>Pedoman PKL</h3>
                <button class="modal-close" onclick="closeModal('modalPedoman')">×</button>
            </div>
            <div class="modal-body">
                {{-- konten pedoman diinput oleh admin di dashboard admin, siswa hanya bisa membaca --}}
                <p>Pedoman PKL akan ditampilkan di sini setelah admin memasukkannya melalui halaman admin.</p>
            </div>
        </div>
    </div>

    <div id="modalSuratPermohonan" class="modal" onclick="closeModal('modalSuratPermohonan')">
        <div class="modal-content" onclick="event.stopPropagation()">
            <div class="modal-header">
                <h3>Surat Permohonan</h3>
                <button class="modal-close" onclick="closeModal('modalSuratPermohonan')">×</button>
            </div>
            <div class="modal-body">
                <p>Surat permohonan diunggah oleh admin; siswa dapat melihat atau mendownload di sini.</p>
                {{-- contoh: <a href="{{ $suratPermohonanUrl ?? '#' }}" target="_blank">Unduh surat permohonan</a> --}}
            </div>
        </div>
    </div>

    <div id="modalSuratPerizinan" class="modal" onclick="closeModal('modalSuratPerizinan')">
        <div class="modal-content" onclick="event.stopPropagation()">
            <div class="modal-header">
                <h3>Surat Perizinan Orangtua</h3>
                <button class="modal-close" onclick="closeModal('modalSuratPerizinan')">×</button>
            </div>
            <div class="modal-body">
                <p>Admin mengunggah surat perizinan orangtua; ditampilkan untuk siswa.</p>
                {{-- contoh: <a href="{{ $suratPerizinanUrl ?? '#' }}" target="_blank">Unduh surat izin</a> --}}
            </div>
        </div>
    </div>

    <div id="modalKtpKia" class="modal" onclick="closeModal('modalKtpKia')">
        <div class="modal-content" onclick="event.stopPropagation()">
            <div class="modal-header">
                <h3>KTP / KIA</h3>
                <button class="modal-close" onclick="closeModal('modalKtpKia')">×</button>
            </div>
            <div class="modal-body">
                <p>Data KTP/KIA siswa diambil dari tabel berkas (halaman Data Siswa PKL). Siswa dapat upload melalui halaman tersebut.</p>
            </div>
        </div>
    </div>

    <div id="modalSuratSehat" class="modal" onclick="closeModal('modalSuratSehat')">
        <div class="modal-content" onclick="event.stopPropagation()">
            <div class="modal-header">
                <h3>Surat Keterangan Sehat</h3>
                <button class="modal-close" onclick="closeModal('modalSuratSehat')">×</button>
            </div>
            <div class="modal-body">
                <p>Surat keterangan sehat dari UKS juga berasal dari berkas siswa di halaman Data Siswa PKL.</p>
            </div>
        </div>
    </div>

    <div id="modalBpjs" class="modal" onclick="closeModal('modalBpjs')">
        <div class="modal-content" onclick="event.stopPropagation()">
            <div class="modal-header">
                <h3>Kartu BPJS Ketenagakerjaan</h3>
                <button class="modal-close" onclick="closeModal('modalBpjs')">×</button>
            </div>
            <div class="modal-body">
                <p>Kartu BPJS Ketenagakerjaan siswa berada di berkas; siswa bisa mengunggah di halaman Data Siswa PKL.</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('siswa.partials.footer')

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }

        function closeSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        }

        function openModal(modalId) {
            document.getElementById(modalId).classList.add('active');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
        }

        document.querySelectorAll('.sidebar-nav-item').forEach(item => {
            item.addEventListener('click', closeSidebar);
        });
    </script>
</body>
</html>


