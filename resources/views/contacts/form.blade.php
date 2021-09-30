@extends("layouts.app")

@section("content")

    <div class="container mx-auto py-16">

        <h1 class="text-3xl font-bold">Nouveau contact</h1>

        <div class="flex items-start mt-8 -mx-8">
            <div class="w-1/2 ">
                <div class="px-8">
                    <div class=" bg-white shadow rounded-lg px-12 py-10">
                        <div class="py-4">
                            <label for="name" class="label">Nom & Prénoms</label>
                            <input type="text" class="input" placeholder="Ex: John Doe" id="name">
                        </div>
                        <div class="py-4">
                            <label for="email" class="label">E-mail</label>
                            <input type="email" class="input" id="email" placeholder="Ex: john@example.com">
                        </div>
                        <div class="py-4">
                            <label for="phone" class="label">Numéro de téléphone</label>
                            <input type="text" class="input" id="phone" placeholder="Ex: 0102030405">
                        </div>
                        <div class="py-4">
                            <label for="adress" class="label">Addresse</label>
                            <textarea name="adress" id="adress" class="input" id="" cols="30" rows="5" placeholder="Ex: Rue de la victoire, abidjan. Cote d'Ivoire"></textarea>
                        </div>
                        <div class="py-4">
                            <button type="submit" class="button">Créer</button>
                        </div>
                    </div>
                </div>

            </div>

            <div class="w-1/2">
                <div class="px-8">
                    <x-contact-details></x-contact-details>
                </div>
            </div>

        </div>


    </div>

@endsection
