<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('user.update',$user) }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$user->name" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$user->email" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Old password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required  />
            </div>

            <!-- New password -->
            <div class="mt-4">
                <x-label for="new_password" :value="__('New password')" />

                <x-input id="new_password" class="block mt-1 w-full"
                                type="password"
                                name="new_password"
                                  />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="new_password_confirmation" :value="__('Confirm new Password')" />

                <x-input id="new_password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="new_password_confirmation"  />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Edit user') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
