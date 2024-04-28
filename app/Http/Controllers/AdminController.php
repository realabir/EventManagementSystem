<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('id', 'desc')->get();
        return view('admin.dashboard', compact('events'));
    }

    public function add()
    {
        return view('admin.add_event');
    }

    public function save(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required',
            'date' => 'required',
            'location' => 'required',
            'available_slots' => 'required',
            'description' => 'required',
        ]);
        $data = Event::create($validation);
        if ($data) {
            session()->flash('success', 'Veranstaltung Add Successfully');
            return redirect(route('admin.dashboard'));
        } else {
            session()->flash('error', 'Some problem occure');
            return redirect(route('admin/dashboard/add'));
        }
    }

    public function edit($id)
    {
        $events = Event::findOrFail($id);
        return view('admin.edit_event', compact('events'));
    }

    public function update(Request $request, $id)
    {
        $events = Event::findOrFail($id);
        $name = $request->name;
        $date = $request->date;
        $location = $request->location;
        $available_slots = $request->available_slots;
        $description = $request->description;

        $events->name = $name;
        $events->date = $date;
        $events->location = $location;
        $events->available_slots = $available_slots;
        $events->description = $description;

        $data = $events->save();
        if ($data) {
            session()->flash('success', 'Veranstaltung Update Successfully');
            return redirect(route('admin.dashboard'));
        } else {
            session()->flash('error', 'Some problem occure');
            return redirect(route('admin/dashboard/update'));
        }
    }

    public function delete($id)
    {
        $events = Event::findOrFail($id)->delete();
        if ($events) {
            session()->flash('success', 'Veranstaltung Deleted Successfully');
        } else {
            session()->flash('error', 'Veranstaltung Not Delete successfully');
        }
        return redirect(route('admin.dashboard'));
    }
}
