<?php

namespace App\Http\Controllers;

use App\Models\Mensagem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use \App\Mail\NovaMensagemMail;
class MensagemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // recover only messages that are not deleted and order by created_at and limit to 10 and associated with user
        $mensagens = Mensagem::all()
                            ->where('user_id', auth()->user()->id)
                            ->where('deleted_at', null)
                            ->sortByDesc('created_at');

        return view('mensagens.index', compact('mensagens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mensagens.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regras = [
            'mensagem' => 'required|string|max:255',
        ];

        $feedback = [
            'mensagem.required' => 'O campo Mensagem é obrigatório.',
            'mensagem.string' => 'O campo Mensagem deve ser uma string.',
            'mensagem.max' => 'O campo Mensagem deve ter no máximo 255 caracteres.',
        ];

        $validacao = $request->validate($regras, $feedback);

        if ($validacao) {
            $mensagem = new Mensagem();
            $mensagem->mensagem = $request->mensagem;
            $mensagem->user_id = auth()->user()->id;

            $mensagem->save();

            $position = $mensagem->getPosition($mensagem->id);
            $mensagem->setPosition($mensagem->id, $position);

            // Enviar email
            $email = auth()->user()->email;
            Mail::to($email)->send(new NovaMensagemMail($mensagem));

            return redirect()->route('mensagens.show', $mensagem->id)->with('toast_success', 'Mensagem criada com sucesso!');
        } else{
            return redirect()->route('mensagens.create')->withErrors($validacao);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $mensagem = Mensagem::find($id);
        return view('mensagens.show', compact('mensagem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $mensagem = Mensagem::find($id);

        /**
         * Verifica se o usuário logado é o mesmo que criou a mensagem
         */
        if (auth()->user()->id == $mensagem->user_id) {
            return view('mensagens.create_edit', compact('mensagem'));
        } else {
            return redirect()->route('mensagens.index')->with('toast_error', 'Você não tem permissão para editar esta mensagem.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id = 0)
    {
        $regras = [
            'mensagem' => 'required|string|max:255',
        ];

        $feedback = [
            'mensagem.required' => 'O campo Mensagem é obrigatório.',
            'mensagem.string' => 'O campo Mensagem deve ser uma string.',
            'mensagem.max' => 'O campo Mensagem deve ter no máximo 255 caracteres.',
        ];

        $validacao = $request->validate($regras, $feedback);

        if ($validacao) {
            
            /**
             * Check if message is not deleted and is associated with user
             */
            $mensagem = Mensagem::find($id);

            if ($mensagem->user_id == auth()->user()->id && $mensagem->deleted_at == null) {
                $mensagem->mensagem = $request->mensagem;
                $mensagem->update();

                return redirect()->route('mensagens.show', $mensagem->id)->with('toast_success', 'Mensagem atualizada com sucesso!');
            } else {
                return redirect()->route('mensagens.index')->with('toast_error', 'Mensagem não encontrada ou não pertence ao utilizador!');
            }

        } else{
            return redirect()->route('mensagens.edit', $id)->withErrors($validacao);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id = 0 )
    {
        // Before delete, ask if user really wants to delete using sweetalert
        $mensagem = Mensagem::find($id);

        if ($mensagem->user_id == auth()->user()->id && $mensagem->deleted_at == null) {

            $mensagem->delete();
            return redirect()->route('mensagens.index')->with('toast_success', 'Mensagem apagada com sucesso!');
        } else {
            return redirect()->route('mensagens.index')->with('toast_error', 'Mensagem não encontrada ou não pertence ao utilizador!');
        }
    }
}
