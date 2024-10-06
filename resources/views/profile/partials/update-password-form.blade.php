<form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6" class="d-flex" role="search">
    @csrf
    @method('put')

    <!-- CURRENT PASSWORD !-->
    <div class="grid grid-cols-1 sm:grid-cols-2">
        <label for="current_password" class="text-center m-2 py-2">Contraseña actual</label>
        <x-text-input class="m-2" id="current_password" name="current_password" type="password" autofocus
            autocomplete="current_password" />
    </div>

    <!-- NEW PASSWORD !-->
    <div class="grid grid-cols-1 sm:grid-cols-2">
        <label for="password" class="text-center m-2 py-2">Contraseña nueva</label>
        <x-text-input class="m-2" id="password" name="password" type="password" autofocus
            autocomplete="new-password" />
    </div>

    <!-- CONFIRM PASSWORD !-->
    <div class="grid grid-cols-1 sm:grid-cols-2">
        <label for="password_confirmation" class="text-center m-2 py-2">Confirmar contraseña</label>
        <x-text-input class="m-2" id="password_confirmation" name="password_confirmation" type="password" autofocus
            autocomplete="password_confirmation" />
    </div>
    <div class="flex align-items-center items-center justify-center">
        <button
            class="py-3 px-5 my-2 items-center tracking-widest bg-gray-800 inline-block border border-transparent rounded-md font-semibold text-xs text-white uppercase ">
            Guardar
        </button>
    </div>
    @if ($errors->updatePassword->get('current_password'))
        @foreach ($errors->updatePassword->get('current_password') as $error)
            <div class="text-red-800 text-center">
                {{ $error }}
            </div>
        @endforeach
    @endif
    @if ($errors->updatePassword->get('password'))
        @foreach ($errors->updatePassword->get('password') as $error)
           <div class="text-red-800 text-center">
                {{ $error }}
            </div>
        @endforeach
    @endif
    @if ($errors->updatePassword->get('password_confirmation'))
        @foreach ($errors->updatePassword->get('password_confirmation') as $error)
           <div class="text-red-800 text-center">
                {{ $error }}
            </div>
        @endforeach
    @endif
    <!-- MESSAGE DATA SAVED !-->
    @if (session('status') === 'password-updated')
        <div class="text-green-800 text-center">
            Se han actualizado sus datos correctamente.
        </div>
    @endif
</form>
