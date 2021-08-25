<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserController extends Controller
{

    /**
     * Retorna todos os usuários cadastrados
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Retorna um usuário específico
     */
    public function show($id)
    {
        return User::findOrFail($id);
    }

    /**
     * Edita um usuário específico
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email =  $request->email;
        $user->birth_date =  $request->birth_date;
        $user->sex = $request->sex;
        $user->password = Hash::make($request->password);

        $user->save();
    }

    /**
     * Deleta um usuário específico
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }
}
