<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::orderBy('id', 'desc')->get();
        return view('admin.brands.index', compact('brands'));
    }


     public function list()
        {
            $brands = Brand::orderBy('id', 'desc')->get();

            //si te sale un erro ejecunta en la rais del proyecto esto   composer require yajra/laravel-datatables-oracle 
            return DataTables::of($brands) // en lugar de datatables()->of($brands)
            ->addIndexColumn()
            ->editColumn('status', function ($brand) {
                return $brand->status == 1
                    ? '<span class="badge badge-success">Activo</span>'
                    : '<span class="badge badge-danger">Inactivo</span>';
            })
            ->addColumn('acciones', function ($brand) {
                $statusOriginal = $brand->status;
                return '
                    <div class="btn-group btn-group-sm" role="group">
                        <button 
                            class="btn btn-primary btn-sm me-2 editBrand" 
                            data-id="' . $brand->id . '" 
                            data-name="' . $brand->name . '"
                            data-status="' . $statusOriginal . '">
                            <i class="fas fa-pen"></i>
                        </button> | 
                        <button 
                            class="btn btn-danger btn-sm deleteBrand"
                            data-id="' . $brand->id . '">
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
            'name' => 'required|string|min:3|max:255|unique:brands,name',
        ]);
    
        // Crear la marca (ejemplo)
        Brand::create($data);
        session()->flash('swal', [
            'icon'=>'success',
            'title'=>'Marca registrada',
            'text'=>'la Marca se ha registrado correctamente',
        ]);
    
        return response()->json(['message' => 'Marca registrada']);

        
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $data = $request->validate([
            'name' => 'required|string|min:3|max:255|unique:brands,name,' . $brand->id,
            'status' => 'required|integer',
        ]);
    
        $brand->update($data);
    
      /*   session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Marca actualizada',
            'text' => 'La marca se ha actualizado correctamente',
        ]); */
    
        return response()->json(['message' => 'Marca actualizada']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();

        return response()->json([
            'message' => 'Marca eliminada correctamente'
        ]);
    }
}
