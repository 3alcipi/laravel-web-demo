<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles =Vehicle::with('type')->where('status',1)->get();
        return view('admin.reservations.index',compact('vehicles'));
    }

     public function list()
    {
        /* $permissions = Permission::all(); */
        
        $reservatios = Reservation::orderBy('id', 'desc')->get();

        return DataTables::of($reservatios)
        ->addIndexcolumn()
        ->addColumn('acciones',function ($reservation){
            $button='';
            /* if (auth()->user()->can('admin.roles.edit')){ */
            $button.='<button
                            class="btn btn-primary btn-sm me-2 editReservation"
                            data-id="' . $reservation->id . '"
                            data-name="'.$reservation->user_id  .'"
                            >
                            <i class="fas fa-pen"></i>
                        </button> |';
           /*  } */
           /*  if(auth()->user()->can('admin.roles.destroy')){ */
            $button.='<button 
                        class="btn btn-danger btn-sm deleteReservation"
                        data-id="' . $reservation->id . '">
                        <i class="fa fa-trash"></i>
                    </button>';
            /* } */

            return '<div class="btn-group btn-group-sm" role="group">'.$button.'</div>';
           
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
