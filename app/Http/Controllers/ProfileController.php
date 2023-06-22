<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('profile.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->request->add(['email' => Str::lower($request->email)]);

        $messages = makeMessages();

        $this->validate($request, [
            'name' => ['required', 'min:3', 'max:20'],
            'email' => ['required', 'unique:users,email,' . auth()->user()->id, 'email', 'max:60']
        ], $messages);

        // Guardar Cambios
        $usuario = User::find(auth()->user()->id);

        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->save();

        toastr()->success('Tu datos fueron actualizados con éxito', 'Datos actualizados!');
        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
