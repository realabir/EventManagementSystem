<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Teilnehmer hinzufügen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('user.register.confirm', $event->id) }}" method="POST" class="register_user" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Teilnehmer</label>
                            @if(session('error'))
                                <script>
                                    alert('{{ session('error') }}');
                                </script>
                            @endif
                            <input type="text" class="form-control" name="attendees_count" placeholder="Teilnehmer" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Speichern</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
