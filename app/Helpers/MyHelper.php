<?php

function makeMessages()
{
    $messages = [
        'name.required' => 'El campo nombre es obligatorio.',
        'email.required' => 'El campo correo electrónico es obligatorio.',
        'password.required' => 'El campo contraseña es obligatorio.',
        'email.email' => 'Ingrese una dirección de correo electrónico válida',
        'email.unique' => 'El correo electrónico ya esta registrado',
        'password.min' => 'La contraseña debe tener al menos :min caracteres.',
    ];

    return $messages;
}
