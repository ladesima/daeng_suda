<?php

namespace App\Http\Controllers\Esdm;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class VillageAccountController extends Controller
{
    /**
     * Tampilkan daftar akun desa dan status registrasi seluruh desa/kelurahan.
     */
    public function index(Request $request)
    {
        $kecamatanFilter = $request->input('kecamatan');
        $statusFilter = $request->input('status'); // 'registered', 'unregistered'
        $search = $request->input('q');

        // Ambil daftar unik kecamatan untuk filter dropdown
        $kecamatans = Village::whereNotNull('kecamatan')
            ->distinct()
            ->orderBy('kecamatan')
            ->pluck('kecamatan');

        // Query desa dengan akun admin_desa yang terhubung
        $query = Village::query()->with(['sector'])
            ->leftJoin('users', function ($join) {
                $join->on('villages.id', '=', 'users.village_id')
                     ->where('users.role', '=', 'admin_desa');
            })
            ->select(
                'villages.id as village_id',
                'villages.nama as village_nama',
                'villages.kecamatan as village_kecamatan',
                'users.id as user_id',
                'users.name as user_name',
                'users.email as user_email',
                'users.created_at as user_created_at'
            );

        if ($kecamatanFilter) {
            $query->where('villages.kecamatan', $kecamatanFilter);
        }

        if ($statusFilter === 'registered') {
            $query->whereNotNull('users.id');
        } elseif ($statusFilter === 'unregistered') {
            $query->whereNull('users.id');
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('villages.nama', 'like', "%{$search}%")
                  ->orWhere('villages.kecamatan', 'like', "%{$search}%")
                  ->orWhere('users.name', 'like', "%{$search}%")
                  ->orWhere('users.email', 'like', "%{$search}%");
            });
        }

        $villages = $query->orderBy('villages.kecamatan')
            ->orderBy('villages.nama')
            ->paginate(25)
            ->withQueryString();

        // Statistik
        $totalDesa = Village::count();
        $totalAkun = User::where('role', 'admin_desa')->whereNotNull('village_id')->count();
        $belumPunyaAkun = max(0, $totalDesa - $totalAkun);

        return view('esdm.admin.desa_accounts.index', compact(
            'villages',
            'kecamatans',
            'totalDesa',
            'totalAkun',
            'belumPunyaAkun',
            'kecamatanFilter',
            'statusFilter',
            'search'
        ));
    }

    /**
     * Form tambah akun desa baru.
     */
    public function create(Request $request)
    {
        // Ambil desa yang belum memiliki akun
        $usedVillageIds = User::where('role', 'admin_desa')
            ->whereNotNull('village_id')
            ->pluck('village_id');

        $availableVillages = Village::whereNotIn('id', $usedVillageIds)
            ->orderBy('kecamatan')
            ->orderBy('nama')
            ->get();

        $selectedVillageId = $request->input('village_id');

        return view('esdm.admin.desa_accounts.create', compact('availableVillages', 'selectedVillageId'));
    }

    /**
     * Simpan akun desa baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'village_id' => [
                'required',
                'exists:villages,id',
                Rule::unique('users', 'village_id')->where(function ($query) {
                    return $query->where('role', 'admin_desa');
                }),
            ],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
        ], [
            'village_id.unique' => 'Desa ini sudah memiliki akun admin desa aktif.',
            'email.unique' => 'Alamat email ini sudah terdaftar pada akun lain.',
            'password.min' => 'Password minimal harus 6 karakter.',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => strtolower($validated['email']),
            'password' => Hash::make($validated['password']),
            'role' => 'admin_desa',
            'village_id' => $validated['village_id'],
        ]);

        return redirect()
            ->route('esdm.admin.desa-accounts.index')
            ->with('success', 'Akun Admin Desa berhasil dibuat!');
    }

    /**
     * Form edit akun desa.
     */
    public function edit(User $desa_account)
    {
        if ($desa_account->role !== 'admin_desa') {
            abort(404, 'Akun bukan Admin Desa');
        }

        $villages = Village::orderBy('kecamatan')->orderBy('nama')->get();

        return view('esdm.admin.desa_accounts.edit', [
            'user' => $desa_account,
            'villages' => $villages,
        ]);
    }

    /**
     * Update akun desa.
     */
    public function update(Request $request, User $desa_account)
    {
        if ($desa_account->role !== 'admin_desa') {
            abort(404);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($desa_account->id),
            ],
            'village_id' => [
                'required',
                'exists:villages,id',
                Rule::unique('users', 'village_id')->ignore($desa_account->id)->where(function ($query) {
                    return $query->where('role', 'admin_desa');
                }),
            ],
            'password' => ['nullable', 'string', 'min:6'],
        ], [
            'village_id.unique' => 'Desa yang dipilih sudah digunakan oleh akun lain.',
        ]);

        $desa_account->name = $validated['name'];
        $desa_account->email = strtolower($validated['email']);
        $desa_account->village_id = $validated['village_id'];

        if (!empty($validated['password'])) {
            $desa_account->password = Hash::make($validated['password']);
        }

        $desa_account->save();

        return redirect()
            ->route('esdm.admin.desa-accounts.index')
            ->with('success', "Akun {$desa_account->name} berhasil diperbarui!");
    }

    /**
     * Reset password cepat ke default ('password123') atau custom.
     */
    public function resetPassword(Request $request, User $user)
    {
        if ($user->role !== 'admin_desa') {
            abort(404);
        }

        $newPassword = $request->input('new_password', 'password123');

        $user->update([
            'password' => Hash::make($newPassword),
        ]);

        return redirect()
            ->back()
            ->with('success', "Password untuk akun {$user->name} berhasil di-reset menjadi: {$newPassword}");
    }

    /**
     * Generate akun otomatis untuk seluruh desa yang belum punya akun.
     */
    public function generateAll()
    {
        $existingVillageIds = User::where('role', 'admin_desa')
            ->whereNotNull('village_id')
            ->pluck('village_id')
            ->toArray();

        $villages = Village::whereNotIn('id', $existingVillageIds)->get();

        $createdCount = 0;
        foreach ($villages as $village) {
            // Bersihkan nama desa untuk email
            $slugDesa = Str::slug($village->nama, '.');
            $slugKec = Str::slug($village->kecamatan, '.');
            $email = "desa.{$slugDesa}.{$slugKec}@jeneponto.go.id";

            // Jika email bentrok, gunakan format unik
            if (User::where('email', $email)->exists()) {
                $email = "desa.{$slugDesa}.{$village->id}@jeneponto.go.id";
            }

            User::create([
                'name' => "Admin Desa {$village->nama}",
                'email' => $email,
                'password' => Hash::make('password123'),
                'role' => 'admin_desa',
                'village_id' => $village->id,
            ]);

            $createdCount++;
        }

        return redirect()
            ->route('esdm.admin.desa-accounts.index')
            ->with('success', "Berhasil membuat otomatis {$createdCount} akun desa! Password default: password123");
    }

    /**
     * Hapus akun desa.
     */
    public function destroy(User $desa_account)
    {
        if ($desa_account->role !== 'admin_desa') {
            abort(404);
        }

        $name = $desa_account->name;
        $desa_account->delete();

        return redirect()
            ->route('esdm.admin.desa-accounts.index')
            ->with('success', "Akun {$name} berhasil dihapus.");
    }
}
