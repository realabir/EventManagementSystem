<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $user = Auth::user();
        $registrations = $user->registrations();

        $events = Event::orderBy('id', 'desc')->get();
        return view('user.dashboard', compact('events', 'registrations'));
    }

    public function register($event)
    {
        $event = Event::find($event);
        return view('user.add_registration', ['event' => $event]);
    }

    public function confirmRegistration(Request $request, Event $event)
    {
        $user = auth()->user();

        if ($request->attendees_count > $event->available_slots) {
            return redirect()->back()->with('error', 'You are trying to subscribe more attendees than the available slots.');
        }

        $event->available_slots -= $request->attendees_count;
        $event->save();

        // Create a new registration for the User and the Event
        $registration = new Registration();  // Substitute "Registration" with your actual Registration model
        $registration->event_id = $event->id;
        $registration->user_id = $user->id;
        $registration->attendees_count = $request->attendees_count;
        $registration->save();

        return redirect('/user/dashboard');
    }

    public function editRegistration(Registration $registration)
    {
        return view('user.edit_registration', ['registration' => $registration]);
    }

    public function updateRegistration(Request $request, Registration $registration)
    {
        $registration->attendees_count = $request->input('attendees_count');
        $registration->save();

        return redirect()->route('user.dashboard');
    }

    public function deleteRegistration(Registration $registration)
    {
        $event = $registration->event;
        $event->available_slots += $registration->attendees_count;
        $event->save();
        $registration->delete();

        return redirect()->route('user.dashboard');
    }
}
