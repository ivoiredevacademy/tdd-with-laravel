@extends("layouts.app")

@section("content")

    <div class="container mx-auto py-16">

        <h1 class="text-3xl font-bold">Nouveau mail</h1>

        <div class="mt-8 w-100 -mx-8">
            <div class="w-2/3">
                <div class="px-8">
                    <form method="POST" action="{{ route('messages.send') }}" class=" bg-white shadow rounded-lg px-12 py-10">
                        @csrf
                        <div class="py-4">
                            <label for="title" class="label">Titre</label>
                            <input type="text" class="input" placeholder="Message " name="title" id="title">
                        </div>

                        <div class="py-4">
                            <label for="contacts" class="label">Destinataires</label>
                            <select  multiple id="contacts" name="contacts[]"class="flex w-100 text-gray-700 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500" name="contacts">
                                <option disabled selected>
                                    Selectionner vos contacts
                                </option>
                                @foreach($contacts as $contact)
                                <option value="{{ $contact->id }}">
                                    {{ $contact->name }}
                                </option>
                                @endforeach

                            </select>
                        </div>


                        <div class="py-4">
                            <label for="message" class="label">Contenu</label>
                            <textarea name="message" id="message" class="input"

                                      cols="30" rows="10" placeholder="Bonjour Mr / Mme ..."></textarea>
                        </div>
                        <div class="py-4">
                            <button type="submit" class="button">Envoyer</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>


    </div>
@endsection
