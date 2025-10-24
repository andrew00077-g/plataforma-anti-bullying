<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Denuncia;
use Illuminate\Support\Facades\Http; // Para llamar al microservicio Python

class DenunciaController extends Controller
{
    public function index(){
        return view('denuncias');
    }

    // Listado simple de denuncias (solo admin prototipo)
    public function lista(){
        $denuncias = Denuncia::orderBy('created_at','desc')->get();
        return view('admin.denuncias_lista', compact('denuncias'));
    }

    public function store(Request $request){
        $data = $request->validate([
            'descripcion' => 'required|string',
            'tipo' => 'nullable|string|max:255',
            'lugar' => 'nullable|string|max:255',
            'fecha' => 'nullable|date',
        ]);

        // Guardar inicialmente (sin análisis)
        $denuncia = Denuncia::create(array_merge($data, [
            'analysis_flagged' => false,
            'analysis_severity' => null,
        ]));

        // Llamar microservicio Python (asegúrate que Flask esté corriendo en http://127.0.0.1:5000)
        try {
            $resp = Http::post('http://127.0.0.1:5000/analyze', [
                'text' => $data['descripcion'],
            ]);

            if ($resp->ok()) {
                $json = $resp->json();
                $denuncia->analysis_flagged = $json['flagged'] ?? false;
                $denuncia->analysis_severity = $json['severity'] ?? null;
                $denuncia->save();
            }
        } catch (\Exception $e) {
            // En prototipo solo logueamos, no detenemos el flujo
            \Log::error('Error al conectar con Python analyzer: '.$e->getMessage());
        }

        return back()->with('success','Denuncia enviada (anónima).');
    }
}
