<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner;

class OwnerController extends Controller
{
    public function index(){
        $data = Owner::all();

        return response()->json($data);
    }

    public function store(Request $request){
        return response()->json(Owner::create($request->all()),201);
    }

    public function show(int $id){
        $owner = Owner::find($id);
        if(is_null($owner)){
            return response()->json('',204);
        }

        return response()->json($owner);
    }

    public function update(int $id, Request $request){
        $owner = Owner::find($id);

        if(is_null($owner)){
            return response()->json(['mensagem' => 'Recurso não encontrado'],404);
        }

        $owner->fill($request->all());
        $owner->save();
    }

    public function destroy(int $id){
        $recursoRemovido = Owner::destroy($id);

        if($recursoRemovido === 0){
            return response()->json([
                'mensagem' => 'Recurso não encontrado'
            ],404);
        }

        return response()->json('',204);
    }

}
