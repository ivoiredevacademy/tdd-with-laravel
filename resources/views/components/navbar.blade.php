<header class="w-full shadow-md bg-white dark:bg-gray-700 items-center h-16 rounded-2xl z-40">
    <div class="container flex flex-col justify-center h-full mx-auto flex-center">
        <div class="items-center flex w-full lg:max-w-68 sm:pr-2 sm:ml-0 items-center">
            <div class="container w-3/4 flex items-center">
                <a href="/" class="mr-12">Contact CRM</a>
                <a href="{{ route('messages.create') }}" class="mr-12 button">
                    <ion-icon name="add-outline" class="text-white"></ion-icon> Nouveau message
                </a>
                <a href="{{ route('dashboard') }}" class="mr-12 nav-link active">Tableau de bord</a>
            </div>

            <form method="POST" action="/logout" class="relative p-1 flex items-center justify-end w-1/4 ml-5 mr-4 sm:mr-0 sm:right-auto">
                @method("DELETE")
                @csrf
                <button type="submit" class="block relative">
                    <ion-icon name="log-out-outline" class="text-3xl"></ion-icon>
                </button>
            </form>
        </div>
    </div>
</header>
