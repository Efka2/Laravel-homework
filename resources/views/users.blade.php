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

                    <a href=" {{route('user.create')}} ">
                        <x-button>
                            Create new user
                        </x-button>
                    </a>

                    @if ($users)
                        <h1 class="mb-4 text-xl">Registered users:</h1>
                        <ul>
                            @foreach ($users as $user)
                                <li class="flex space-x-3 text-xl align-center"> 
                                    <b>ID</b> : {{$user->id}}
                                    <b>Name</b> : {{$user->name}}
                                    <b>E-mail</b>: {{$user->email}}
                                    <b>E-mail verified</b> : {{$user->email_verified_at ? "Yes" : "No"}}
                                    
                                    <a href=" {{route('user.edit', $user)}} ">
                                        <x-button class="bg-blue-800 hover:bg-blue-700">
                                            Edit user
                                        </x-button>
                                    </a>

                                    <form action="{{route('user.delete',$user)}}" method="POST"
                                        onclick="return confirm('Are you sure you want to delete this item?')">
                                        @method('DELETE')
                                        @csrf
                                        <x-button class="bg-red-700 hover:bg-red-600">
                                            Delete user
                                        </x-button>
                                    </form>
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
