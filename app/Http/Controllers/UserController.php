<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Query dasar melakukan left join antara user dan user_details
        $query = DB::table('user')
            ->leftJoin('user_details', 'user.id', '=', 'user_details.id_user')
            ->select(
                'user.id',
                'user_details.name as name', // MENGAMBIL NAME DARI USER_DETAILS
                'user.email',
                'user.phone',
                'user_details.ktp'
            );

        // Filter berdasarkan Nama (DIUBAH KE USER_DETAILS)
        if ($request->filled('nama')) {
            $query->where('user_details.name', 'like', '%' . $request->nama . '%');
        }

        // Filter berdasarkan Email
        if ($request->filled('email')) {
            $query->where('user.email', 'like', '%' . $request->email . '%');
        }

        // Filter berdasarkan No. HP
        if ($request->filled('no_hp')) {
            $query->where('user.phone', 'like', '%' . $request->no_hp . '%');
        }

        // Filter berdasarkan KTP (dari tabel user_details)
        if ($request->filled('ktp')) {
            $query->where('user_details.ktp', 'like', '%' . $request->ktp . '%');
        }

        // Dapatkan hasil (bisa disesuaikan dengan paginate jika data banyak)
        $users = $query->paginate(10);

        // Lempar variabel users ke tampilan
        return view('user.filter', compact('users'));
    }
}
