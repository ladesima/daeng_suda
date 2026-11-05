<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Redirect user based on role.
     *
     * - admin_desa -> route('esdm.desa.dashboard')
     * - admin_sda  -> route('esdm.admin.dashboard')
     * - pimpinan   -> route('esdm.pimpinan.dashboard')
     * - admin/default -> route('admin.dashboard')
     */
    protected function redirectBasedOnRole(): RedirectResponse
    {
        $user = Auth::user();

        if ($user) {
            if ($user->role === 'admin_desa') {
                return redirect()->route('esdm.desa.dashboard');
            }
            if ($user->role === 'admin_sda') {
                return redirect()->route('esdm.admin.dashboard');
            }
            if ($user->role === 'pimpinan') {
                return redirect()->route('esdm.pimpinan.dashboard');
            }
        }

        return redirect()->route('admin.dashboard');
    }

    // Tampilkan login; kalau sudah login, redirect sesuai peran
    public function create()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole();
        }
        return view('auth.login');
    }

    // Proses login; setelah sukses, redirect sesuai peran (tanpa intended)
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();

        // Pastikan tidak ada intended sisa ke halaman publik
        $request->session()->forget('url.intended');

        return $this->redirectBasedOnRole();
    }

    // Logout
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
