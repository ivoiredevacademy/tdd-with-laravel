<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactsController extends Controller
{

    public function create()
    {
        return view('contacts.form', ["contact" => null]);
    }

    public function store(Request $request)
    {
        $this->applyFormValidation($request);

        $attributes = $request->merge(['user_id' => auth()->id()])->all();
        Contact::create($attributes);

        return redirect('/dashboard')->with('success', 'Le contact a été crée avec succès');
    }

    public function edit(Contact $contact)
    {
        return view('contacts.form', compact('contact'));
    }


    public function update(Request $request, Contact $contact)
    {
        $this->applyOwnerGuard($contact);

        $this->applyFormValidation($request);

        $contact->update($request->all());

        return redirect('/dashboard')->with('success', 'Le contact a été modifié avec succès');
    }

    /**
     * @param Request $request
     */
    protected function applyFormValidation(Request $request): void
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'address' => 'required'
        ]);
    }

    public function destroy(Contact $contact)
    {
        $this->applyOwnerGuard($contact);

        $contact->delete();

        return redirect('/dashboard')->with('success', 'Le contact a été supprimé avec succès');
    }

    /**
     * @param Contact $contact
     */
    protected function applyOwnerGuard(Contact $contact): void
    {
        if (auth()->user()->isNot($contact->owner)) {
            abort(403);
        }
    }
}
