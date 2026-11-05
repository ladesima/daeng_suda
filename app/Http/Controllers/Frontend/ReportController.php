<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    // === 1) Form Laporan Kejadian Mendesak ===
    public function createEmergency()
    {
        return view('front.reports.emergency');
    }

    public function storeEmergency(Request $r)
    {
        $data = $r->validate([
            'reporter_name'  => 'required|string|max:255',
            'reporter_phone' => 'required|string|max:30',
            'reporter_email' => 'nullable|email|max:255',
            'district'       => 'nullable|string|max:255',
            'village'        => 'nullable|string|max:255',
            'address'        => 'nullable|string|max:500',
            'lat'            => 'nullable|numeric',
            'lng'            => 'nullable|numeric',

            'category'       => 'required|string|max:50', // kekeringan/hama/pencemaran/lainnya
            'severity'       => 'required|string|max:20', // rendah/sedang/tinggi
            'occurred_at'    => 'nullable|date',
            'description'    => 'nullable|string|max:5000',
            'photos.*'       => 'nullable|image|max:2048', // tiap foto max 2MB
        ]);

        $files = [];
        if ($r->hasFile('photos')) {
            foreach ($r->file('photos') as $file) {
                $files[] = $file->store('reports/photos', 'public');
            }
        }

        $report = Report::create([
            'type'           => 'emergency',
            'reporter_name'  => $data['reporter_name'],
            'reporter_phone' => $data['reporter_phone'],
            'reporter_email' => $data['reporter_email'] ?? null,
            'district'       => $data['district'] ?? null,
            'village'        => $data['village'] ?? null,
            'address'        => $data['address'] ?? null,
            'lat'            => $data['lat'] ?? null,
            'lng'            => $data['lng'] ?? null,

            'category'       => $data['category'],
            'severity'       => $data['severity'],
            'occurred_at'    => $data['occurred_at'] ?? null,
            'description'    => $data['description'] ?? null,
            'photos'         => $files,

            'tracking_code'  => strtoupper(Str::random(8)),
            'status'         => 'submitted',
        ]);

        return back()->with('success',
            "Laporan terkirim. Kode pelacakan: {$report->tracking_code}. Simpan kode ini untuk melihat status pada menu Riwayat Pelaporan."
        );
    }

    // === 2) Form Permohonan Bantuan ===
    public function createAssistance()
    {
        return view('front.reports.assistance');
    }

    public function storeAssistance(Request $r)
    {
        $data = $r->validate([
            'reporter_name'  => 'required|string|max:255',
            'reporter_phone' => 'required|string|max:30',
            'reporter_email' => 'nullable|email|max:255',
            'district'       => 'nullable|string|max:255',
            'village'        => 'nullable|string|max:255',
            'address'        => 'nullable|string|max:500',
            'lat'            => 'nullable|numeric',
            'lng'            => 'nullable|numeric',

            'assistance_type'=> 'required|string|max:255', // pompa air, irigasi tersier, dsb.
            'urgency'        => 'required|string|max:20',  // rendah/sedang/tinggi
            'description'    => 'nullable|string|max:5000',
            'attachments.*'  => 'nullable|mimes:pdf,jpg,jpeg,png|max:3072',
        ]);

        $files = [];
        if ($r->hasFile('attachments')) {
            foreach ($r->file('attachments') as $file) {
                $files[] = $file->store('reports/attachments', 'public');
            }
        }

        $report = Report::create([
            'type'            => 'assistance',
            'reporter_name'   => $data['reporter_name'],
            'reporter_phone'  => $data['reporter_phone'],
            'reporter_email'  => $data['reporter_email'] ?? null,
            'district'        => $data['district'] ?? null,
            'village'         => $data['village'] ?? null,
            'address'         => $data['address'] ?? null,
            'lat'             => $data['lat'] ?? null,
            'lng'             => $data['lng'] ?? null,

            'assistance_type' => $data['assistance_type'],
            'urgency'         => $data['urgency'],
            'description'     => $data['description'] ?? null,
            'attachments'     => $files,

            'tracking_code'   => strtoupper(Str::random(8)),
            'status'          => 'submitted',
        ]);

        return back()->with('success',
            "Permohonan tersimpan. Kode pelacakan: {$report->tracking_code}. Gunakan pada menu Riwayat Pelaporan."
        );
    }

    // === 3) Riwayat Pelaporan ===
    public function history(Request $r)
    {
        $qPhone = trim($r->query('phone', ''));
        $qCode  = trim($r->query('code', ''));

        $items = collect();
        if ($qPhone !== '') {
            $items = Report::query()
                ->when($qCode !== '', fn($qq) => $qq->where('tracking_code', $qCode))
                ->where('reporter_phone', $qPhone)
                ->latest()
                ->paginate(10)
                ->withQueryString();
        }

        return view('front.reports.history', compact('items','qPhone','qCode'));
    }
}
