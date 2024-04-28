<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrierung bearbeiten') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('registration.update', $registration) }}" method="POST" class="register_user" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Teilnehmer</label>
                            <input type="text" class="form-control" name="attendees_count"
                                   value="{{ old('attendees_count', $registration->attendees_count) }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Änderungen speichern</button>
                    </form>
                    <form action="{{route('registration.delete', ['registration' => $registration->id])}}" method="POST" class="mt-3">
                        @csrf
                        <button type="submit" class="btn btn-danger">Abmeldung</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
