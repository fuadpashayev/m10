<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhoneController extends Controller
{
    public function create()
    {
        if (Auth::user()->getAttribute('phone'))
            return redirect(route('dashboard', absolute: true)
        );

        return view('auth.phone');
    }

    public function store(Request $request)
    {
        $request->merge([
            'phone' => Helper::phoneFormatter($request->phone)
        ]);

        $data = $request->validate([
            'phone' => ['required', 'phone:AZ', 'unique:users,phone,' . Auth::id() . ',id']
        ], [
            'phone.unique' => 'This phone number is already in use.',
            'phone.phone' => 'The phone number is not valid.'
        ]);

        Auth::user()->update($data);

        return redirect()->route('pin-code');
    }
}
