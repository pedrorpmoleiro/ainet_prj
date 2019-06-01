<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePassword;
use App\Http\Requests\StoreSocio;
use App\Http\Requests\UpdateSocio;
use App\Movimento;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $socios = User::orderBy('id');
        $query = $request->query();
        $title = 'Sócios';

        $filters = [
            'num_socio' => '', 'nome_informal' => '', 'email' => '', 'tipo' => '',
            'direcao' => '', 'quotas_pagas' => '', 'ativo' => ''
        ];

        foreach ($query as $name => $value) {
            $$name = $value;
        }

        if (isset($num_socio)) {
            $filters['num_socio'] = $num_socio;

            $socios = $socios->where('num_socio', $num_socio);
        }

        if (isset($nome_informal)) {
            $filters['nome_informal'] = $nome_informal;

            $socios = $socios->where('nome_informal', 'like', '%' . $nome_informal . '%');
        }

        if (isset($email)) {
            $filters['email'] = $email;


            $socios = $socios->where('email', 'like', '%' . $email . '%');
        }
        if (isset($tipo)) {
            $filters['tipo'] = $tipo;

            if ($tipo != "Todos") $socios = $socios->where('tipo_socio', $tipo);
        }

        if (isset($direcao)) {
            $filters['direcao'] = $direcao;

            if ($direcao != 'A') $socios = $socios->where('direcao', $direcao);
        }

        if (isset($quotas_pagas)) {
            $filters['quotas_pagas'] = $quotas_pagas;

            if ($quotas_pagas != 'A') $socios = $socios->where('quota_paga', $quotas_pagas);
        }

        if (Auth::user()->direcao == 1) {
            if (isset($ativo)) {
                $filters['ativo'] = $ativo;

                if ($ativo != 'A') $socios = $socios->where('ativo', $ativo);
            }
        } else {
            $socios = $socios->where('ativo', 1);
        }

        $socios = $socios->paginate(24);

        return view('socios.list', compact('title', 'socios', 'filters'));
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

        $socio['password'] = Hash::make($socio['data_nascimento']);

        $user = User::create($socio);

        if (isset($socio['file_foto'])) {
            $path = $socio['file_foto']->storeAs('public/fotos', $user->id . '_pic.jpg');
            $foto = basename($path);
            $user->foto_url = $foto;
            $user->save();
        }

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
        $tipos_licenca = DB::table('tipos_licencas')->select(['code'])->get();
        $classes_certificados = DB::table('classes_certificados')->select(['code'])->get();

        return view('socios.edit', compact('title', 'socio', 'tipos_licenca', 'classes_certificados'));
    }

    public function update(UpdateSocio $request, User $socio)
    {
        $socioEdit = $request->validated();

        $foto = null;
        if (isset($socioEdit['file_foto'])) {
            Storage::delete("public/fotos/$socio->foto_url");
            $path = $socioEdit['file_foto']->storeAs('public/fotos', $socio->id . '_pic.jpg');
            $foto = basename($path);
            unset($socioEdit['file_foto']);
        }

        if (isset($socioEdit['file_licenca'])) {
            $socioEdit['file_licenca']->storeAs('docs_piloto', "licenca_$socio->id.pdf");
            unset($socioEdit['file_licenca']);
            $socioEdit['licenca_confirmada'] = 0;
        }

        if (isset($socioEdit['file_certificado'])) {
            $socioEdit['file_certificado']->storeAs('docs_piloto', "certificado_$socio->id.pdf");
            unset($socioEdit['file_certificado']);
            $socioEdit['certificado_confirmado'] = 0;
        }

        $keys = array_keys($socioEdit, null, true);

        foreach ($keys as $key) {
            unset($socioEdit[$key]);
        }

        $socioEdit['data_nascimento'] = date('Y-m-d', strtotime($socioEdit['data_nascimento'])) ?? $socioEdit['data_nascimento'];

        if ($socio->tipo_socio == 'P') {
            if ($socioEdit['num_licenca'] != (string)$socio->num_licenca
                || $socioEdit['tipo_licenca'] != (string)$socio->tipo_licenca
                || $socioEdit['validade_licenca'] != (string)$socio->validade_licenca
            ) {
                $socioEdit['licenca_confirmada'] = '0';
            }

            if ($socioEdit['num_certificado'] != (string)$socio->num_certificado
                || $socioEdit['classe_certificado'] != (string)    $socio->classe_certificado
                || $socioEdit['validade_certificado'] != (string)$socio->validade_certificado
            ) {
                $socioEdit['certificado_confirmado'] = '0';
            }

            $socioEdit['validade_licenca'] = $socioEdit['validade_licenca'] ?? $socio->validade_licenca;
            $socioEdit['validade_certificado'] = $socioEdit['validade_certificado'] ?? $socio->validade_certificado;

        } else if (!Auth::user()->direcao) {
            if (isset($socioEdit['num_socio'])) unset($socioEdit['num_socio']);
            if (isset($socioEdit['ativo'])) unset($socioEdit['ativo']);
            if (isset($socioEdit['quota_paga'])) unset($socioEdit['quota_paga']);
            if (isset($socioEdit['sexo'])) unset($socioEdit['sexo']);
            if (isset($socioEdit['tipo_socio'])) unset($socioEdit['tipo_socio']);
            if (isset($socioEdit['direcao'])) unset($socioEdit['direcao']);
            if (isset($socioEdit['instrutor'])) unset($socioEdit['instrutor']);
            if (isset($socioEdit['aluno'])) unset($socioEdit['aluno']);
            if (isset($socioEdit['certificado_confirmado'])) unset($socioEdit['certificado_confirmado']);
            if (isset($socioEdit['licenca_confirmada'])) unset($socioEdit['licenca_confirmada']);
        }

        $socio->fill($socioEdit);
        $socio->foto_url = $foto ?? $socio->foto_url;

        $socio->save();

        return redirect()->action('UserController@index');
    }

    public function destroy(User $socio)
    {
        Storage::delete("public/fotos/$socio->foto_url");

        if (Movimento::where('piloto_id', $socio->id)->count() == 0
            && Movimento::where('instrutor_id', $socio->id)->count() == 0
        ) {
            $socio->forceDelete();
        } else {
            $socio->delete();
        }

        return redirect()->action('UserController@index');
    }

    public function setQuota(Request $request, User $socio)
    {
        $quota_paga = (int)$request->input('quota_paga');

        if ($quota_paga != 0 && $quota_paga != 1) {
            throw new AccessDeniedHttpException('Unauthorized.');
        }

        $socio->quota_paga = $quota_paga;

        $socio->save();

        return redirect()->action('UserController@index');
    }

    public function resetQuotas()
    {
        DB::table('users')->update(['quota_paga' => '0']);

        return redirect()->action('UserController@index');
    }

    public function desativarSemQuotas()
    {
        User::where('quota_paga', '0')->update(['ativo' => '0']);

        return redirect()->action('UserController@index');
    }

    public function ativarSocio(Request $request, User $socio)
    {
        $ativo = (int)$request->input('ativo');

        if ($ativo != 0 && $ativo != 1) {
            throw new AccessDeniedHttpException('Unauthorized.');
        }

        $socio->ativo = $ativo;

        $socio->save();

        return redirect()->action('UserController@index');
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
        if (Storage::disk('local')->exists("docs_piloto/licenca_$piloto->id.pdf")) {
            return response()->file(storage_path("app/docs_piloto/licenca_$piloto->id.pdf", "licenca.pdf", [], null));
        } else {
            return redirect()->action('UserController@edit', ['socio' => $piloto->id]);
        }
    }

    public function certificado(User $piloto)
    {
        if (Storage::disk('local')->exists("docs_piloto/certificado_$piloto->id.pdf")) {
            return response()->file(storage_path("app/docs_piloto/certificado_$piloto->id.pdf", "certificado.pdf", [], null));
        } else {
            return redirect()->action('UserController@edit', ['socio' => $piloto->id]);
        }
    }
}
