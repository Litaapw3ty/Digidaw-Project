{{-- =========================================================
    UPLOAD MODAL
========================================================= --}}
<div id="uploadModal" class="fixed inset-0 z-[10000] hidden items-center justify-center bg-black/60 p-4 backdrop-blur-sm transition-opacity">
    <div class="modal-shell w-full max-w-4xl max-h-[95vh] overflow-y-auto rounded-2xl bg-white shadow-2xl dark:bg-gray-900">

        {{-- HEADER --}}
        <div class="modal-header flex items-start justify-between border-b border-gray-200 px-8 py-5 dark:border-gray-700">
            <div>
                <h3 class="text-[22px] font-extrabold text-gray-900 dark:text-gray-100">
                    Upload Dokumen
                </h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Unggah dokumen yang sesuai dengan indikator penilaian.
                </p>
            </div>

            <button type="button" onclick="closeUploadModal()" class="text-3xl leading-none text-gray-400 transition hover:text-gray-700 dark:text-gray-300 dark:hover:text-white">
                &times;
            </button>
        </div>

        {{-- FORM --}}
        <form id="uploadForm" method="POST" action="{{ route('user.penilaian.internal.upload', $indikator->id_indikator) }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id_data_dukung" id="uploadDataDukungId">

            {{-- CONTENT --}}
            <div class="modal-body px-8 py-6">

                {{-- INFORMASI DATA DUKUNG --}}
                <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <h4 class="mb-3 text-sm font-bold text-[#17256b] dark:text-blue-400">
                        Informasi Data Dukung
                    </h4>
                    <div class="grid grid-cols-[130px_20px_1fr] gap-y-3 text-sm">
                        <div class="text-gray-600 dark:text-gray-400">Nama</div>
                        <div class="text-gray-500 dark:text-gray-500">:</div>
                        <div id="uploadDataDukungName" class="font-medium text-gray-800 dark:text-gray-200">-</div>

                        <div class="text-gray-600 dark:text-gray-400">Status Mandiri</div>
                        <div class="text-gray-500 dark:text-gray-500">:</div>
                        <div>
                            <span class="inline-flex rounded-full bg-[#ffdfe1] px-4 py-1 text-xs font-bold text-red-600 dark:bg-red-900/40 dark:text-red-400">
                                Belum Upload
                            </span>
                        </div>
                    </div>
                </div>

                {{-- KETENTUAN --}}
                <div class="mt-5 rounded-xl border border-[#2dd4bf] bg-[#f0fdfa] p-5 dark:border-teal-700 dark:bg-teal-900/20">
                    <div class="flex gap-3.5">
                        <div class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-[#12a89d] text-xs font-bold text-white">i</div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-900 dark:text-gray-100">Ketentuan Upload</h4>
                            <ul class="mt-2 space-y-1.5 text-sm text-gray-600 dark:text-gray-300">
                                <li>• Format file yang diizinkan: PDF, DOC, DOCX</li>
                                <li>• Ukuran maksimal file: 20 MB</li>
                                <li>• Pastikan dokumen dapat dibuka dan tidak diproteksi kata sandi</li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- FILE / DOKUMEN BUKTI --}}
                <div class="mt-5">
                    <label class="mb-2 block text-sm font-semibold text-gray-800 dark:text-gray-200">
                        Dokumen Bukti <span class="text-red-500">*</span>
                    </label>

                    {{-- State 1: Dropzone --}}
                    <label id="uploadDropzone" for="uploadDokumen" class="flex cursor-pointer flex-col items-center justify-center rounded-xl border-2 border-dashed border-[#12a89d] bg-[#ffffff] py-7 text-center transition hover:bg-[#f0fdfa] dark:border-teal-600 dark:bg-gray-800 dark:hover:bg-teal-900/10">
                        <div class="mb-2 flex h-10 w-10 items-center justify-center rounded-full bg-[#e4f6f4] dark:bg-teal-900/40">
                            <svg class="h-5 w-5 text-[#12a89d]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-gray-800 dark:text-gray-100">Klik untuk memilih dokumen</span>
                        <span class="mt-1 text-xs text-gray-400 dark:text-gray-400">PDF, DOC, DOCX • Maks. 20 MB</span>
                    </label>

                    {{-- State 2: Selected File Card (Lengkap dengan Ukuran, Tanggal, & Nama Pengguna) --}}
                    <div id="uploadSelectedArea" class="hidden rounded-xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                        <h4 class="mb-3 text-sm font-bold text-[#17256b] dark:text-blue-400">Dokumen Saat Ini</h4>
                        <div class="flex items-center justify-between rounded-lg border border-gray-200 p-4 dark:border-gray-700">
                            <div class="flex items-start gap-4">
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-red-100 text-red-600 dark:bg-red-900/30 dark:text-red-400">
                                    <svg class="h-7 w-7" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zm-1 1.5L18.5 9H13V3.5zM6 20V4h5v6h6v10H6z"/>
                                    </svg>
                                </div>
                                <div class="min-w-0 text-sm">
                                    <div id="uploadFileName" class="truncate font-bold text-gray-800 dark:text-gray-200">-</div>
                                    <div class="mt-1 grid grid-cols-[100px_10px_1fr] gap-y-1 text-xs text-gray-500 dark:text-gray-400">
                                        <div>Ukuran File</div>
                                        <div>:</div>
                                        <span id="uploadFileSize">-</span>

                                        <div>Tanggal Upload</div>
                                        <div>:</div>
                                        <span id="uploadFileDate">-</span>

                                        <div>Diunggah Oleh</div>
                                        <div>:</div>
                                        <span>{{ Auth::user()->name ?? 'Pengguna' }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            {{-- Tombol Hapus --}}
                            <button type="button" onclick="removeSelectedFile()" class="ml-4 flex shrink-0 items-center gap-1 rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600 transition hover:bg-red-100 dark:border-red-900/30 dark:bg-red-900/20 dark:text-red-400">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Hapus
                            </button>
                        </div>
                    </div>
                    
                    <input id="uploadDokumen" type="file" name="dokumen" required accept=".pdf,.doc,.docx" class="hidden">
                </div>

                {{-- CATATAN MANDIRI --}}
                <div class="mt-5">
                    <label for="uploadCatatan" class="mb-2 flex items-center text-sm font-semibold text-gray-800 dark:text-gray-200">
                        Catatan Mandiri <span class="text-red-500 ml-0.5">*</span>
                        <span class="ml-1.5 text-xs font-normal text-red-500">min: 10 kata, max: 1000 karakter</span>
                    </label>
                    
                    <textarea id="uploadCatatan" name="catatan_user" rows="4" maxlength="1000" required class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm leading-6 text-gray-700 outline-none transition placeholder:text-gray-400 focus:border-[#12a89d] focus:ring-1 focus:ring-[#12a89d] dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100 dark:placeholder:text-gray-500" placeholder="Tambahkan catatan terkait dokumen (opsional)"></textarea>

                    <div class="mt-1.5 flex items-center justify-between text-xs">
                        <span id="uploadCatatanWordInfo" class="text-gray-500 dark:text-gray-400">0 kata</span>
                        <span id="uploadCatatanCounter" class="text-gray-400 dark:text-gray-500">0 / 1000</span>
                    </div>

                    <p id="uploadCatatanError" class="mt-1 hidden text-xs text-red-500">
                        Catatan wajib diisi minimal 10 kata.
                    </p>
                </div>

            </div>

            {{-- FOOTER --}}
            <div class="modal-footer flex justify-end gap-3 border-t border-gray-200 bg-gray-50 px-8 py-5 dark:border-gray-700 dark:bg-gray-800/50">
                <button type="button" onclick="closeUploadModal()" class="rounded-lg border border-gray-300 bg-white px-6 py-2.5 text-sm font-semibold text-gray-600 shadow-sm transition hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                    Batal
                </button>

                <button type="submit" class="rounded-lg bg-[#00baba] px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#00a0a0]">
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
        if (!data) return;

        activeUploadDataDukungId = dataDukungId;

        document.getElementById('uploadForm').reset();
        removeSelectedFile(); 

        document.getElementById('uploadDataDukungId').value = data.id;
        document.getElementById('uploadDataDukungName').textContent = data.name;

        document.getElementById('uploadCatatanCounter').textContent = '0 / 1000';
        document.getElementById('uploadCatatanWordInfo').textContent = '0 kata';
        document.getElementById('uploadCatatanError').classList.add('hidden');
        document.getElementById('uploadCatatan').classList.remove('border-red-400');

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

    document.getElementById('uploadDokumen').addEventListener('change', function() {
        const file = this.files[0];
        const dropzone = document.getElementById('uploadDropzone');
        const selectedArea = document.getElementById('uploadSelectedArea');

        if (!file) {
            removeSelectedFile();
            return;
        }

        // Format tanggal hari ini secara otomatis (contoh: 7 Oktober 2026 09:05 WIB)
        const now = new Date();
        const options = { day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit', hour12: false };
        const formattedDate = now.toLocaleDateString('id-ID', options) + ' WIB';

        document.getElementById('uploadFileName').textContent = file.name;
        document.getElementById('uploadFileSize').textContent = formatUploadFileSize(file.size);
        document.getElementById('uploadFileDate').textContent = formattedDate;
        
        dropzone.classList.add('hidden');
        dropzone.classList.remove('flex');
        selectedArea.classList.remove('hidden');
    });

    function removeSelectedFile() {
        document.getElementById('uploadDokumen').value = '';
        
        const dropzone = document.getElementById('uploadDropzone');
        const selectedArea = document.getElementById('uploadSelectedArea');
        
        selectedArea.classList.add('hidden');
        dropzone.classList.remove('hidden');
        dropzone.classList.add('flex');
    }

    function countUploadWords(text) {
        const cleanText = text.trim();
        if (!cleanText) return 0;
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

    document.getElementById('uploadForm').addEventListener('submit', function(event) {
        if (!validateUploadNote()) {
            event.preventDefault();
            document.getElementById('uploadCatatan').focus();
        }
    });

    function formatUploadFileSize(bytes) {
        if (!bytes || bytes <= 0) return '0 B';
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