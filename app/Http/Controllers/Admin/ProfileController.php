<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

    /**
     * ProfileController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function  index(){
        $loggedId = intval(Auth::id());
        $user = User::find($loggedId);
        if($user){
            return view('admin.profile.index',[
                'user'=>$user
            ]);
        }
        redirect()->route('admin');
    }

    public function  save(Request  $request)
    {
        $loggedId = intval(Auth::id());
        $user = User::find($loggedId);
        if (!$user) {
            return redirect()->route('users.index');
        }

        $data = $request->only([
            'name',
            'email',
            'password',
            'password_confirmation'
        ]);

        $validator = Validator::make([
            'name' => $data['name'],
            'email' => $data['email']
        ], [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100']
        ]);

        // 1. alterar o nome
        $user->name = $data['name'];
        //2. alteração do email
        //2.1 verificar se o email foi alterado
        if ($user->email != $data['email']) {
            //2.2 verificar se o novo email já existe
            $hasEmail = User::where('email', $data['email'])->first();
            if (!$hasEmail) {
                $user->email = $data['email'];
            } else {
                $validator->errors()->add('password', __('validation.unique', [
                    'attribute' => 'email'
                ]));
            }
        }
        //3 verifica se existe senha digitada
        if (!empty($data['password'])) {
            //3.2 verifica se a confirmação de senha condiz ccom a senha digitada
            if (strlen($data['password'])>= 4) {
                if ($data['password'] === $data['password_confirmation']) {
                    $user->password = Hash::make($data['password']);

                } else {
                    $validator->errors()->add('password', __('validation.confirmed', [
                        'attribute' => 'senha',
                    ]));
                }
            } else {
                $validator->errors()->add('password', __('validation.min.string', [
                    'attribute' => 'senha',
                    'min' => 4
                ]));
            }
        }

        if (count($validator->errors()) > 0) {
            return redirect()->route('profile', [
                'user' => $user
            ])->withErrors($validator);
        }
        $user->save();
        return redirect()->route('profile')->with('warning','Informações alteradas com sucesso!!');
    }
}
