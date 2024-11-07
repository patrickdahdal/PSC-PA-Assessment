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
    public function create()
    {
      return view('admin.traits.create');
    }
        
    public function store(Request $request)
    {
        $data = $request->all();
        TraitModel::create($data);
        return redirect()->route('admin.traits.index')->with('success', 'Create Trait successfully.');
    }
    public function edit($id)
    {
        $trait = TraitModel::find($id);
        return view('admin.traits.edit', compact('trait'));
    }

    public function update(Request $request, $id)
    {
        $trait = TraitModel::find($id);
        $trait->update($request->all());
        return redirect()->route('admin.traits.index')->with('success', 'Trait updated successfully.');
    }

    public function destroy($id)
    {
       $trait = TraitModel::find($id)->delete();
       return redirect()->route('admin.traits.index')->with('success', 'Trait deleted successfully.');
    }
}
