<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Type;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(){
       /*  $this->middleware('can:admin.vehicles.index')->only('index');
        $this->middleware('can:admin.vehicles.list')->only('list');
        $this->middleware('can:admin.vehicles.store')->only('store');
        $this->middleware('can:admin.vehicles.update')->only('update');
        $this->middleware('can:admin.vehicles.destroy')->only('destroy'); */
    }
    public function index()
    {
        $vehicles = Vehicle::orderBy('id', 'desc')->get();
        $types = Type::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        return view('admin.vehicles.index', compact('vehicles', 'types','brands'));
    }

    public function list()
        {
            $vehicles = Vehicle::with('type','brand')->orderBy('id', 'desc')->get();

            //si te sale un erro ejecunta en la rais del proyecto esto   composer require yajra/laravel-datatables-oracle 
            return DataTables::of($vehicles) // en lugar de datatables()->of($brands)
            ->addIndexColumn()
            ->editColumn('color', function ($vehicle) {
                return $vehicle->color ?? 'No Color';
            })
            ->addColumn('type_name', function ($vehicle) {
                return $vehicle->type ? $vehicle->type->name : 'Sin tipo';
            })
            ->addColumn('brand_name', function ($vehicle) {
                return $vehicle->brand ? $vehicle->brand->name : 'Sin tipo';
            })
            ->editColumn('status', function ($vehicle) {
                return $vehicle->status == 1
                    ? '<span class="badge badge-success">Activo</span>'
                    : '<span class="badge badge-danger">Inactivo</span>';
            })
      
            ->addColumn('acciones', function ($vehicle) {
                $statusOriginal = $vehicle->status;
                $data = [
                    'id' => $vehicle->id,
                    'plate' => $vehicle->plate,
                    'model' => $vehicle->model,
                    'type_name' => $vehicle->type->name,
                    'brand_name' => $vehicle->brand->name,
                    'color' => $vehicle->color,
                    'year' => $vehicle->year,
                    'engine_number' => $vehicle->engine_number,
                    'chassis_number' => $vehicle->chassis_number,
                    'description' => $vehicle->description,
                    'image_patch' => $vehicle->image_patch ? Storage::url($vehicle->image_patch) : null,
                    'status' => $statusOriginal==1 ? '<div class="bg-success py-2 px-3 mt-4"><h2 class="mb-0 text-center">Activo</h2></div>':'<div class="bg-danger py-2 px-3 mt-4"><h2 class="mb-0 text-center">Inactivo</h2></div>',
                ];
                $button = '<button class="btn btn-secondary btn-sm me-2 viewVehicle" 
                                data-vehicle=\'' . json_encode($data) . '\'>
                                <i class="fas fa-eye"></i>
                            </button>';
               if (auth()->user()->can('admin.vehicles.update')){
                $button .= '| <button 
                            class="btn btn-primary btn-sm me-2 editVehicle" 
                            data-id="' . $vehicle->id . '" 
                            data-plate="' . $vehicle->plate . '"
                            data-model="' . $vehicle->model . '"
                            data-type_id="' . $vehicle->type_id . '"
                            data-brand_id="' . $vehicle->brand_id . '"
                            data-color="' . $vehicle->color . '"
                            data-year="' . $vehicle->year . '"
                            data-engine_number="' . $vehicle->engine_number . '"
                            data-chassis_number="' . $vehicle->chassis_number . '"
                            data-description="' . $vehicle->description . '"
                            data-image_patch="' . Storage::url($vehicle->image_patch) . '"
                            data-status="' . $statusOriginal . '">
                            <i class="fas fa-pen"></i>
                        </button>'; 
               }

               if(auth()->user()->can('admin.vehicles.destroy')){
                        
                $button.= '|<button 
                            class="btn btn-danger btn-sm deleteVehicle"
                            data-id="' . $vehicle->id . '">
                            <i class="fa fa-trash"></i>
                        </button>';
               }

                return '<div class="btn-group btn-group-sm" role="group">'.$button.'</div>';
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
       
       // Validación (opcional pero recomendado)
        $data=$request->validate([
            'plate' => 'required|string|min:3|max:255|unique:vehicles,plate',
            'model' => 'required|string|min:3|max:255',
            'type_id' => 'required|exists:types,id',
            'brand_id' => 'required|exists:brands,id',
            'color' => 'required|string|min:3|max:255',
            'year' => 'required|integer|min:1992|max:'.date('Y'),
            'engine_number' => 'nullable|string|min:3|max:255',
            'chassis_number' => 'nullable|string|min:3|max:255',
            'description' => 'nullable|string|min:3',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // validez para la imagen
            'status' => 'required',
        ]);

        
        if ($request->hasFile('image')) {         
             $data['image_patch'] = $request->file('image')->store('vehicles');
          }

        // Crear el vehículo
        Vehicle::create($data);

    return response()->json(['message' => 'Vehículo registrado correctamente']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        
        $data = $request->validate([
            'plate' => 'required|string|min:3|max:255|unique:vehicles,plate,'.$vehicle->id,
            'model' => 'required|string|min:3|max:255',
            'type_id' => 'required|exists:types,id',
            'brand_id' => 'required|exists:brands,id',
            'color' => 'required|string|min:3|max:255',
            'year' => 'required|integer|min:1992|max:'.date('Y'),
            'engine_number' => 'nullable|string|min:3|max:255',
            'chassis_number' => 'nullable|string|min:3|max:255',
            'description' => 'nullable|string|min:3',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // validez para la imagen
            'status' => 'required',
        ]);

        if ($request->hasFile('image')) {
          if($vehicle->image_patch){
            Storage::delete($vehicle->image_patch);
          }
            $data['image_patch'] = $request->file('image')->store('vehicles');  
        }

        $vehicle->update($data);    

        return response()->json(['message' => 'Vehículo actualizado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return response()->json([
            'message' => 'Tipo de vehículo eliminada correctamente'
        ]);
    }
}
