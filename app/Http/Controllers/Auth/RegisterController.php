<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;
use App\Mail\ActivationNotifier;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'=>'required|regex:/^([a-zA-Z]+\s)*[a-zA-Z]+$/',
            'email'=>'required|email|unique:users,email',
            'nome_informal'=>'required|regex:/^([a-zA-Z]+\s)*[a-zA-Z]+$/',
            'sexo'=>'required',
            'data_nascimento'=>'required|date',
            'nif'=>'required|unique:users,nif|integer',
            'telefone'=>'required|unique:users,telefone|regex:/^\+?\d{3}(?: ?\d+)*$/',
            'endereco'=>'required',
            'tipo_socio'=>'required'
        ], [
            'name.required'=>'O nome deve ser preeenchido',
            'name.regex'=>'O nome não deve conter números',
            'email.required'=>'O email deve ser preenchido',
            'email.email'=>'O formato do email não é válido',
            'email.unique'=>'Este email já se encontra registado',
            'nome_informal.required'=>'O nome deve ser preenchido',
            'nome_informal.regex'=>'O nome não deve conter números',
            'sexo.required'=>'O género tem que ser definido',
            'data_nascimento.required'=>'A data de nascimento deve ser preenchida',
            'data_nascimento.date'=>'O formato da data está inválido',
            'nif.required'=>'O NIF deve ser preenchido',
            'nif.unique'=>'Este NIF já se encontra registado',
            'nif.integer'=>'O NIF tem que ser um número inteiro',
            'telefone.required'=>'O número de telefone deve ser preenchido',
            'telefone.unique'=>'Este número de telefone já se encontra registado',
            'telefone.regex'=>'O formato número de telefone não é válido',
            'endereco.required'=>'O endereço deve ser preenchido',
            'tipo_socio.required'=>'O tipo de sócio tem que ser preenchido'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $num_socio = User::max('num_socio');
        $data['num_socio'] = ++$num_socio;
        $data['password'] = Hash::make($data['data_nascimento']);

        $return = User::create($data);

        $socio = User::where('num_socio', $num_socio)->first();
        Mail::to($socio)->send(new ActivationNotifier($socio));

        return $return;
    }
}
