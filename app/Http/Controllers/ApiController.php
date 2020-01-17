<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    protected $modelClass;
    public function getAll()
    {
        $items=$this->modelClass::all();
        return $items;
    }

    public function getById(String $id)
    {
        $item=$this->modelClass::find($id);
        if ($item) {
            return $item;
        } else {
            return $this->notFound();
        }
    }

    public function delete($id)
    {
        if ($id) {
            $item=$this->modelClass::find($id);
            if ($item) {
                $item->delete();
                return response()->json(['ok' => 200], 200);
            } else {
                return $this->notFound();
            }
        } else {
            return response()->json(['error' => 401,'message'=>'ID is required'], 401);
        }
    }

    protected function notFound()
    {
        return response()->json(['error' => 404,'message'=>'not found'], 404);
    }
}
