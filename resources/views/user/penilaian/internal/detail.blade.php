{{-- =========================================================
    DETAIL MODAL
========================================================= --}}
<div id="documentDetailModal" class="fixed inset-0 z-[10001] hidden items-center justify-center bg-black/50 p-4">
    <div class="modal-shell w-full max-w-3xl max-h-[92vh] overflow-y-auto rounded-xl bg-white shadow-2xl dark:bg-gray-900">

        {{-- HEADER --}}
        <div class="modal-header flex items-start justify-between border-b border-gray-200 px-6 py-5 dark:border-gray-700">
            <div>
                <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100">
                    Detail Dokumen
                </h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Informasi dokumen bukti yang telah diupload.
                </p>
            </div>

            <button type="button" onclick="closeDocumentDetail()" class="text-2xl leading-none text-gray-400 hover:text-gray-700 dark:text-gray-300 dark:hover:text-white">
                &times;
            </button>
        </div>

        {{-- CONTENT --}}
        <div class="modal-body px-7 py-5">

            {{-- DATA DUKUNG --}}
            <div class="rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <div class="border-b border-gray-200 px-6 py-3.5 text-sm font-bold text-[#17256b] dark:border-gray-700 dark:text-blue-300">
                    Data Dukung
                </div>

                <div id="detailDataDukungName" class="px-6 py-4 text-sm font-medium leading-6 text-gray-800 dark:text-gray-100">
                    -
                </div>
            </div>

            {{-- STATUS --}}
            <div class="mt-4 flex items-center justify-between rounded-xl border border-gray-200 bg-white px-5 py-4 dark:border-gray-700 dark:bg-gray-800">
                <div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">
                        Status
                    </div>
                    <div id="detailStatus" class="mt-1 text-sm font-semibold text-gray-800 dark:text-gray-100">
                        -
                    </div>
                </div>

                <span id="detailStatusBadge" class="rounded-full px-3 py-1 text-xs font-semibold">
                    -
                </span>
            </div>

            {{-- DOKUMEN --}}
            <div class="mt-4">
                <div class="mb-2 block text-sm font-semibold text-gray-700 dark:text-gray-200">
                    Dokumen Saat Ini
                </div>

                <div class="rounded-xl border border-gray-200 bg-white p-4 dark:border-gray-700 dark:bg-gray-800">
                    <div class="flex items-start gap-3">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-[#e4f6f4] dark:bg-teal-900/40">
                            <svg class="h-6 w-6 text-[#12a89d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                                <polyline points="14 2 14 8 20 8" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                            </svg>
                        </div>

                        <div class="min-w-0 flex-1">
                            <div id="detailFileName" class="break-all text-sm font-semibold text-gray-800 dark:text-gray-100">
                                -
                            </div>

                            <div class="mt-1 flex flex-wrap gap-x-3 gap-y-1 text-xs text-gray-500 dark:text-gray-400">
                                <span id="detailFileSize">-</span>
                                <span id="detailFileVersion">-</span>
                            </div>

                            <div id="detailUploadedDate" class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                -
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <a id="detailOpenFile" href="#" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 rounded-lg border border-[#12a89d] px-4 py-2 text-sm font-semibold text-[#12a89d] hover:bg-[#eafafa] dark:hover:bg-teal-950/30">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7 9.542" />
                            </svg>
                            Lihat Dokumen
                        </a>
                    </div>
                </div>
            </div>

            {{-- CATATAN --}}
            <div class="mt-4">
                <div class="mb-2 block text-sm font-semibold text-gray-700 dark:text-gray-200">
                    Catatan Mandiri
                </div>

                <div id="detailNote" class="min-h-[90px] whitespace-pre-line rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm leading-6 text-gray-600 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
                    -
                </div>
            </div>

            {{-- CATATAN ASESOR --}}
            <div id="detailAdvisorNoteWrapper" class="mt-4 hidden">
                <div class="mb-1.5 text-xs font-bold text-red-600">
                    Catatan Asesor
                </div>

                <div id="detailAdvisorNote" class="whitespace-pre-line rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm leading-6 text-red-700 dark:border-red-900 dark:bg-red-950/30 dark:text-red-300"></div>
            </div>

        </div>

        {{-- FOOTER --}}
        <div class="modal-footer flex items-center justify-between border-t border-gray-200 bg-gray-50 px-6 py-4 dark:border-gray-700 dark:bg-gray-900">
            <button type="button" onclick="closeDocumentDetail()" class="rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                Tutup
            </button>

            <button type="button" onclick="openEditModalFromDetail()" class="rounded-lg bg-[#f5bd18] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#dfa900]">
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

        if (!data) {
            return;
        }

        const dokumen = data.dokumen && data.dokumen.length ? data.dokumen[0] : null;

        if (!dokumen) {
            alert('Dokumen belum tersedia.');
            return;
        }

        activeDocumentDataDukungId = dataDukungId;

        document.getElementById('detailDataDukungName').textContent = data.name;
        document.getElementById('detailStatus').textContent = formatDetailStatus(data.status);

        const badge = document.getElementById('detailStatusBadge');
        badge.textContent = formatDetailStatus(data.status);
        badge.className = 'rounded-md px-2.5 py-1 text-[10px] font-semibold ' + getDetailStatusClass(data.status);

        document.getElementById('detailFileName').textContent = dokumen.name;
        document.getElementById('detailFileSize').textContent = formatDetailFileSize(dokumen.size);
        document.getElementById('detailFileVersion').textContent = 'Versi ' + dokumen.version;
        document.getElementById('detailUploadedDate').textContent = 'Upload: ' + dokumen.createdAt;
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
        if (!activeDocumentDataDukungId) {
            return;
        }

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
        if (status === 'DIVERIFIKASI') {
            return 'bg-[#d9f7df] text-green-700';
        }

        if (status === 'PERLU_PERBAIKAN') {
            return 'bg-[#ffe1e1] text-red-600';
        }

        if (status === 'TERKIRIM') {
            return 'bg-[#dcecff] text-blue-600';
        }

        return 'bg-gray-100 text-gray-500 dark:text-gray-400 dark:text-gray-500';
    }

    function formatDetailFileSize(bytes) {
        if (!bytes || bytes <= 0) {
            return '-';
        }

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