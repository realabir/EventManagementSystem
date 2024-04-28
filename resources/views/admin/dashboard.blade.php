<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Veranstaltungen - Admin') }}
        </h2>
    </x-slot>

    <!-- Dashboard Template mit Bootstrap-Verbesserungen -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="d-flex justify-content-end mb-2">
                        <a href="{{ route('admin.dashboard.add') }}" class="btn btn-success">Veranstaltung hinzufügen</a>
                    </div>
                    <hr />
                    @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <table class="table table-striped">
                        <thead class="thead-light">
                        <tr>
                            <th>Name</th>
                            <th>Datum</th>
                            <th>Ort</th>
                            <th>Verfübare Plätze</th>
                            <th>Beschreibung</th>
                            <th>Aktionen</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($events as $event)
                            <tr>
                                <td>{{ $event->name }}</td>
                                <td>{{ $event->date }}</td>
                                <td>{{ $event->location }}</td>
                                <td>{{ $event->available_slots }}</td>
                                <td>{{ $event->description }}</td>
                                <td>
                                    <a href="{{ route('admin.details', ['event' => $event->id]) }}" class="btn btn-info">Details</a>
                                    <a href="{{ route('admin.dashboard.edit', ['id' => $event->id]) }}" class="btn btn-warning">Edit</a>
                                    <a href="{{ route('admin.dashboard.delete', ['id' => $event->id]) }}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Keine Veranstaltungen gefunden!</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
