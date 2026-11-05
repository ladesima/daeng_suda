<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    /**
     * Tampilkan daftar pegawai.
     */
    public function index()
    {
        $employees = Employee::with('atasan')
            ->orderBy('atasan_id')
            ->orderBy('id')
            ->get();

        return view('admin.employees.index', compact('employees'));
    }

    /**
     * Tampilkan form tambah pegawai.
     */
    public function create()
    {
        $superiors = Employee::all();
        return view('admin.employees.create', compact('superiors'));
    }

    /**
     * Simpan data pegawai baru.
     */
    public function store(Request $request)
    {
        if ($request->filled('superior_id') && !$request->filled('atasan_id')) {
            $request->merge(['atasan_id' => $request->input('superior_id')]);
        }

        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'jabatan'   => 'required|string|max:255',
            'nip'       => 'nullable|string|max:50',
            'atasan_id' => 'nullable|exists:employees,id',
            'foto'      => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('foto')) {
            $targetDir = public_path('uploads/employees');
            if (!file_exists($targetDir)) {
                @mkdir($targetDir, 0755, true);
            }
            $file = $request->file('foto');
            $ext = $file->getClientOriginalExtension() ?: 'jpg';
            $filename = time() . '_' . Str::random(10) . '.' . $ext;
            $file->move($targetDir, $filename);
            $validated['foto'] = 'uploads/employees/' . $filename;
        }

        Employee::create($validated);

        return redirect()->route('admin.employees.index')
            ->with('success', 'Pegawai berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit pegawai.
     */
    public function edit(Employee $employee)
    {
        $superiors = Employee::where('id', '!=', $employee->id)->get();
        return view('admin.employees.edit', compact('employee', 'superiors'));
    }

    /**
     * Update data pegawai.
     */
    public function update(Request $request, Employee $employee)
    {
        if ($request->filled('superior_id') && !$request->filled('atasan_id')) {
            $request->merge(['atasan_id' => $request->input('superior_id')]);
        }

        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'jabatan'   => 'required|string|max:255',
            'nip'       => 'nullable|string|max:50',
            'atasan_id' => 'nullable|exists:employees,id',
            'foto'      => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('foto')) {
            if ($employee->foto) {
                if (file_exists(public_path($employee->foto))) {
                    @unlink(public_path($employee->foto));
                } elseif (file_exists(public_path('uploads/' . $employee->foto))) {
                    @unlink(public_path('uploads/' . $employee->foto));
                }
            }

            $targetDir = public_path('uploads/employees');
            if (!file_exists($targetDir)) {
                @mkdir($targetDir, 0755, true);
            }
            $file = $request->file('foto');
            $ext = $file->getClientOriginalExtension() ?: 'jpg';
            $filename = time() . '_' . Str::random(10) . '.' . $ext;
            $file->move($targetDir, $filename);
            $validated['foto'] = 'uploads/employees/' . $filename;
        }

        $employee->update($validated);

        return redirect()->route('admin.employees.index')
            ->with('success', 'Data pegawai berhasil diperbarui!');
    }

    /**
     * Hapus data pegawai.
     */
    public function destroy(Employee $employee)
    {
        if ($employee->foto) {
            if (file_exists(public_path($employee->foto))) {
                @unlink(public_path($employee->foto));
            } elseif (file_exists(public_path('uploads/' . $employee->foto))) {
                @unlink(public_path('uploads/' . $employee->foto));
            }
        }

        $employee->delete();

        return redirect()->route('admin.employees.index')
            ->with('success', 'Pegawai berhasil dihapus!');
    }
}
