{{-- =========================================================
    EDIT MODAL
========================================================= --}}
<div id="editModal" class="fixed inset-0 z-[10002] hidden items-center justify-center bg-black/50 p-4">
    <div class="modal-shell w-full max-w-3xl max-h-[92vh] overflow-y-auto rounded-xl bg-white shadow-2xl dark:bg-gray-900">

        {{-- HEADER --}}
        <div class="modal-header flex items-start justify-between border-b border-gray-200 px-6 py-5 dark:border-gray-700">
            <div>
                <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100">
                    Edit Dokumen
                </h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Perbarui dokumen dan catatan mandiri.
                </p>
            </div>

            <button type="button" onclick="closeEditModal()" class="text-2xl leading-none text-gray-400 hover:text-gray-700 dark:text-gray-300 dark:hover:text-white">
                &times;
            </button>
        </div>

        {{-- FORM --}}
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="hidden" id="editDataDukungId">

            {{-- CONTENT --}}
            <div class="modal-body px-7 py-5">

                {{-- DATA DUKUNG --}}
                <div class="rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="border-b border-gray-200 px-6 py-3.5 text-sm font-bold text-[#17256b] dark:border-gray-700 dark:text-blue-300">
                        Informasi Data Dukung
                    </div>

                    <div class="grid grid-cols-[105px_20px_1fr] gap-1 px-6 pt-4">
                        <span class="text-sm text-gray-600 dark:text-gray-300">
                            Nama
                        </span>
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            :
                        </span>
                        <span id="editDataDukungName" class="text-sm font-medium leading-6 text-gray-800 dark:text-gray-100">
                            -
                        </span>
                    </div>

                    <div class="grid grid-cols-[105px_20px_1fr] gap-1 px-6 pt-4">
                        <span class="text-sm text-gray-600 dark:text-gray-300">
                            Status
                        </span>
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            :
                        </span>
                        <span id="editStatusBadge" class="inline-flex w-fit rounded-full bg-[#ffdfe1] px-3 py-1 text-xs font-semibold text-red-600 dark:bg-red-900/40 dark:text-red-300">
                            Upload
                        </span>
                    </div>
                </div>

                {{-- KETENTUAN --}}
                <div class="mt-4 rounded-lg border border-[#67dfe0] bg-[#efffff] p-5 dark:border-cyan-700 dark:bg-cyan-950/25">
                    <div class="flex gap-2">
                        <svg class="mt-0.5 h-4 w-4 shrink-0 text-[#12a89d]" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z" clip-rule="evenodd" />
                        </svg>

                        <div>
                            <div class="text-base font-bold text-gray-700 dark:text-gray-100">
                                Ketentuan Upload
                            </div>

                            <ul class="mt-2 space-y-1.5 text-sm leading-6 text-gray-600 dark:text-gray-300">
                                <li>
                                    • Format file yang diizinkan: PDF, DOC, DOCX
                                </li>
                                <li>
                                    • Ukuran maksimal file: 20 MB
                                </li>
                                <li>
                                    • Pastikan dokumen dapat dibuka dan tidak diproteksi kata sandi
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- DOKUMEN SAAT INI --}}
                <div class="mt-4">
                    <div class="mb-1.5 text-xs font-bold text-[#FFFFFF]">
                        Dokumen Saat Ini
                    </div>

                    <div class="rounded-xl border border-gray-200 bg-white p-4 dark:border-gray-700 dark:bg-gray-800">
                        <div class="flex items-start gap-3">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-red-50 dark:bg-red-950/30">
                                <svg class="h-7 w-7 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                                    <polyline points="14 2 14 8 20 8" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                </svg>
                            </div>

                            <div class="min-w-0 flex-1">
                                <div id="editCurrentFile" class="break-all text-sm font-semibold text-gray-800 dark:text-gray-100">
                                    Belum ada dokumen.
                                </div>

                                <div class="mt-1 space-y-1 text-xs text-gray-500 dark:text-gray-400">
                                    <div>
                                        Ukuran File
                                        <span class="mx-1">:</span>
                                        <span id="editCurrentFileSize">-</span>
                                    </div>
                                    <div>
                                        Versi
                                        <span class="mx-1">:</span>
                                        <span id="editCurrentFileVersion">-</span>
                                    </div>
                                    <div>
                                        Tanggal Upload
                                        <span class="mx-1">:</span>
                                        <span id="editCurrentFileDate">-</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="editCurrentFileActions" class="mt-3 hidden">
                            <a id="editCurrentFileLink" href="#" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 rounded-lg border border-[#12a89d] px-4 py-2 text-sm font-semibold text-[#12a89d] hover:bg-[#eafafa] dark:hover:bg-teal-950/30">
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7 9.542 7z" />
                                </svg>
                                Lihat
                            </a>
                        </div>
                    </div>
                </div>

                {{-- GANTI DOKUMEN --}}
                <div class="mt-4">
                    <label for="editDokumen" class="mb-2 block text-sm font-semibold text-gray-700 dark:text-gray-200">
                        Ganti Dokumen
                    </label>

                    <label for="editDokumen" class="flex min-h-[72px] cursor-pointer items-center justify-between rounded-xl border-2 border-dashed border-[#42d5cb] bg-[#fbffff] px-4 py-4 transition hover:border-[#12a89d] hover:bg-[#f3fbfa] dark:border-teal-600 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <div>
                            <div class="text-sm font-medium text-gray-700 dark:text-gray-200">
                                Pilih dokumen baru
                            </div>
                            <div class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                PDF, DOC, DOCX • Maks. 20 MB
                            </div>
                        </div>

                        <span class="rounded-lg bg-[#eafafa] px-4 py-2 text-sm font-semibold text-[#159b99] dark:bg-teal-900/40 dark:text-teal-300">
                            Pilih File
                        </span>
                    </label>

                    <input id="editDokumen" type="file" name="dokumen" accept=".pdf,.doc,.docx" class="hidden">

                    <div id="editSelectedFile" class="mt-2 hidden rounded-lg bg-gray-50 px-3 py-2 text-xs font-semibold text-gray-600 dark:bg-gray-700 dark:text-gray-300"></div>

                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        Kosongkan jika tidak ingin mengganti dokumen.
                    </p>
                </div>

                {{-- CATATAN --}}
                <div class="mt-4">
                    <label for="editCatatan" class="mb-2 block text-sm font-semibold text-gray-700 dark:text-gray-200">
                        Catatan Mandiri
                        <span class="text-red-500">*</span>
                        <span class="ml-1 text-[10px] font-normal text-red-500">
                            min: 10 kata, max: 1000 karakter
                        </span>
                    </label>

                    <textarea id="editCatatan" name="catatan_user" rows="4" maxlength="1000" required class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm leading-6 text-gray-700 outline-none transition placeholder:text-gray-400 focus:border-[#12a89d] focus:ring-1 focus:ring-[#12a89d] dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100 dark:placeholder:text-gray-500" placeholder="Masukkan catatan mandiri..."></textarea>

                    <div class="mt-1 flex items-center justify-between">
                        <span id="editCatatanWordInfo" class="text-xs text-gray-500 dark:text-gray-400">
                            0 kata
                        </span>
                        <span id="editCatatanCounter" class="text-xs text-gray-500 dark:text-gray-400">
                            0 / 1000
                        </span>
                    </div>

                    <p id="editCatatanError" class="mt-1 hidden text-xs text-red-500"></p>
                </div>

            </div>

            {{-- FOOTER --}}
            <div class="modal-footer flex items-center justify-between border-t border-gray-200 bg-gray-50 px-6 py-4 dark:border-gray-700 dark:bg-gray-900">
                <button type="button" id="editDeleteButton" onclick="deleteCurrentDocument()" class="hidden rounded-lg border border-red-200 bg-white px-3 py-2 text-xs font-semibold text-red-500 hover:bg-red-50 dark:bg-red-950/20">
                    Hapus Dokumen
                </button>

                <div class="ml-auto flex gap-2">
                    <button type="button" onclick="closeEditModal()" class="rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                        Batal
                    </button>

                    <button type="submit" class="rounded-lg bg-[#12a89d] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#0d857c]">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- FORM DELETE --}}
<form id="deleteDocumentForm" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

<script>
    const editDocumentData = {
        @foreach($dataDukung as $item)
            {{ $item->id_data_dukung }}: {
                id: {{ $item->id_data_dukung }},
                name: @json($item->nama_data_dukung),
                status: @json($item->status_data_dukung),
                keterangan: @json($item->keterangan),
                dokumen: [
                    @foreach($item->dokumen as $dokumen)
                        {
                            id: {{ $dokumen->id_dokumen }},
                            name: @json($dokumen->file_name),
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

    let activeEditDataDukungId = null;

    function openEditModal(dataDukungId) {
        const data = editDocumentData[dataDukungId];

        if (!data) {
            return;
        }

        activeEditDataDukungId = dataDukungId;

        document.getElementById('editForm').action = "{{ url('/user/penilaian/internal') }}/" + "{{ $indikator->id_indikator }}" + "/edit/" + dataDukungId;
        document.getElementById('editDataDukungId').value = dataDukungId;
        document.getElementById('editDataDukungName').textContent = data.name;
        document.getElementById('editStatusBadge').textContent = formatEditStatus(data.status);

        const dokumen = data.dokumen && data.dokumen.length ? data.dokumen[0] : null;

        if (dokumen) {
            document.getElementById('editCurrentFile').textContent = dokumen.name;
            document.getElementById('editCurrentFileSize').textContent = formatEditFileSize(dokumen.size);
            document.getElementById('editCurrentFileVersion').textContent = 'Versi ' + dokumen.version;
            document.getElementById('editCurrentFileDate').textContent = dokumen.createdAt;
            document.getElementById('editCurrentFileLink').href = dokumen.url;

            document.getElementById('editCurrentFileActions').classList.remove('hidden');
            document.getElementById('editDeleteButton').classList.remove('hidden');
            document.getElementById('editCatatan').value = dokumen.note || data.keterangan || '';
        } else {
            document.getElementById('editCurrentFile').textContent = 'Belum ada dokumen.';
            document.getElementById('editCurrentFileSize').textContent = '-';
            document.getElementById('editCurrentFileVersion').textContent = '-';
            document.getElementById('editCurrentFileDate').textContent = '-';

            document.getElementById('editCurrentFileActions').classList.add('hidden');
            document.getElementById('editDeleteButton').classList.add('hidden');
            document.getElementById('editCatatan').value = data.keterangan || '';
        }

        document.getElementById('editDokumen').value = '';
        document.getElementById('editSelectedFile').textContent = '';
        document.getElementById('editSelectedFile').classList.add('hidden');

        validateEditNote();

        const modal = document.getElementById('editModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeEditModal() {
        const modal = document.getElementById('editModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }

    function countEditWords(text) {
        const cleanText = text.trim();

        if (!cleanText) {
            return 0;
        }

        return cleanText.split(/\s+/).filter(Boolean).length;
    }

    function validateEditNote() {
        const textarea = document.getElementById('editCatatan');
        const words = countEditWords(textarea.value);

        document.getElementById('editCatatanWordInfo').textContent = words + ' kata';
        document.getElementById('editCatatanCounter').textContent = textarea.value.length + ' / 1000';

        if (words < 10) {
            document.getElementById('editCatatanError').classList.remove('hidden');
            textarea.classList.add('border-red-400');
            return false;
        }

        document.getElementById('editCatatanError').classList.add('hidden');
        textarea.classList.remove('border-red-400');
        return true;
    }

    document.getElementById('editCatatan').addEventListener('input', validateEditNote);

    document.getElementById('editForm').addEventListener('submit', function(event) {
        if (!validateEditNote()) {
            event.preventDefault();
            document.getElementById('editCatatan').focus();
        }
    });

    document.getElementById('editDokumen').addEventListener('change', function() {
        const file = this.files[0];
        const display = document.getElementById('editSelectedFile');

        if (!file) {
            display.textContent = '';
            display.classList.add('hidden');
            return;
        }

        display.textContent = file.name + ' (' + formatEditFileSize(file.size) + ')';
        display.classList.remove('hidden');
    });

    function deleteCurrentDocument() {
        const data = editDocumentData[activeEditDataDukungId];

        if (!data || !data.dokumen || !data.dokumen.length) {
            return;
        }

        const dokumen = data.dokumen[0];

        if (!confirm('Apakah Anda yakin ingin menghapus dokumen ini?')) {
            return;
        }

        const form = document.getElementById('deleteDocumentForm');
        form.action = "{{ url('/user/penilaian/internal') }}/" + "{{ $indikator->id_indikator }}" + "/edit/" + activeEditDataDukungId + "/document/" + dokumen.id;
        form.submit();
    }

    function formatEditStatus(status) {
        const labels = {
            BELUM_DIISI: 'Belum Diisi',
            TERKIRIM: 'Sudah Diupload',
            DIVERIFIKASI: 'Terverifikasi',
            PERLU_PERBAIKAN: 'Perlu Diperbaiki'
        };

        return labels[status] || status || '-';
    }

    function formatEditFileSize(bytes) {
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

    document.getElementById('editModal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeEditModal();
        }
    });
</script>