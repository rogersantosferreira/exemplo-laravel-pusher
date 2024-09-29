<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Pusher\Pusher;

class Teste1Controller extends Controller
{
    public function envia(Request $request) {
        try {
            // conecta à instância Pusher do Laravel
            $pusher = new Pusher(
                '402718cde78ca8343bf6',
                '80a45045f3227897e671',
                '1871982',
                [
                    'cluster' => 'mt1',
                    'useTLS' => true
                ]
            );
            
            // enviar mensagem para o canal público
            $data['message'] = $request->message;
            $pusher->trigger('my-channel', 'my-event', $data);

            // dá retorno ao AJAX do jquery que chamou o envio da msg
            return response()->json(['status' => 'sucesso',
                                     'mensagem' => 'Mensagem enviada com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'erro',
                                     'mensagem' => $e->getMessage()]);
        }
    }
}
