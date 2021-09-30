@extends("layouts.base")

@section("main")
    <div class=" ">
        <div class="flex min-h-screen">
            <div class="w-2/3 flex items-center justify-center">
                <div class="w-1/2">
                    <h1 class="text-4xl">Connexion</h1>
                    <span class="text-gray-600">Retrouvez tous vos contacts</span>

                    <div class="my-6">
                        <input type="text" class="input" placeholder="Votre adresse e-mail: email@test.com"/>
                    </div>

                    <div class="my-6">
                        <input type="password" class="input" placeholder="Votre mot de passe : ********"/>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" class="h-5 w-5">
                        <label for="remember" class="text-base ml-2">Se souvenir de moi ?</label>
                    </div>

                    <div class="my-4">
                        <button
                            class="button"
                        >Se connecter</button>
                    </div>
                </div>

            </div>
            <div class="bg-blue-800 w-1/3 text-white flex flex-col items-center justify-center " style="background-color: #0059B2">
                <span class="text-5xl font-bold">
                    Contact Manager
                </span>
                <div class="w-2/3 mt-6">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam, voluptatum, quidem ipsa dolore alias at non excepturi nemo
                </div>
                @include("svg.graph")
            </div>

        </div>
    </div>
@endsection
