<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Rules\PinCodeUnique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PinCodeController extends Controller
{
    public function create()
    {
        if (Auth::user()->getAttribute('pin_code'))
            return redirect(route('dashboard', absolute: true)
        );

        return view('auth.pin_code');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'fin' => ['required', 'string', 'max:7', 'min:7', 'unique:users,fin,' . Auth::id(). ',id'],
            'pin_code' => ['required', 'digits:4', new PinCodeUnique]
        ], [
            'pin_code.digits' => 'The pin code must be 6 digits.'
        ]);

        $data = [
            'pin_code' => md5($data['pin_code']),
            'fin' => $data['fin']
        ];

        Auth::user()->update($data);

        Auth::user()->pinCodes()->create([
            'pin_code' => $data['pin_code']
        ]);

        return redirect(route('dashboard', absolute: true));
    }
}
