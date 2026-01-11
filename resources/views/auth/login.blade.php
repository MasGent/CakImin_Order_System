<x-guest-layout>
    <div class="w-[60vw] flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-md p-8 bg-white rounded-xl shadow-md">
            <div class="flex flex-col items-center mb-6">
                <div class="flex">
                    {{-- <img src="img/logo.png" alt="" class="w-auto h-6"> --}}
                    <h1 class="text-2xl font-poppins font-bold text-gray-800">Kedai Cak-Imin</h1>
                </div>

                <p class="text-gray-500 font-light text-xs">Jaya Makan, Jaya Minum</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Username -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-poppins font-medium text-gray-700">Username</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus
                        class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-500 text-sm" />
                </div>

                <!-- Password -->
                <div class="mb-4 relative">
                    <label for="password" class="block text-sm font-poppins font-medium text-gray-700">Password</label>

                    <input id="password" type="password" name="password" required
                        class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 pr-10" />

                    <!-- Toggle Button -->
                    <button type="button" onclick="togglePassword()"
                        class="absolute right-3 top-[38px] text-gray-500 hover:text-blue-500 focus:outline-none">
                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path id="eyeOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path id="eyeOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>

                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-500 text-sm" />
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between mb-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="remember" class="text-blue-500 border-gray-300 rounded">
                        <span class="ml-2 text-sm text-gray-700">Remember this Device</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="text-sm text-blue-500 hover:underline" href="{{ route('password.request') }}">
                            Forgot Password ?
                        </a>
                    @endif
                </div>

                <!-- Sign In Button -->
                <div>
                    <button type="submit"
                        class="w-full py-2 px-4 bg-blue-500 text-white font-medium font-sans rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
                        Sign In
                    </button>
                </div>
            </form>




        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById("password");
            const icon = document.getElementById("eyeIcon");

            if (input.type === "password") {
                input.type = "text";
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.957 9.957 0 012.519-4.042M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3l18 18" />
                `;
            } else {
                input.type = "password";
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            }
        }
    </script>
</x-guest-layout>
