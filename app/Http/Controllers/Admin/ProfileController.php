<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function __construct(){
        $this->middleware('auth');

    }

    public function index(){
        $loggedId = intval(Auth::id());

        $user = User::find($loggedId);

        if($user){
            return view('admin.profile.index', ['user'=>$user]);

        }

        return redirect()->route('admin');
    }

    public function update(Request $request)
    {
        $loggedId = intval(Auth::id());
        $user = User::find($loggedId);

        if($user){
            $data = $request->only([
                'name',
                'email',
                'password',
                'password_confirmation'
            ]);

            $validator = Validator::make([
                'name'=> $data['name'],
                'email'=> $data['email']
            ], [
                'name'=> ['required', 'string', 'max:100', ],
                'email'=> ['required', 'string', 'email', 'max:100']
            ]);


            //1. Alteração do nome
            $user->name = $data['name'];

            //2. Alteração do email
            $hasEmail = User::where('email', $data['email'])->get(); //query de verificação (where)
            
            //2.1 Verificar se o email sofreu alterações

            if($user->email != $data['email']){

                //2.2 Verificar se o email existe

                if(count($hasEmail) === 0){
                   //2.3 Alterar o email =)
                    $user->email = $data['email'];
                }else{

                    $validator->errors()->add('email', __('validation.unique', [
                        'attribute' => 'email'
                    ]));
                }
            }

            //3 Alterar a senha
            //3.1 Verifica se a senha foi digitada no input
            if(!empty($data['password'])){
                if(strlen($data['password']) >= 4){
                    if($data['password'] === $data['password_confirmation']){
                        $user->password = Hash::make($data['password']);
                    }else{
                        $validator->errors()->add('passoword', __('validation.confirmed', [
                            'attribute' => 'password'
                        ]));
                    }

                }else{
                    $validator->errors()->add('passoword', __('validation.min.string', [
                        'attribute' => 'password',
                        'min'=> 4
                    ]));

                }

            }

            if(count( $validator->errors() ) > 0){

                return redirect()->route('user.profile', [
                    'user'=> $loggedId
                ])->withErrors($validator);
            }

            $user->save();

            return redirect()->route('user.profile')->with('warning', 'Informações alteradas com sucesso!');
        }

        return redirect()->route('user.profile');
    }

}
