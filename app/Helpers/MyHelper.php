<?php

use Carbon\Carbon;
use App\Models\Concert;

function makeMessages()
{
    $messages = [
        'name.required' => 'El campo nombre es requerido.',
        'email.required' => 'El campo correo electrónico es requerido.',
        'email.unique' => 'El correo electrónico ya se encuentra en el sistema.',
        'price.required' => 'El campo precio es requerido.',
        'price.min' => 'El campo precio debe ser mayor o igual a :min.',
        'price.max' => 'Ingrese un precio válido.',
        'price.numeric' => 'El campo precio debe ser un valor númerico.',
        'stock.required' => 'El campo stock es requerido.',
        'date.required' => 'El campo fecha es requerido.',
        'date.date' => 'Ingrese una fecha válida.',
        'email.email' => 'Ingrese una dirección de correo electrónico válida.',
        'password.required' => 'El campo contraseña es requerido.',
        'password.min' => 'La contraseña debe tener al menos :min caracteres.',
        'stock.between' => 'El stock debe ser entre 100 y 400 entradas.',
        'quantity.required' => 'El campo cantidad de entradas es requerido.',
        'quantity.min' => 'La cantidad de entradas debe ser mayor o igual a :min.',
        'pay_method.required' => 'El método de pago es requerido.',
        'date_search.required' => 'Ingrese una fecha válida.',
        'email_search.required' => 'Ingrese un correo electrónico válido.',
        'email_search.email' => 'Ingrese un correo electrónico válido.',
        'email_search.string' => 'Ingrese un correo electrónico válido.',
    ];

    return $messages;
}

function validDate($date)
{
    $fechaActual = date("d-m-Y");
    $fechaVerificar = Carbon::parse($date);

    if ($fechaVerificar->lessThanOrEqualTo($fechaActual)) {
        return true;
    }

    return false;
}

function existConcertDay($date_concert)
{
    $concerts = Concert::getConcerts();
    $date = date($date_concert);

    foreach ($concerts as $concert) {

        if ($concert->date == $date) {
            return true;
        }
    }
    return false;
}

function verifyStock($id, $quantity)
{
    $concert = Concert::find($id);

    if ($quantity > $concert->stock) {
        return false;
    }
    return true;
}

function discountStock($id, $quantity)
{
    $concert = Concert::find($id);

    $concert->stock -= $quantity;
    $concert->save();
    return true;
}

function generateReservationNumber()
{
    do {
        $number = mt_rand(1000, 9999);
        // ejecutar foreach
    } while (substr($number, 0, 1) === '0');

    return $number;
}
