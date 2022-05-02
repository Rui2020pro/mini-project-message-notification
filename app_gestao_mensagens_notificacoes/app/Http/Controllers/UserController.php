<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
            'new_password' => 'required|string|min:6',
            'password_confirmation' => 'required_with:password|same:new_password',
        ];

        $feedback = [
            'new_password.required' => 'A nova senha é obrigatória',
            'new_password.min' => 'A password deve ter no mínimo 6 caracteres',
            'password_confirmation.required_with' => 'A confirmação de password é obrigatória',
            'password_confirmation.same' => 'A confirmação de password não confere',
        ];
    
        /**
         * Validate the request
         */
        $validator = Validator::make($request->all(), $regras, $feedback);

        /**
         * If the validation fails, return the user to the edit page
         */
        if($validator->fails()) {

            return back()->with('toast_error', $validator->errors()->all())->withInput();
        }

        /**
         * Update the user's password if the password respect the rules
         */
        $user->password = Hash::make($request->new_password);
        $user->save();
        return back()->with('toast_success', 'Password alterada com sucesso!');

    }
}
