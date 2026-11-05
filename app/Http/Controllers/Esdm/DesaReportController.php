<?php

namespace App\Http\Controllers\Esdm;

use App\Http\Controllers\Controller;
use App\Models\EsdmReport;
use App\Models\EsdmReportAttachment;
use App\Models\EsdmReportHistory;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class DesaReportController extends Controller
{
    /**
     * Tampilkan dashboard desa.
     */
    public function dashboard()
    {
        $user = auth()->user();
        $village = $user->village ?? ($user->village_id ? Village::find($user->village_id) : null);

        $reportsQuery = EsdmReport::query();
        if ($user->village_id) {
            $reportsQuery->where('village_id', $user->village_id);
        } else {
            $reportsQuery->whereRaw('1 = 0');
        }

        $stats = [
            'total' => (clone $reportsQuery)->count(),
            'baru' => (clone $reportsQuery)->where('status', EsdmReport::STATUS_BARU)->count(),
            'verifikasi' => (clone $reportsQuery)->where('status', EsdmReport::STATUS_VERIFIKASI)->count(),
            'perbaikan' => (clone $reportsQuery)->where('status', EsdmReport::STATUS_PERBAIKAN)->count(),
            'tindak_lanjut' => (clone $reportsQuery)->where('status', EsdmReport::STATUS_TINDAK_LANJUT)->count(),
            'dalam_proses' => (clone $reportsQuery)->where('status', EsdmReport::STATUS_DALAM_PROSES)->count(),
            'selesai' => (clone $reportsQuery)->where('status', EsdmReport::STATUS_SELESAI)->count(),
            'by_status' => [
                EsdmReport::STATUS_BARU => (clone $reportsQuery)->where('status', EsdmReport::STATUS_BARU)->count(),
                EsdmReport::STATUS_VERIFIKASI => (clone $reportsQuery)->where('status', EsdmReport::STATUS_VERIFIKASI)->count(),
                EsdmReport::STATUS_PERBAIKAN => (clone $reportsQuery)->where('status', EsdmReport::STATUS_PERBAIKAN)->count(),
                EsdmReport::STATUS_TINDAK_LANJUT => (clone $reportsQuery)->where('status', EsdmReport::STATUS_TINDAK_LANJUT)->count(),
                EsdmReport::STATUS_DALAM_PROSES => (clone $reportsQuery)->where('status', EsdmReport::STATUS_DALAM_PROSES)->count(),
                EsdmReport::STATUS_SELESAI => (clone $reportsQuery)->where('status', EsdmReport::STATUS_SELESAI)->count(),
            ],
            'by_type' => [
                EsdmReport::TYPE_PJU => (clone $reportsQuery)->where('type', EsdmReport::TYPE_PJU)->count(),
                EsdmReport::TYPE_BPBL => (clone $reportsQuery)->where('type', EsdmReport::TYPE_BPBL)->count(),
                EsdmReport::TYPE_JARINGAN_LISTRIK => (clone $reportsQuery)->where('type', EsdmReport::TYPE_JARINGAN_LISTRIK)->count(),
                EsdmReport::TYPE_KEBUTUHAN_ENERGI => (clone $reportsQuery)->where('type', EsdmReport::TYPE_KEBUTUHAN_ENERGI)->count(),
                EsdmReport::TYPE_PERMASALAHAN => (clone $reportsQuery)->where('type', EsdmReport::TYPE_PERMASALAHAN)->count(),
            ],
        ];

        $reports = (clone $reportsQuery)->with(['village', 'attachments'])
            ->latest()
            ->paginate(10);

        return view('esdm.desa.dashboard', compact('village', 'reports', 'stats'));
    }

    /**
     * Tampilkan form input laporan berdasarkan tipe.
     */
    public function create(string $type)
    {
        $normalizedType = str_replace('-', '_', $type);

        $validTypes = [
            EsdmReport::TYPE_PJU,
            EsdmReport::TYPE_BPBL,
            EsdmReport::TYPE_JARINGAN_LISTRIK,
            EsdmReport::TYPE_KEBUTUHAN_ENERGI,
            EsdmReport::TYPE_PERMASALAHAN,
        ];

        if (!in_array($normalizedType, $validTypes)) {
            abort(404, 'Jenis laporan ESDM tidak valid.');
        }

        $type = $normalizedType;
        $typeLabel = EsdmReport::typeLabels()[$type] ?? $type;
        $viewName = 'esdm.desa.forms.' . str_replace('_', '-', $type);

        return view($viewName, compact('type', 'typeLabel'));
    }

    /**
     * Simpan laporan ESDM baru.
     */
    public function store(Request $request)
    {
        $validTypes = [
            EsdmReport::TYPE_PJU,
            EsdmReport::TYPE_BPBL,
            EsdmReport::TYPE_JARINGAN_LISTRIK,
            EsdmReport::TYPE_KEBUTUHAN_ENERGI,
            EsdmReport::TYPE_PERMASALAHAN,
        ];

        $validated = $request->validate([
            'type' => ['required', Rule::in($validTypes)],
            'lokasi' => ['required', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string'],
            'tingkat_urgensi' => ['nullable', Rule::in(['rendah', 'sedang', 'tinggi'])],
            'data' => ['nullable', 'array'],
            'attachments' => ['nullable', 'array'],
            'attachments.*' => ['file', 'max:5120', 'mimes:jpg,jpeg,png,pdf,doc,docx'],
        ]);

        $user = auth()->user();

        DB::transaction(function () use ($request, $validated, $user) {
            $report = EsdmReport::create([
                'village_id' => $user->village_id,
                'user_id' => $user->id,
                'type' => $validated['type'],
                'status' => EsdmReport::STATUS_BARU,
                'lokasi' => $validated['lokasi'],
                'keterangan' => $validated['keterangan'] ?? null,
                'tingkat_urgensi' => $validated['tingkat_urgensi'] ?? null,
                'data' => $validated['data'] ?? [],
            ]);

            if ($request->hasFile('attachments')) {
                $targetDir = public_path('uploads/esdm-attachments');
                if (!file_exists($targetDir)) {
                    @mkdir($targetDir, 0755, true);
                }

                foreach ($request->file('attachments') as $file) {
                    $ext = $file->getClientOriginalExtension() ?: 'jpg';
                    $filename = time() . '_' . Str::random(12) . '.' . $ext;
                    $file->move($targetDir, $filename);
                    $path = 'uploads/esdm-attachments/' . $filename;

                    EsdmReportAttachment::create([
                        'esdm_report_id' => $report->id,
                        'file_path' => $path,
                        'file_type' => $file->getClientMimeType(),
                        'original_name' => $file->getClientOriginalName(),
                    ]);
                }
            }

            EsdmReportHistory::create([
                'esdm_report_id' => $report->id,
                'user_id' => $user->id,
                'from_status' => null,
                'to_status' => EsdmReport::STATUS_BARU,
                'catatan' => 'Laporan baru dibuat',
            ]);
        });

        return redirect()->route('esdm.desa.dashboard')->with('success', 'Laporan ESDM berhasil dikirim.');
    }

    /**
     * Tampilkan detail laporan desa.
     */
    public function show(EsdmReport $report)
    {
        if ($report->village_id !== auth()->user()->village_id) {
            abort(403, 'Anda tidak memiliki hak akses untuk melihat laporan ini.');
        }

        $report->load(['village', 'attachments', 'histories.user']);

        return view('esdm.desa.show', compact('report'));
    }

    /**
     * Tampilkan form perbaikan laporan.
     */
    public function edit(EsdmReport $report)
    {
        if ($report->village_id !== auth()->user()->village_id) {
            abort(403, 'Anda tidak memiliki hak akses untuk mengubah laporan ini.');
        }

        if ($report->status !== EsdmReport::STATUS_PERBAIKAN) {
            abort(403, 'Laporan hanya dapat diedit jika berstatus perbaikan.');
        }

        $report->load(['attachments', 'histories']);

        return view('esdm.desa.edit', compact('report'));
    }

    /**
     * Simpan perbaikan laporan.
     */
    public function update(Request $request, EsdmReport $report)
    {
        if ($report->village_id !== auth()->user()->village_id) {
            abort(403, 'Anda tidak memiliki hak akses untuk mengubah laporan ini.');
        }

        if ($report->status !== EsdmReport::STATUS_PERBAIKAN) {
            abort(403, 'Laporan hanya dapat diedit jika berstatus perbaikan.');
        }

        $validTypes = [
            EsdmReport::TYPE_PJU,
            EsdmReport::TYPE_BPBL,
            EsdmReport::TYPE_JARINGAN_LISTRIK,
            EsdmReport::TYPE_KEBUTUHAN_ENERGI,
            EsdmReport::TYPE_PERMASALAHAN,
        ];

        $validated = $request->validate([
            'type' => ['sometimes', 'required', Rule::in($validTypes)],
            'lokasi' => ['required', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string'],
            'tingkat_urgensi' => ['nullable', Rule::in(['rendah', 'sedang', 'tinggi'])],
            'data' => ['nullable', 'array'],
            'attachments' => ['nullable', 'array'],
            'attachments.*' => ['file', 'max:5120', 'mimes:jpg,jpeg,png,pdf,doc,docx'],
            'catatan_perbaikan' => ['nullable', 'string'],
        ]);

        DB::transaction(function () use ($request, $report, $validated) {
            $oldStatus = $report->status;

            $updateData = [
                'lokasi' => $validated['lokasi'],
                'keterangan' => $validated['keterangan'] ?? null,
                'tingkat_urgensi' => $validated['tingkat_urgensi'] ?? null,
                'status' => EsdmReport::STATUS_BARU,
            ];

            if (isset($validated['type'])) {
                $updateData['type'] = $validated['type'];
            }

            if (array_key_exists('data', $validated)) {
                $updateData['data'] = $validated['data'] ?? [];
            }

            $report->update($updateData);

            if ($request->hasFile('attachments')) {
                $targetDir = public_path('uploads/esdm-attachments');
                if (!file_exists($targetDir)) {
                    @mkdir($targetDir, 0755, true);
                }

                foreach ($request->file('attachments') as $file) {
                    $ext = $file->getClientOriginalExtension() ?: 'jpg';
                    $filename = time() . '_' . Str::random(12) . '.' . $ext;
                    $file->move($targetDir, $filename);
                    $path = 'uploads/esdm-attachments/' . $filename;

                    EsdmReportAttachment::create([
                        'esdm_report_id' => $report->id,
                        'file_path' => $path,
                        'file_type' => $file->getClientMimeType(),
                        'original_name' => $file->getClientOriginalName(),
                    ]);
                }
            }

            EsdmReportHistory::create([
                'esdm_report_id' => $report->id,
                'user_id' => auth()->id(),
                'from_status' => $oldStatus,
                'to_status' => EsdmReport::STATUS_BARU,
                'catatan' => $validated['catatan_perbaikan'] ?? 'Laporan diperbaiki oleh Admin Desa dan diajukan kembali',
            ]);
        });

        return redirect()->route('esdm.desa.dashboard')->with('success', 'Laporan berhasil diperbaiki dan diajukan kembali.');
    }
}
