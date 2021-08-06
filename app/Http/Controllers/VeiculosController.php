<?php

namespace App\Http\Controllers;

use App\Models\Veiculos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VeiculosController extends Controller
{
    public function index()
    {
        $data = veiculos::with('usuario')->get();
        return view('veiculos.index',compact('data'));
    }
    public function create()
    {       
        return view('veiculos.create');
    }

    public function verificaUser($veiculo){
        $user = Veiculos::with('usuario')->find($veiculo);
        if ($user->usuario->id != Auth::id()){
            return true;
        }
    }

    public function store(Request $request)
    {  
        $mensagens = [
            'formato_placa_de_veiculo' => 'A placa deve conter o seguinte formato: ABC1D23'
        ];
        $this->validate($request, [
            'placa' => 'required|formato_placa_de_veiculo|unique:veiculos',
            'modelo' => 'required',
            'cor' => 'required',  
            'tipo' => 'required',               
        ],$mensagens);      

        try {
            $input = $request->all();
            $input['user_id'] = Auth::id();
            veiculos::create($input);   
            return redirect()->route('veiculos.index')
            ->with('success','Veiculos criado com sucesso');
        } catch (\Throwable $th) {
            return redirect()->route('veiculos.index')
            ->with('error',$th->getMessage());
        }         
    }
    public function show($id)
    {
        $veiculo = Veiculos::find($id);
        return view('veiculos.show',compact('veiculo'));
    }
    public function edit($id)
    {   
        if ($this->verificaUser($id) == true){
            return redirect()->route('veiculos.index')
            ->withErrors('Veiculos não pertence ao usuario autenticado');
        };
        $veiculos = Veiculos::find($id);
        return view('veiculos.edit', compact('veiculos'));
    }
    public function update(Request $request, $id){   
        if ($this->verificaUser($id) == true){
            return redirect()->route('veiculos.index')
            ->withErrors('Veiculos não pertence ao usuario autenticado');
        };
        $veiculos = Veiculos::find($id);   
        $mensagens = [
            'formato_placa_de_veiculo' => 'A placa deve conter o seguinte formato: ABC1D23'
        ];
        $this->validate($request, [
            'placa' => 'required|formato_placa_de_veiculo|unique:veiculos,placa,'. $id,
            'modelo' => 'required',
            'cor' => 'required',  
            'tipo' => 'required',               
        ], $mensagens);   
                
        try {            
            $input = $request->all();
            $input['user_id'] = Auth::id();           
            $veiculos->update($input); 
            return redirect()->route('veiculos.index')
            ->with('success','Veiculos atualizado com sucesso');
        } catch (\Throwable $th) {
            return redirect()->route('veiculos.index')
            ->with('error',$th->getMessage());
        }        
    }
    public function destroy($id)
    {       
        if ($this->verificaUser($id) == true){
            return redirect()->route('veiculos.index')
            ->withErrors('Veiculos não pertence ao usuario autenticado');
        };
        try {            
            $veiculos = Veiculos::find($id);
            $veiculos->delete(); 
            return redirect()->route('veiculos.index')
            ->with('success','Veiculos excluido com sucesso');
        } catch (\Throwable $th) {
            return redirect()->route('veiculos.index')
            ->with('error',$th->getMessage());
        }      
    }
}
