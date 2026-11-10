@extends('layouts.app')

@section('title', 'Pengaduan & Reschedule (AJAX) - ParkTrack')

@section('content')
<div class="max-w-6xl mx-auto mb-12">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-white flex items-center">
                <i class="bi bi-chat-left-dots-fill text-brand-500 mr-3"></i>Pengaduan & Permintaan Reschedule
            </h2>
            <p class="text-slate-400 text-sm mt-1">
                Pencatatan dan pengelolaan aduan parkir serta unggah bukti tiket tanpa muat ulang halaman (AJAX).
            </p>
        </div>
        <button type="button" id="addBtn" class="bg-brand-500 hover:bg-brand-600 text-white font-bold px-5 py-2.5 rounded-xl text-sm transition-colors shadow-lg shadow-brand-500/20 flex items-center cursor-pointer">
            <i class="bi bi-plus-lg mr-2"></i>Buat Pengaduan
        </button>
    </div>

    <div id="alert-container" class="mb-5"></div>

    <div class="bg-slate-800 border border-slate-700 rounded-2xl overflow-hidden shadow-lg">
        <div class="p-5 border-b border-slate-700 flex flex-col sm:flex-row justify-between items-stretch sm:items-center gap-3">
            <div class="font-semibold text-white flex items-center gap-2">
                <span>Daftar Pengaduan</span>
                <span id="total-count" class="bg-slate-900 border border-slate-700 text-brand-400 text-xs font-bold px-2.5 py-0.5 rounded-full">0</span>
            </div>
            <div class="relative sm:w-80">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                    <i class="bi bi-search"></i>
                </div>
                <input
                    type="search"
                    id="search"
                    placeholder="Cari pengemudi, plat nomor, kategori..."
                    class="w-full bg-slate-900 border border-slate-700 text-slate-50 text-sm rounded-xl focus:ring-brand-500 focus:border-brand-500 block pl-10 p-2.5"
                >
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-300" id="pengaduan-table">
                <thead class="text-xs text-slate-400 uppercase bg-slate-900/60 border-b border-slate-700">
                    <tr>
                        <th class="px-4 py-4 w-12">No</th>
                        <th class="px-4 py-4">Pengemudi & Kontak</th>
                        <th class="px-4 py-4">Plat Nomor</th>
                        <th class="px-4 py-4">Kategori</th>
                        <th class="px-4 py-4">Jadwal Baru</th>
                        <th class="px-4 py-4">Deskripsi</th>
                        <th class="px-4 py-4">Status</th>
                        <th class="px-4 py-4">Bukti File</th>
                        <th class="px-4 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/50">
                    <tr>
                        <td colspan="9" class="px-5 py-12 text-center text-slate-400">
                            <i class="bi bi-arrow-repeat animate-spin inline-block mr-2"></i>Memuat data pengaduan...
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="pengaduanModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/75 backdrop-blur-xs p-4 overflow-y-auto">
    <div class="bg-slate-800 border border-slate-700 rounded-2xl shadow-2xl w-full max-w-xl overflow-hidden my-8">
        <div class="bg-slate-900 border-b border-slate-700 px-6 py-4 flex justify-between items-center">
            <h5 class="font-bold text-white text-lg" id="pengaduanModalLabel">Buat Pengaduan</h5>
            <button type="button" id="closeModalBtn" class="text-slate-400 hover:text-white text-xl leading-none cursor-pointer">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="p-6 max-h-[80vh] overflow-y-auto">
            <form id="pengaduanForm" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="id" id="id">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="nama_pengemudi" class="block text-sm font-semibold text-slate-300 mb-1.5">
                            Nama Pengemudi <span class="text-red-400">*</span>
                        </label>
                        <input
                            type="text"
                            id="nama_pengemudi"
                            name="nama_pengemudi"
                            value="{{ auth()->user()->name }}"
                            placeholder="Nama lengkap pengemudi"
                            required
                            class="w-full bg-slate-900 border border-slate-700 rounded-xl p-2.5 text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500"
                        >
                        <p class="text-red-400 text-xs mt-1 hidden error-text" id="nama_pengemudi-error"></p>
                    </div>

                    <div>
                        <label for="kontak" class="block text-sm font-semibold text-slate-300 mb-1.5">
                            Kontak (No. HP / Email) <span class="text-red-400">*</span>
                        </label>
                        <input
                            type="text"
                            id="kontak"
                            name="kontak"
                            value="{{ auth()->user()->phone ?? auth()->user()->email }}"
                            placeholder="0812xxxx / email@domain.com"
                            required
                            class="w-full bg-slate-900 border border-slate-700 rounded-xl p-2.5 text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500"
                        >
                        <p class="text-red-400 text-xs mt-1 hidden error-text" id="kontak-error"></p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="plat_nomor" class="block text-sm font-semibold text-slate-300 mb-1.5">
                            Plat Nomor Kendaraan <span class="text-red-400">*</span>
                        </label>
                        <input
                            type="text"
                            id="plat_nomor"
                            name="plat_nomor"
                            placeholder="Contoh: B 1234 ABC"
                            required
                            class="w-full bg-slate-900 border border-slate-700 rounded-xl p-2.5 text-white text-sm uppercase font-mono focus:ring-2 focus:ring-brand-500 focus:border-brand-500"
                        >
                        <p class="text-red-400 text-xs mt-1 hidden error-text" id="plat_nomor-error"></p>
                    </div>

                    <div>
                        <label for="kategori" class="block text-sm font-semibold text-slate-300 mb-1.5">
                            Kategori Pengaduan <span class="text-red-400">*</span>
                        </label>
                        <select
                            id="kategori"
                            name="kategori"
                            required
                            class="w-full bg-slate-900 border border-slate-700 rounded-xl p-2.5 text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500"
                        >
                            <option value="Reschedule Jadwal">Reschedule Jadwal</option>
                            <option value="Masalah Slot">Masalah Slot</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                        <p class="text-red-400 text-xs mt-1 hidden error-text" id="kategori-error"></p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="jadwal_baru" class="block text-sm font-semibold text-slate-300 mb-1.5">
                            Jadwal Reservasi Baru
                        </label>
                        <input
                            type="datetime-local"
                            id="jadwal_baru"
                            name="jadwal_baru"
                            style="color-scheme: dark;"
                            class="w-full bg-slate-900 border border-slate-700 rounded-xl p-2.5 text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500"
                        >
                        <p class="text-red-400 text-xs mt-1 hidden error-text" id="jadwal_baru-error"></p>
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-semibold text-slate-300 mb-1.5">
                            Status Penanganan <span class="text-red-400">*</span>
                        </label>
                        <select
                            id="status"
                            name="status"
                            @disabled(! auth()->user()->isOfficer())
                            class="w-full bg-slate-900 border border-slate-700 rounded-xl p-2.5 text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 disabled:opacity-60"
                        >
                            <option value="Menunggu">Menunggu</option>
                            <option value="Diproses">Diproses</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                        <p class="text-red-400 text-xs mt-1 hidden error-text" id="status-error"></p>
                    </div>
                </div>

                <div>
                    <label for="deskripsi" class="block text-sm font-semibold text-slate-300 mb-1.5">
                        Deskripsi Kendala / Alasan Reschedule <span class="text-red-400">*</span>
                    </label>
                    <textarea
                        id="deskripsi"
                        name="deskripsi"
                        rows="3"
                        placeholder="Jelaskan detail kendala parkir atau alasan perubahan jadwal..."
                        required
                        class="w-full bg-slate-900 border border-slate-700 rounded-xl p-2.5 text-white text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500"
                    ></textarea>
                    <p class="text-red-400 text-xs mt-1 hidden error-text" id="deskripsi-error"></p>
                </div>

                <div>
                    <label for="file_bukti" class="block text-sm font-semibold text-slate-300 mb-1.5">
                        Unggah Bukti Tiket / Foto Kendala <span class="text-red-400" id="berkas-required">*</span>
                    </label>
                    <div id="berkas-current" class="hidden mb-2 p-2.5 bg-slate-900 border border-slate-700 rounded-xl text-xs text-slate-300 flex items-center justify-between">
                        <span>Berkas saat ini:</span>
                        <a href="#" target="_blank" rel="noopener" id="berkas-current-link" class="text-brand-400 hover:underline font-semibold inline-flex items-center gap-1">
                            <i class="bi bi-box-arrow-up-right"></i>
                            <span id="berkas-current-name">Lihat Bukti</span>
                        </a>
                    </div>
                    <input
                        type="file"
                        id="file_bukti"
                        name="file_bukti"
                        accept=".jpg,.jpeg,.png,.pdf"
                        class="w-full bg-slate-900 border border-slate-700 rounded-xl p-2 text-white text-sm file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-brand-500 file:text-white hover:file:bg-brand-600 cursor-pointer"
                    >
                    <p class="text-red-400 text-xs mt-1 hidden error-text" id="file_bukti-error"></p>
                    <p class="text-slate-400 text-xs mt-1" id="berkas-help">Format jpg, jpeg, png, atau pdf. Maksimal 2 MB.</p>
                </div>
            </form>
        </div>
        <div class="bg-slate-900 border-t border-slate-700 px-6 py-4 flex justify-end gap-3">
            <button type="button" id="cancelModalBtn" class="border border-slate-600 text-slate-300 hover:text-white px-5 py-2 rounded-xl text-sm font-medium transition-colors cursor-pointer">
                Batal
            </button>
            <button type="button" id="saveBtn" class="bg-brand-500 hover:bg-brand-600 text-white font-bold px-6 py-2 rounded-xl text-sm transition-colors cursor-pointer flex items-center gap-2">
                <i class="bi bi-arrow-repeat animate-spin hidden" id="saveSpinner"></i>
                <span class="submit-text">Simpan</span>
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        const urls = {
            data: "{{ route('pengaduan.data') }}",
            store: "{{ route('pengaduan.store') }}",
            edit: "{{ route('pengaduan.edit', ':id') }}",
            update: "{{ route('pengaduan.update', ':id') }}",
            destroy: "{{ route('pengaduan.destroy', ':id') }}",
        };

        const defaultNama = @json(auth()->user()->name);
        const defaultKontak = @json(auth()->user()->phone ?? auth()->user()->email);

        let records = [];

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json'
            }
        });

        function escapeHtml(value) {
            return String(value ?? '')
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        function openModal() {
            $('#pengaduanModal').removeClass('hidden').addClass('flex');
            $('#nama_pengemudi').trigger('focus');
        }

        function closeModal() {
            $('#pengaduanModal').removeClass('flex').addClass('hidden');
            $('#pengaduanForm')[0].reset();
            $('#id').val('');
            $('#nama_pengemudi').val(defaultNama);
            $('#kontak').val(defaultKontak);
            $('#status').val('Menunggu');
            clearErrors();
            setFileMode();
        }

        $('#closeModalBtn, #cancelModalBtn').on('click', closeModal);

        function fileLink(item) {
            if (! item.file_bukti_url) {
                return '<span class="text-slate-500">-</span>';
            }
            const fileName = item.display_nama_berkas || 'Lihat Bukti';
            const isPdf = fileName.toLowerCase().endsWith('.pdf');
            const icon = isPdf ? 'bi-file-earmark-pdf-fill text-red-400' : 'bi-file-earmark-image-fill text-brand-400';
            return `<a href="${escapeHtml(item.file_bukti_url)}" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 text-xs font-semibold text-brand-400 hover:text-brand-300 hover:underline">
                        <i class="bi ${icon}"></i>
                        <span>${escapeHtml(fileName)}</span>
                    </a>`;
        }

        function setFileMode(item = null) {
            $('#file_bukti').val('');
            $('#berkas-required').toggleClass('hidden', item !== null);
            $('#berkas-current').toggleClass('hidden', ! item?.file_bukti_url);
            $('#berkas-help').text(item
                ? 'Kosongkan jika tidak ingin mengganti berkas. Format jpg, jpeg, png, atau pdf. Maksimal 2 MB.'
                : 'Format jpg, jpeg, png, atau pdf. Maksimal 2 MB.');
            if (item?.file_bukti_url) {
                $('#berkas-current-link').attr('href', item.file_bukti_url);
                $('#berkas-current-name').text(item.display_nama_berkas || 'Lihat Bukti');
            }
        }

        function showAlert(message, type = 'success') {
            const isSuccess = type === 'success';
            const style = isSuccess
                ? 'bg-emerald-500/20 border-emerald-500/40 text-emerald-300'
                : 'bg-red-500/20 border-red-500/40 text-red-300';
            const icon = isSuccess ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill';

            const alertEl = $(`
                <div class="border ${style} px-4 py-3 rounded-xl flex items-center justify-between gap-3">
                    <div class="flex items-center gap-2">
                        <i class="bi ${icon}"></i>
                        <span class="text-sm font-medium">${escapeHtml(message)}</span>
                    </div>
                    <button type="button" class="text-sm opacity-75 hover:opacity-100 cursor-pointer" onclick="$(this).parent().remove()">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            `);
            $('#alert-container').html(alertEl);
            setTimeout(() => alertEl.fadeOut(300, function () { $(this).remove(); }), 4000);
        }

        function clearErrors() {
            $('#pengaduanForm .error-text').text('').addClass('hidden');
            $('#pengaduanForm input, #pengaduanForm select, #pengaduanForm textarea').removeClass('border-red-500').addClass('border-slate-700');
        }

        function formatJadwal(val) {
            if (! val) {
                return '<span class="text-slate-500">-</span>';
            }
            const clean = String(val).replace('T', ' ').substring(0, 16);
            return `<span class="text-emerald-400 font-medium text-xs">${escapeHtml(clean)}</span>`;
        }

        function renderTable() {
            const keyword = $('#search').val().trim().toLowerCase();
            const rows = records.filter((item) =>
                [item.nama_pengemudi, item.kontak, item.plat_nomor, item.kategori, item.deskripsi, item.status]
                    .some((value) => (value || '').toLowerCase().includes(keyword))
            );

            $('#total-count').text(records.length);

            if (records.length === 0) {
                $('#pengaduan-table tbody').html(`
                    <tr>
                        <td colspan="9" class="px-5 py-12 text-center text-slate-400">
                            <i class="bi bi-inbox text-4xl text-slate-600 block mb-2"></i>
                            <p>Belum ada data pengaduan. Klik <strong>Buat Pengaduan</strong> untuk memulai.</p>
                        </td>
                    </tr>
                `);
                return;
            }

            if (rows.length === 0) {
                $('#pengaduan-table tbody').html(`
                    <tr>
                        <td colspan="9" class="px-5 py-12 text-center text-slate-400">
                            <i class="bi bi-search text-4xl text-slate-600 block mb-2"></i>
                            <p>Tidak ada data pengaduan yang cocok dengan pencarian.</p>
                        </td>
                    </tr>
                `);
                return;
            }

            const html = rows.map((item, index) => {
                let statusBadge = 'bg-amber-500/15 text-amber-400 border-amber-500/30';
                if (item.status === 'Diproses') {
                    statusBadge = 'bg-blue-500/15 text-blue-400 border-blue-500/30';
                } else if (item.status === 'Selesai') {
                    statusBadge = 'bg-emerald-500/15 text-emerald-400 border-emerald-500/30';
                }

                return `
                    <tr class="hover:bg-slate-700/20 transition-colors">
                        <td class="px-4 py-4 text-slate-400">${index + 1}</td>
                        <td class="px-4 py-4">
                            <div class="font-bold text-white">${escapeHtml(item.nama_pengemudi)}</div>
                            <div class="text-xs text-slate-400 mt-0.5"><i class="bi bi-telephone text-brand-400 mr-1"></i>${escapeHtml(item.kontak)}</div>
                        </td>
                        <td class="px-4 py-4">
                            <span class="bg-slate-900 px-2.5 py-1 rounded text-xs font-mono border border-slate-700 text-white uppercase font-bold tracking-wider">
                                ${escapeHtml(item.plat_nomor)}
                            </span>
                        </td>
                        <td class="px-4 py-4">
                            <span class="text-xs px-2.5 py-1 rounded-full bg-slate-700 text-slate-200 font-medium">
                                ${escapeHtml(item.kategori)}
                            </span>
                        </td>
                        <td class="px-4 py-4">${formatJadwal(item.jadwal_baru)}</td>
                        <td class="px-4 py-4 max-w-xs">
                            <p class="text-xs text-slate-300 line-clamp-2">${escapeHtml(item.deskripsi)}</p>
                        </td>
                        <td class="px-4 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-bold border ${statusBadge}">
                                ${escapeHtml(item.status)}
                            </span>
                        </td>
                        <td class="px-4 py-4">${fileLink(item)}</td>
                        <td class="px-4 py-4 text-right whitespace-nowrap">
                            <div class="inline-flex items-center gap-2">
                                <button data-id="${item.id}" class="edit bg-amber-500/20 hover:bg-amber-500 text-amber-300 hover:text-slate-900 border border-amber-500/30 font-semibold px-3 py-1.5 rounded-lg text-xs transition-colors cursor-pointer">
                                    <i class="bi bi-pencil mr-1"></i>Edit
                                </button>
                                <button data-id="${item.id}" data-nama="${escapeHtml(item.nama_pengemudi)}" class="delete bg-red-500/20 hover:bg-red-500 text-red-300 hover:text-white border border-red-500/30 font-semibold px-3 py-1.5 rounded-lg text-xs transition-colors cursor-pointer">
                                    <i class="bi bi-trash mr-1"></i>Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            }).join('');

            $('#pengaduan-table tbody').html(html);
        }

        function loadData() {
            $.ajax({
                url: urls.data,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    records = data;
                    renderTable();
                },
                error: function () {
                    $('#pengaduan-table tbody').html(`
                        <tr>
                            <td colspan="9" class="px-5 py-12 text-center text-red-400">
                                <i class="bi bi-wifi-off text-3xl block mb-2"></i>
                                Gagal memuat data pengaduan. Silakan muat ulang halaman.
                            </td>
                        </tr>
                    `);
                }
            });
        }

        loadData();
        $('#search').on('input', renderTable);

        $('#addBtn').on('click', function () {
            closeModal();
            $('#pengaduanModalLabel').text('Buat Pengaduan Baru');
            setFileMode();
            openModal();
        });

        $('#pengaduanForm').on('submit', function (e) {
            e.preventDefault();
            $('#saveBtn').trigger('click');
        });

        $('#saveBtn').on('click', function () {
            const btn = $(this);
            const id = $('#id').val();

            btn.prop('disabled', true);
            btn.find('.submit-text').text('Menyimpan...');
            $('#saveSpinner').removeClass('hidden');
            clearErrors();

            const formData = new FormData(document.getElementById('pengaduanForm'));
            if (id) {
                formData.append('_method', 'PUT');
            }

            $.ajax({
                url: id ? urls.update.replace(':id', id) : urls.store,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function (response) {
                    closeModal();
                    loadData();
                    showAlert(response.success, 'success');
                },
                error: function (xhr) {
                    if (xhr.status === 422 && xhr.responseJSON?.errors) {
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            $(`#${key}`).removeClass('border-slate-700').addClass('border-red-500');
                            $(`#${key}-error`).text(value[0]).removeClass('hidden');
                        });
                    } else {
                        closeModal();
                        showAlert('Terjadi kesalahan saat menyimpan data.', 'danger');
                    }
                },
                complete: function () {
                    btn.prop('disabled', false);
                    btn.find('.submit-text').text('Simpan');
                    $('#saveSpinner').addClass('hidden');
                }
            });
        });

        $(document).on('click', '.edit', function () {
            const id = $(this).data('id');
            $.get(urls.edit.replace(':id', id), function (data) {
                clearErrors();
                $('#pengaduanModalLabel').text('Edit Data Pengaduan');
                $('#id').val(data.id);
                $('#nama_pengemudi').val(data.nama_pengemudi);
                $('#kontak').val(data.kontak);
                $('#plat_nomor').val(data.plat_nomor);
                $('#kategori').val(data.kategori);
                if (data.jadwal_baru) {
                    $('#jadwal_baru').val(String(data.jadwal_baru).replace(' ', 'T').substring(0, 16));
                } else {
                    $('#jadwal_baru').val('');
                }
                $('#deskripsi').val(data.deskripsi);
                $('#status').val(data.status);
                setFileMode(data);
                openModal();
            }).fail(function () {
                showAlert('Gagal memuat data pengaduan untuk diedit.', 'danger');
            });
        });

        $(document).on('click', '.delete', function () {
            const id = $(this).data('id');
            const nama = $(this).data('nama');
            window.confirmDelete(`Data pengaduan "${nama}" beserta berkas buktinya akan dihapus permanen.`).then(function (confirmed) {
                if (! confirmed) {
                    return;
                }
                $.ajax({
                    type: 'DELETE',
                    url: urls.destroy.replace(':id', id),
                    dataType: 'json',
                    success: function (response) {
                        loadData();
                        showAlert(response.success, 'success');
                    },
                    error: function () {
                        showAlert('Gagal menghapus data pengaduan.', 'danger');
                    }
                });
            });
        });
    });
</script>
@endpush
