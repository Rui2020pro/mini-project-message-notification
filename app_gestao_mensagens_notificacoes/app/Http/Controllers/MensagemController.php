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
        //
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

            // Enviar email
            $email = auth()->user()->email;
            Mail::to($email)->send(new NovaMensagemMail($mensagem));

            return redirect()->route('mensagens.show', $mensagem->id);
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
     * @param  \App\Models\Mensagem  $mensagem
     * @return \Illuminate\Http\Response
     */
    public function edit(Mensagem $mensagem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mensagem  $mensagem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mensagem $mensagem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mensagem  $mensagem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mensagem $mensagem)
    {
        //
    }
}
