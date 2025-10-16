<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AccountController extends Controller
{
    public function index_admin(Request $request)
    {
        $query = User::where('role', 'admin'); 

        if ($request->filled('search')) {
            $query->where('username', 'like', '%' . $request->search . '%');
        }

        $admins = $query->orderBy('id', 'asc')->get();

        return view('admin.account.admin', compact('admins'));
    }

    public function index_user(Request $request)
    {
        $query = User::where('role', 'user'); 

        if ($request->filled('search')) {
            $query->where('username', 'like', '%' . $request->search . '%');
        }

        $users = $query->orderBy('id', 'asc')->get();

        return view('admin.account.user', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (auth()->id() == $user->id) {
            return back()->with('error', 'Akun yang sedang digunakan tidak dapat dihapus.');
        }

        $user->delete();

        if (auth()->user()->role == 'admin') {
            return redirect()->route('admin.account.index')->with('success', 'Data admin berhasil dihapus.');
        } else {
            return redirect()->route('user.account.index')->with('success', 'Data user berhasil dihapus.');
        }
    }
}
