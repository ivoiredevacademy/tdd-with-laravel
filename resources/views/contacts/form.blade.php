@extends("layouts.app")

@section("content")

    <div class="container mx-auto py-16">

        <h1 class="text-3xl font-bold">{{ $contact ? "Modifier contact" : "Nouveau contact" }}</h1>

        <div class="flex items-start mt-8 -mx-8">
            <div class="w-1/2 ">
                <div class="px-8">
                    <form method="POST"
                          action="{{ $contact ? route('contacts.update', $contact) : route('contacts.store') }}" class=" bg-white shadow rounded-lg px-12 py-10">
                        @csrf
                        @if($contact)
                            @method('PUT')
                        @endif
                        <div class="py-4">
                            <label for="name" class="label">Nom & Prénoms</label>
                            <input type="text" class="input" placeholder="Ex: John Doe" id="name"
                                   name="name"
                                   value="{{ $contact ? $contact->name : old('name') }}"
                            >
                            @error('name')
                            <small class="text-red-600">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="py-4">
                            <label for="email" class="label">E-mail</label>
                            <input type="email" class="input" id="email" placeholder="Ex: john@example.com"
                                name="email"
                                   value="{{ $contact ? $contact->email : old('email') }}"
                            >
                            @error('email')
                            <small class="text-red-600">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="py-4">
                            <label for="phone" class="label">Numéro de téléphone</label>
                            <input type="text" class="input" id="phone" placeholder="Ex: 0102030405"
                                name="phone"
                                   value="{{ $contact ? $contact->phone : old('phone') }}"
                            >
                            @error('phone')
                            <small class="text-red-600">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="py-4">
                            <label for="address" class="label">Adresse</label>
                            <textarea name="address"
                                      id="address" class="input" cols="30" rows="5" placeholder="Ex: Rue de la victoire, abidjan. Cote d'Ivoire"
                            >{{ $contact ? $contact->address : old('address') }}</textarea>
                            @error('address')
                            <small class="text-red-600">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="py-4">
                            <button type="submit" class="button">{{ $contact ? "Mettre à jour" : "Créer" }}</button>
                        </div>
                    </form>
                </div>

            </div>

            <div class="w-1/2">
                <div class="px-8">
                    @if($contact)
                    <x-contact-details :contact="$contact"></x-contact-details>
                    @endif
                </div>
            </div>

        </div>


    </div>

@endsection
