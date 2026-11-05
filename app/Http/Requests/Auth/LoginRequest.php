<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email'    => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * HANYA izinkan login untuk role=admin.
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // Otentikasi dengan email dan password
        $credentials = [
            'email'    => (string) $this->input('email'),
            'password' => (string) $this->input('password'),
        ];

        if (! Auth::attempt($credentials, $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('Kredensial yang diberikan tidak cocok dengan data kami.'),
            ]);
        }

        // Pastikan hanya role yang diizinkan yang dapat mengakses sistem
        $allowedRoles = ['admin', 'admin_sda', 'admin_desa', 'pimpinan'];
        if (! in_array(Auth::user()->role, $allowedRoles)) {
            Auth::logout();
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('Akun Anda tidak memiliki izin untuk masuk ke sistem ini.'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => (int) ceil($seconds / 60),
            ]),
        ]);
    }

    public function throttleKey(): string
    {
        // Pastikan cast ke string agar aman di Laravel 10/11
        $email = Str::lower((string) $this->input('email'));
        return Str::transliterate($email.'|'.$this->ip());
    }
}
