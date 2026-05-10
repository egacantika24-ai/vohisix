@extends('layouts.app')

@section('title', 'Profil Siswa - SiswaPKL Pro')

@section('content')
@php
    $berkasCompleted = 0;
    if ($berkas->ktp_kia) $berkasCompleted++;
    if ($berkas->surat_sehat) $berkasCompleted++;
    if ($berkas->kartu_bpjs) $berkasCompleted++;
    $berkasProgress = ($berkasCompleted / 3) * 100;
@endphp
<style>
* { margin: 0; padding: 0; box-sizing: border-box; }
.profile-page { padding: 32px 22px 60px; }
.profile-header { background: #fff; border-radius: 24px; padding: 32px 30px; box-shadow: 0 20px 60px rgba(15, 74, 86, .08); margin-bottom: 28px; }
.profile-header h1 { margin: 14px 0 10px; color: #003056; font-size: 2.25rem; }
.profile-header p { margin: 0; color: #475569; font-size: 15px; max-width: 720px; }
.status-badge { display: inline-flex; align-items: center; gap: 8px; padding: 10px 14px; border-radius: 999px; font-size: 11px; font-weight: 700; text-transform: uppercase; background: #fef3f2; color: #9f1239; }
.status-badge.complete { background: #eff6ff; color: #1d4ed8; }
.badge-dot { width: 8px; height: 8px; border-radius: 999px; background: currentColor; animation: pulse 2s ease-in-out infinite; }
@keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.5; } }
.dashboard-cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 18px; margin-top: 24px; }
.dashboard-card { background: #003056; color: #fff; border-radius: 24px; padding: 24px; box-shadow: 0 20px 60px rgba(15, 74, 86, .08); }
.dashboard-card .label { text-transform: uppercase; font-size: 11px; letter-spacing: .2em; opacity: .82; margin-bottom: 10px; display: inline-block; }
.dashboard-card .value { font-size: 2rem; font-weight: 800; line-height: 1; }
.profile-grid { display: grid; grid-template-columns: minmax(0, 1.75fr) minmax(0, 1fr); gap: 22px; margin-bottom: 24px; }
.upload-form { background: #fff; border-radius: 24px; border: 1px solid #e8edf2; padding: 28px; }
.upload-zone { border: 2px dashed #dbe8f5; background: #f8fbff; border-radius: 20px; padding: 28px; text-align: center; cursor: pointer; transition: all .2s; }
.upload-zone:hover { border-color: #003056; background: #eff6ff; }
.upload-zone input { display: none; }
.upload-zone p { margin: 0; color: #475569; font-size: 14px; }
.upload-zone .upload-title { margin-bottom: 8px; color: #003056; font-weight: 700; }
.upload-zone .upload-help { color: #64748b; font-size: 13px; }
.progress-bar { height: 12px; background: #e2e8f0; border-radius: 999px; overflow: hidden; margin-top: 16px; }
.progress-bar span { display: block; height: 100%; background: linear-gradient(90deg, #0f4e8c, #3f83f8); border-radius: 999px; width: {{ $berkasProgress }}%; transition: width .5s ease; }
.progress-info { display: flex; justify-content: space-between; align-items: center; margin-top: 12px; color: #64748b; font-size: 13px; }
.btn-primary.upload-submit { margin-top: 22px; border-radius: 16px; padding: 14px 26px; font-weight: 700; background: #003056; color: #fff; border: none; cursor: pointer; }
.btn-primary.upload-submit:hover { background: #002542; }
.info-panel { display: grid; gap: 18px; }
.info-card { background: #fff; border: 1px solid #e8edf2; border-radius: 24px; padding: 28px; }
.info-card h3 { margin-top: 0; margin-bottom: 20px; color: #003056; font-size: 1rem; letter-spacing: .08em; text-transform: uppercase; }
.info-card .info-text { color: #475569; line-height: 1.8; margin-bottom: 18px; }
.info-card ul { list-style: none; padding: 0; margin: 0; display: grid; gap: 12px; }
.info-card ul li { display: flex; gap: 10px; align-items: flex-start; }
.info-card ul li::before { content: '' ; width: 8px; height: 8px; margin-top: 6px; background: #003056; border-radius: 999px; display: inline-block; }
.profile-field { display: grid; gap: 10px; margin-bottom: 18px; }
.profile-field label { display: block; font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase; letter-spacing: .1em; }
.profile-field p { margin: 0; color: #0f172a; font-size: 15px; font-weight: 700; }
@media (max-width: 1024px) { .profile-grid { grid-template-columns: 1fr; } }
@media (max-width: 640px) { .profile-header, .info-card, .upload-form { padding: 22px; } }
</style>

<div class="profile-page">
    <div class="profile-header">
        <div>
            <span class="status-badge {{ $berkas->lengkap ? 'complete' : '' }}">
                <span class="badge-dot"></span>
                Status: {{ $berkas->lengkap ? 'Berkas Lengkap' : 'Belum Lengkap' }}
            </span>
            <h1>Profil Siswa</h1>
            <p>Kelola data profil dan kelengkapan dokumen PKL Anda dalam satu halaman ringkas.</p>
        </div>
        <div class="dashboard-cards">
            <div class="dashboard-card">
                <div class="label">Data Profil</div>
                <div class="value">{{ $siswa->nama }}</div>
                <div style="margin-top: 10px; font-size: 13px; color: rgba(255,255,255,.85);">NIS: {{ $siswa->nis }}</div>
            </div>
            <div class="dashboard-card">
                <div class="label">Progress Berkas</div>
                <div class="value">{{ $berkasCompleted }}/3</div>
                <div style="margin-top: 10px; font-size: 13px; color: rgba(255,255,255,.85);">{{ $berkasCompleted === 3 ? 'Selesai Dikumpulkan' : 'Sisa ' . (3 - $berkasCompleted) . ' Berkas Lagi' }}</div>
                <div class="progress-bar"><span></span></div>
            </div>
        </div>
    </div>

    <div class="profile-grid">
        <div class="upload-form">
            <form action="{{ route('siswa.profile.upload-berkas') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h3>Unggah Berkas</h3>
                <p class="info-text">Lengkapi dokumen penting siswa untuk mempercepat proses verifikasi dan booking PKL.</p>

                <div class="upload-zone" onclick="document.getElementById('ktp_kia').click();">
                    <input type="file" id="ktp_kia" name="ktp_kia" accept=".pdf,.jpg,.jpeg,.png" />
                    <p class="upload-title">KTP / KIA</p>
                    <p class="upload-help">Klik untuk pilih file. Format PDF / JPG / PNG, maksimal 2MB.</p>
                </div>
                <div class="upload-zone" style="margin-top: 18px;" onclick="document.getElementById('surat_sehat').click();">
                    <input type="file" id="surat_sehat" name="surat_sehat" accept=".pdf,.jpg,.jpeg,.png" />
                    <p class="upload-title">Surat Sehat</p>
                    <p class="upload-help">Pilih hasil scan surat kesehatan.</p>
                </div>
                <div class="upload-zone" style="margin-top: 18px;" onclick="document.getElementById('kartu_bpjs').click();">
                    <input type="file" id="kartu_bpjs" name="kartu_bpjs" accept=".pdf,.jpg,.jpeg,.png" />
                    <p class="upload-title">Kartu BPJS</p>
                    <p class="upload-help">Unggah kartu BPJS Ketenagakerjaan.</p>
                </div>

                <button type="submit" class="btn btn-primary upload-submit">Simpan Progress</button>
                <div class="progress-info">
                    <span>{{ $berkasCompleted }} dari 3 berkas terunggah</span>
                    <span>{{ round($berkasProgress) }}%</span>
                </div>
            </form>
        </div>

        <div class="info-panel">
            <div class="info-card">
                <h3>Ketentuan Unggah</h3>
                <p class="info-text">Pastikan unggahan memenuhi syarat agar proses verifikasi dapat berjalan cepat dan data PKL dapat diproses tanpa hambatan.</p>
                <ul>
                    <li>Dokumen digital harus discan dengan jelas agar terbaca sistem.</li>
                    <li>Ukuran file maksimal 2MB untuk setiap berkas.</li>
                    <li>Verifikasi manual oleh Hubin bisa memakan waktu hingga 2 hari kerja.</li>
                </ul>
            </div>
            <div class="info-card">
                <h3>Detail Akun</h3>
                <div class="profile-field">
                    <label>NIS</label>
                    <p>{{ $siswa->nis }}</p>
                </div>
                <div class="profile-field">
                    <label>Nama Lengkap</label>
                    <p>{{ $siswa->nama }}</p>
                </div>
                <div class="profile-field">
                    <label>Kelas</label>
                    <p>{{ $siswa->kelas }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection