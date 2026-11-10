<?php

namespace Modules\Pengaduan\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Modules\Pengaduan\Http\Requests\PengaduanRequest;
use Modules\Pengaduan\Models\Pengaduan;

class PengaduanController extends Controller
{
    public function index(): View
    {
        return view('pengaduan::index');
    }

    public function getData(): JsonResponse
    {
        return response()->json(Pengaduan::latest()->get());
    }

    public function store(PengaduanRequest $request): JsonResponse
    {
        $data = $request->safe()->except('file_bukti');
        $data['plat_nomor'] = strtoupper($data['plat_nomor']);
        $data['status'] = $request->user()?->isOfficer()
            ? ($data['status'] ?? 'Menunggu')
            : 'Menunggu';

        $file = $request->file('file_bukti');
        $data['file_bukti'] = $file->store('bukti-pengaduan', 'public');
        $data['nama_berkas'] = $file->getClientOriginalName();

        Pengaduan::create($data);

        return response()->json(['success' => 'Data pengaduan berhasil disimpan.']);
    }

    public function edit(Pengaduan $pengaduan): JsonResponse
    {
        return response()->json($pengaduan);
    }

    public function update(PengaduanRequest $request, Pengaduan $pengaduan): JsonResponse
    {
        $data = $request->safe()->except('file_bukti');
        $data['plat_nomor'] = strtoupper($data['plat_nomor']);

        if (! $request->user()?->isOfficer()) {
            $data['status'] = $pengaduan->status;
        } else {
            $data['status'] = $data['status'] ?? $pengaduan->status;
        }

        if ($request->hasFile('file_bukti')) {
            if ($pengaduan->file_bukti) {
                Storage::disk('public')->delete($pengaduan->file_bukti);
            }

            $file = $request->file('file_bukti');
            $data['file_bukti'] = $file->store('bukti-pengaduan', 'public');
            $data['nama_berkas'] = $file->getClientOriginalName();
        }

        $pengaduan->update($data);

        return response()->json(['success' => 'Data pengaduan berhasil diperbarui.']);
    }

    public function destroy(Pengaduan $pengaduan): JsonResponse
    {
        if ($pengaduan->file_bukti) {
            Storage::disk('public')->delete($pengaduan->file_bukti);
        }

        $pengaduan->delete();

        return response()->json(['success' => 'Data pengaduan beserta berkas bukti berhasil dihapus.']);
    }
}
