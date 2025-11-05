<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sheet;

class SheetController extends Controller
{
    public function index()
    {
        $sheets = Sheet::orderBy('row')->orderBy('column')->get()->groupBy('row');

        return view('sheets.index', ['sheets' => $sheets]);
    }
}
