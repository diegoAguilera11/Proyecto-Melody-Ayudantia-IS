<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        // dd('Desde login controller');
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $messages = makeMessages();
        // Validar la información
        $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8']
        ], $messages);

        // Se intenta autenticar al usuario
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('message', 'Las credenciales son incorrectas');
        }

        return redirect()->route('concerts.index');
    }
}
