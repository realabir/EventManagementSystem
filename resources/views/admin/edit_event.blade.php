<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Veranstaltungs Editor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.dashboard.edit', $events->id) }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $events->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Datum</label>
                            <input type="date" class="form-control" name="date" placeholder="Datum" value="{{ $events->date }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ort</label>
                            <input type="text" class="form-control" name="location" placeholder="Ort" value="{{ $events->location }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">max. Teilnehmer</label>
                            <input type="number" class="form-control" name="available_slots" placeholder="max. Teilnehmer" value="{{ $events->available_slots }}" required min="1" max="9999">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Beschreibung</label>
                            <input type="text" class="form-control" name="description" placeholder="Beschreibung" value="{{ $events->description }}" required>
                        </div>
                        <button type="submit" class="btn btn-warning">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
