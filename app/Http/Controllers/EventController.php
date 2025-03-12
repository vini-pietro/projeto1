<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Lista todos os eventos
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }
    // Mostra o formulário para criar um evento
    public function create()
    {
        return view('events.create');
    }

    // Salva um novo evento no banco de dados
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'event_date' => 'required|date',
        'location' => 'required',
    ]);

    Event::create([
        'title' => $request->title,
        'description' => $request->description,
        'event_date' => $request->event_date, 
        'location' => $request->location, 
    ]);

    return redirect()->route('events.index')->with('success', 'Event created successfully!');
}

    // Exibe detalhes de um evento específico
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('events.show', compact('event'));
    }

    // Mostra o formulário para editar um evento existente
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('events.edit', compact('event'));
    }

    // Atualiza um evento no banco de dados
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'event_date' => 'required|date',
            'location' => 'required',
        ]);

        $event = Event::findOrFail($id);
        $event->update($request->all());

        return redirect('/events')->with('success', 'Event updated successfully!');
    }

    // Exclui um evento
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect('/events')->with('success', 'Event deleted successfully!');
    }
}
