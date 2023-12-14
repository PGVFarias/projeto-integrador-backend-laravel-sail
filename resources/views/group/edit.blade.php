<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Grupo') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('groups.update', ['group' => $group]) }}">
                        @csrf
                        @method('PUT')
                        <!-- Name -->
                        <div>
                            <x-input-label for="description" :value="__('Descrição')" />
                            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="$group->description" required autofocus autocomplete="description" />
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="users" :value="__('Usuários')" />
                            <x-select-input id="users[]" class="block mt-1 w-full chosen-select" name="users[]" multiple="true" autofocus autocomplete="users">
                                @foreach($users as $user)
                                    <option @selected($group->users()->find($user)) value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </x-select-input>
                            <x-input-error :messages="$errors->get('users')" class="mt-2" />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4" onclick="location.href='{{ route('groups.index') }}'" type="button">
                                {{ __('Voltar') }}
                            </x-primary-button>
                            <x-success-button class="ms-4">
                                {{ __('Salvar') }}
                            </x-success-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
