<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;

class EmpresasController extends Controller
{
    public function index(){
 
        $empresas = Empresa::all();
 
        return view('empresas.index',compact('empresas'));
    }
 
    public function create(){
        return view('empresas.create');
    }
    
    public function storeEmpresa(Request $request){
 
        $empresa = $request->all();

        $validacao = \Validator::make($empresa, [
            'razao_social' => ['required', 'string', 'max:255'],
            'endereco' => ['required','string', 'max:255'],
            $this->validate($request, [
                'cnpj' => 'required|cnpj',
                'unique:empresas'
            ]),
            'telefone' => ['required','string', 'min:10']
        ]);

        if($validacao->fails()){
            return redirect()->back()->withErrors($validacao)->withInput();
        }      

        Empresa::create($empresa);
 
        return redirect('/register')
        ->with('success','Empresa Cadastrada com sucesso!');
    }

}
