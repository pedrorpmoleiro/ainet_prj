<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ActivationNotifier;
use App\Mail\ReActivationNotifier;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $socios = User::paginate(12);
        $title = 'Sócios';

        return view('socios.list', compact('title', 'socios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Inserir novo sócio';
        $socio = new User();

        return view('socios.add', compact('title', 'socio'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('cancel')) {
            return redirect()->action('UserController@index');
        }

        $socio = $request->validate([
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

        $num_socio = User::max('num_socio');
        $socio['num_socio'] = ++$num_socio;
        $socio['password'] = Hash::make($socio['data_nascimento']);

        User::create($socio);

        $socio = User::where('num_socio', $num_socio)->first();
        Mail::to($socio)->send(new ActivationNotifier($socio));

        return redirect()->action('UserController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // NAO E PARA IMPLEMENTAR
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $socio)
    {
        $title = "Editar Sócio";

        return view('socios.edit', compact('title', 'socio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $socio)
    {
        if ($request->has('cancel')) {
            return redirect()->action('UserController@index');
        }

        $socioEdit = $request->validate([
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

        $socio->fill($socioEdit);
        $socio->save();

        return redirect()->action('UserController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $socio)
    {
        $socio->delete();

        return redirect()->action('UserController@index');
    }

    public function resetQuotas()
    {

    }

    public function desativarSemQuotas() 
    {

    }

    public function validateEmail(User $user)
    {

    }

    public function ativarSocio(User $socio)
    {

    }

    public function sendReActivationEmail(User $socio) 
    {
        Mail::to($socio)->send(new ReActivationNotifier($socio));

        return redirect()->action('UserController@index');
    }
}
