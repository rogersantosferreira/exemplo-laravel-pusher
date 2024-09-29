<?php

use Illuminate\Support\Facades\Broadcast;


Broadcast::channel('canal.privado', function ($user) {
    return true; 
    // Autentique o usuário aqui conforme necessário, como por exemplo, 
    // verificar se o usuário logado deveria ser o destinatário dessa notificação sendo emitida.
    // O método abaixo traz um exemplo disso.
});

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
