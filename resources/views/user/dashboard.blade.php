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
                            <th>Verfügbare Plätze</th>
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
                                    @if(auth()->user()->events->contains($event))
                                        <form method="POST" action="{{ route('registration.edit', ['registration' => $registrations->where('event_id', $event->id)->first()->id]) }}">
                                            @csrf
                                            <a href="{{ route('registration.edit', $registrations->where('event_id', $event->id)->first()) }}" class="btn btn-info">Bearbeiten</a>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('user.register', ['id' => $event->id]) }}">
                                            @csrf
                                            <a href="{{ route('user.register', ['id' => $event->id]) }}" class="btn btn-primary">Anmelden</a>
                                        </form>
                                    @endif
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
