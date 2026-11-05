<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\EmergencyReport;
use App\Models\AssistanceRequest;

class ReportController extends Controller
{
    /* =========================
     *  Laporan Kejadian Mendesak
     * ========================= */
    public function createEmergency()
    {
        return view('front.report.emergency');
    }

    public function storeEmergency(Request $request)
    {
        $data = $request->validate([
            'nama'      => ['required','string','max:200'],
            'hp'        => ['required','string','max:30'],
            'email'     => ['nullable','email','max:200'],
            'kecamatan' => ['nullable','string','max:120'],
            'desa'      => ['nullable','string','max:120'],
            'alamat'    => ['nullable','string','max:255'],
            'severity'  => ['required','in:rendah,sedang,tinggi,darurat'],
            'kategori'  => ['required','in:kekeringan,hama,pencemaran,lainnya'],
            'waktu'     => ['required','date'],
            'lat'       => ['nullable','string','max:50'],
            'lng'       => ['nullable','string','max:50'],
            'uraian'    => ['required','string'],
            'lampiran.*'=> ['nullable','file','mimes:jpg,jpeg,png,webp,pdf','max:4096'],
        ]);

        $data['tracking_code'] = strtoupper(Str::random(8));

        /** @var \App\Models\EmergencyReport $report */
        $report = EmergencyReport::create($data);

        // TODO: simpan file jika perlu
        // if ($request->hasFile('lampiran')) { ... }

        return redirect()
            ->route('report.history', ['hp' => $data['hp']])
            ->with('success', 'Laporan mendesak berhasil dikirim. Kode: '.$data['tracking_code']);
    }

    /* =========================
     *  Permohonan Bantuan
     * ========================= */
    public function createAssistance()
    {
        return view('front.report.assistance');
    }

    public function storeAssistance(Request $request)
    {
        $data = $request->validate([
            'nama'      => ['required','string','max:200'],
            'hp'        => ['required','string','max:30'],
            'email'     => ['nullable','email','max:200'],
            'kecamatan' => ['nullable','string','max:120'],
            'desa'      => ['nullable','string','max:120'],
            'alamat'    => ['nullable','string','max:255'],
            'urgency'   => ['required','in:rendah,sedang,tinggi,mendesak'],
            'jenis'     => ['required','string','max:255'],
            'lat'       => ['nullable','string','max:50'],
            'lng'       => ['nullable','string','max:50'],
            'uraian'    => ['required','string'],
            'lampiran.*'=> ['nullable','file','mimes:jpg,jpeg,png,webp,pdf','max:4096'],
        ]);

        $data['tracking_code'] = strtoupper(Str::random(8));

        /** @var \App\Models\AssistanceRequest $req */
        $req = AssistanceRequest::create($data);

        // TODO: simpan file jika perlu
        // if ($request->hasFile('lampiran')) { ... }

        return redirect()
            ->route('report.history', ['hp' => $data['hp']])
            ->with('success', 'Permohonan bantuan terkirim. Kode: '.$data['tracking_code']);
    }

    /* =========================
     *  Riwayat Pelaporan
     *  (sudah kamu pasang sebelumnya)
     * ========================= */
    public function historyEmergency()
    {
        // pilih kolom yang penting, order terbaru
        $items = EmergencyReport::query()
            ->select(['id','kode','nama','hp','kecamatan','desa','kategori','severity','status','created_at','waktu'])
            ->latest('created_at')
            ->paginate(15)
            ->withQueryString();

        return view('front.report.history_emergency', compact('items'));
    }

    /** Riwayat semua Permohonan Bantuan */
    public function historyAssistance()
    {
        $items = AssistanceRequest::query()
            ->select(['id','kode','nama','hp','kecamatan','desa','jenis','urgency','status','created_at'])
            ->latest('created_at')
            ->paginate(15)
            ->withQueryString();

        return view('front.report.history_assistance', compact('items'));
    }
}
