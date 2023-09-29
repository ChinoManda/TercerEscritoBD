<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tarea;
use App\Models\tareaCategoria;
use App\Models\revision;
use Illuminate\Support\Facades\DB;
class TareasController extends Controller
{
    public function CreateWithCategories (Request $request){

        try {
            DB::raw('LOCK TABLE tareas READ');
            DB::raw('LOCK TABLE tareasCategoria READ');
            DB::beginTransaction();

        $Tarea = new tarea();
        
        $Tarea -> titulo = $request ->post("titulo"); 
        $Tarea -> usuario_id = $request ->post("usuario_id");
        $Tarea -> contenido = $request ->post("contenido");
        $Tarea -> estado = $request ->post("estado");
        $Tarea -> autor = $request ->post("autor");
        $Tarea -> save();
        
        $TareaCategoria = new tarea();
        $TareaCategoria2 = new tarea();

        $TareaCategoria -> categoria = $request ->post("categoria1");
        $TareaCategoria2 -> categoria = $request ->post("categoria2");

        $TareaCategoria -> tarea_id = $Tarea->id;
        $TareaCategoria2 -> tarea_id = $Tarea->id;

        $TareaCategoria->save();
        $TareaCategoria2->save();
        return $Tarea;
        }
        catch (\Illuminate\Database\QueryException $th) {
            DB::rollback();
            return $th->getMessage();
        }
        catch (\PDOException $th) {
            return response("Permission to DB denied",403);
        }
    }

    public function CreateWithRevision (Request $request){

        try {
            DB::raw('LOCK TABLE tareas READ');
            DB::raw('LOCK TABLE tareas WRITE');
            DB::raw('LOCK TABLE revision READ');
            DB::raw('LOCK TABLE revision WRITE');
            DB::beginTransaction();

        $Tarea = new tarea();
        
        $Tarea -> titulo = $request ->post("titulo"); 
        $Tarea -> usuario_id = $request ->post("usuario_id");
        $Tarea -> contenido = $request ->post("contenido");
        $Tarea -> estado = $request ->post("estado");
        $Tarea -> autor = $request ->post("autor");
        $Tarea -> save();
        
        $Revision = new revision();
        $Revision -> detalle = $request ->post("detalle");
        $Revision -> tarea_id = $Tarea->id;
        $Revision-> save();
        return $Tarea;
        }
        catch (\Illuminate\Database\QueryException $th) {
            DB::rollback();
            return $th->getMessage();
        }
        catch (\PDOException $th) {
            return response("Permission to DB denied",403);
        }
    }
}
