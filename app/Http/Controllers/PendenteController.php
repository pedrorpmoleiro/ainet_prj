<?php

namespace App\Http\Controllers;

use App\Movimento;
use App\User;

class PendenteController extends Controller
{
    public function index() {
        $title = "Asuntos Pendentes";
        $movimentos = Movimento::whereNotNull('tipo_conflito')->where('confirmado',0)->orWhere('confirmado',0)->paginate(24, ['*'], 'movimentos');
        $socios= User::where('licenca_confirmada',0)->orWhere('certificado_confirmado',0)->paginate(24, ['*'], 'socios');

        return view('pendente_list', compact('title', 'movimentos','socios'));
    }
}
