<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <title>Pencarian DUDI - SMKN 6 Malang</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/cari-dudi.css') }}">
</head>
<body>
    <!-- Overlay untuk menutup menu saat klik di luar -->
    <div class="overlay" id="overlay" onclick="closeAllMenus()"></div>
    
    <!-- Header Section dengan Background Biru -->
    <div class="search-header-section">
        <div class="container">
            <div class="header-content">
                <!-- Search Box - Split Layout -->
                <div class="search-wrapper">
                    <div class="search-split">
                        <!-- Lokasi Search - Kiri -->
                        <div class="location-search" id="locationSearch">
                            <div class="search-box" onclick="toggleLocationDropdown()">
                                <i class="fas fa-map-pin"></i>
                                <span id="selectedLocationText">Pilih Lokasi</span>
                                <i class="fas fa-chevron-down chevron"></i>
                            </div>
                            
                            <!-- Location Dropdown -->
                            <div class="location-dropdown" id="locationDropdown">
                                <div class="location-tabs">
                                    <div class="location-tab active" data-level="provinsi" onclick="switchLocationTab('provinsi')">Provinsi</div>
                                    <div class="location-tab" data-level="kabupaten" onclick="switchLocationTab('kabupaten')">Kab/Kota</div>
                                </div>
                                
                                <div class="location-content" id="provinsiList">
                                    <div class="location-list"></div>
                                </div>
                                
                                <div class="location-content" id="kabupatenList" style="display: none;">
                                    <div class="back-link" onclick="backToProvinsi()">
                                        <i class="fas fa-arrow-left"></i>
                                        <span>Kembali ke Provinsi</span>
                                    </div>
                                    <div id="kabupatenItems"></div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- DUDI Search - Kanan -->
                        <div class="dudi-search">
                            <i class="fas fa-search"></i>
                            <input id="searchInput" type="text" placeholder="Cari nama perusahaan atau bidang..." value="{{ request('search', '') }}">
                            <button onclick="applyFilters()">Cari</button>
                        </div>
                    </div>
                    
                    <!-- Selected Location Badge -->
                    <div class="selected-location-badge" id="selectedLocationBadge" style="display: none;">
                        <div class="location-badge" id="selectedLocationBadgeContent">
                            <i class="fas fa-map-pin"></i>
                            <span id="selectedLocationFull">Jawa Timur</span>
                            <span class="location-type-badge" id="selectedLocationType">Provinsi</span>
                            <i class="fas fa-times remove-location" onclick="clearLocation()"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Filter Row -->
                <div class="filter-row">
                    <div class="filter-left">
                        <button class="filter-icon-btn" id="filterButton" onclick="toggleFilterMenu()">
                            <i class="fas fa-sliders-h"></i>
                            <span>Filter</span>
                        </button>
                        <div class="active-filters" id="activeFilters"></div>
                        <span class="reset-all" id="resetAllBtn" onclick="resetAllFilters()" style="display: none;">Reset semua</span>
                        
                        <div class="filter-menu" id="filterMenu">
                            <div class="filter-menu-header">
                                <i class="fas fa-filter"></i> Filter Pencarian PKL
                            </div>
                            <div class="filter-menu-content">
                                <div class="filter-group">
                                    <div class="filter-group-title">
                                        <i class="fas fa-clock"></i> Jam Kerja PKL
                                    </div>
                                    <div class="filter-option" style="margin-bottom: 10px;">
                                        <input type="radio" name="jamSemua" id="jamSemua" value="semua" checked>
                                        <label for="jamSemua"><strong>Semua Jam Kerja</strong></label>
                                    </div>
                                    <div class="jam-grid">
                                        <div class="jam-group">
                                            <h4><i class="fas fa-sun"></i> Jam Berangkat</h4>
                                            <div class="jam-options">
                                                <div class="jam-option">
                                                    <input type="checkbox" id="berangkatPagi" value="05:00-07:00">
                                                    <label for="berangkatPagi">Pagi (05.00 - 07.00)</label>
                                                </div>
                                                <div class="jam-option">
                                                    <input type="checkbox" id="berangkatSiang" value="07:00-09:00">
                                                    <label for="berangkatSiang">Siang (07.00 - 09.00)</label>
                                                </div>
                                                <div class="jam-option">
                                                    <input type="checkbox" id="berangkatSore" value="09:00-11:00">
                                                    <label for="berangkatSore">Sore (09.00 - 11.00)</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="jam-group">
                                            <h4><i class="fas fa-moon"></i> Jam Pulang</h4>
                                            <div class="jam-options">
                                                <div class="jam-option">
                                                    <input type="checkbox" id="pulangSiang" value="12:00-14:00">
                                                    <label for="pulangSiang">Siang (12.00 - 14.00)</label>
                                                </div>
                                                <div class="jam-option">
                                                    <input type="checkbox" id="pulangSore" value="14:00-16:00">
                                                    <label for="pulangSore">Sore (14.00 - 16.00)</label>
                                                </div>
                                                <div class="jam-option">
                                                    <input type="checkbox" id="pulangMalam" value="16:00-18:00">
                                                    <label for="pulangMalam">Malam (16.00 - 18.00)</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="font-size: 0.75rem; color: #64748b; margin-top: 8px; font-style: italic;">
                                        <i class="fas fa-info-circle"></i> Pilih jam berangkat dan/atau jam pulang
                                    </div>
                                </div>
                                <div class="filter-group">
                                    <div class="filter-group-title">
                                        <i class="fas fa-users"></i> Kuota
                                    </div>
                                    <div class="filter-options">
                                        <div class="filter-option">
                                            <input type="radio" name="kuota" id="kuotaSemua" value="semua" checked>
                                            <label for="kuotaSemua">Semua</label>
                                            <span class="count">{{ $dudis->total() }}</span>
                                        </div>
                                        <div class="filter-option">
                                            <input type="radio" name="kuota" id="kuotaKecil" value="kecil">
                                            <label for="kuotaKecil">&lt; 5 orang</label>
                                            <span class="count">&nbsp;</span>
                                        </div>
                                        <div class="filter-option">
                                            <input type="radio" name="kuota" id="kuotaSedang" value="sedang">
                                            <label for="kuotaSedang">5 - 10 orang</label>
                                            <span class="count">&nbsp;</span>
                                        </div>
                                        <div class="filter-option">
                                            <input type="radio" name="kuota" id="kuotaBesar" value="besar">
                                            <label for="kuotaBesar">&gt; 10 orang</label>
                                            <span class="count">&nbsp;</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="filter-menu-footer">
                                <button class="btn-reset" onclick="resetFilters()">Reset</button>
                                <button class="btn-apply" onclick="applyFilters()">Terapkan</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="sort-dropdown" id="sortDropdown">
                        <div class="sort-dropdown-btn" onclick="toggleSortDropdown()">
                            <span id="selectedSortText">Urutkan</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="sort-dropdown-menu" id="sortDropdownMenu">
                            <div class="sort-dropdown-item">
                                <input type="checkbox" id="sortTerdekat" value="terdekat" onchange="updateSort()">
                                <label for="sortTerdekat">Terdekat</label>
                            </div>
                            <div class="sort-dropdown-item">
                                <input type="checkbox" id="sortTerjauh" value="terjauh" onchange="updateSort()">
                                <label for="sortTerjauh">Terjauh</label>
                            </div>
                            <div class="sort-dropdown-item">
                                <input type="checkbox" id="sortNamaAZ" value="nama-az" onchange="updateSort()">
                                <label for="sortNamaAZ">A-Z</label>
                            </div>
                            <div class="sort-dropdown-item">
                                <input type="checkbox" id="sortNamaZA" value="nama-za" onchange="updateSort()">
                                <label for="sortNamaZA">Z-A</label>
                            </div>
                            <div class="sort-dropdown-item">
                                <input type="checkbox" id="sortKuotaBanyak" value="kuota-banyak" onchange="updateSort()">
                                <label for="sortKuotaBanyak">Kuota Terbanyak</label>
                            </div>
                            <div class="sort-dropdown-item">
                                <input type="checkbox" id="sortKuotaSedikit" value="kuota-sedikit" onchange="updateSort()">
                                <label for="sortKuotaSedikit">Kuota Tersedikit</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="sort-selected" id="sortSelected"></div>
            </div>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="container">
        <!-- Jumlah Lowongan -->
        <div class="result-count">
            <i class="fas fa-briefcase"></i> <span id="jobCount">{{ $dudis->total() }}</span> lowongan PKL tersedia
        </div>
        
        <!-- Grid Lowongan - 4 Kolom -->
        <div class="job-grid" id="jobGrid">
            @foreach($dudis as $dudi)
                @php
                    $jumlahPendaftar = \App\Models\Booking::where('id_dudi', $dudi->id_dudi)->whereIn('status', ['Direview', 'Diterima'])->count();
                    $kuotaTersisa = max($dudi->kuota - $jumlahPendaftar, 0);
                @endphp
                <div class="company-card" data-nama="{{ strtolower($dudi->nama_dudi) }}" data-bidang="{{ strtolower($dudi->bidang_usaha) }}" data-kuota="{{ $dudi->kuota }}" data-tersisa="{{ $kuotaTersisa }}" data-jammasuk="{{ $dudi->jam_masuk }}" data-jampulang="{{ $dudi->jam_pulang }}" data-kota="{{ strtolower($dudi->kota) }}">
                    <div class="card-header">
                        <div class="image-placeholder">
                            @if($dudi->logo)
                                <img src="{{ asset('storage/' . $dudi->logo) }}" alt="{{ $dudi->nama_dudi }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 12px;">
                            @else
                                <i class="fas fa-image"></i>
                            @endif
                        </div>
                        <div class="company-info">
                            <div class="company-name">{{ $dudi->nama_dudi }}</div>
                            <div class="company-location"><i class="fas fa-map-marker-alt"></i> {{ $dudi->kota }}</div>
                        </div>
                    </div>
                    <div class="detail-item"><i class="fas fa-briefcase"></i> {{ $dudi->bidang_usaha }}</div>
                    <div class="detail-item"><i class="fas fa-clock"></i> {{ $dudi->jam_masuk ?? '-' }} - {{ $dudi->jam_pulang ?? '-' }}</div>
                    <div class="kuota-highlight">
                        <i class="fas fa-users"></i>
                        <span><span class="kuota-angka">{{ $kuotaTersisa }}</span> dari <span class="kuota-angka">{{ $dudi->kuota }}</span> kuota tersisa</span>
                    </div>
                    <a href="{{ route('siswa.dudi.show', $dudi->id_dudi) }}" class="btn btn-primary" style="margin-top: auto;">Lihat Detail</a>
                </div>
            @endforeach
        </div>
        
        <div class="search-footer">
            <i class="fas fa-circle"></i>
            <span>Akhir dari hasil pencarian</span>
            <i class="fas fa-circle"></i>
        </div>

        <div class="pagination" style="margin-top: 20px; display: flex; justify-content: center; gap: 10px;">
            {{ $dudis->links() }}
        </div>
    </div>

    <footer>
        <div class="footer-container">
            <div class="footer-top">
                <div class="footer-logo-container">
                    <div class="footer-logo-text">VOHISIX</div>
                </div>
                <p class="footer-subtitle">
                    Booking PKL adalah platform resmi SMK Negeri 6 Malang untuk memudahkan siswa dalam mencari, melamar, dan memantau proses PKL secara digital.
                </p>
            </div>
            
            <div class="footer-middle">
                <div class="footer-section info-section">
                    <div class="section-content">
                        <h3 class="footer-title">Informasi Sekolah</h3>
                        <div class="contact-info">
                            <p><i class="fas fa-school"></i> SMK Negeri 6 Malang</p>
                            <p><i class="fas fa-map-marker-alt"></i> JL. Ki Ageng Gribig no.28</p>
                            <p><i class="fas fa-phone"></i> Telp: (0341) 720138</p>
                            <p><i class="fas fa-envelope"></i> smkn6malang@sch.id</p>
                        </div>
                    </div>
                </div>
                
                <div class="footer-section bantuan-section">
                    <div class="section-content">
                        <h3 class="footer-title">Bantuan</h3>
                        <ul class="footer-links">
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">Panduan Penggunaan</a></li>
                            <li><a href="#">Cara Upload</a></li>
                            <li><a href="#">Cara Melamar</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="footer-section pembuat-section">
                    <div class="section-content">
                        <h3 class="footer-title">Pembuat</h3>
                        <ul class="pembuat-list">
                            <li>Cantika Egaraisya R</li>
                            <li>Mega Yuliani</li>
                            <li>Aditya Fabian</li>
                        </ul>
                    </div>
                </div>
                
                <div class="footer-section medsos-vertical-section">
                    <div class="section-content">
                        <div class="social-vertical">
                            <a href="#" class="social-item instagram">
                                <span class="social-icon-small"><i class="fab fa-instagram"></i></span>
                                <span>Instagram</span>
                            </a>
                            <a href="#" class="social-item tiktok">
                                <span class="social-icon-small"><i class="fab fa-tiktok"></i></span>
                                <span>TikTok</span>
                            </a>
                            <a href="#" class="social-item facebook">
                                <span class="social-icon-small"><i class="fab fa-facebook-f"></i></span>
                                <span>Facebook</span>
                            </a>
                            <a href="#" class="social-item youtube">
                                <span class="social-icon-small"><i class="fab fa-youtube"></i></span>
                                <span>YouTube</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="copyright">
                <p>&copy; <span id="currentYear"></span> All Rights Reserved. Booking PKL.</p>
            </div>
        </div>
    </footer>

    <script>
        // ==================== DATA LOKASI ====================
        const locationData = {
            provinsi: [
                { id: 'jatim', name: 'Jawa Timur', count: 18 },
                { id: 'jateng', name: 'Jawa Tengah', count: 6 },
                { id: 'jabar', name: 'Jawa Barat', count: 4 },
                { id: 'jakarta', name: 'DKI Jakarta', count: 5 },
                { id: 'banten', name: 'Banten', count: 3 }
            ],
            kabupaten: {
                jatim: [
                    { id: 'malang', name: 'Kota Malang', count: 12 },
                    { id: 'surabaya', name: 'Kota Surabaya', count: 8 },
                    { id: 'batu', name: 'Kota Batu', count: 3 },
                    { id: 'kediri', name: 'Kota Kediri', count: 2 },
                    { id: 'blitar', name: 'Kota Blitar', count: 1 },
                    { id: 'pasuruan', name: 'Kota Pasuruan', count: 2 },
                    { id: 'tuban', name: 'Kab. Tuban', count: 1 }
                ],
                jateng: [
                    { id: 'semarang', name: 'Kota Semarang', count: 4 },
                    { id: 'solo', name: 'Kota Solo', count: 2 },
                    { id: 'kudus', name: 'Kab. Kudus', count: 1 }
                ],
                jabar: [
                    { id: 'bandung', name: 'Kota Bandung', count: 3 },
                    { id: 'cikarang', name: 'Kab. Bekasi', count: 2 },
                    { id: 'cibitung', name: 'Kab. Bekasi', count: 1 }
                ],
                jakarta: [
                    { id: 'jakpus', name: 'Jakarta Pusat', count: 2 },
                    { id: 'jaksel', name: 'Jakarta Selatan', count: 2 },
                    { id: 'jaktim', name: 'Jakarta Timur', count: 1 }
                ],
                banten: [
                    { id: 'tangerang', name: 'Kota Tangerang', count: 2 },
                    { id: 'cilegon', name: 'Kota Cilegon', count: 1 }
                ]
            }
        };

        // State lokasi
        let selectedProvinsi = null;
        let selectedKabupaten = null;
        let selectedLocationType = null; // 'provinsi' atau 'kabupaten'
        let currentLevel = 'provinsi';

        function loadProvinsi() {
            const listContainer = document.querySelector('#provinsiList .location-list');
            listContainer.innerHTML = '';
            
            locationData.provinsi.forEach(prov => {
                const item = document.createElement('div');
                item.className = `location-item ${selectedProvinsi === prov.id && selectedLocationType === 'provinsi' ? 'selected' : ''}`;
                item.onclick = () => selectProvinsi(prov.id, prov.name);
                item.innerHTML = `
                    <i class="fas fa-map"></i>
                    <div class="item-content">
                        <div class="item-name">${prov.name}</div>
                        <div class="item-count">${prov.count} lowongan</div>
                    </div>
                    <span class="item-type">Provinsi</span>
                    <i class="fas fa-check check-icon"></i>
                `;
                listContainer.appendChild(item);
            });
        }

        function loadKabupaten(provinsiId) {
            const container = document.getElementById('kabupatenItems');
            container.innerHTML = '';
            
            if (!provinsiId) {
                container.innerHTML = '<div style="padding: 15px; text-align: center; color: #64748b;">Pilih provinsi terlebih dahulu</div>';
                return;
            }
            
            const provinsiName = locationData.provinsi.find(p => p.id === provinsiId)?.name || '';
            
            const allProvItem = document.createElement('div');
            allProvItem.className = `view-all-province ${selectedProvinsi === provinsiId && selectedLocationType === 'provinsi' ? 'selected' : ''}`;
            allProvItem.onclick = () => selectProvinsi(provinsiId, provinsiName);
            allProvItem.innerHTML = `
                <i class="fas fa-globe"></i>
                <span>Semua ${provinsiName}</span>
                <span class="item-type">Provinsi</span>
            `;
            container.appendChild(allProvItem);
            
            const kabupatenList = locationData.kabupaten[provinsiId] || [];
            
            kabupatenList.forEach(kab => {
                const item = document.createElement('div');
                item.className = `location-item ${selectedKabupaten === kab.id && selectedLocationType === 'kabupaten' ? 'selected' : ''}`;
                item.onclick = () => selectKabupaten(provinsiId, kab.id, kab.name);
                item.innerHTML = `
                    <i class="fas fa-city"></i>
                    <div class="item-content">
                        <div class="item-name">${kab.name}</div>
                        <div class="item-count">${kab.count} lowongan</div>
                    </div>
                    <span class="item-type">Kab/Kota</span>
                    <i class="fas fa-check check-icon"></i>
                `;
                container.appendChild(item);
            });
        }

        function selectProvinsi(id, name) {
            selectedProvinsi = id;
            selectedKabupaten = null;
            selectedLocationType = 'provinsi';
            updateSelectedLocation(name, 'provinsi');
            applyFilters();
            closeLocationDropdown();
        }

        function selectKabupaten(provinsiId, kabId, kabName) {
            selectedProvinsi = provinsiId;
            selectedKabupaten = kabId;
            selectedLocationType = 'kabupaten';
            const provinsiName = locationData.provinsi.find(p => p.id === provinsiId)?.name || '';
            updateSelectedLocation(kabName, 'kabupaten', provinsiName);
            applyFilters();
            closeLocationDropdown();
        }

        function updateSelectedLocation(name, type, provinsiName = '') {
            const badge = document.getElementById('selectedLocationBadge');
            const text = document.getElementById('selectedLocationFull');
            const typeBadge = document.getElementById('selectedLocationType');

            if (name) {
                if (type === 'provinsi') {
                    text.textContent = name;
                    typeBadge.textContent = 'Provinsi';
                } else {
                    text.textContent = `${provinsiName} > ${name}`;
                    typeBadge.textContent = 'Kab/Kota';
                }
                badge.style.display = 'flex';
                document.getElementById('selectedLocationText').textContent = name;
            } else {
                badge.style.display = 'none';
                document.getElementById('selectedLocationText').textContent = 'Pilih Lokasi';
            }
        }

        function clearLocation() {
            selectedProvinsi = null;
            selectedKabupaten = null;
            selectedLocationType = null;
            updateSelectedLocation();
            switchLocationTab('provinsi');
            loadProvinsi();
            applyFilters();
            closeLocationDropdown();
        }

        function backToProvinsi() {
            switchLocationTab('provinsi');
        }

        function toggleLocationDropdown() {
            const dropdown = document.getElementById('locationDropdown');
            dropdown.classList.toggle('active');
            if (dropdown.classList.contains('active')) {
                if (currentLevel === 'provinsi') {
                    loadProvinsi();
                } else if (currentLevel === 'kabupaten' && selectedProvinsi) {
                    loadKabupaten(selectedProvinsi);
                }
            }
        }

        function closeLocationDropdown() {
            document.getElementById('locationDropdown').classList.remove('active');
        }

        function switchLocationTab(level) {
            currentLevel = level;
            document.querySelectorAll('.location-tab').forEach(tab => tab.classList.remove('active'));
            document.querySelector(`.location-tab[data-level="${level}"]`).classList.add('active');

            document.getElementById('provinsiList').style.display = level === 'provinsi' ? 'block' : 'none';
            document.getElementById('kabupatenList').style.display = level === 'kabupaten' ? 'block' : 'none';

            if (level === 'provinsi') {
                loadProvinsi();
            } else if (level === 'kabupaten' && selectedProvinsi) {
                loadKabupaten(selectedProvinsi);
            }
        }

        function toggleFilterMenu() {
            document.getElementById('filterMenu').classList.toggle('active');
        }

        function toggleSortDropdown() {
            document.getElementById('sortDropdownMenu').classList.toggle('active');
        }

        function updateSort() {
            // placeholder: update selected sort badge
            const selected = Array.from(document.querySelectorAll('.sort-dropdown-menu input:checked')); 
            const container = document.getElementById('sortSelected');
            container.innerHTML = '';

            selected.forEach(input => {
                const badge = document.createElement('div');
                badge.className = 'sort-badge';
                badge.innerHTML = `${input.nextElementSibling.textContent} <i class="fas fa-times" onclick="clearSort('${input.id}')"></i>`;
                container.appendChild(badge);
            });

            if(selected.length === 0) {
                document.getElementById('selectedSortText').textContent = 'Urutkan';
            } else {
                document.getElementById('selectedSortText').textContent = selected.map(i => i.nextElementSibling.textContent).join(', ');
            }
        }

        function clearSort(id) {
            const input = document.getElementById(id);
            if (input) {
                input.checked = false;
                updateSort();
            }
        }

        function resetFilters() {
            document.querySelectorAll('.filter-menu input').forEach(input => {
                input.checked = input.value === 'semua';
            });
            document.getElementById('activeFilters').innerHTML = '';
            document.getElementById('resetAllBtn').style.display = 'none';
            applyFilters();
        }

        function applyFilters() {
            const searchInput = document.getElementById('searchInput').value.trim().toLowerCase();
            const cards = document.querySelectorAll('.company-card');

            const jamMasuk = Array.from(document.querySelectorAll('input[name="jamSemua"]:checked, input[name^="berangkat"]:checked')).map(i => i.value);
            const jamPulang = Array.from(document.querySelectorAll('input[id^="pulang"]:checked')).map(i => i.value);
            const kuotaFilter = document.querySelector('input[name="kuota"]:checked')?.value || 'semua';

            let visibleCount = 0;

            cards.forEach(card => {
                let visible = true;
                const name = card.dataset.nama;
                const bidang = card.dataset.bidang;
                const kuota = parseInt(card.dataset.kuota, 10);
                const tersisa = parseInt(card.dataset.tersisa, 10);
                const jamMasukCard = card.dataset.jammasuk || '';
                const jamPulangCard = card.dataset.jampulang || '';

                if (searchInput) {
                    visible = (name + ' ' + bidang).includes(searchInput);
                }

                if (kuotaFilter === 'kecil') {
                    visible = visible && kuota < 5;
                } else if (kuotaFilter === 'sedang') {
                    visible = visible && kuota >= 5 && kuota <= 10;
                } else if (kuotaFilter === 'besar') {
                    visible = visible && kuota > 10;
                }

                // jam filter placeholder: hanya cek jika ada filter
                if (jamMasuk.length && !jamMasuk.includes('semua')) {
                    visible = visible && (jamMasuk.includes(jamMasukCard) || !jamMasukCard);
                }
                if (jamPulang.length) {
                    visible = visible && (jamPulang.includes(jamPulangCard) || !jamPulangCard);
                }

                card.style.display = visible ? 'flex' : 'none';
                if (visible) visibleCount++;
            });

            document.getElementById('jobCount').textContent = visibleCount;
            document.getElementById('resetAllBtn').style.display = visibleCount < {{ $dudis->total() }} ? 'inline' : 'none';
        }

        function closeAllMenus() {
            document.getElementById('filterMenu').classList.remove('active');
            document.getElementById('sortDropdownMenu').classList.remove('active');
            closeLocationDropdown();
        }

        document.addEventListener('click', function(event) {
            if (!event.target.closest('.filter-menu') && !event.target.closest('#filterButton')) {
                document.getElementById('filterMenu').classList.remove('active');
            }
            if (!event.target.closest('.sort-dropdown') && !event.target.closest('#sortDropdown')) {
                document.getElementById('sortDropdownMenu').classList.remove('active');
            }
            if (!event.target.closest('.location-search') && !event.target.closest('#locationDropdown')) {
                closeLocationDropdown();
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            loadProvinsi();
            updateSort();
            applyFilters();

            const year = new Date().getFullYear();
            document.getElementById('currentYear').textContent = year;
        });
    </script>
</body>
</html>

