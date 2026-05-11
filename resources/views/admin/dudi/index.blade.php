@extends('layouts.app')

@section('title', 'Data DUDI')

@section('content')
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body {
        font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;
        background-color: #f0f4f8;
    }
    .bg-navy { background-color: #003056; }
    .text-navy { color: #003056; }
    ::-webkit-scrollbar { width: 6px; height: 6px; }
    ::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 10px; }
    ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fadeIn { animation: fadeIn 0.3s ease-out forwards; }
</style>

<div class="min-h-screen bg-[#f0f4f8]">
    <!-- Header -->
    <header class="bg-[#003056] text-white px-6 lg:px-8 py-6 shadow-lg relative overflow-hidden">
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-center gap-6 relative z-10">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold tracking-tight mb-1">Data Perusah aan (DUDI)</h1>
                <p class="text-slate-300 text-sm opacity-80">Portal Administrasi Program Praktik Kerja Lapangan Terpadu</p>
            </div>
            <div class="flex gap-6">
                <div class="text-center border-r border-white/20 pr-6">
                    <span class="block text-2xl lg:text-3xl font-bold text-white">{{ $totalDudi }}</span>
                    <span class="text-[9px] lg:text-[10px] uppercase tracking-[0.2em] text-slate-300 font-bold">Total DUDI</span>
                </div>
                <div class="text-center">
                    <span class="block text-2xl lg:text-3xl font-bold text-white">{{ $totalKuota }}</span>
                    <span class="text-[9px] lg:text-[10px] uppercase tracking-[0.2em] text-slate-300 font-bold">Total Kuota</span>
                </div>
            </div>
        </div>
        <div class="absolute -top-12 -right-12 w-48 h-48 bg-white/5 rounded-full blur-2xl"></div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-6 lg:py-8">
        <div class="bg-white rounded-xl lg:rounded-2xl shadow-xl overflow-hidden border border-slate-200">
            <!-- Toolbar -->
            <div class="bg-slate-50 p-4 lg:p-6 border-b border-slate-200 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
                    <div class="relative flex-1 sm:flex-initial">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </div>
                        <input type="text" placeholder="Cari Nama atau Bidang Industri..." class="pl-10 pr-4 py-2 border border-slate-300 rounded-lg text-sm w-full sm:w-80 focus:outline-none focus:ring-2 focus:ring-[#003056]/20 focus:border-[#003056] transition-all bg-white font-medium" value="{{ $search ?? '' }}" name="search">
                    </div>
                    <div class="relative flex-1 sm:flex-initial">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400">
                                <polygon points="22 3 2 3 10 13 10 21 14 18 14 13 22 3"></polygon>
                            </svg>
                        </div>
                        <select class="bg-white border border-slate-300 rounded-lg text-sm pl-10 pr-8 py-2 outline-none focus:ring-2 focus:ring-[#003056]/20 focus:border-[#003056] transition-all appearance-none cursor-pointer w-full sm:w-auto font-medium" name="bidang_usaha">
                            <option value="">Semua Bidang</option>
                            @foreach($allBidang as $bidangItem)
                                <option value="{{ $bidangItem }}" {{ ($bidang == $bidangItem) ? 'selected' : '' }}>{{ $bidangItem }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <a href="{{ route('admin.dudi.create') }}" class="bg-[#003056] hover:bg-[#001f38] text-white px-6 py-2 rounded-lg text-sm font-bold transition shadow-md flex items-center gap-2 w-full md:w-auto justify-center">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Tambah DUDI Baru
                </a>
            </div>

            <!-- Table - Responsive scroll -->
            <div class="overflow-x-auto">
                <table class="w-full text-left min-w-[1200px]">
                    <thead>
                        <tr class="bg-[#003056] text-white text-[10px] lg:text-[11px] uppercase font-bold tracking-wider border-b border-white/10">
                            <th class="px-4 lg:px-6 py-4 text-center w-16">No</th>
                            <th class="px-4 lg:px-6 py-4">Nama DUDI</th>
                            <th class="px-4 lg:px-6 py-4">Alamat</th>
                            <th class="px-4 lg:px-6 py-4 text-center">Jam Berangkat</th>
                            <th class="px-4 lg:px-6 py-4 text-center">Jam Pulang</th>
                            <th class="px-4 lg:px-6 py-4">Bidang Industri</th>
                            <th class="px-4 lg:px-6 py-4 text-center">Jumlah Pegawai</th>
                            <th class="px-4 lg:px-6 py-4">Website</th>
                            <th class="px-4 lg:px-6 py-4">No. Telp</th>
                            <th class="px-4 lg:px-6 py-4">Email</th>
                            <th class="px-4 lg:px-6 py-4 text-center">Kuota</th>
                            <th class="px-4 lg:px-6 py-4">Penanggung Jawab</th>
                            <th class="px-4 lg:px-6 py-4 text-right sticky right-0 bg-[#003056]">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($dudis as $dudi)
                            <tr class="hover:bg-slate-50/50 transition-colors group animate-fadeIn">
                                <td class="px-4 lg:px-6 py-4 text-center text-slate-400 font-mono text-xs">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</td>
                                <td class="px-4 lg:px-6 py-4">
                                    <div class="font-bold text-[#003056] text-sm">{{ $dudi->nama_dudi }}</div>
                                </td>
                                <td class="px-4 lg:px-6 py-4">
                                    <div class="text-slate-500 font-semibold text-xs leading-relaxed max-w-xs">{{ $dudi->alamat }}</div>
                                </td>
                                <td class="px-4 lg:px-6 py-4 text-center">
                                    <span class="bg-[#003056]/5 px-2 py-1 rounded text-[#003056] font-bold text-xs">{{ $dudi->jam_masuk ?? '-' }}</span>
                                </td>
                                <td class="px-4 lg:px-6 py-4 text-center">
                                    <span class="bg-slate-100 px-2 py-1 rounded text-slate-500 font-bold text-xs">{{ $dudi->jam_pulang ?? '-' }}</span>
                                </td>
                                <td class="px-4 lg:px-6 py-4 text-slate-700 font-semibold text-xs">{{ $dudi->bidang_usaha }}</td>
                                <td class="px-4 lg:px-6 py-4 text-center font-bold text-slate-500 italic text-xs">{{ $dudi->jumlah_pegawai }}</td>
                                <td class="px-4 lg:px-6 py-4">
                                    @if($dudi->website)
                                        <a href="{{ preg_match('/^https?:\/\//', $dudi->website) ? $dudi->website : 'https://' . $dudi->website }}" target="_blank" rel="noreferrer" class="text-blue-500 font-bold italic text-xs hover:underline flex items-center gap-1">
                                            {{ $dudi->website }}
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                                                <polyline points="15 3 21 3 21 9"></polyline>
                                                <line x1="10" y1="14" x2="21" y2="3"></line>
                                            </svg>
                                        </a>
                                    @else
                                        <span class="text-slate-400">-</span>
                                    @endif
                                </td>
                                <td class="px-4 lg:px-6 py-4 font-semibold text-slate-600 text-xs">{{ $dudi->telepon }}</td>
                                <td class="px-4 lg:px-6 py-4 font-semibold text-slate-600 text-xs">{{ $dudi->email }}</td>
                                <td class="px-4 lg:px-6 py-4 text-center">
                                    <div class="flex flex-col items-center">
                                        <span class="text-base lg:text-lg font-black text-[#003056] leading-none">{{ $dudi->kuota ?? 0 }}</span>
                                        <span class="text-[8px] font-bold text-slate-400">(0 Terdaftar)</span>
                                    </div>
                                </td>
                                <td class="px-4 lg:px-6 py-4">
                                    <div class="font-bold text-slate-700 text-xs">{{ $dudi->pembimbing_dudi }}</div>
                                </td>
                                <td class="px-4 lg:px-6 py-4 text-right sticky right-0 bg-white/95 backdrop-blur-sm group-hover:bg-transparent">
                                    <div class="flex justify-end gap-1">
                                        <a href="{{ route('admin.dudi.edit', $dudi->id_dudi) }}" class="text-[#003056] hover:text-[#003056]/70 p-1.5 hover:bg-[#003056]/5 rounded-lg transition-all">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M17 3l4 4-7 7H10v-4l7-7z"></path>
                                                <path d="M4 20h16"></path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.dudi.destroy', $dudi->id_dudi) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 p-1.5 hover:bg-red-50 rounded-lg transition-all" onclick="return confirm('Yakin ingin menghapus?')">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M3 6h18"></path>
                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"></path>
                                                    <path d="M8 4V2h8v2"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="13" class="px-6 py-16 text-center text-slate-300">
                                    <div class="flex flex-col items-center gap-3">
                                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="opacity-10">
                                            <circle cx="11" cy="11" r="8"></circle>
                                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                        </svg>
                                        <p class="font-bold text-xs uppercase tracking-widest">Data Tidak Ditemukan</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Footer -->
            <div class="bg-[#003056] text-white/70 px-4 lg:px-8 py-5 flex flex-col md:flex-row justify-between items-center gap-4 text-[9px] lg:text-[10px] uppercase font-bold tracking-[0.2em]">
                <div class="flex items-center gap-3">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white/50">
                        <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
                        <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
                        <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
                    </svg>
                    <span>Total data tersimpan: <span class="text-white font-black">{{ $totalDudi }}</span> perusahaan</span>
                </div>
                <div class="flex items-center gap-3">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white/50">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    <span>Terakhir diperbarui: <span class="text-white font-medium">{{ now()->format('d F Y, H:i') }}</span></span>
                </div>
            </div>
        </div>

        <div class="mt-8 text-center pb-8">
            <p class="text-slate-400 text-[8px] lg:text-[9px] uppercase tracking-[0.3em] font-black">Sistem Informasi PKL Terpadu © 2026 • Professional Edition</p>
        </div>
    </main>
</div>

<div class="page-hero">
    <div class="section-title">
        <div>
            <h1>Data Perusahaan (DUDI)</h1>
            <p>Kelola daftar perusahaan PKL dengan tampilan yang lebih profesional dan konsisten.</p>
        </div>
        <a href="{{ route('admin.dudi.create') }}" class="btn btn-primary" style="border-radius: 999px; padding: 12px 24px; font-weight: 700;">+ Tambah DUDI</a>
    </div>
    <div class="hero-stats">
        <div class="hero-stat"><strong>{{ $totalDudi }}</strong><span>Total DUDI</span></div>
        <div class="hero-stat"><strong>{{ $totalKuota }}</strong><span>Total Kuota</span></div>
    </div>
</div>

<div class="card" style="padding: 0; overflow: hidden;">
    <div class="toolbar-panel">
        <div>
            <h2>Daftar DUDI</h2>
            <p style="margin: 8px 0 0; color:#6b7a91; font-size:14px;">Temukan, filter, dan atur semua data perusahaan PKL dengan mudah.</p>
        </div>
        <form action="{{ route('admin.dudi.index') }}" method="GET" class="toolbar-grid">
            <input type="text" name="search" placeholder="Cari nama atau bidang usaha..." value="{{ $search }}" />
            <select name="bidang_usaha">
                <option value="">Semua Bidang</option>
                @foreach($allBidang as $bidangItem)
                    <option value="{{ $bidangItem }}" {{ $bidang == $bidangItem ? 'selected' : '' }}>{{ $bidangItem }}</option>
                @endforeach
            </select>
            <select name="sort_by">
                <option value="newest" {{ $sortBy == 'newest' ? 'selected' : '' }}>Terbaru</option>
                <option value="oldest" {{ $sortBy == 'oldest' ? 'selected' : '' }}>Terlama</option>
                <option value="name_asc" {{ $sortBy == 'name_asc' ? 'selected' : '' }}>Nama A-Z</option>
                <option value="name_desc" {{ $sortBy == 'name_desc' ? 'selected' : '' }}>Nama Z-A</option>
            </select>
            <button type="submit">Cari</button>
        </form>
    </div>

    <div class="toolbar-panel" style="margin-bottom: 20px;">
        <div>
            <h2>Impor Data DUDI</h2>
            <p style="margin: 8px 0 0; color:#6b7a91; font-size:14px;">Unggah file Excel / CSV untuk menambahkan banyak DUDI dalam satu kali proses.</p>
        </div>
        <form action="{{ route('admin.dudi.import') }}" method="POST" enctype="multipart/form-data" class="toolbar-grid">
            @csrf
            <input type="file" name="file" accept=".csv,.xlsx" required />
            <button type="submit">Unggah Excel</button>
        </form>
    </div>

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th style="width:70px;">No</th>
                    <th>Nama DUDI</th>
                    <th>Alamat</th>
                    <th style="width:120px;">Jam Berangkat</th>
                    <th style="width:120px;">Jam Pulang</th>
                    <th>Bidang Industri</th>
                    <th style="width:120px;">Jumlah Pegawai</th>
                    <th>Website</th>
                    <th>No. Telp</th>
                    <th>Email</th>
                    <th style="width:120px;">Kuota</th>
                    <th>Penanggung Jawab</th>
                    <th style="width:180px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dudis as $dudi)
                    <tr>
                        <td>{{ ($dudis->currentPage() - 1) * $dudis->perPage() + $loop->iteration }}</td>
                        <td><strong>{{ $dudi->nama_dudi }}</strong></td>
                        <td>{{ $dudi->alamat }}</td>
                        <td>{{ $dudi->jam_masuk ?? '-' }}</td>
                        <td>{{ $dudi->jam_pulang ?? '-' }}</td>
                        <td>{{ $dudi->bidang_usaha }}</td>
                        <td>{{ $dudi->jumlah_pegawai }}</td>
                        <td>
                            @if($dudi->website)
                                <a href="{{ preg_match('/^https?:\/\//', $dudi->website) ? $dudi->website : 'https://' . $dudi->website }}" target="_blank" rel="noreferrer">{{ $dudi->website }}</a>
                            @endif
                        </td>
                        <td>{{ $dudi->telepon }}</td>
                        <td>{{ $dudi->email }}</td>
                        <td style="text-align:center;">
                            <strong>{{ $dudi->kuota ?? 0 }}</strong>
                        </td>
                        <td>{{ $dudi->pembimbing_dudi }}</td>
                        <td>
                            <div class="action-group">
                                <a href="{{ route('admin.dudi.edit', $dudi->id_dudi) }}" class="edit">Edit</a>
                                <form action="{{ route('admin.dudi.destroy', $dudi->id_dudi) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="13" class="no-data">Tidak ada data DUDI</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($dudis->hasPages())
        <div class="pagination" style="margin: 20px; justify-content: flex-end;">
            @if($dudis->onFirstPage())
                <span>← Sebelumnya</span>
            @else
                <a href="{{ $dudis->previousPageUrl() }}{{ !empty($search) ? '&search='.$search : '' }}{{ !empty($bidang) ? '&bidang_usaha='.$bidang : '' }}{{ $sortBy != 'newest' ? '&sort_by='.$sortBy : '' }}">← Sebelumnya</a>
            @endif

            @foreach($dudis->getUrlRange(1, $dudis->lastPage()) as $page => $url)
                @if($page == $dudis->currentPage())
                    <span class="active"><span>{{ $page }}</span></span>
                @else
                    <a href="{{ $url }}{{ !empty($search) ? '&search='.$search : '' }}{{ !empty($bidang) ? '&bidang_usaha='.$bidang : '' }}{{ $sortBy != 'newest' ? '&sort_by='.$sortBy : '' }}">{{ $page }}</a>
                @endif
            @endforeach

            @if($dudis->hasMorePages())
                <a href="{{ $dudis->nextPageUrl() }}{{ !empty($search) ? '&search='.$search : '' }}{{ !empty($bidang) ? '&bidang_usaha='.$bidang : '' }}{{ $sortBy != 'newest' ? '&sort_by='.$sortBy : '' }}">Selanjutnya →</a>
            @else
                <span>Selanjutnya →</span>
            @endif
        </div>
    @endif
</div>
@endsection
