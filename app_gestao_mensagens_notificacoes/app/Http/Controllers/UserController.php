<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Render the edit profile page
     */
    public function edit()
    {

        $id = auth()->user()->id;
        
        $user = User::find($id);

        return view('user.edit', compact('user'));
    }

    /**
     * Update the user profile
     */
    public function update(Request $request)
    {
        /**
         * Get the user id
         */
        $id = auth()->user()->id;

        // amanhã vamos verificar se o usuário está tentando alterar a senha
        
        /**
         * Get the user
         */
        $user = User::find($id);

        /**
         * Build regras and feedback messages
         */
        $regras = [
            'new_password' => 'string|min:6',
            'password_confirmation' => 'required_with:password|same:new-password',
        ];

        $feedback = [
            'new_password.min' => 'A password deve ter no mínimo 6 caracteres',
            'password_confirmation.required_with' => 'A confirmação de password é obrigatória',
            'password_confirmation.same' => 'A confirmação de password não confere',
        ];

        /**
         * Validate the request
         */
        $validacao = $request->validate($regras, $feedback);

        echo '<pre>';
        print_r($validacao);
        echo '</pre>';
        die("RUi");

        // amanhã vamos verificar se o usuário está tentando alterar a senha

        /**
         * Update the user's password if the password respect the rules
         */
        if ($validacao) {
            $user->password = Hash::make($request->new_password);
            dd($user);
            die("Rui");
            $user->save();

            return redirect()->route('user.edit')->with('toast_success', 'Password alterada com sucesso!');
        }else{
            // return redirect route with all errors from validation and with old input with toast error
            return redirect()->route('user.edit')->withErrors($validacao)->withInput()->with('toast_error', $validacao);
        }

    }
}
