<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Novos Documentos') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('documents.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mt-4">
                            <x-input-label for="group_id" :value="__('Grupo')" />
                            <x-select-input id="group_id" class="block mt-1 w-full chosen-select" name="group_id" :value="old('group_id')" autofocus autocomplete="users">
                                @foreach($groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->description }}</option>
                                @endforeach
                            </x-select-input>
                            <x-input-error :messages="$errors->get('group_id')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="files" :value="__('Arquivos')" />
                            <x-text-input id="files[]" multiple class="block mt-1 w-full" type="file" name="files[]" :value="old('files[]')" required />
                            @if($errors->get('files.*'))
                                <x-input-error messages="Os arquivos devem ser no formato PDF" class="mt-2" />
                            @endif
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4" onclick="location.href='{{ route('documents.index') }}'" type="button">
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
