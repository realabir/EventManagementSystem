<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $events = Event::orderBy('id', 'desc')->get();
        return view('user.dashboard', compact('events'));
    }

    public function subscribe($id)
    {
        $event = Event::find($id);
        return view('user.add_registration', ['event' => $event]);
    }

    public function confirmSubscription(Request $request, $id)
    {
        $user = auth()->user();

        $event = Event::find($id);

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

    public function unsubscribe($id)
    {
        $user = auth()->user();

        $event = Event::find($id);
        // Remove registration for this user and event
        $user->registrations()->where('event_id', $event->id)->delete();

        return back();
    }
}
