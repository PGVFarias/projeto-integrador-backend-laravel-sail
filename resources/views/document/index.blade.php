<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Documentos') }}
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
                <x-primary-button class="ms-4 mt-2" onclick="location.href='{{ route('documents.create') }}'"
                                  type="button">
                    {{ __('Inserir') }}
                </x-primary-button>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="w-full whitespace-no-wrapw-full whitespace-no-wrap">
                        <thead>
                        <tr class="text-center font-bold">
                            <th class="border px-6 py-4">Código</th>
                            <th class="border px-6 py-4">Nome</th>
                            <th class="border px-6 py-4">Grupo</th>
                            <th class="border px-6 py-4">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($documents as $document)
                            <tr>
                                <td class="border px-6 py-4">{{ $document->id }}</td>
                                <td class="border px-6 py-4">{{ $document->name }}</td>
                                <td class="border px-6 py-4">{{ $document->group->description }}</td>
                                <td class="border px-6 py-4">
                                    <form method="POST"
                                          action="{{ route('documents.destroy', ['document' => $document->id]) }}">
                                        @csrf
                                        @method("DELETE")
                                        <x-secondary-button
                                            onclick="location.href='{{ route('documents.download', ['document' => $document->id]) }}'"
                                            type="button">
                                            {{ __('Download') }}
                                        </x-secondary-button>
                                        @if(Auth::user()->is_admin)
                                            <x-danger-button data-id="{{$document->id}}" type="button"
                                                             onclick="deleteDocument(this)">
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
        function deleteDocument(elem) {
            Swal.fire({
                title: "Certeza que deseja deletar este documento? A ação não pode ser desfeita.",
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: "Deletar",
                denyButtonText: `Não deletar`
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $(elem).closest('form').submit()
                } else if (result.isDenied) {
                    Swal.fire("Documento não será deletado", "", "info");
                }
            });
        }
    </script>
</x-app-layout>
