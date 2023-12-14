<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Grupos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('message'))
                <x-alert type="green" :message="session('message')"></x-alert>
            @endif
            @if(session('error'))
                <x-danger-alert type="green" :message="session('error')"></x-danger-alert>
            @endif
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <x-primary-button class="ms-4 mt-2" onclick="location.href='{{ route('groups.create') }}'" type="button">
                    {{ __('Inserir') }}
                </x-primary-button>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="w-full whitespace-no-wrapw-full whitespace-no-wrap">
                        <thead>
                        <tr class="text-center font-bold">
                            <th class="border px-6 py-4">Código</th>
                            <th class="border px-6 py-4">Descrição</th>
                            <th class="border px-6 py-4">Qnt. Documentos</th>
                            <th class="border px-6 py-4">Qnt. Usuários</th>
                            <th class="border px-6 py-4">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($groups as $group)
                            <tr>
                                <td class="border px-6 py-4">{{ $group->id }}</td>
                                <td class="border px-6 py-4">{{ $group->description }}</td>
                                <td class="border px-6 py-4">{{ $group->documents->count() }}</td>
                                <td class="border px-6 py-4">{{ $group->users->count() }}</td>
                                <td class="border px-6 py-4">
                                    <form method="POST" action="{{ route('groups.destroy', ['group' => $group->id]) }}">
                                        @csrf
                                        @method("DELETE")
                                        <x-secondary-button onclick="location.href='{{ route('groups.edit', ['group' => $group->id]) }}'" type="button">
                                            {{ __('Editar') }}
                                        </x-secondary-button>
                                        @if($group->documents->count() === 0 && $group->users->count() === 0)
                                            <x-danger-button data-id="{{$group->id}}" type="button" onclick="deleteGroup(this)">
                                                {{ __('Deletar') }}
                                            </x-danger-button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        function deleteGroup(elem) {
            Swal.fire({
                title: "Certeza que deseja deletar este grupo? A ação não pode ser desfeita.",
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: "Deletar",
                denyButtonText: `Não deletar`
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $(elem).closest('form').submit()
                } else if (result.isDenied) {
                    Swal.fire("Grupo não será deletado", "", "info");
                }
            });
        }
    </script>
</x-app-layout>
