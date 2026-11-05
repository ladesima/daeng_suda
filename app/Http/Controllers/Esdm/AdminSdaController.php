<?php

namespace App\Http\Controllers\Esdm;

use App\Http\Controllers\Controller;
use App\Models\EsdmReport;
use App\Models\EsdmReportHistory;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AdminSdaController extends Controller
{
    /**
     * Tampilkan dashboard admin SDA dengan statistik lengkap.
     */
    public function dashboard()
    {
        $totalReports = EsdmReport::count();

        // 1. Total laporan per status (untuk pie chart)
        $statusCounts = [
            EsdmReport::STATUS_BARU => EsdmReport::where('status', EsdmReport::STATUS_BARU)->count(),
            EsdmReport::STATUS_VERIFIKASI => EsdmReport::where('status', EsdmReport::STATUS_VERIFIKASI)->count(),
            EsdmReport::STATUS_PERBAIKAN => EsdmReport::where('status', EsdmReport::STATUS_PERBAIKAN)->count(),
            EsdmReport::STATUS_TINDAK_LANJUT => EsdmReport::where('status', EsdmReport::STATUS_TINDAK_LANJUT)->count(),
            EsdmReport::STATUS_DALAM_PROSES => EsdmReport::where('status', EsdmReport::STATUS_DALAM_PROSES)->count(),
            EsdmReport::STATUS_SELESAI => EsdmReport::where('status', EsdmReport::STATUS_SELESAI)->count(),
        ];
        $statusLabels = EsdmReport::statusLabels();

        // 2. Total laporan per tipe
        $typeCounts = [
            EsdmReport::TYPE_PJU => EsdmReport::where('type', EsdmReport::TYPE_PJU)->count(),
            EsdmReport::TYPE_BPBL => EsdmReport::where('type', EsdmReport::TYPE_BPBL)->count(),
            EsdmReport::TYPE_JARINGAN_LISTRIK => EsdmReport::where('type', EsdmReport::TYPE_JARINGAN_LISTRIK)->count(),
            EsdmReport::TYPE_KEBUTUHAN_ENERGI => EsdmReport::where('type', EsdmReport::TYPE_KEBUTUHAN_ENERGI)->count(),
            EsdmReport::TYPE_PERMASALAHAN => EsdmReport::where('type', EsdmReport::TYPE_PERMASALAHAN)->count(),
        ];
        $typeLabels = EsdmReport::typeLabels();

        // 3. Total desa yang sudah input vs belum (target 113 desa)
        $totalVillages = Village::count();
        $villagesWithReports = Village::whereHas('esdmReports')->count();
        $villagesWithoutReports = max(0, $totalVillages - $villagesWithReports);

        // 4. Rekap data agregat dari JSON laporan
        $pjuReports = EsdmReport::where('type', EsdmReport::TYPE_PJU)->get();
        $totalPjuRusak = $pjuReports->sum(function ($report) {
            $data = $report->data ?? [];
            return (int) ($data['jumlah_rusak'] ?? $data['jumlah_unit'] ?? $data['jumlah'] ?? 0);
        });
        $totalPjuKebutuhan = $pjuReports->sum(function ($report) {
            $data = $report->data ?? [];
            return (int) ($data['jumlah_kebutuhan'] ?? $data['kebutuhan'] ?? 0);
        });

        $bpblReports = EsdmReport::where('type', EsdmReport::TYPE_BPBL)->get();
        $totalBpblCalon = $bpblReports->sum(function ($report) {
            $data = $report->data ?? [];
            return (int) ($data['jumlah_calon_penerima'] ?? $data['jumlah_kk'] ?? $data['jumlah_penerima'] ?? $data['jumlah'] ?? 0);
        });

        $jaringanReports = EsdmReport::where('type', EsdmReport::TYPE_JARINGAN_LISTRIK)->get();
        $totalJaringanTiang = $jaringanReports->sum(function ($report) {
            $data = $report->data ?? [];
            return (int) ($data['jumlah_tiang'] ?? $data['tiang'] ?? 0);
        });

        $rekapData = [
            'pju_rusak' => $totalPjuRusak,
            'pju_kebutuhan' => $totalPjuKebutuhan,
            'bpbl_calon_penerima' => $totalBpblCalon,
            'jaringan_tiang' => $totalJaringanTiang,
        ];

        // 5. Recent reports (10 terbaru)
        $recentReports = EsdmReport::with(['village', 'user'])->latest()->limit(10)->get();

        $stats = [
            'total_reports' => $totalReports,
            'status_counts' => $statusCounts,
            'type_counts' => $typeCounts,
            'total_villages' => $totalVillages,
            'villages_with_reports' => $villagesWithReports,
            'villages_without_reports' => $villagesWithoutReports,
            'rekap' => $rekapData,
        ];

        return view('esdm.admin.dashboard', compact(
            'totalReports',
            'statusCounts',
            'statusLabels',
            'typeCounts',
            'typeLabels',
            'totalVillages',
            'villagesWithReports',
            'villagesWithoutReports',
            'rekapData',
            'recentReports',
            'stats'
        ));
    }

    /**
     * Tampilkan daftar seluruh laporan dengan filter.
     */
    public function index(Request $request)
    {
        $filters = [
            'kecamatan' => $request->input('kecamatan'),
            'village_id' => $request->input('village_id'),
            'type' => $request->input('type'),
            'status' => $request->input('status'),
            'periode' => $request->input('periode'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'search' => $request->input('search'),
        ];

        $query = EsdmReport::with(['village', 'user'])->latest();

        if (!empty($filters['village_id'])) {
            $query->where('village_id', $filters['village_id']);
        } elseif (!empty($filters['kecamatan'])) {
            $query->whereHas('village', function ($q) use ($filters) {
                $q->where('kecamatan', $filters['kecamatan']);
            });
        }

        if (!empty($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['periode'])) {
            if (str_contains($filters['periode'], ' to ')) {
                $dates = explode(' to ', $filters['periode']);
                if (count($dates) === 2) {
                    $query->whereBetween('created_at', [trim($dates[0]) . ' 00:00:00', trim($dates[1]) . ' 23:59:59']);
                }
            } elseif (str_contains($filters['periode'], ' - ')) {
                $dates = explode(' - ', $filters['periode']);
                if (count($dates) === 2) {
                    $query->whereBetween('created_at', [trim($dates[0]) . ' 00:00:00', trim($dates[1]) . ' 23:59:59']);
                }
            } else {
                $query->whereDate('created_at', $filters['periode']);
            }
        } elseif (!empty($filters['start_date']) && !empty($filters['end_date'])) {
            $query->whereBetween('created_at', [$filters['start_date'] . ' 00:00:00', $filters['end_date'] . ' 23:59:59']);
        } elseif (!empty($filters['start_date'])) {
            $query->whereDate('created_at', '>=', $filters['start_date']);
        } elseif (!empty($filters['end_date'])) {
            $query->whereDate('created_at', '<=', $filters['end_date']);
        }

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('lokasi', 'like', "%{$search}%")
                  ->orWhere('keterangan', 'like', "%{$search}%");
            });
        }

        $reports = $query->paginate(20)->withQueryString();
        $villages = Village::orderBy('nama')->get();
        $kecamatans = Village::select('kecamatan')
            ->whereNotNull('kecamatan')
            ->distinct()
            ->orderBy('kecamatan')
            ->pluck('kecamatan');

        return view('esdm.admin.index', compact('reports', 'filters', 'villages', 'kecamatans'));
    }

    /**
     * Tampilkan detail laporan.
     */
    public function show(EsdmReport $report)
    {
        $report->load([
            'village',
            'user',
            'verifier',
            'attachments',
            'histories.user',
        ]);

        return view('esdm.admin.show', compact('report'));
    }

    /**
     * Proses verifikasi laporan oleh Admin SDA.
     */
    public function verify(Request $request, EsdmReport $report)
    {
        $validated = $request->validate([
            'action' => ['required', Rule::in(['terima', 'perbaikan'])],
            'catatan' => ['required', 'string'],
        ]);

        DB::transaction(function () use ($report, $validated) {
            $oldStatus = $report->status;
            $newStatus = $validated['action'] === 'terima'
                ? EsdmReport::STATUS_VERIFIKASI
                : EsdmReport::STATUS_PERBAIKAN;

            $updateData = [
                'status' => $newStatus,
            ];

            if ($validated['action'] === 'terima') {
                $updateData['verified_by'] = auth()->id();
                $updateData['verified_at'] = now();
            }

            $report->update($updateData);

            EsdmReportHistory::create([
                'esdm_report_id' => $report->id,
                'user_id' => auth()->id(),
                'from_status' => $oldStatus,
                'to_status' => $newStatus,
                'catatan' => $validated['catatan'],
            ]);
        });

        $message = $validated['action'] === 'terima'
            ? 'Laporan berhasil diverifikasi.'
            : 'Laporan dikembalikan ke desa untuk perbaikan.';

        return back()->with('success', $message);
    }

    /**
     * Perbarui status tindak lanjut, dalam proses, atau selesai.
     */
    public function updateStatus(Request $request, EsdmReport $report)
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in([
                EsdmReport::STATUS_TINDAK_LANJUT,
                EsdmReport::STATUS_DALAM_PROSES,
                EsdmReport::STATUS_SELESAI,
            ])],
            'catatan' => ['required', 'string'],
            'instansi_koordinasi' => ['nullable', 'string', 'max:255'],
            'hasil_koordinasi' => ['nullable', 'string'],
        ]);

        DB::transaction(function () use ($report, $validated) {
            $oldStatus = $report->status;
            $newStatus = $validated['status'];

            $report->update([
                'status' => $newStatus,
            ]);

            EsdmReportHistory::create([
                'esdm_report_id' => $report->id,
                'user_id' => auth()->id(),
                'from_status' => $oldStatus,
                'to_status' => $newStatus,
                'catatan' => $validated['catatan'],
                'instansi_koordinasi' => $validated['instansi_koordinasi'] ?? null,
                'hasil_koordinasi' => $validated['hasil_koordinasi'] ?? null,
            ]);
        });

        return back()->with('success', 'Status laporan berhasil diperbarui.');
    }
}
