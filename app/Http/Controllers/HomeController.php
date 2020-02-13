<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbsList = json_encode([
            ["title"=>"Home", "url"=>route('home')]
        ]);


        $totalUrgentTasks = Task::where('priority', 'Alta')->count();
        $totalMediumTasks = Task::where('priority', 'Media')->count();
        $totalLowTasks = Task::where('priority', 'Baixa')->count();

        return view('home', compact('breadcrumbsList', 'totalUrgentTasks', 'totalMediumTasks', 'totalLowTasks'));
    }
}
