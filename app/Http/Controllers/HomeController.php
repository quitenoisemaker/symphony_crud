<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $noOfRecords = 10;
        $getItems = Item::select('id', 'name', 'description', 'image')->orderBy('id', 'DESC')->paginate($noOfRecords);

        return view('home', compact('getItems'));
    }
}
