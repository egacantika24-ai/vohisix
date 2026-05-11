@extends('layouts.app')

@section('title', 'SiswaPKL Pro - Dashboard Administrasi PKL')

@section('content')
@php
    $berkasCompleted = 0;
    if ($berkas && $berkas->ktp_kia) $berkasCompleted++;
    if ($berkas && $berkas->surat_sehat) $berkasCompleted++;
    if ($berkas && $berkas->kartu_bpjs) $berkasCompleted++;
    $berkasProgress = ($berkasCompleted / 3) * 100;
@endphp
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    body {
        font-family: 'Outfit', ui-sans-serif, system-ui, sans-serif;
        background-color: #FFFFFF;
    }
    
    .font-display {
        font-family: 'Quicksand', sans-serif;
    }
    
    @keyframes pulse-custom {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }
    
    .animate-pulse-custom {
        animation: pulse-custom 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    
    .glass-card {
        background: white;
        border: 1px solid #E8EDF2;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
    }
    
    .upload-zone {
        border: 2px dashed #E2E8F0;
        transition: all 0.2s ease;
        cursor: pointer;
        background: #FAFCFE;
    }
    
    .upload-zone:hover {
        border-color: #003056;
        background-color: #F5F8FC;
    }
    
    ::-webkit-scrollbar {
        width: 8px;
    }
    
    ::-webkit-scrollbar-track {
        background: #F1F5F9;
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb {
        background: #CBD5E1;
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: #94A3B8;
    }

    .btn-primary {
        background-color: #003056;
        transition: all 0.2s ease;
    }
    
    .btn-primary:hover {
        background-color: #002543;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 48, 86, 0.15);
    }
    
    .btn-primary:active {
        transform: translateY(0);
    }
    
    .text-primary {
        color: #003056;
    }
    
    .border-primary {
        border-color: #003056;
    }
    
    .bg-primary {
        background-color: #003056;
    }
    
    .bg-primary-light {
        background-color: #F0F4F9;
    }
    
    /* Uploaded card style - solid biru tua tanpa gradasi */
    .uploaded-card {
        background-color: #003056;
        border: 1px solid #003056;
    }
</style>

<div class="min-h-screen bg-white text-[#1E293B] font-sans">
    {# Main Content #}
    <main class="flex-1 flex flex-col min-w-0">
        {# Content Body #}
        <div class="p-6 lg:p-10 max-w-6xl mx-auto w-full space-y-8 lg:space-y-10 overflow-y-auto">
            {# Welcome & Info #}
            <section class="flex flex-col md:flex-row md:items-start justify-between gap-6">
                <div class="flex-1">
                    <span class="px-3 py-1 bg-red-50 border border-red-200 text-red-700 rounded-lg text-[10px] font-bold tracking-widest uppercase mb-3 inline-flex items-center gap-2 shadow-sm">
                        <span class="w-1.5 h-1.5 bg-red-500 rounded-full animate-pulse-custom"></span>
                        Status: {{ ($berkasCompleted == 3) ? 'Selesai Dikumpulkan' : 'Belum Lengkap' }}
                    </span>
                    <h2 class="text-2xl lg:text-3xl font-bold font-display text-[#003056] tracking-tight mt-1">Data Kelengkapan Berkas</h2>
                    <p class="text-[#64748B] mt-2 max-w-lg font-medium">Pastikan dokumen asli telah discan dengan jelas sebelum mengunggah ke sistem.</p>
                </div>
                
                <div class="bg-[#003056] p-5 rounded-2xl text-white shadow-lg min-w-[200px]">
                    <p class="text-[10px] uppercase font-bold opacity-80 mb-1 tracking-widest">Progress Berkas</p>
                    <p class="text-sm font-bold flex items-center gap-2">
                        @if($berkasCompleted == 3)
                            Selesai Dikumpulkan
                        @else
                            Sisa {{ 3 - $berkasCompleted }} Berkas Lagi
                        @endif
                    </p>
                    <div class="w-full bg-white/30 h-2 mt-4 rounded-full overflow-hidden shadow-inner">
                        <div class="bg-white h-full shadow-sm transition-all duration-1000 ease-out" style="width: {{ $berkasProgress }}%"></div>
                    </div>
                    <p class="text-[10px] text-right mt-2 font-bold opacity-80">{{ $berkasCompleted }}/3 Berkas Berhasil</p>
                </div>
            </section>

            {# Form Area #}
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 lg:gap-8">
                <div class="xl:col-span-2 space-y-6">
                    <div class="glass-card p-6 lg:p-10 rounded-2xl">
                        <div class="space-y-8">
                            {# KTP/KIA Upload #}
                            <div>
                                <label class="flex items-center justify-between mb-3">
                                    <span class="text-sm font-bold text-[#003056] flex items-center gap-2">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#003056" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="opacity-70">
                                            <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                            <line x1="1" y1="10" x2="23" y2="10"></line>
                                        </svg>
                                        Fotocopy KTP / KIA
                                    </span>
                                    @if($berkas && $berkas->ktp_kia)
                                        <span class="text-[#003056] font-bold text-[10px] uppercase tracking-wider flex items-center gap-1">
                                            ✓ Sudah Diunggah
                                        </span>
                                    @endif
                                </label>
                                
                                @if($berkas && $berkas->ktp_kia)
                                    <div class="uploaded-card flex items-center gap-4 p-4 rounded-2xl shadow-md">
                                        <div class="bg-white/20 p-2 rounded-xl">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                                <polyline points="14 2 14 8 20 8"></polyline>
                                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                                <polyline points="10 9 9 9 8 9"></polyline>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-xs font-bold text-white font-display tracking-wide">KTP_KIA_SCAN.pdf</p>
                                            <p class="text-[10px] text-white/70 font-medium">Berhasil diverifikasi sistem</p>
                                        </div>
                                        <button type="button" class="text-[10px] font-bold text-white/80 hover:text-white underline uppercase tracking-tighter transition-colors">
                                            Ganti
                                        </button>
                                    </div>
                                @else
                                    <div class="upload-zone rounded-2xl p-6 lg:p-8 text-center group">
                                        <div class="mx-auto mb-3 text-[#94A3B8] group-hover:text-[#003056] transition-colors">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                                <polyline points="17 8 12 3 7 8"></polyline>
                                                <line x1="12" y1="3" x2="12" y2="15"></line>
                                            </svg>
                                        </div>
                                        <p class="text-xs font-bold text-[#003056] uppercase tracking-wide">Pilih atau Seret File Berkas</p>
                                        <p class="text-[10px] text-[#94A3B8] mt-1 font-semibold">Format PDF / JPG, Maks 2MB</p>
                                    </div>
                                @endif
                                <p class="text-[10px] text-[#475569] mt-2 font-medium">Identitas diri resmi untuk keperluan asuransi dan administrasi industri.</p>
                            </div>

                            {# Surat Sehat Upload #}
                            <div>
                                <label class="flex items-center justify-between mb-3">
                                    <span class="text-sm font-bold text-[#003056] flex items-center gap-2">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#003056" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="opacity-70">
                                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                            <polyline points="9 12 11 14 15 10"></polyline>
                                        </svg>
                                        Surat Keterangan Sehat
                                    </span>
                                    @if($berkas && $berkas->surat_sehat)
                                        <span class="text-[#003056] font-bold text-[10px] uppercase tracking-wider flex items-center gap-1">
                                            ✓ Sudah Diunggah
                                        </span>
                                    @endif
                                </label>
                                
                                @if($berkas && $berkas->surat_sehat)
                                    <div class="uploaded-card flex items-center gap-4 p-4 rounded-2xl shadow-md">
                                        <div class="bg-white/20 p-2 rounded-xl">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                                <polyline points="14 2 14 8 20 8"></polyline>
                                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                                <polyline points="10 9 9 9 8 9"></polyline>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-xs font-bold text-white font-display tracking-wide">SURAT_SEHAT_SCAN.pdf</p>
                                            <p class="text-[10px] text-white/70 font-medium">Berhasil diverifikasi sistem</p>
                                        </div>
                                        <button type="button" class="text-[10px] font-bold text-white/80 hover:text-white underline uppercase tracking-tighter transition-colors">
                                            Ganti
                                        </button>
                                    </div>
                                @else
                                    <div class="upload-zone rounded-2xl p-6 lg:p-8 text-center group">
                                        <div class="mx-auto mb-3 text-[#94A3B8] group-hover:text-[#003056] transition-colors">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                                <polyline points="17 8 12 3 7 8"></polyline>
                                                <line x1="12" y1="3" x2="12" y2="15"></line>
                                            </svg>
                                        </div>
                                        <p class="text-xs font-bold text-[#003056] uppercase tracking-wide">Pilih atau Seret File Berkas</p>
                                        <p class="text-[10px] text-[#94A3B8] mt-1 font-semibold">Format PDF / JPG, Maks 2MB</p>
                                    </div>
                                @endif
                                <p class="text-[10px] text-[#475569] mt-2 font-medium">Dikeluarkan oleh UKS atau Puskesmas setempat.</p>
                            </div>

                            {# Kartu BPJS Upload #}
                            <div>
                                <label class="flex items-center justify-between mb-3">
                                    <span class="text-sm font-bold text-[#003056] flex items-center gap-2">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#003056" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="opacity-70">
                                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                            <polyline points="9 12 11 14 15 10"></polyline>
                                        </svg>
                                        Kartu BPJS Ketenagakerjaan
                                    </span>
                                    @if($berkas && $berkas->kartu_bpjs)
                                        <span class="text-[#003056] font-bold text-[10px] uppercase tracking-wider flex items-center gap-1">
                                            ✓ Sudah Diunggah
                                        </span>
                                    @endif
                                </label>
                                
                                @if($berkas && $berkas->kartu_bpjs)
                                    <div class="uploaded-card flex items-center gap-4 p-4 rounded-2xl shadow-md">
                                        <div class="bg-white/20 p-2 rounded-xl">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                                <polyline points="14 2 14 8 20 8"></polyline>
                                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                                <polyline points="10 9 9 9 8 9"></polyline>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-xs font-bold text-white font-display tracking-wide">BPJS_SCAN.pdf</p>
                                            <p class="text-[10px] text-white/70 font-medium">Berhasil diverifikasi sistem</p>
                                        </div>
                                        <button type="button" class="text-[10px] font-bold text-white/80 hover:text-white underline uppercase tracking-tighter transition-colors">
                                            Ganti
                                        </button>
                                    </div>
                                @else
                                    <div class="upload-zone rounded-2xl p-6 lg:p-8 text-center group">
                                        <div class="mx-auto mb-3 text-[#94A3B8] group-hover:text-[#003056] transition-colors">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                                <polyline points="17 8 12 3 7 8"></polyline>
                                                <line x1="12" y1="3" x2="12" y2="15"></line>
                                            </svg>
                                        </div>
                                        <p class="text-xs font-bold text-[#003056] uppercase tracking-wide">Pilih atau Seret File Berkas</p>
                                        <p class="text-[10px] text-[#94A3B8] mt-1 font-semibold">Format PDF / JPG, Maks 2MB</p>
                                    </div>
                                @endif
                                <p class="text-[10px] text-[#475569] mt-2 font-medium">Syarat wajib perlindungan keselamatan kerja selama PKL.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white border border-[#E8EDF2] rounded-2xl p-6 lg:p-8 shadow-sm h-full flex flex-col">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-6 text-[#003056]">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#003056" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="16" x2="12" y2="12"></line>
                                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                </svg>
                                <h3 class="font-bold font-display uppercase text-xs tracking-widest">Ketentuan Unggah</h3>
                            </div>
                            <ul class="space-y-4">
                                <li class="flex gap-3 items-start">
                                    <span class="w-1.5 h-1.5 bg-[#003056] rounded-full mt-1.5 shrink-0"></span>
                                    <p class="text-xs text-[#475569] leading-relaxed font-medium">Dokumen digital harus merupakan hasil scan (bukan foto) agar terbaca jelas.</p>
                                </li>
                                <li class="flex gap-3 items-start">
                                    <span class="w-1.5 h-1.5 bg-[#003056] rounded-full mt-1.5 shrink-0"></span>
                                    <p class="text-xs text-[#475569] leading-relaxed font-medium">Ukuran berkas dibatasi maksimal 2MB untuk efisiensi penyimpanan server.</p>
                                </li>
                                <li class="flex gap-3 items-start">
                                    <span class="w-1.5 h-1.5 bg-[#003056] rounded-full mt-1.5 shrink-0"></span>
                                    <p class="text-xs text-[#475569] leading-relaxed font-medium">Verifikasi manual oleh Hubin memerlukan waktu maksimal 2 hari kerja.</p>
                                </li>
                            </ul>
                        </div>

                        <div class="mt-10 pt-8 border-t border-[#E8EDF2]">
                            <button class="w-full py-4 rounded-2xl font-bold font-display transition-all shadow-sm active:scale-[0.98] {{$berkasCompleted == 3 ? 'btn-primary text-white' : 'bg-[#F1F5F9] text-[#94A3B8] cursor-not-allowed'}}">
                                Simpan Seluruh Progress
                            </button>
                            <p class="text-[10px] text-center text-[#94A3B8] mt-4 font-medium uppercase tracking-tighter">Terakhir diperbarui: {{ now()->format('d F Y, H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
