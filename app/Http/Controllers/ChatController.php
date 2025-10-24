<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    /**
     * Vista del chat del estudiante (confidencial por sesión)
     */
    public function index(Request $request)
    {
        // Generar un ID único por sesión si no existe
        if (!$request->session()->has('chat_user_id')) {
            $request->session()->put('chat_user_id', uniqid('chat_', true));
        }

        $userSessionId = $request->session()->get('chat_user_id');

        /**
         * 🔹 Solución:
         * Solo mostramos mensajes del administrador que fueron enviados
         * después del primer mensaje del estudiante actual.
         * Así evitamos traer mensajes viejos de otros chats.
         */
        $firstStudentMessage = Chat::where('usuario', $userSessionId)->orderBy('created_at', 'asc')->first();

        $messages = Chat::where(function($q) use ($userSessionId, $firstStudentMessage) {
                // Mensajes del estudiante
                $q->where('usuario', $userSessionId);

                // Mensajes del administrador solo si existen mensajes del estudiante
                if ($firstStudentMessage) {
                    $q->orWhere(function($sub) use ($firstStudentMessage) {
                        $sub->where('usuario', 'Administrador')
                            ->where('created_at', '>=', $firstStudentMessage->created_at);
                    });
                }
            })
            ->orderBy('created_at', 'asc')
            ->take(100)
            ->get();

        if ($request->ajax()) {
            return response()->json($messages);
        }

        return view('chat', compact('messages'));
    }

    /**
     * Guardar mensaje del estudiante
     */
    public function store(Request $request)
    {
        // Asegurar que el usuario tiene un ID de sesión
        if (!$request->session()->has('chat_user_id')) {
            $request->session()->put('chat_user_id', uniqid('chat_', true));
        }

        $userSessionId = $request->session()->get('chat_user_id');

        $data = $request->validate([
            'mensaje' => 'required|string|max:1000',
        ]);

        // Guardar mensaje con identificador de sesión
        $chat = Chat::create([
            'usuario' => $userSessionId,
            'mensaje' => $data['mensaje'],
            'severity' => null,
            'analyzed' => false,
            'flagged' => false,
        ]);

        // Analizar mensaje con el microservicio Python
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
            \Log::error('Error analizando mensaje: ' . $e->getMessage());
        }

        return response()->json($chat);
    }

    /**
     * Vista del chat para el administrador
     */
    public function adminIndex(Request $request)
    {
        $messages = Chat::orderBy('created_at', 'asc')->take(100)->get();

        if ($request->ajax()) {
            return response()->json($messages);
        }

        return view('admin.chat_admin', compact('messages'));
    }

    /**
     * Guardar mensaje del administrador
     */
    public function adminStore(Request $request)
    {
        $data = $request->validate([
            'mensaje' => 'required|string|max:1000',
        ]);

        $chat = Chat::create([
            'usuario' => 'Administrador',
            'mensaje' => $data['mensaje'],
            'severity' => null,
            'analyzed' => true,
            'flagged' => false,
        ]);

        return response()->json($chat);
    }

    /**
     * Mostrar lista de usuarios con chats activos
     */
    public function adminList()
    {
        // Obtener los usuarios únicos (excepto el Administrador)
        $usuarios = Chat::where('usuario', '!=', 'Administrador')
            ->select('usuario')
            ->distinct()
            ->get();

        return view('admin.chat_lista', compact('usuarios'));
    }

    /**
     * Mostrar chat específico con un usuario
     */
    public function adminShow($usuario, Request $request)
    {
        /**
         * 🔹 Aquí también aplicamos el mismo filtro para evitar
         * mostrar mensajes del administrador de otros chats.
         */
        $firstStudentMessage = Chat::where('usuario', $usuario)->orderBy('created_at', 'asc')->first();

        $messages = Chat::where(function($q) use ($usuario, $firstStudentMessage) {
                $q->where('usuario', $usuario);

                if ($firstStudentMessage) {
                    $q->orWhere(function($sub) use ($firstStudentMessage) {
                        $sub->where('usuario', 'Administrador')
                            ->where('created_at', '>=', $firstStudentMessage->created_at);
                    });
                }
            })
            ->orderBy('created_at', 'asc')
            ->get();

        if ($request->ajax()) {
            return response()->json($messages);
        }

        return view('admin.chat_show', compact('messages', 'usuario'));
    }
}
