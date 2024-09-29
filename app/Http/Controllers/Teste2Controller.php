<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Pusher\Pusher;

class Teste2Controller extends Controller
{
 
    //função para autenticar o canala privado e retornar uma hash única de conexão do socket
    public function autentica(Request $request) {
        //dd($request->all());
        
        // Autenticação básica do usuário (pode ser baseada no ID ou outra lógica)
        // aqui use a linha abaixo caso queira verificar se está logado pra tentar nomear um canal privado com base em ID do usuário, por exemplo
        
        //if (auth()->check()) {            // só descomente caso queira exigir autenticação para usar o canal privado
            $pusher = new Pusher(
                '402718cde78ca8343bf6',
                '80a45045f3227897e671',
                '1871982',
                ['cluster' => 'mt1',
                 'useTLS' => true]
            );

            // Verificação da assinatura do canal privado
            $auth = $pusher->socket_auth($request->channel_name, $request->socket_id);

            return response($auth, 200);
        //} else {                         //aqui é o retorno do caso quando não está logado!
        //    return response('Unauthorized', 403);
        //}
    }


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
        
            // enviar mensagem para o canal privado
            $data['message'] = $request->message;
            $pusher->trigger('private-my-channel', 'my-event', $data);
        
            // dá retorno ao AJAX do jquery que chamou o envio da msg
            return response()->json(['status' => 'sucesso',
                                     'mensagem' => 'Mensagem enviada com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'erro',
                                        'mensagem' => $e->getMessage()]);
        }
    }
}
