<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seat;

class SeatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function update(Request $request)
    {
        $request->validate([
            'seat_id' => 'required',
        ]);

        $user = $request->user();

        if ($user->seat !== NULL)
        {
            $user->seat->user_id = NULL;
            $user->seat->update();
        }

        $seat_id = $request->seat_id;
        $seat = Seat::find($seat_id);

        if ($seat !== NULL && $seat->user_id == NULL)
        {
            $seat->user_id = $user->id;
            $seat->update();
            return view('dashboard');
        }

        return back()->with('message', 'Seat is not available!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
