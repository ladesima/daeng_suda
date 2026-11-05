<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Potential, Sector};
use Illuminate\Http\Request;

class PotentialController extends Controller
{
    public function index() {
        return view('admin.potentials.index', [
            'items'=>Potential::with('sector')->latest()->paginate(10)
        ]);
    }
    public function create() { return view('admin.potentials.create', ['sectors'=>Sector::all()]); }
    public function store(Request $r)
{
    $data = $r->validate([
        // field lama (opsional—sesuaikan)
        'sector_id'        => ['required','exists:sectors,id'],
        'title'            => ['required','string','max:255'],
        'slug'             => ['nullable','string','max:255','unique:potentials,slug'],

        // A. Identitas
        'desa'             => ['nullable','string','max:255'],
        'kecamatan'        => ['nullable','string','max:255'],
        'kepala_desa'      => ['nullable','string','max:255'],
        'kontak_person'    => ['nullable','string','max:255'],
        'luas_wilayah_ha'  => ['nullable','numeric'],
        'jumlah_penduduk'  => ['nullable','integer'],
        'kelompok_umkm'    => ['nullable','string'],

        // B. Bidang (semua optional)
        'pertanian.luas_sawah_ha'   => ['nullable','numeric'],
        'pertanian.luas_jagung_ha'  => ['nullable','numeric'],
        'pertanian.lahan_tadah_hujan_ha' => ['nullable','numeric'],
        'pertanian.komoditas_utama' => ['nullable','string'],
        'pertanian.produksi_ton'    => ['nullable','numeric'],
        'pertanian.permasalahan'    => ['nullable','string'],
        'pertanian.usulan_program'  => ['nullable','string'],

        'perkebunan.jenis'          => ['nullable','string'],
        'perkebunan.luas_ha'        => ['nullable','numeric'],
        'perkebunan.produksi_tahunan'=> ['nullable','numeric'],
        'perkebunan.permasalahan'   => ['nullable','string'],
        'perkebunan.usulan_program' => ['nullable','string'],

        'perikanan.jenis_usaha'     => ['nullable','string'],
        'perikanan.luas_tambak_ha'  => ['nullable','numeric'],
        'perikanan.produksi_ton'    => ['nullable','numeric'],
        'perikanan.jenis_utama'     => ['nullable','string'],
        'perikanan.permasalahan'    => ['nullable','string'],
        'perikanan.usulan_program'  => ['nullable','string'],

        'peternakan.jenis_dominan'  => ['nullable','string'],
        'peternakan.populasi'       => ['nullable','string'],
        'peternakan.produksi'       => ['nullable','string'],
        'peternakan.permasalahan'   => ['nullable','string'],
        'peternakan.usulan_program' => ['nullable','string'],

        'energi.potensi_surya_kwp'  => ['nullable','numeric'],
        'energi.potensi_angin_kwp'  => ['nullable','numeric'],
        'energi.potensi_mikrohidro_kwp' => ['nullable','numeric'],
        'energi.potensi_biogas'     => ['nullable','string'],
        'energi.permasalahan'       => ['nullable','string'],
        'energi.usulan_program'     => ['nullable','string'],

        'pertambangan.jenis_galian' => ['nullable','string'],
        'pertambangan.luas_ha'      => ['nullable','numeric'],
        'pertambangan.status_izin'  => ['nullable','string'],
        'pertambangan.dampak_lingkungan' => ['nullable','string'],
        'pertambangan.usulan_program'    => ['nullable','string'],

        'lingkungan_hidup.kondisi_hutan' => ['nullable','string'],
        'lingkungan_hidup.pencemaran'    => ['nullable','string'],
        'lingkungan_hidup.kawasan_konservasi' => ['nullable','string'],
        'lingkungan_hidup.permasalahan'  => ['nullable','string'],
        'lingkungan_hidup.usulan_program'=> ['nullable','string'],

        // C
        'data_pendukung.kebutuhan_csr'   => ['nullable','string'],
        'data_pendukung.kerjasama_opd'   => ['nullable','string'],
        'data_pendukung.data_sdm'        => ['nullable','string'],
    ]);

    $potential = \App\Models\Potential::create($data);

    return redirect()->route('admin.potentials.index')->with('success','Potensi disimpan.');
}

public function update(Request $r, \App\Models\Potential $potential)
{
    $data = $r->validate([
        'sector_id'        => ['required','exists:sectors,id'],
        'title'            => ['required','string','max:255'],
        'slug'             => ['nullable','string','max:255','unique:potentials,slug,'.$potential->id],
        // … (aturan sama seperti di store)
        // (boleh copy sama persis bagian validasi di atas)
    ]);

    $potential->update($data);

    return redirect()->route('admin.potentials.index')->with('success','Potensi diupdate.');
}

    public function destroy(Potential $potential) { $potential->delete(); return back()->with('ok','Dihapus'); }
    public function show(Potential $potential) { return view('admin.potentials.show', ['item'=>$potential]); }
}
