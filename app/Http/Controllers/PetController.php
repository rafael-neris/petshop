<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;

class PetController extends Controller{

    public function index(){
        
        $data = Pet::all();

        return response()->json($data);
    }

    public function store(Request $request){

        return response()->json(Pet::create($request->all()), 201);

    }

    public function show(int $id){
        $pet = Pet::find($id);
        if(is_null($pet)){
            return response()->json([
                'mensagem' => 'Recurso não encontrado'
            ],404);
        }

        return response()->json($pet);
    }

    public function update($id, Request $request){
        $pet = Pet::find($id);

        if(is_null($pet)){
            return response()->json(['mensagem'=>'Recurso não encontrado'],404);
        }

        $pet->fill($request->all());
        $pet->save();
    
    }

    public function destroy(int $id){
        $recursoRemovido = Pet::destroy($id);

        if($recursoRemovido === 0){
            return response()->json([
                'mensagem' => 'Recurso não encontrado'
            ],404);
        }

        return response()->json('',204);
    }

}