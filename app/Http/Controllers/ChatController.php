<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function index(){
        $messages = Chat::orderBy('created_at','desc')->take(50)->get()->reverse();
        return view('chat', compact('messages'));
    }

    public function store(Request $request){
        $data = $request->validate([
            'usuario' => 'nullable|string|max:100',
            'mensaje' => 'required|string',
        ]);

        // Guardar mensaje
        $chat = Chat::create($data);

        // (Opcional) analizar mensaje con Python (ejemplo)
        try {
            $resp = Http::post('http://127.0.0.1:5000/analyze', [
                'text' => $data['mensaje'],
            ]);
            if ($resp->ok()) {
                $json = $resp->json();
                $chat->analyzed = true;
                $chat->flagged = $json['flagged'] ?? false;
                $chat->severity = $json['severity'] ?? null;
                $chat->save();
            }
        } catch (\Exception $e) {
            \Log::error('Python chat analyzer error: '.$e->getMessage());
        }

        return redirect()->route('chat.index');
    }
}
