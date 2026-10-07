{{-- =========================================================
    EDIT MODAL
========================================================= --}}
<div id="editModal" class="fixed inset-0 z-[10002] hidden items-center justify-center bg-black/60 p-4 backdrop-blur-sm transition-opacity">
    <div class="modal-shell w-full max-w-4xl max-h-[95vh] overflow-y-auto rounded-2xl bg-white shadow-2xl dark:bg-gray-900">

        {{-- HEADER --}}
        <div class="modal-header flex items-start justify-between border-b border-gray-200 px-8 py-5 dark:border-gray-700">
            <div>
                <h3 class="text-[22px] font-extrabold text-gray-900 dark:text-gray-100">
                    Edit Dokumen
                </h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Perbarui dokumen dan catatan mandiri.
                </p>
            </div>

            <button type="button" onclick="closeEditModal()" class="text-3xl leading-none text-gray-400 transition hover:text-gray-700 dark:text-gray-300 dark:hover:text-white">
                &times;
            </button>
        </div>

        {{-- FORM --}}
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="hidden" id="editDataDukungId">

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
                        <div id="editDataDukungName" class="font-medium text-gray-800 dark:text-gray-200">-</div>

                        <div class="text-gray-600 dark:text-gray-400">Status Mandiri</div>
                        <div class="text-gray-500 dark:text-gray-500">:</div>
                        <div>
                            <span id="editStatusBadge" class="inline-flex rounded-full px-4 py-1 text-xs font-bold bg-[#dcecff] text-blue-600 dark:bg-blue-900/40 dark:text-blue-400">
                                Upload
                            </span>
                        </div>
                    </div>
                </div>

                {{-- DOKUMEN SAAT INI --}}
                <div id="editDocumentWrapper">
                    <h4 class="mb-2 text-sm font-semibold text-gray-800 dark:text-gray-200">
                        Dokumen Saat Ini
                    </h4>

                    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                        <div class="flex items-center justify-between rounded-lg border border-gray-200 p-4 dark:border-gray-700">
                            <div class="flex items-start gap-4">
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-red-100 text-red-600 dark:bg-red-900/30 dark:text-red-400">
                                    <svg class="h-7 w-7" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zm-1 1.5L18.5 9H13V3.5zM6 20V4h5v6h6v10H6z"/>
                                    </svg>
                                </div>
                                <div class="min-w-0 text-sm">
                                    <div id="editCurrentFile" class="truncate font-bold text-gray-800 dark:text-gray-200">Belum ada dokumen.</div>
                                    <div class="mt-1 grid grid-cols-[100px_10px_1fr] gap-y-1 text-xs text-gray-500 dark:text-gray-400">
                                        <div>Ukuran File</div>
                                        <div>:</div>
                                        <span id="editCurrentFileSize">-</span>

                                        <div>Tanggal Upload</div>
                                        <div>:</div>
                                        <span id="editCurrentFileDate">-</span>

                                        <div>Diunggah Oleh</div>
                                        <div>:</div>
                                        <span>{{ Auth::user()->name ?? 'Pengguna' }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="ml-4 flex shrink-0 items-center gap-2">
                                <a id="editCurrentFileLink" href="#" target="_blank" rel="noopener noreferrer" class="hidden rounded-lg border border-[#12a89d] bg-white px-4 py-1.5 text-xs font-semibold text-[#12a89d] transition hover:bg-[#eafafa] dark:bg-transparent dark:hover:bg-teal-950/30">
                                    Lihat
                                </a>

                                <button type="button" id="editDeleteButton" onclick="deleteCurrentDocument()" class="hidden rounded-lg border border-red-200 bg-red-50 px-4 py-1.5 text-xs font-semibold text-red-600 transition hover:bg-red-100 dark:border-red-900/30 dark:bg-red-900/20 dark:text-red-400">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- GANTI DOKUMEN --}}
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-800 dark:text-gray-200">
                        Ganti Dokumen <span class="text-xs font-normal text-gray-400">(Opsional)</span>
                    </label>

                    {{-- Dropzone Awal --}}
                    <label id="editDropzone" for="editDokumen" class="flex cursor-pointer flex-col items-center justify-center rounded-xl border-2 border-dashed border-[#12a89d] bg-white py-6 text-center transition hover:bg-[#f0fdfa] dark:border-teal-600 dark:bg-gray-800 dark:hover:bg-teal-900/10">
                        <div class="mb-1.5 flex h-9 w-9 items-center justify-center rounded-full bg-[#e4f6f4] dark:bg-teal-900/40">
                            <svg class="h-4 w-4 text-[#12a89d]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-gray-800 dark:text-gray-100">Klik untuk mengganti dokumen</span>
                        <span class="mt-0.5 text-xs text-gray-400">PDF, DOC, DOCX • Maks. 20 MB</span>
                    </label>

                    {{-- Card File Baru (Desain Identik dengan "Dokumen Saat Ini") --}}
                    <div id="editSelectedArea" class="hidden rounded-xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                        <div class="flex items-center justify-between rounded-lg border border-gray-200 p-4 dark:border-gray-700">
                            <div class="flex items-start gap-4">
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-teal-100 text-teal-600 dark:bg-teal-900/30 dark:text-teal-400">
                                    <svg class="h-7 w-7" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zm-1 1.5L18.5 9H13V3.5zM6 20V4h5v6h6v10H6z"/>
                                    </svg>
                                </div>
                                <div class="min-w-0 text-sm">
                                    <div id="editSelectedFileName" class="truncate font-bold text-gray-800 dark:text-gray-200">-</div>
                                    <div class="mt-1 grid grid-cols-[100px_10px_1fr] gap-y-1 text-xs text-gray-500 dark:text-gray-400">
                                        <div>Ukuran File</div>
                                        <div>:</div>
                                        <span id="editSelectedFileSize">-</span>

                                        <div>Tanggal Upload</div>
                                        <div>:</div>
                                        <span id="editSelectedFileDate">-</span>

                                        <div>Diunggah Oleh</div>
                                        <div>:</div>
                                        <span>{{ Auth::user()->name ?? 'Pengguna' }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="ml-4 flex shrink-0 items-center gap-2">
                                <button type="button" class="cursor-not-allowed rounded-lg border border-[#12a89d] bg-white px-4 py-1.5 text-xs font-semibold text-[#12a89d] opacity-50 dark:bg-transparent" title="Dokumen belum di-upload">
                                    Lihat
                                </button>

                                <button type="button" onclick="removeEditSelectedFile()" class="rounded-lg border border-red-200 bg-red-50 px-4 py-1.5 text-xs font-semibold text-red-600 transition hover:bg-red-100 dark:border-red-900/30 dark:bg-red-900/20 dark:text-red-400">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>

                    <input id="editDokumen" type="file" name="dokumen" accept=".pdf,.doc,.docx" class="hidden">
                </div>

                {{-- CATATAN MANDIRI --}}
                <div>
                    <label for="editCatatan" class="mb-2 flex items-center text-sm font-semibold text-gray-800 dark:text-gray-200">
                        Catatan Mandiri <span class="text-red-500 ml-0.5">*</span>
                        <span class="ml-1.5 text-xs font-normal text-red-500">min: 10 kata, max: 1000 karakter</span>
                    </label>
                    
                    <textarea id="editCatatan" name="catatan_user" rows="4" maxlength="1000" required class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm leading-6 text-gray-700 outline-none transition placeholder:text-gray-400 focus:border-[#12a89d] focus:ring-1 focus:ring-[#12a89d] dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100 dark:placeholder:text-gray-500" placeholder="Masukkan catatan mandiri..."></textarea>

                    <div class="mt-1.5 flex items-center justify-between text-xs">
                        <span id="editCatatanWordInfo" class="text-gray-500 dark:text-gray-400">0 kata</span>
                        <span id="editCatatanCounter" class="text-gray-400 dark:text-gray-500">0 / 1000</span>
                    </div>

                    <p id="editCatatanError" class="mt-1 hidden text-xs text-red-500">
                        Catatan wajib diisi minimal 10 kata.
                    </p>
                </div>

            </div>

            {{-- FOOTER --}}
            <div class="modal-footer flex justify-end gap-3 border-t border-gray-200 bg-gray-50 px-8 py-5 dark:border-gray-700 dark:bg-gray-800/50">
                <button type="button" onclick="closeEditModal()" class="rounded-lg border border-gray-300 bg-white px-6 py-2.5 text-sm font-semibold text-gray-600 shadow-sm transition hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                    Batal
                </button>

                <button type="submit" class="rounded-lg bg-[#00baba] px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#00a0a0]">
                    Simpan
                </button>
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
                                    ? \Carbon\Carbon::parse($dokumen->created_at)->format('d/m/Y H:i') . ' WIB'
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
        if (!data) return;

        activeEditDataDukungId = dataDukungId;

        document.getElementById('editForm').action = "{{ url('/user/penilaian/internal') }}/" + "{{ $indikator->id_indikator }}" + "/edit/" + dataDukungId;
        document.getElementById('editDataDukungId').value = dataDukungId;
        document.getElementById('editDataDukungName').textContent = data.name;
        document.getElementById('editStatusBadge').textContent = formatEditStatus(data.status);

        const dokumen = data.dokumen && data.dokumen.length ? data.dokumen[0] : null;

        if (dokumen) {
            document.getElementById('editCurrentFile').textContent = dokumen.name;
            document.getElementById('editCurrentFileSize').textContent = formatEditFileSize(dokumen.size);
            document.getElementById('editCurrentFileDate').textContent = dokumen.createdAt;
            document.getElementById('editCurrentFileLink').href = dokumen.url;

            document.getElementById('editCurrentFileLink').classList.remove('hidden');
            document.getElementById('editDeleteButton').classList.remove('hidden');
            document.getElementById('editCatatan').value = dokumen.note || data.keterangan || '';
        } else {
            document.getElementById('editCurrentFile').textContent = 'Belum ada dokumen.';
            document.getElementById('editCurrentFileSize').textContent = '-';
            document.getElementById('editCurrentFileDate').textContent = '-';

            document.getElementById('editCurrentFileLink').classList.add('hidden');
            document.getElementById('editDeleteButton').classList.add('hidden');
            document.getElementById('editCatatan').value = data.keterangan || '';
        }

        removeEditSelectedFile();
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

    // Toggle tampilan saat dokumen baru dipilih
    document.getElementById('editDokumen').addEventListener('change', function() {
        const file = this.files[0];
        const dropzone = document.getElementById('editDropzone');
        const selectedArea = document.getElementById('editSelectedArea');

        if (!file) {
            removeEditSelectedFile();
            return;
        }

        // Format tanggal sekarang
        const now = new Date();
        const options = { day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit', hour12: false };
        const formattedDate = now.toLocaleDateString('id-ID', options) + ' WIB';

        document.getElementById('editSelectedFileName').textContent = file.name;
        document.getElementById('editSelectedFileSize').textContent = formatEditFileSize(file.size);
        document.getElementById('editSelectedFileDate').textContent = formattedDate;

        dropzone.classList.add('hidden');
        dropzone.classList.remove('flex');
        selectedArea.classList.remove('hidden');
    });

    function removeEditSelectedFile() {
        document.getElementById('editDokumen').value = '';

        const dropzone = document.getElementById('editDropzone');
        const selectedArea = document.getElementById('editSelectedArea');

        selectedArea.classList.add('hidden');
        dropzone.classList.remove('hidden');
        dropzone.classList.add('flex');
    }

    function countEditWords(text) {
        const cleanText = text.trim();
        if (!cleanText) return 0;
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

    function deleteCurrentDocument() {
        const data = editDocumentData[activeEditDataDukungId];
        if (!data || !data.dokumen || !data.dokumen.length) return;

        const dokumen = data.dokumen[0];
        if (!confirm('Apakah Anda yakin ingin menghapus dokumen ini?')) return;

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

    document.getElementById('editModal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeEditModal();
        }
    });
</script>