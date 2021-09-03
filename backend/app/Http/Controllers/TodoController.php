<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /*create*/
    public function create(Request $request){
        $todo = new Todo();
        $todo->text = $request->text;
        $todo->user_id = $request->user_id;
        $todo->save();
        return response()->json([
            'message'=> 'Задача добавлена',
            'object' => $todo], 200);

    }
    /*read*/
    public function index($id){
        return response()->json(Todo::all()->where('user_id', '=', $id), 200);
    }

    /*update*/
    public function update(Request $request){
        $todo = Todo::find($request->id);
        $todo->update($request->all());
        $todo->save();
        return response()->json([
            'message'=>'Задача успешно изменена',
            'data'=>$todo
        ], 200);
    }

    /*delete*/
    public function delete($id){
        $todo = Todo::find($id);
        $todo->delete();
        return response()->json([
            'message'=>'Удаление прошло успешно!',
        ],200);
    }
    /*"СДЕЛАНО"*/
    public function checkDone(Request $request){
        $todo = Todo::find($request->id);
        $todo->done = true;
        $todo->update();
        return response()->json([
            'message'=> 'Выполнено!'
        ], 200);
    }
    /*"НЕ СДЕЛАНО"*/
    public function unCheck(Request $request){
        $todo = Todo::find($request->id);
        $todo->done = false;
        $todo->update();

        return response()->json([
            'message'=> 'Выполнено!'
        ], 200);
    }
}
