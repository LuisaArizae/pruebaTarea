<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Task as ModelsTask;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $tasks = Task::all(); 
        return view('tasks.index', compact('tasks'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',

         ]);
                Task::create($request->all());
                return redirect()->route('tasks.index')
                ->with('success','el post se ha enviado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task=Task::find($id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    $request->validate([
      'title' => 'required|max:255',
      'body' => 'required',
    ]);
        $tasks = Task::find($id);
        $tasks->update($request->all());
        return redirect()->route('tasks.index')
        ->with('success', 'tarea se actualizado correctamente.');
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Tarea eliminada exitosamente.');
    }

    public function create()
  {
    return view('task.create');
    }


    
}
