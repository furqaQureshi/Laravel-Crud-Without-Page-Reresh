<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $task = Task::all();
        if ($request->ajax()) {
            return DataTables::of($task)
                ->addIndexColumn()
                ->addColumn('id', function ($row) {
                    return '<a href="#">' . $row->id . '</a>';
                })->addColumn('title', function ($row) {
                    return $row->title;
                })->addColumn('description', function ($row) {
                    return $row->description;
                })->addColumn('action', function ($row) {
                    $btn = '<a href="#" data-id="' . $row->id . '" class="edit btn btn-primary btn-sm my-2 editTask">Edit</a>';
                    $btn = $btn . ' <a href="#" data-id="' . $row->id . '" class="btn btn-danger btn-sm deleteTask">Delete</a>';
                    return $btn;
                })->rawColumns(['id', 'title', 'description', 'action'])->make(true);
        }
        return view('layouts.index');
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 400, 'erros' => $validator->messages()]);
        }
        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->completed = $request->completed == 1 ? 1 : 0;
        $task->save();
        return response()->json([
            'status' => 200,
            'message' => 'Task Create SuccessFully!'
        ]);
    }
    public function destory($id)
    {
        try {
            $task = Task::where('id', $id)->first();
            if ($task != '') {
                $task->delete();
                return response()->json(['success' => '1', 'message' => "Task Delete is SuccessFully!"]);
            }
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }
    public function edit($id)
    {
        $task = Task::where('id', $id)->first();
        return response()->json(['response'=>$task]);
    }
    public function update(Request $request){
        $task = Task::find($request->id);
        $task->title = $request->title;
        $task->description = $request->description;
        $task->save();
        return response()->json(['success'=>'Task Update is SuessFully..']);
    }
}
