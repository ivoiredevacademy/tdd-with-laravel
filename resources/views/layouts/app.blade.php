@extends("layouts.base")

@section("main")

<div class="">
    <x-navbar></x-navbar>

    <div class="bg-gray-100 min-h-screen">
       <div class="pt-4">
           <div class="container mx-auto">
               @if(session()->has('success'))
               <x-alert></x-alert>
               @endif
           </div>
       </div>
        @yield("content")
    </div>

    <x-footer></x-footer>
</div>


@endsection
