<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\TraitModel;

class TraitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $traits = TraitModel::orderBy('number')->get();

        return view('admin.traits.index', compact('traits'));
    }
}
