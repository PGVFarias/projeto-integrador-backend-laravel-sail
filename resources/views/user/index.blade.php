<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Usuários') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="w-full whitespace-no-wrapw-full whitespace-no-wrap">
                        <thead>
                            <tr class="text-center font-bold">
                                <th class="border px-6 py-4">Nome</th>
                                <th class="border px-6 py-4">E-mail</th>
                                <th class="border px-6 py-4">Ativo</th>
                                <th class="border px-6 py-4">Tipo</th>
                                <th class="border px-6 py-4">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="border px-6 py-4">{{ $user->name }}</td>
                                    <td class="border px-6 py-4">{{ $user->email }}</td>
                                    <td class="border px-6 py-4">{{ $user->active_state }}</td>
                                    <td class="border px-6 py-4">{{ $user->type->name }}</td>
                                    <td class="border px-6 py-4 text-center">
                                        @if($user->is_active)
                                            <a class="bg-red-300 hover:bg-red-400 text-white-800 font-bold py-2 px-4 rounded" href="{{ route('user.changeState', ['user' => $user->id]) }}">
                                                <span>Desativar</span>
                                            </a>
                                        @else
                                            <a class="bg-green-300 hover:bg-green-400 text-gray-800 font-bold py-2 px-4 rounded" href="{{ route('user.changeState', ['user' => $user->id]) }}">
                                                <span>Ativar</span>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
