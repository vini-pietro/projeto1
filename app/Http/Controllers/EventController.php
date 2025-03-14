<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::withCount('users')->get(); // Adiciona a contagem correta de participantes
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }
    public function __construct()

{
    $this->middleware('auth');
    $this->middleware('admin')->only(['create', 'store', 'edit', 'update', 'destroy']);
}

    public function dashboard()
{
    $user = Auth::user();
    $events = $user->events()->withCount('users')->get(); // Certifique-se de carregar os eventos do usuário
    return view('dashboard', compact('events'));
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

        // Salva a imagem na pasta public/images e usa o nome original com timestamp para evitar conflitos
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        Event::create([
            'title' => $request->title,
            'location' => $request->location,
            'event_date' => $request->event_date,
            'image' => $imageName, // Apenas o nome do arquivo
            'description' => $request->description,
        ]);

        return redirect()->route('events.index')->with('success', 'Evento criado com sucesso!');
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('events.show', compact('event'));
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'event_date' => 'required|date',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // Permite envio opcional de imagem
        ]);

        // Verifica se uma nova imagem foi enviada
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $event->image = $imageName; // Atualiza no banco de dados o nome da nova imagem
        }

        // Atualiza os outros dados do evento
        $event->update([
            'title' => $request->title,
            'location' => $request->location,
            'event_date' => $request->event_date,
            'description' => $request->description,
            'image' => $event->image, // Mantém a imagem correta no banco
        ]);

        return redirect()->route('events.index')->with('success', 'Evento atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        // Verifica se há usuários inscritos antes de excluir
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

        // Alterna entre participar e sair do evento
        if ($user->events()->where('event_id', $event->id)->exists()) {
            $user->events()->detach($event->id);
            return redirect()->route('events.index')->with('success', 'Você saiu do evento.');
        } else {
            $user->events()->attach($event->id);
            return redirect()->route('events.index')->with('success', 'Você está participando do evento!');
        }
    }
}
