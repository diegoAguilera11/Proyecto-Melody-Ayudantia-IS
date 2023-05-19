<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Concert;
use Illuminate\Http\Request;

class ConcertController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        if ($user->role == 2) {
            $concerts = Concert::getConcerts();
            return view('admin.dashboard', [
                'concerts' => $concerts,
            ]);
        } else {
            return view('client.dashboard');
        }
    }

    public function create()
    {
        return view('concerts.create');
    }

    public function store(Request $request)
    {
        // dd($request);
        $messages = makeMessages();

        // Validar
        $this->validate($request, [
            'name' => ['required', 'min:5'],
            'price' => ['required', 'numeric', 'min:20000', 'max:2147483647'],
            'stock' => ['required', 'numeric', 'between:100,400'],
            'date' => ['required', 'date']
        ], $messages);

        //  Verificamos si la fecha ingresada es mayor a la fecha actual.
        $invalidDate = validDate($request->date);
        if ($invalidDate) {
            return back()->with('message', 'La fecha debe ser mayor a ' . date("d-m-Y"));
        }


        // Verificar si en la fecha ingresada existe un concierto.
        $existConcert = existConcertDay($request->date);
        if ($existConcert) {
            return back()->with('message', 'Ya existe un concierto para el dia ingresado');
        }

        // Crear Concierto
        Concert::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'date' => $request->date,
            'image' => "843392092f000"
        ]);

        toastr()->success('El concierto fue creado con éxito', 'Concierto creado!');

        return redirect()->route('dashboard');
    }

    public function searchDate(Request $request)
    {
        $messages = makeMessages();
        $this->validate($request, [
            'date_search' => ['required']
        ], $messages);

        $date = date($request->date_search);
        if ($date == null) {
            $concerts = Concert::getConcerts();
            return view('client.index', [
                'concerts' => $concerts,
            ]);
        } else {
            $concerts = Concert::where('date', "=", $date)->simplePaginate(1);
            return view('client.index', [
                'concerts' => $concerts
            ]);
        }
    }


    public function concertsList()
    {
        $concerts = Concert::getConcerts();
        return view('client.index', [
            'concerts' => $concerts,
        ]);
    }

    public function myConcerts()
    {
        // dd(auth()->user());
        return view('client.my_concerts', [
            'user' => auth()->user()
        ]);
    }
}
