<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Concert;
use App\Models\DetailOrder;
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

        return view('client.my_concerts', [
            'user' => auth()->user()
        ]);
    }

    public function concertClients($id)
    {

        $concert = Concert::find($id);

        // Obtener los detalles de orden para el concierto seleccionado mediante su id
        $detail_orders = DetailOrder::where('concert_id', $id)->orderBy('created_at', 'asc')->get();

        // Obtener los usuarios relacionados con los detalles de orden
        $clients = User::whereIn('id', $detail_orders->pluck('user_id'))->get();


        return view(
            'concerts.concert_clients',

            compact('detail_orders', 'clients', 'concert')
        );
    }

    public function allConcerts()
    {
        $concerts = Concert::withSum('detailOrder', 'total')->get();
        return view('concerts.concerts', compact('concerts'));
    }
}
