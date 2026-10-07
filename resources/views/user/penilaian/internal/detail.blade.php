{{-- =========================================================
    DETAIL MODAL
========================================================= --}}
<div id="documentDetailModal" class="fixed inset-0 z-[10001] hidden items-center justify-center bg-black/60 p-4 backdrop-blur-sm transition-opacity">
    <div class="modal-shell w-full max-w-4xl max-h-[95vh] overflow-y-auto rounded-2xl bg-white shadow-2xl dark:bg-gray-900">

        {{-- HEADER --}}
        <div class="modal-header flex items-start justify-between border-b border-gray-200 px-8 py-5 dark:border-gray-700">
            <div>
                <h3 class="text-[22px] font-extrabold text-gray-900 dark:text-gray-100">
                    Detail Dokumen
                </h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Informasi dokumen bukti yang telah diupload.
                </p>
            </div>

            <button type="button" onclick="closeDocumentDetail()" class="text-3xl leading-none text-gray-400 transition hover:text-gray-700 dark:text-gray-300 dark:hover:text-white">
                &times;
            </button>
        </div>

        {{-- CONTENT --}}
        <div class="modal-body px-8 py-6 space-y-5">

            {{-- INFORMASI DATA DUKUNG --}}
            <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <h4 class="mb-3 text-sm font-bold text-[#17256b] dark:text-blue-400">
                    Informasi Data Dukung
                </h4>
                <div class="grid grid-cols-[130px_20px_1fr] gap-y-3 text-sm">
                    <div class="text-gray-600 dark:text-gray-400">Nama</div>
                    <div class="text-gray-500 dark:text-gray-500">:</div>
                    <div id="detailDataDukungName" class="font-medium text-gray-800 dark:text-gray-200">-</div>

                    <div class="text-gray-600 dark:text-gray-400">Status</div>
                    <div class="text-gray-500 dark:text-gray-500">:</div>
                    <div>
                        <span id="detailStatusBadge" class="inline-flex rounded-full px-4 py-1 text-xs font-bold">
                            -
                        </span>
                    </div>
                </div>
            </div>

            {{-- DOKUMEN SAAT INI --}}
            <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <h4 class="mb-3 text-sm font-bold text-[#17256b] dark:text-blue-400">
                    Dokumen Saat Ini
                </h4>

                <div class="flex items-center justify-between rounded-lg border border-gray-200 p-4 dark:border-gray-700">
                    <div class="flex items-start gap-4">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-red-100 text-red-600 dark:bg-red-900/30 dark:text-red-400">
                            <svg class="h-7 w-7" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zm-1 1.5L18.5 9H13V3.5zM6 20V4h5v6h6v10H6z"/>
                            </svg>
                        </div>
                        <div class="min-w-0 text-sm">
                            <div id="detailFileName" class="truncate font-bold text-gray-800 dark:text-gray-200">-</div>
                            <div class="mt-1 grid grid-cols-[100px_10px_1fr] gap-y-1 text-xs text-gray-500 dark:text-gray-400">
                                <div>Ukuran File</div>
                                <div>:</div>
                                <span id="detailFileSize">-</span>

                                <div>Tanggal Upload</div>
                                <div>:</div>
                                <span id="detailUploadedDate">-</span>

                                <div>Diunggah Oleh</div>
                                <div>:</div>
                                <span>{{ Auth::user()->name ?? 'Pengguna' }}</span>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Tombol Lihat Dokumen --}}
                    <a id="detailOpenFile" href="#" target="_blank" rel="noopener noreferrer" class="ml-4 flex shrink-0 items-center gap-1.5 rounded-lg border border-[#12a89d] bg-white px-3.5 py-2 text-xs font-semibold text-[#12a89d] transition hover:bg-[#eafafa] dark:bg-transparent dark:hover:bg-teal-950/30">
                        Lihat
                    </a>
                </div>
            </div>

            {{-- CATATAN MANDIRI --}}
            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-800 dark:text-gray-200">
                    Catatan Mandiri
                </label>
                <div id="detailNote" class="min-h-[90px] whitespace-pre-line rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm leading-6 text-gray-600 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
                    -
                </div>
            </div>

            {{-- CATATAN ASESOR --}}
            <div id="detailAdvisorNoteWrapper" class="hidden">
                <div class="mb-1.5 text-xs font-bold text-red-600 dark:text-red-400">
                    Catatan Asesor
                </div>
                <div id="detailAdvisorNote" class="whitespace-pre-line rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm leading-6 text-red-700 dark:border-red-900 dark:bg-red-950/30 dark:text-red-300"></div>
            </div>

        </div>

        {{-- FOOTER --}}
        <div class="modal-footer flex items-center justify-between border-t border-gray-200 bg-gray-50 px-8 py-5 dark:border-gray-700 dark:bg-gray-800/50">
            <button type="button" onclick="closeDocumentDetail()" class="rounded-lg border border-gray-300 bg-white px-6 py-2.5 text-sm font-semibold text-gray-600 shadow-sm transition hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                Tutup
            </button>

            <button type="button" onclick="openEditModalFromDetail()" class="rounded-lg bg-[#f5bd18] px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#dfa900]">
                Edit
            </button>
        </div>

    </div>
</div>

<script>
    const documentDetailData = {
        @foreach($dataDukung as $item)
            {{ $item->id_data_dukung }}: {
                id: {{ $item->id_data_dukung }},
                name: @json($item->nama_data_dukung),
                status: @json($item->status_data_dukung),
                keterangan: @json($item->keterangan),
                advisorNote: @json($item->catatan_asesor),
                dokumen: [
                    @foreach($item->dokumen as $dokumen)
                        {
                            id: {{ $dokumen->id_dokumen }},
                            name: @json($dokumen->file_name),
                            path: @json($dokumen->file_path),
                            size: {{ $dokumen->file_size ?? 0 }},
                            version: {{ $dokumen->versi ?? 1 }},
                            note: @json($dokumen->catatan_user),
                            createdAt: @json(
                                $dokumen->created_at
                                    ? \Carbon\Carbon::parse($dokumen->created_at)->format('d/m/Y H:i')
                                    : '-'
                            ),
                            url: @json(asset('storage/' . $dokumen->file_path))
                        },
                    @endforeach
                ]
            },
        @endforeach
    };

    let activeDocumentDataDukungId = null;

    function openDocumentDetail(dataDukungId) {
        const data = documentDetailData[dataDukungId];
        if (!data) return;

        const dokumen = data.dokumen && data.dokumen.length ? data.dokumen[0] : null;
        if (!dokumen) {
            alert('Dokumen belum tersedia.');
            return;
        }

        activeDocumentDataDukungId = dataDukungId;

        document.getElementById('detailDataDukungName').textContent = data.name;

        const badge = document.getElementById('detailStatusBadge');
        badge.textContent = formatDetailStatus(data.status);
        badge.className = 'inline-flex rounded-full px-4 py-1 text-xs font-bold ' + getDetailStatusClass(data.status);

        document.getElementById('detailFileName').textContent = dokumen.name;
        document.getElementById('detailFileSize').textContent = formatDetailFileSize(dokumen.size);
        document.getElementById('detailUploadedDate').textContent = dokumen.createdAt + ' WIB';
        document.getElementById('detailOpenFile').href = dokumen.url;
        document.getElementById('detailNote').textContent = dokumen.note || data.keterangan || '-';

        const advisorWrapper = document.getElementById('detailAdvisorNoteWrapper');
        if (data.advisorNote) {
            document.getElementById('detailAdvisorNote').textContent = data.advisorNote;
            advisorWrapper.classList.remove('hidden');
        } else {
            advisorWrapper.classList.add('hidden');
        }

        const modal = document.getElementById('documentDetailModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeDocumentDetail() {
        const modal = document.getElementById('documentDetailModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }

    function openEditModalFromDetail() {
        if (!activeDocumentDataDukungId) return;
        closeDocumentDetail();
        if (typeof openEditModal === 'function') {
            openEditModal(activeDocumentDataDukungId);
        }
    }

    function formatDetailStatus(status) {
        const labels = {
            BELUM_DIISI: 'Belum Diisi',
            TERKIRIM: 'Sudah Diupload',
            DIVERIFIKASI: 'Terverifikasi',
            PERLU_PERBAIKAN: 'Perlu Diperbaiki'
        };
        return labels[status] || status || '-';
    }

    function getDetailStatusClass(status) {
        if (status === 'DIVERIFIKASI') return 'bg-[#d9f7df] text-green-700 dark:bg-green-900/40 dark:text-green-400';
        if (status === 'PERLU_PERBAIKAN') return 'bg-[#ffe1e1] text-red-600 dark:bg-red-900/40 dark:text-red-400';
        if (status === 'TERKIRIM') return 'bg-[#dcecff] text-blue-600 dark:bg-blue-900/40 dark:text-blue-400';
        return 'bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-300';
    }

    function formatDetailFileSize(bytes) {
        if (!bytes || bytes <= 0) return '-';
        const units = ['B', 'KB', 'MB', 'GB'];
        let size = bytes;
        let index = 0;
        while (size >= 1024 && index < units.length - 1) {
            size /= 1024;
            index++;
        }
        return size.toFixed(2) + ' ' + units[index];
    }

    document.getElementById('documentDetailModal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeDocumentDetail();
        }
    });
</script>