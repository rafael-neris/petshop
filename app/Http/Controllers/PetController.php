<?php
namespace App\Http\Controllers;

use App\Services\PetService;
use Fig\Http\Message\StatusCodeInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\Pet;

class PetController extends Controller
{
    private PetService $petService;

    public function __construct(PetService $petService)
    {
        $this->petService = $petService;
    }

    public function index()
    {
        $data = Pet::all();
        return response()->json($data);
    }

    public function store(Request $request){

        return response()->json(Pet::create($request->all()), 201);

    }

    public function show(int $id){

        try {
            $pet = $this->petService->getById($id);
            return response()->json($pet);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'mensagem' => 'Recurso não encontrado'
            ], 404);
        }
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

        if (!$recursoRemovido) {
            return response()->json([
                'mensagem' => 'Recurso não encontrado'
            ], StatusCodeInterface::STATUS_NOT_FOUND);
        }

        return response()->json('', StatusCodeInterface::STATUS_NO_CONTENT);
    }
}
