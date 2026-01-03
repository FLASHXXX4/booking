<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- User Information Display -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">User Information</h3>
                    <div class="space-y-2">
                        <div>
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Name:</span>
                            <span class="ml-2 text-gray-900 dark:text-gray-100">{{ $user->name }}</span>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Email:</span>
                            <span class="ml-2 text-gray-900 dark:text-gray-100">{{ $user->email }}</span>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Member since:</span>
                            <span class="ml-2 text-gray-900 dark:text-gray-100">{{ $user->created_at->format('F Y') }}</span>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Reservations:</span>
                            <span class="ml-2 text-gray-900 dark:text-gray-100">{{ $user->reservations()->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
