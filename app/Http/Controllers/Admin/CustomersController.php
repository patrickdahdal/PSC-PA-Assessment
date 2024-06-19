<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

use App\Customer;
use App\Membercode;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();

        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'company_name' => 'required',
            'email'        => 'required|email|unique:customers'
        ]);

        $data = $request->except(['membercode', 'password', 'password_confirmation']);

        if ($request->input('password')) {
            request()->validate([
                'password'     => 'required|confirmed|min:6'
            ]);

            $data['password'] = bcrypt($request->input('password'));
        }

        $customer = Customer::create($data);

        if ($customer->id && $request->input('membercode')) {
            Membercode::create([
                'customer_id' => $customer->id,
                'membercode'  => $request->input('membercode')
            ]);
        }

        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::findOrFail($id);

        return view('admin.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::with('membercode')->find($id);

        return view('admin.customers.edit', compact('customer'));
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
        $customer = Customer::findOrFail($id);

        request()->validate([
            'company_name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('customers')->ignore($id),
            ]
        ]);

        if ($request->input('password')) {
            request()->validate([
                'password'     => 'required|confirmed|min:6'
            ]);

            $customer->update(['password' => bcrypt($request->input('password'))]);
        }

        $data = $request->except(['membercode', 'password', 'password_confirmation']);
        $customer->update($data);

        $membercode = Membercode::where('customer_id', $id)->first();
        if ($membercode) {
            $membercode->update(['membercode' => $request->input(['membercode'])]);
        } else {
            Membercode::create([
                'customer_id' => $id,
                'membercode'  => $request->input('membercode')
            ]);
        }

        return redirect()->route('admin.customers.show', [$customer->id])
            ->with('success', 'Customer updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);

        // Soft-delete all related models
        $membercode = $customer->membercode;
        foreach ($membercode->respondents as $r) {
            foreach ($r->assessments as $a) {
                $a->delete();
            }
            $r->delete();
        }
        $membercode->delete();
        $customer->delete();

        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer deleted successfully');
    }
    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function customersMassDestroy(Request $request)
    {
        
        if ($request->input('ids')) {
            $customers = Customer::whereIn('id', $request->input('ids'))->get();

            foreach ($customers as $customer) {
                // Soft-delete all related models
                $membercode = $customer->membercode;
                foreach ($membercode->respondents as $r) {
                    foreach ($r->assessments as $a) {
                        $a->delete();
                    }
                    $r->delete();
                }
                $membercode->delete();
                $customer->delete();
            }
        }
    }
}
