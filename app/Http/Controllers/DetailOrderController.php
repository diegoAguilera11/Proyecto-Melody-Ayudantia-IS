<?php

namespace App\Http\Controllers;

use App\Models\Concert;
use App\Models\DetailOrder;
use Illuminate\Http\Request;

class DetailOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $concert = Concert::find($id);
        return view('client.create', [
            'concert' => $concert
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {

        $reservation_number = generateReservationNumber();

        //Modificar request
        $request->request->add(['reservation_number' => $reservation_number]);


        $messages = makeMessages();
        $this->validate($request, [
            'quantity' => ['required', 'numeric', 'min:1'],
            'pay_method' => ['required'],
            'total' => ['required']
        ], $messages);

        // Validar el stock del concierto
        $validStock = verifyStock($id, $request->quantity);

        if (!$validStock) {
            return back()->with('message', 'No se dispone del stock suficiente para este concierto.');
        }

        //Crear la orden de compra
        $detail_order = DetailOrder::create([
            'reservation_number' => $request->reservation_number,
            'quantity' => $request->quantity,
            'total' => $request->total,
            'payment_method' => $request->pay_method,
            'user_id' => auth()->user()->id,
            'concert_id' => $id
        ]);

        // Descontar el stock del concierto
        discountStock($id, $request->quantity);

        return redirect()->route('generate.pdf', [
            'id' => $detail_order->id
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(DetailOrder $detailOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailOrder $detailOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetailOrder $detailOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetailOrder $detailOrder)
    {
        //
    }
}
