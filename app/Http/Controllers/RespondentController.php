<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RespondentController extends Controller
{
    public function create()
    {
        // request()->session()->flush();
        return view('respondent.create');
    }

    public function store()
    {
        $data = request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:respondents',
            'contact_number' => 'required|unique:respondents|digits:8',
        ]);

        request()->session()->put('respondent', [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'contact_number' => $data['contact_number']
        ]);

        return redirect('/survey/1');
    }
}
