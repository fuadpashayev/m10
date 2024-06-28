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
        return view('auth.pin_code');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'pin_code' => ['required', 'digits:4', new PinCodeUnique]
        ], [
            'pin_code.digits' => 'The pin code must be 6 digits.'
        ]);


        $data['pin_code'] = md5($data['pin_code']);

        Auth::user()->update($data);

        Auth::user()->pinCodes()->create($data);

        return redirect(route('dashboard', absolute: true));
    }
}
