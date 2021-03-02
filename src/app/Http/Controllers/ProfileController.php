<?php

namespace App\Http\Controllers;

use App\Rules\StrengthPassword;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index () {
    	$user = auth()->user()->load('socialAccount');
    	return view('profile.index', compact('user'));
    }

    public function editarPerfilUsuario () {
        $user = auth()->user()->load('socialAccount');
        return view('profile.index', compact('user'));
    }

    public function userProfile (Request $request) {
        $user = User::find($request->id_user);
        return view('perfil-usuario', compact('user'));
    }

    public function notIndex () {
        return redirect()->route('inicioPagina');
    }

    public function update () {
		$this->validate(request(), [
			'password' => ['confirmed', new StrengthPassword]
		]);

		$user = auth()->user();
		$user->password = bcrypt(request('password'));
		$user->save();
	    return back()->with('message', ['success', __("Usuario actualizado correctamente")]);
    }

    public function updateUsuario (Request $request) {
        $AuthUserID = auth()->user()->id;
        $user = User::find($AuthUserID);
        $user->name = $request->user_name;
        $user->last_name = $request->user_lastname;
        $user->email = $request->user_email;

        if ($request->picture) {
            $imageName = $request->picture->getClientOriginalName();
            $request->picture->move(public_path('/images/users'), $imageName);
            $user->picture = $imageName;
        }

        $user->save();

        $user = User::find($AuthUserID);
        return view('perfil-usuario', compact('user'));
    }

    public function updateContrasenaUsuario (Request $request) {
        $AuthUserID = auth()->user()->id;
        $user = User::find($AuthUserID);
        $user->password = bcrypt($request->nuevaContrasena);
        $user->save();

        $user = User::find($AuthUserID);
        return view('perfil-usuario', compact('user'));
    }

}
