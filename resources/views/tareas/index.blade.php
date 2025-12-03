<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mis Tareas') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('tareas.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Nueva tarea</a>

        <div class="mt-6 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
            @foreach ($tareas as $tarea)
                <div class="flex justify-between items-center border-b py-2">
                    <div>
                        <h3 class="text-lg font-semibold {{ $tarea->completada ? 'line-through text-gray-400' : '' }}">
                            {{ $tarea->titulo }}
                        </h3>
                        <p class="text-sm text-gray-500">{{ $tarea->descripcion }}</p>
                    </div>
                    <div class="flex gap-2">
                        @if (!$tarea->completada)
                            <form method="POST" action="{{ route('tareas.completar', $tarea) }}">
                                @csrf
                                @method('PATCH')
                                <button class="text-green-600 hover:underline">Completar</button>
                            </form>
                        @endif
                        <a href="{{ route('tareas.edit', $tarea) }}" class="text-blue-600 hover:underline">Editar</a>
                        <form method="POST" action="{{ route('tareas.destroy', $tarea) }}">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline">Eliminar</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>