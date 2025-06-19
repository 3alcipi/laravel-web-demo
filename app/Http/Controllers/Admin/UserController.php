<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     */

     public function __construct(){
        $this->middleware('can:admin.users.index')->only('index');       
        $this->middleware('can:admin.users.edit')->only('edit','update');
     }
    public function index()
    {
        return view('admin.users.index');
    }

     public function list()
        {
            $users = User::orderBy('id', 'desc')->get();
         

            //si te sale un erro ejecunta en la rais del proyecto esto   composer require yajra/laravel-datatables-oracle 
            return DataTables::of($users) // en lugar de datatables()->of($brands)
            ->addIndexColumn()
        
            ->addColumn('acciones', function ($user) {
               
                return '
        <div class="btn-group btn-group-sm" role="group">
            <a 
                href="' . route('admin.users.edit', $user->id) . '" 
                class="btn btn-primary btn-sm me-2">
                <i class="fas fa-pen"></i>
            </a> | 

        <button 
            class="btn btn-danger btn-sm deleteUser"
            data-id="' . $user->id . '">
            <i class="fa fa-trash"></i>
        </button>
    </div>
';
            })
            ->rawColumns(['acciones'])
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
        //
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
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
      
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);
        return redirect()->route('admin.users.edit', $user->id)
            ->with('success', 'Roles actualizados correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
