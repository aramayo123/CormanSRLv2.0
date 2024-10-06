<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}" class="">
    @csrf
    @method('patch')
    <!-- NOMBRE Y APELLIDO !-->
    <div class="grid grid-cols-1 sm:grid-cols-2">
        <label for="name" class="text-center m-2 py-2">Nombre completo</label>
        <x-text-input class="m-2" id="name" name="name" type="text" :value="old('name', $user->name)" required autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>
    
    <!-- EMAIL !-->
    <div>
        <div class="grid grid-cols-1 sm:grid-cols-2">
            <!-- CAMPO EMAIL !-->
            <label for="email" class="text-center m-2 py-2">{{ __('Email') }}</label>
            <x-text-input class="m-2"  id="email" name="email" type="email" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="flex align-items-center items-center justify-center">
            <button class="py-3 px-5 my-2 items-center tracking-widest bg-gray-800 inline-block border border-transparent rounded-md font-semibold text-xs text-white uppercase ">
                Guardar
            </button>
        </div>
        <!-- MESSAGE DATA SAVED !-->
        @if(session('status') === 'profile-updated')
            <div class="text-green-800 text-center">
                Se han actualizado sus datos correctamente.
            </div>
        @endif
    </div>
</form>
