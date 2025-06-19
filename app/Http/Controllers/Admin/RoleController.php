<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\models\Role;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{

    public function __construct(){
        $this->middleware('can:admin.roles.index')->only('index','list');
        $this->middleware('can:admin.roles.create')->only('store');
        $this->middleware('can:admin.roles.edit')->only('permissions','update');
        $this->middleware('can:admin.roles.destroy')->only('destroy');
    }
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.roles.index', compact('permissions'));
    }

    public function getPermissions($id)
    {
        $role = Role::findOrFail($id);
        $permissions = $role->permissions->pluck('name'); // devuelve solo los nombres

        return response()->json($permissions);
    }

    public function list()
    {
        /* $permissions = Permission::all(); */
        
        $roles = Role::orderBy('id', 'desc')->get();

        return DataTables::of($roles)
        ->addIndexcolumn()
        ->addColumn('acciones',function ($role){
            $button='';
            if (auth()->user()->can('admin.roles.edit')){
            $button.='<button
                            class="btn btn-primary btn-sm me-2 editRole"
                            data-id="' . $role->id . '"
                            data-name="'.$role->name .'"
                            >
                            <i class="fas fa-pen"></i>
                        </button> |';
            }
            if(auth()->user()->can('admin.roles.destroy')){
            $button.='<button 
                        class="btn btn-danger btn-sm deleteRole"
                        data-id="' . $role->id . '">
                        <i class="fa fa-trash"></i>
                    </button>';
            }

            return '<div class="btn-group btn-group-sm" role="group">'.$button.'</div>';
           
        })
        ->rawColumns(['acciones'])
        ->make(true);
    }


    
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
 






public function store(Request $request)
{
   

    $data = $request->validate([
        'name' => 'required|string|max:255|unique:roles,name',
        'permissions' => 'array'
    ]);

    $role = Role::create([
        'name' => $data['name'],
        'guard_name' => 'web',
    ]);

  

    if (!empty($data['permissions'])) {
        $permissions = Permission::whereIn('name', $data['permissions'])->pluck('id');
       
        $role->permissions()->sync($permissions);
    }

    return response()->json(['message' => 'Rol creado Exitosamente']);  
    }







    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Role $role)
        {
            $data = $request->validate([
                'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
                'permissions' => 'array'
            ]);

            $role->update([
                'name' => $data['name'],
                'guard_name' => 'web',
            ]);

            if (!empty($data['permissions'])) {
                $permissions = Permission::whereIn('name', $data['permissions'])->pluck('id');
                $role->permissions()->sync($permissions);
            } else {
                $role->permissions()->detach(); // para quitar todos si viene vacío
            }

            return response()->json(['message' => 'Rol actualizado exitosamente.']);
        }


    

    /**
     * Remove the specified resource from storage.
     */
   

public function destroy(Role $role)
{
    $asignado = DB::table('model_has_roles')
        ->where('role_id', $role->id)
        ->exists();

    if ($asignado) {
        return response()->json([
            'message' => 'No se puede eliminar este rol porque está asignado a uno o más usuarios.'
        ], 403); // Código 403 = Forbidden
    }

    $role->delete();

    return response()->json([
        'message' => 'Rol eliminado correctamente.'
    ]);
}

}
