@extends("layouts.app")

@section("content")


<div class="container mx-auto ">
    <div class="py-16">
        <div class="flex flex-row mb-1 sm:mb-0 justify-between w-full">
            <h2 class="text-2xl leading-tight">
                Contacts
            </h2>
            <div class="text-end">
                <a href="{{ route('contacts.create') }}" class="button">
                    Ajouter un contact
                </a>
            </div>
        </div>
        <div class="py-4 mt-2">
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                    <tr>
                        <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                            Nom & Prénoms
                        </th>
                        <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                            Email
                        </th>
                        <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                            Date de création
                        </th>
                        <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($contacts as $contact)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center">
                                        <div class="ml-3">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $contact->name }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $contact->email }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $contact->created_at->format('d-m-Y à h:i:s') }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm flex items-center">
                                    <a href="{{ route('contacts.edit', $contact) }}" class="text-blue-600 hover:text-blue-900 mr-2">
                                        Details
                                    </a>
                                    <ion-icon name="chevron-forward-outline"></ion-icon>
                                </td>

                            </tr>
                        @endforeach



                    </tbody>
                </table>
                <div class="px-5 bg-white py-5 flex flex-col xs:flex-row items-center xs:justify-between">
                    <div class="flex w-full justify-between">
                        {{ $contacts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
