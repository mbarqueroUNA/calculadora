<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculadoraController extends Controller
{
    public function showForm()
    {
        return view('calculadora');
    }

    public function calcular(Request $request)
    {
        $request->validate([
            'a' => 'required|numeric',
            'b' => 'required|numeric',
            'op' => 'required|in:sumar,restar,multiplicar,dividir',
        ]);

        $a = $request->input('a');
        $b = $request->input('b');
        $op = $request->input('op');
        $resultado = null;

        switch ($op) {
            case 'sumar':
                $resultado = $a + $b;
                break;
            case 'restar':
                $resultado = $a - $b;
                break;
            case 'multiplicar':
                $resultado = $a * $b;
                break;
            case 'dividir':
                if ($b == 0) {
                    return back()->withErrors(['b' => 'No se puede dividir por cero'])->withInput();
                }
                $resultado = $a / $b;
                break;
        }

        return view('calculadora', compact('resultado'));
    }
}
