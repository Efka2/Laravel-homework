<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <x-button>
                        Create new user
                    </x-button>

                    
                    @if ($users)
                        <h1 class="mb-4 text-xl">Registered users:</h1>
                        <ul>
                            @foreach ($users as $user)
                                <li class="flex space-x-3 text-xl"> 
                                    <b>ID</b> : {{$user->id}}
                                    <b>Name</b> : {{$user->name}}
                                    <b>E-mail</b>: {{$user->email}}
                                    <b>E-mail verified</b> : {{$user->email_verified_at ? "Yes" : "No"}} 
                                </li>
                            @endforeach
                        </ul>
                    @else 
                        <h1>There are not registered users!</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
