<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){

        $this->middleware('auth');
        $this->middleware('can:edit-users');
    }
    
    public function index()
    {
        $users = User::paginate(10);
        $loggedId = intval(Auth::id());

        return view('admin.users.index', ['users'=>$users, 'loggedId'=>$loggedId]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'name',
            'email',
            'password',
            'password_confirmation'
        ]);

        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:200', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed']
        ]);

        if($validator->fails()){
            return redirect()->route('user.create')->withErrors($validator);
        }

        $users = new User;
        $users->name = $data['name'];
        $users->email = $data['email'];
        $users->password = Hash::make($data['password']);
        $users->save();

        return redirect()->route('users.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        if($user){
            return view('admin.users.edit', [
                'user'=>$user
            ]);

        }
        return redirect()->route('users.index');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

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

                return redirect()->route('user.edit', [
                    'user'=> $id
                ])->withErrors($validator);
            }

            $user->save();
        }

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loggedId = intval(Auth::id());

        if($loggedId !== intval($id)){
            $user = User::find($id);
            $user->delete();
        }

        return redirect()->route('users.index');
    }

    public function admin($id){
        $user = User::find($id);

        if($user){
            if($user->admin === 0){
                $user->admin = 1;
                $user->save();
                return redirect()->route('users.index')->with('warning', 'Usuário definido com Admin');
            }

        }

        return redirect()->route('users.index');

    }

    public function remove_admin($id){
        $user = User::find($id);

        if($user){
           $user->admin = 0;
           $user->save();
           return redirect()->route('users.index')->with('warning', 'Usuário removido de admin com sucesso!');
        }

        return redirect()->route('users.index');

    }
}
