<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $data = User::all();
        return view('usuarios.index',compact('data'));
    }
    public function create()
    {       
        return view('usuarios.create');
    }
    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password', 
        ]);

        if ($validator->fails()) {
            return response()
                ->json([
                    'status' => 'Failed',
                    'message' => $validator->errors()->first(),
                ]);
        }
    
        try {
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            User::create($input);   
            return response()
                ->json([
                    'status' => 'Ok',
                    'message' => 'Usúario cadastrado com sucesso',
                    'redirect' => route('usuarios.index')
                ]);
        } catch (\Throwable $e) {
            return response()
            ->json([
                'status' => 'Failed',
                'message' => $e->getMessage(),
            ]);
        }         
    }
    public function show($id)
    {
        $user = User::find($id);
        return view('usuarios.show',compact('user'));
    }
    public function edit($id)
    {    
        $user = User::find($id);
        return view('usuarios.edit', compact('user'));
    }
    public function update(Request $request, $id){       
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',               
        ]);       
        
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
        try {
            $user = User::find($id);
            $user->update($input); 
            return redirect()->route('usuarios.index')
            ->with('success','Usúario atualizado com sucesso');
        } catch (\Throwable $th) {
            return redirect()->route('usuarios.index')
            ->with('error',$th->getMessage());
        }        
    }
    public function destroy($id)
    {       
        try {
            $user = User::find($id);
            $user->delete(); 
            return redirect()->route('usuarios.index')
            ->with('success','Usúario excluido com sucesso');
        } catch (\Throwable $th) {
            return redirect()->route('usuarios.index')
            ->with('error',$th->getMessage());
        }      
    }
}
