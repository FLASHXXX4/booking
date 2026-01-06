<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-2">Welcome Back</h2>
        <p class="text-gray-600 text-sm">Sign in to your account to continue</p>
    </div>

    <!-- Session Status -->
    @if(session('status'))
    <div class="mb-4 bg-blue-50 border-l-4 border-blue-400 text-blue-700 px-4 py-3 rounded" role="alert">
        {{ session('status') }}
    </div>
    @endif

    @if(session('success'))
    <div class="mb-4 bg-green-50 border-l-4 border-green-400 text-green-700 px-4 py-3 rounded" role="alert">
        {{ session('success') }}
    </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('Email') }}</label>
            <input 
                id="email" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" 
                type="email" 
                name="email" 
                value="{{ old('email') }}" 
                required 
                autofocus 
                autocomplete="username"
            />
            @error('email')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('Password') }}</label>
            <input 
                id="password" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                type="password"
                name="password"
                required 
                autocomplete="current-password"
            />
            @error('password')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between mb-6">
            <label for="remember_me" class="inline-flex items-center">
                <input 
                    id="remember_me" 
                    type="checkbox" 
                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" 
                    name="remember"
                >
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-blue-600 hover:text-blue-700 font-medium" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-lg transition transform hover:scale-105">
            {{ __('Log in') }}
        </button>

        <!-- Register Link -->
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 font-semibold">
                    {{ __('Register here') }}
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
