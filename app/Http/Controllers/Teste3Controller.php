<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Pusher\Pusher;
use App\Events\MeuEvento;

class Teste3Controller extends Controller
{
    //função para enviar mensagens da página demo para o canal privado
    public function envia(Request $request) {
        try {
            // conecta à instância Pusher do Laravel
            $pusher = new Pusher(
                '402718cde78ca8343bf6',
                '80a45045f3227897e671',
                '1871982',
                ['cluster' => 'mt1',
                 'useTLS' => true]
            );
        
            // enviar mensagem para o canal privado via despacho de Evento em broadcasting no Laravel
            event(new MeuEvento($request->message));
        
            // dá retorno ao AJAX do jquery que chamou o envio da msg
            return response()->json(['status' => 'sucesso',
                                     'mensagem' => 'Mensagem enviada com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'erro',
                                     'mensagem' => $e->getMessage()]);
        }
    }
}
