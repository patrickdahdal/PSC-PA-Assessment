<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Respondent;
use DataTables;
use Lang;

class RespondentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Respondent::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('id', function($row){
                        return '<a href="'.route('admin.respondents.show', [$row->id]).'">'.$row->id.'</a>';
                    })->addColumn('full_name', function($row){
                        return '<a href="'.route('admin.respondents.show', [$row->id]).'">'.$row->first_name.' '.$row->last_name.'</a>';                        
                    })->addColumn('company_name', function($row){
                        return '<a href="'.route('admin.customers.show', [$row->membercode->customer_id]).'">'.$row->membercode->customer->company_name.'</a>';
                    })->addColumn('member_code', function($row){
                        return $row->membercode->membercode;
                    })->addColumn('gender', function($row){
                        if ($row->gender === 'W')
                            return Lang::get('front.test.female');
                        else if ($row->gender === 'M')
                            return Lang::get('front.test.male');
                        else if ($row->gender === 'T')
                        return Lang::get('front.test.transgender');
                        else if ($row->gender === 'N')
                            return Lang::get('front.test.non_binary-conforming');
                        else if ($row->gender === 'P')
                            return Lang::get('front.test.prefer_not_to_respond');
                        return ''.Lang::get('front.test.female').'';
                    })->addColumn('action', function($row){
                        return '<a class="btn btn-xs btn-primary" href="'.route('admin.respondents.show', [$row->id]).'">'.Lang::get('global.app.view').'</a>';
                    })->rawColumns(['id', 'full_name', 'company_name','member_code', 'gender', 'action'])                    
                    ->make(true);
        } else {
            $respondents = Respondent::all();
            return view('admin.respondents.index', compact('respondents'));
        }
                
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $respondent = Respondent::findOrFail($id);

        return view('admin.respondents.show', compact('respondent'));
    }
}
