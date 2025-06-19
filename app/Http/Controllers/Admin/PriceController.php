<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Price;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prices = Price::orderBy('id', 'desc')->get();
        $vehicles = Vehicle::where('status', 1)->get();
        return view('admin.prices.index', compact('prices', 'vehicles'));
    }

    public function list()
    {
        $prices = Price::with('vehicle')->orderBy('id', 'desc')->get();
       

        //si te sale un erro ejecunta en la rais del proyecto esto   composer require yajra/laravel-datatables-oracle 
        return DataTables::of($prices) // en lugar de datatables()->of($brands)
        ->addIndexColumn()
        ->addColumn('vehicle_plate', function ($price) {
            return $price->vehicle ? $price->vehicle->plate : 'Sin vehículo';
        })
        ->addColumn('vehicle_model', function ($price) {
            return $price->vehicle ? $price->vehicle->model : 'Sin vehículo';
        })
        ->editColumn('used', function ($price) {
            return $price->used == 1
                ? '✅Si'
                : '❌ No';
        })
        ->editColumn('status', function ($price) {
            return $price->status == 1
                ? '<span class="badge badge-success">Activo</span>'
                : '<span class="badge badge-danger">Inactivo</span>';
        })
        
        ->addColumn('acciones', function ($price) {
            $statusOriginal = $price->status;
            return '
                <div class="btn-group btn-group-sm" role="group">
                    <button 
                        class="btn btn-primary btn-sm me-2 editPrice" 
                        data-id="' . $price->id . '" 
                        data-vehicle_id="' . $price->vehicle_id . '" 
                        data-price_day="' . $price->price_day. '" 
               
                        data-status="' . $statusOriginal . '">
                        <i class="fas fa-pen"></i>
                    </button> | 
                    <button 
                        class="btn btn-danger btn-sm deleteBrand"
                        data-id="' . $price->id . '">
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
           // Desactivar otros precios activos para ese vehículo
           Price::where('vehicle_id', $request->vehicle_id)
           ->where('status', 1)
           ->update(['status' => 0]);
   
        $data=$request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'price_day' => 'required|numeric',
            'status' => 'required',
        ]);
    
        // Crear la marca (ejemplo)
        Price::create($data);
   
    
        return response()->json(['message' => 'Precio registrada']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Price $price)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Price $price)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Price $price)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Price $price)
    {
        //
    }
}
