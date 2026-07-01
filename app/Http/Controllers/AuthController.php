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
            // 1. Panggil API eksternal
            $responsePusat = Http::withoutVerifying()
                ->withHeaders([
                    'X-API-KEY' => 'fjm_secure_72b81e9d4a5c30f4a123f8c0e7b921',
                    'Content-Type' => 'application/json',
                ])->post('https://mobile.fokusjasamitra.com/api/koperasi/login.php', [
                    'badge'    => $request->username,
                    'password' => $request->password
                ]);

            $responseData = $responsePusat->json();

            // 2. Cek kegagalan dari API
            if (!$responsePusat->successful() || !isset($responseData['status']) || $responseData['status'] !== 'success') {
                // Ambil pesan asli dari API, atau gunakan pesan default
                $pesanError = $responseData['message'] ?? 'NIK atau kata sandi salah.';
                return back()->withErrors(['login' => $pesanError]);
            }

            // 3. Ambil data user dari API 
            // Catatan: di contoh sistemmu yang sukses, datanya ada di 'user_data', bukan 'data'
            $apiUser = $responseData['user_data'] ?? $responseData['data'] ?? [];

            // 4. BUAT SESSION MANUAL (Menggantikan Model User & Auth::login)
            session([
                'is_logged_in' => true,
                'user_id'      => $request->username, // Simpan NIK
                'name'         => $apiUser['nama'] ?? $apiUser['name'] ?? $request->username,
                'role'         => 'user',
            ]);

            // Regenerate session untuk mencegah Session Fixation (Keamanan)
            $request->session()->regenerate();

            return redirect()->route('pengeluaran.index')->with('success', 'Login berhasil!');
        } catch (\Exception $e) {
            Log::error('Login error: ' . $e->getMessage());
            return back()->withErrors(['login' => 'Gagal terhubung ke server.']);
        }
    }

    public function logout(Request $request)
    {
        // Hapus semua data session manual yang kita buat tadi
        $request->session()->flush();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout berhasil!');
    }
}
