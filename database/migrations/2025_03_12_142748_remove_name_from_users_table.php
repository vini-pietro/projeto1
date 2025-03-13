<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::withCount('users')->get(); // Conta os usuários inscritos em cada evento
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'event_date' => 'required|date',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'description' => 'required|string',
        ]);

        $imagePath = $request->file('image')->store('events', 'public');

        Event::create([
            'title' => $request->title,
            'location' => $request->location,
            'event_date' => $request->event_date,
            'image' => $imagePath,
            'description' => $request->description,
        ]);

        return redirect()->route('events.index')->with('success', 'Evento criado com sucesso!');
    }

    public function show($id)
    {
        $event = Event::withCount('users')->findOrFail($id);
        return view('events.show', compact('event'));
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'event_date' => 'required|date',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $event = Event::findOrFail($id);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public');
            $event->image = $imagePath;
        }

        $event->update($request->only(['title', 'location', 'event_date', 'description']));

        return redirect()->route('events.index')->with('success', 'Evento atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        if ($event->users()->count() > 0) {
            return redirect()->route('events.index')->with('error', 'Não é possível excluir este evento, pois há usuários inscritos.');
        }

        $event->delete();
        return redirect()->route('events.index')->with('success', 'Evento deletado com sucesso!');
    }

    public function joinEvent($eventId)
    {
        $event = Event::findOrFail($eventId);
        $user = Auth::user();

        if ($user->events()->where('event_id', $event->id)->exists()) {
            $user->events()->detach($event->id);
            return redirect()->route('events.index')->with('success', 'Você saiu do evento.');
        } else {
            $user->events()->attach($event->id);
            return redirect()->route('events.index')->with('success', 'Você está participando do evento!');
        }
    }

    public function dashboard()
    {
        $user = Auth::user();
        $events = $user->events()->withCount('users')->get();
        return view('dashboard', compact('events'));
    }
}
