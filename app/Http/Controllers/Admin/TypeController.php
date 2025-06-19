<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::orderBy('id', 'desc')->get();
        return view('admin.types.index', compact('types'));
    }

    public function list()
        {
            $types = Type::orderBy('id', 'desc')->get();

            //si te sale un erro ejecunta en la rais del proyecto esto   composer require yajra/laravel-datatables-oracle 
            return DataTables::of($types) // en lugar de datatables()->of($brands)
            ->addIndexColumn()
            ->editColumn('status', function ($type) {
                return $type->status == 1
                    ? '<span class="badge badge-success">Activo</span>'
                    : '<span class="badge badge-danger">Inactivo</span>';
            })
            ->addColumn('acciones', function ($type) {
                $statusOriginal = $type->status;
                return '
                    <div class="btn-group btn-group-sm" role="group">
                        <button 
                            class="btn btn-primary btn-sm me-2 editType" 
                            data-id="' . $type->id . '" 
                            data-name="' . $type->name . '"
                            data-status="' . $statusOriginal . '">
                            <i class="fas fa-pen"></i>
                        </button> | 
                        <button 
                            class="btn btn-danger btn-sm deleteType"
                            data-id="' . $type->id . '">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                ';
            })
            ->rawColumns(['status', 'acciones'])
            ->make(true);
        }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'name' => 'required|string|min:3|max:255|unique:types,name',
        ]);
    
        // Crear la marca (ejemplo)
        Type::create($data);
    
        return response()->json(['message' => 'Tipo de vehículo registrada']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        $data = $request->validate([
            'name' => 'required|string|min:3|max:255|unique:types,name,' . $type->id,
            'status' => 'required|integer',
        ]);
    
        $type->update($data);    
     
        return response()->json(['message' => 'Tipo de vehículo actualizada']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();

        return response()->json([
            'message' => 'Tipo de vehículo eliminada correctamente'
        ]);
    }
}
