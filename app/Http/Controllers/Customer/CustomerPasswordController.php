<?php

namespace App\Http\Controllers\customer;

use Log;
use Hash;
use Validator;
use App\Customer;
use Illuminate\Http\Request;
use App\CustomerResetPassword;
use App\Http\Controllers\Controller;

class CustomerPasswordController extends Controller
{
    //
    public function showLinkRequestForm(Request $request)
    {
        return view('customer.passwords.showLinkRequestForm');
    }

    public function sendResetPasswordMail(Request $request)
    {   
        $email = $request->email;
        $passwordReset = Customer::where('email', '=', $email)->first();
        if ($passwordReset) {
            $tokenKey = random_bytes(30);
            $tokenKey = bin2hex($tokenKey);
            $passwordReset = CustomerResetPassword::where('email', $email)->first();
            if ($passwordReset) {
                $passwordReset->token = $tokenKey;
                $passwordReset->save();
            } else {
                $passwordReset = new CustomerResetPassword();
                $passwordReset->email = $email;
                $passwordReset->token = $tokenKey;
                $passwordReset->save();
            }
            $passwordReset->sendPasswordResetNotification($tokenKey);
            return redirect()->back()->with('success', 'Password change successfully!');
        } else {
            return redirect()->back()->withErrors("Email doesn't exist");
        }
    }

    public function showResetForm(Request $request)
    {                
        $token = $request->token;
        $passwordReset = CustomerResetPassword::where('token', $token)->first();
        if ($passwordReset){            
            return view('customer.passwords.reset')->with(
                ['token' => $token, 'email' => $passwordReset->email]
            );
        }
        else {            
            return view('customer.passwords.reset')->withErrors(['error' => 'This link has been expired.']);
        }
    }

    public function reset(Request $request)
    {        

        $this->validator($request->all())->validate();
        
        $passwordReset = CustomerResetPassword::where([
            ['email', '=', $request['email']],
            ['token', '=', $request['token']]
        ])->first();
                
        if ($passwordReset) {
            $passwordReset->delete();
            $customer = Customer::where('email', $request['email'])->first();

            if ($customer) {
                $customer->password = Hash::make($request['password']);
                $customer->save();

                session([
                    'customer_id'   => $customer->id,
                    'customer_auth' => true
                ]);
    
                return redirect('account/index');
            }
        } else {
            return redirect()->back()->withErrors('Email');
        }
    }

        /**
     * Get a validator for an incoming change password request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'email',
            'password' => 'required|confirmed|min:8',
        ]);
    }


}
