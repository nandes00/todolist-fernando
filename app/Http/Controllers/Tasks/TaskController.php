<?php

namespace App\Http\Controllers\Tasks;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        return view('home');
    }

    public function indexUrgentTasks()
    {
        $breadcrumbsList = json_encode([
            ["title"=>"Home", "url"=>route('home')],
            ["title"=>"Tarefas Sinal Vermelho", "url"=>route('tasks.urgent.list')]
        ]);

        $listTasks = json_encode(Task::where('priority', 'Alta')
            ->select( 'id', 'title', 'description', 'priority', 'author', 'date', 'status')
            ->get());

        return view('tasks.list', compact('breadcrumbsList', 'listTasks'));
    }

    public function indexMediumTasks()
    {
        $breadcrumbsList = json_encode([
            ["title"=>"Home", "url"=>route('home')],
            ["title"=>"Tarefas Sinal Amarelo", "url"=>route('tasks.medium.list')]
        ]);

        $listTasks = json_encode(Task::where('priority', 'Media')
            ->select( 'id', 'title', 'description', 'priority', 'author', 'date', 'status')
            ->get());

        return view('tasks.list', compact('breadcrumbsList', 'listTasks'));
    }

    public function indexLowTasks()
    {
        $breadcrumbsList = json_encode([
            ["title"=>"Home", "url"=>route('home')],
            ["title"=>"Tarefas Sinal Verde", "url"=>route('tasks.low.list')]
        ]);

        $listTasks = json_encode(Task::where('priority', 'Baixa')
            ->select( 'id', 'title', 'description', 'priority', 'author', 'date', 'status')
            ->get());

        return view('tasks.list', compact('breadcrumbsList', 'listTasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validation =\Validator::make($data,[
            "title"=>"required",
            "description"=>"required",
            "priority"=>"required",
            "date"=>"required",
            "status"=>"required"
        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $data['author'] = auth()->user()->name;

        Task::create($data);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Task::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validation =\Validator::make($data,[
            "title"=>"required",
            "description"=>"required",
            "priority"=>"required",
            "date"=>"required",
            "status"=>"required"
        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        Task::find($id)->update($data);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::find($id)->delete();
        return redirect()->back();
    }
}
