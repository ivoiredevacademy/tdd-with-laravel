<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $contacts = Contact::whereUserId(auth()->id())->latest()->paginate(15);

        return view('dashboard', compact('contacts'));
    }
}
