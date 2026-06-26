<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Tampilkan form login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login request dengan API eksternal
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        try {
            // Panggil API eksternal
            $responsePusat = Http::withHeaders([
                'X-API-KEY' => 'fjm_secure_72b81e9d4a5c30f4a123f8c0e7b921',
                'Content-Type' => 'application/json',
            ])->post('https://mobile.fokusjasamitra.com/api/koperasi/login.php', [
                'badge'    => $request->username,
                'password' => $request->password
            ]);

            // Cek apakah API response berhasil
            if ($responsePusat->failed()) {
                return back()->withErrors(['login' => 'Gagal terhubung ke server. Silakan coba lagi.']);
            }

            $responseData = $responsePusat->json();

            // Cek apakah login berhasil dari API
            if (!isset($responseData['status']) || $responseData['status'] !== 'success') {
                return back()->withErrors(['login' => $responseData['message'] ?? 'Username atau password salah.']);
            }

            // Data user dari API
            $apiUser = $responseData['data'] ?? [];

            // Cari atau buat user di database lokal
            $user = User::updateOrCreate(
                ['badge' => $request->username],
                [
                    'name'   => $apiUser['name'] ?? $request->username,
                    'email'  => $apiUser['email'] ?? $request->username . '@fokusjasamitra.com',
                    'api_id' => $apiUser['id'] ?? null,
                    'password' => bcrypt($request->password), // Simpan password lokal untuk keamanan
                ]
            );

            // Login user
            Auth::login($user);

            return redirect()->intended('dashboard')
                ->with('success', 'Login berhasil!');

        } catch (\Exception $e) {
            Log::error('Login error: ' . $e->getMessage());
            return back()->withErrors(['login' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout berhasil!');
    }
}
