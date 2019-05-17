<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePassword;
use App\Http\Requests\StoreSocio;
use App\Http\Requests\UpdateSocio;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::user()->direcao) {
            $socios = User::paginate(24);
        } else {
            $socios = User::where('ativo', 1)->paginate(24);
        }

        $title = 'Sócios';

        return view('socios.list', compact('title', 'socios'));
    }

    public function create()
    {
        $title = 'Inserir novo sócio';
        $socio = new User();

        return view('socios.add', compact('title', 'socio'));
    }

    public function store(StoreSocio $request)
    {
        if ($request->has('cancel')) {
            return redirect()->action('UserController@index');
        }

        $socio = $request->validated();

        $num_socio = User::max('num_socio');
        $socio['num_socio'] = ++$num_socio;
        $socio['password'] = Hash::make($socio['data_nascimento']);

        $user = User::create($socio);

        $user->sendEmailVerificationNotification();

        return redirect()->action('UserController@index');
    }

    public function show($id)
    {
        // NAO E PARA IMPLEMENTAR
    }

    public function edit(User $socio)
    {
        $title = "Editar Sócio";

        return view('socios.edit', compact('title', 'socio'));
    }

    public function update(UpdateSocio $request, User $socio)
    {
        if ($request->has('cancel')) {
            return redirect()->action('UserController@index');
        }

        $socioEdit = $request->validated();

//        $request->profile_picture->storeAs('fotos', $socio->id.'_pic.jpg');

        $keys = array_keys($socioEdit, null, true);

        foreach ($keys as $key) {
            unset($socioEdit[$key]);
        }

        $socio->fill($socioEdit);
        $socio->save();

        return redirect()->action('UserController@index');
    }

    public function destroy(User $socio)
    {
        $socio->delete();

        return redirect()->action('UserController@index');
    }

    public function setQuota() 
    {

    }

    public function resetQuotas()
    {

    }

    public function desativarSemQuotas() 
    {

    }

    public function ativarSocio(User $socio)
    {

    }

    public function alterarPassword()
    {
        $title = 'Alterar a senha';

        return view('socios.alterPassword', compact('title'));
    }

    public function patchPassword(ChangePassword $request)
    {
        $request->validated();

        $user = Auth::user();

        $user->password = Hash::make($request->input('password'));
        $user->password_inicial = 0;

        $user->save();

        return redirect()->back();
    }

    public function sendReActivationEmail(User $socio)
    {
        $socio->sendEmailVerificationNotification();

        return redirect()->back();
    }

    public function licenca(User $piloto)
    {
        return response()->file(storage_path("app/docs_piloto/licenca_$piloto->id.pdf", "licenca.pdf", [], null));
    }

    public function certificado(User $piloto)
    {
        return response()->file(storage_path("app/docs_piloto/certificado_$piloto->id.pdf", "certificado.pdf", [], null));
    }
}
