<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function index()
    {
        $results = (new \App\Models\Information())->get_items();
        return view('information.index', compact('results'));
    }
}
