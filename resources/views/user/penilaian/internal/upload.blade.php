{{-- =========================================================
    UPLOAD MODAL
========================================================= --}}
<div id="uploadModal" class="fixed inset-0 z-[10000] hidden items-center justify-center bg-black/50 p-4">
    <div class="modal-shell w-full max-w-3xl max-h-[92vh] overflow-y-auto rounded-xl bg-white shadow-2xl dark:bg-gray-900">

        {{-- HEADER --}}
        <div class="modal-header flex items-start justify-between border-b border-gray-200 px-6 py-5 dark:border-gray-700">
            <div>
                <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100">
                    Upload Dokumen
                </h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Upload dokumen bukti untuk data dukung yang dipilih.
                </p>
            </div>

            <button type="button" onclick="closeUploadModal()" class="text-2xl leading-none text-gray-400 hover:text-gray-700 dark:text-gray-300 dark:hover:text-white">
                &times;
            </button>
        </div>

        {{-- FORM --}}
        <form id="uploadForm" method="POST" action="{{ route('user.penilaian.internal.upload', $indikator->id_indikator) }}" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="id_data_dukung" id="uploadDataDukungId">

            {{-- CONTENT --}}
            <div class="modal-body px-7 py-5">

                {{-- INFORMASI DATA DUKUNG --}}
                <div class="modal-info-card rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-600 dark:bg-gray-800">
                    <div class="border-b border-gray-200 px-6 py-3.5 dark:border-gray-600">
                        <div class="text-sm font-bold text-[#17256b] dark:text-blue-300">
                            Informasi Data Dukung
                        </div>
                    </div>

                    <div class="space-y-4 px-6 py-4 text-sm">
                        <div class="grid grid-cols-[105px_20px_1fr] gap-1">
                            <div class="text-gray-600 dark:text-gray-300">Nama</div>
                            <div class="text-gray-500 dark:text-gray-400">:</div>
                            <div id="uploadDataDukungName" class="font-medium leading-6 text-gray-800 dark:text-gray-100">-</div>
                        </div>

                        <div class="grid grid-cols-[105px_20px_1fr] items-center gap-1">
                            <div class="text-gray-600 dark:text-gray-300">Status Mandiri</div>
                            <div class="text-gray-500 dark:text-gray-400">:</div>
                            <div>
                                <span class="inline-flex rounded-full bg-[#ffdfe1] px-3 py-1 text-xs font-semibold text-red-600 dark:bg-red-900/40 dark:text-red-300">
                                    Belum Upload
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KETENTUAN --}}
                <div class="modal-rule mt-4 rounded-lg border border-[#67dfe0] bg-[#efffff] p-5 dark:border-cyan-700 dark:bg-cyan-950/25">
                    <div class="flex gap-3">
                        <div class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-[#16bdb9] text-xs font-bold text-white">i</div>
                        <div class="min-w-0">
                            <div class="text-base font-bold text-gray-700 dark:text-gray-100">Ketentuan Upload</div>
                            <ul class="mt-2 space-y-1.5 text-sm leading-6 text-gray-600 dark:text-gray-300">
                                <li>
                                    • Format file: PDF, DOC, atau DOCX
                                </li>
                                <li>
                                    • Ukuran maksimal: 20 MB
                                </li>
                                <li>
                                    • Dokumen tidak boleh menggunakan password/proteksi
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- FILE --}}
                <div class="mt-4">
                    <label for="uploadDokumen" class="mb-2 block text-sm font-semibold text-gray-700 dark:text-gray-200">
                        Dokumen Bukti
                        <span class="text-red-500">*</span>
                    </label>

                    <label for="uploadDokumen" class="flex min-h-[180px] cursor-pointer flex-col items-center justify-center rounded-xl border-2 border-dashed border-[#42d5cb] bg-[#fbffff] px-6 py-8 text-center transition hover:border-[#12a89d] hover:bg-[#f3fbfa] dark:border-teal-600 dark:bg-gray-800 dark:hover:bg-gray-750">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-[#e4f6f4] dark:bg-teal-900/40">
                            <svg class="h-6 w-6 text-[#12a89d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 16V4m0 0L8 8m4-4l4 4" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2" />
                            </svg>
                        </div>

                        <div class="mt-3 text-base font-medium text-gray-700 dark:text-gray-100">
                            Klik untuk memilih dokumen
                        </div>

                        {{-- MAGANG PNCCCCCCCCCCCCCCC JAYAAAAAAAAAAAAA --}}
                        <div class="mt-1 text-sm text-gray-400 dark:text-gray-400">
                            PDF, DOC, DOCX • Maks. 20 MB
                        </div>

                        <div id="uploadSelectedFile" class="mt-2 hidden max-w-full rounded-md bg-[#eafafa] px-3 py-1.5 text-[10px] font-semibold text-[#159b99]"></div>
                    </label>

                    <input id="uploadDokumen" type="file" name="dokumen" required accept=".pdf,.doc,.docx" class="hidden">
                </div>

                {{-- CATATAN --}}
                <div class="mt-4">
                    <label for="uploadCatatan" class="mb-2 block text-sm font-semibold text-gray-700 dark:text-gray-200">
                        Catatan Mandiri
                        <span class="text-red-500">*</span>
                        <span class="ml-1 text-xs font-normal text-red-500">
                            min: 10 kata, max: 1000 karakter
                        </span>
                    </label>

                    <textarea id="uploadCatatan" name="catatan_user" rows="3" maxlength="1000" required class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm leading-6 text-gray-700 outline-none transition placeholder:text-gray-400 focus:border-[#12a89d] focus:ring-1 focus:ring-[#12a89d] dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100 dark:placeholder:text-gray-500" placeholder="Masukkan catatan terkait dokumen yang diupload..."></textarea>

                    <div class="mt-1 flex items-center justify-between">
                        <span id="uploadCatatanWordInfo" class="text-[10px] text-gray-400 dark:text-gray-500">
                            0 kata
                        </span>
                        <span id="uploadCatatanCounter" class="text-[10px] text-gray-400 dark:text-gray-500">
                            0 / 1000
                        </span>
                    </div>

                    <p id="uploadCatatanError" class="mt-1 hidden text-[10px] text-red-500">
                        Catatan wajib diisi minimal 10 kata.
                    </p>
                </div>

            </div>

            {{-- FOOTER --}}
            <div class="modal-footer flex justify-end gap-2 border-t border-gray-200 bg-gray-50 px-6 py-4 dark:border-gray-700 dark:bg-gray-900">
                <button type="button" onclick="closeUploadModal()" class="rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                    Batal
                </button>

                <button type="submit" class="rounded-lg bg-[#12a89d] px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-[#0d857c]">
                    Upload
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const uploadData = {
        @foreach($dataDukung as $item)
            {{ $item->id_data_dukung }}: {
                id: {{ $item->id_data_dukung }},
                name: @json($item->nama_data_dukung),
                description: @json($item->deskripsi),
            },
        @endforeach
    };

    let activeUploadDataDukungId = null;

    function openUploadModal(dataDukungId) {
        const data = uploadData[dataDukungId];

        if (!data) {
            return;
        }

        activeUploadDataDukungId = dataDukungId;

        document.getElementById('uploadForm').reset();
        document.getElementById('uploadDataDukungId').value = data.id;
        document.getElementById('uploadDataDukungName').textContent = data.name;

        document.getElementById('uploadSelectedFile').textContent = '';
        document.getElementById('uploadSelectedFile').classList.add('hidden');

        document.getElementById('uploadCatatanCounter').textContent = '0 / 1000';
        document.getElementById('uploadCatatanWordInfo').textContent = '0 kata';
        document.getElementById('uploadCatatanError').classList.add('hidden');

        const modal = document.getElementById('uploadModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeUploadModal() {
        const modal = document.getElementById('uploadModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }

    function countUploadWords(text) {
        const cleanText = text.trim();

        if (!cleanText) {
            return 0;
        }

        return cleanText.split(/\s+/).filter(Boolean).length;
    }

    function validateUploadNote() {
        const textarea = document.getElementById('uploadCatatan');
        const words = countUploadWords(textarea.value);

        document.getElementById('uploadCatatanWordInfo').textContent = words + ' kata';
        document.getElementById('uploadCatatanCounter').textContent = textarea.value.length + ' / 1000';

        if (words < 10) {
            document.getElementById('uploadCatatanError').classList.remove('hidden');
            textarea.classList.add('border-red-400');
            return false;
        }

        document.getElementById('uploadCatatanError').classList.add('hidden');
        textarea.classList.remove('border-red-400');
        return true;
    }

    document.getElementById('uploadCatatan').addEventListener('input', validateUploadNote);

    document.getElementById('uploadDokumen').addEventListener('change', function() {
        const file = this.files[0];
        const display = document.getElementById('uploadSelectedFile');

        if (!file) {
            display.textContent = '';
            display.classList.add('hidden');
            return;
        }

        display.textContent = file.name + ' (' + formatUploadFileSize(file.size) + ')';
        display.classList.remove('hidden');
    });

    document.getElementById('uploadForm').addEventListener('submit', function(event) {
        if (!validateUploadNote()) {
            event.preventDefault();
            document.getElementById('uploadCatatan').focus();
        }
    });

    function formatUploadFileSize(bytes) {
        if (!bytes || bytes <= 0) {
            return '0 B';
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

    document.getElementById('uploadModal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeUploadModal();
        }
    });
</script>