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
    public function store(Request $request)
    {   
        $this->validate($request, [
            'placa' => 'required',
            'modelo' => 'required',
            'cor' => 'required',  
            'tipo' => 'required',               
        ]);      

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
        $veiculos = Veiculos::find($id);
        return view('veiculos.create', compact('veiculos'));
    }
    public function update(Request $request, $id){    
        $veiculos = Veiculos::find($id);   
        $this->validate($request, [
            'placa' => 'required|unique:placa',
            'modelo' => 'required',
            'cor' => 'required',  
            'tipo' => 'required',               
        ]);   
                
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
