<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function showChangePasswordForm()
    {
        return view('auth.passwords.reset'); // Vista para cambiar la contraseña
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        // Verifica que la contraseña actual sea correcta
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual no es correcta.']);
        }

        // Actualiza la contraseña
        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        //$user->Save();

        return redirect()->route('home')->with('status', 'Contraseña cambiada correctamente.');
    }
}
