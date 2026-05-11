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
