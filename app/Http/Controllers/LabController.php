<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lab;
use Carbon\Carbon;

class LabController extends Controller
{
    /**
     * Display a listing of available labs sorted by their starting time.
     */
    public function index()
    {
        return view('labs.lab', ['labs' => Lab::all()->sortBy('start_time')->where(function ($lab)
        {
            $duration = $lab->duration;
            return Carbon::now()->addHours(-$duration)->lt($lab->start_time);
        })]);
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
    public function show(Request $request)
    {
        $request->validate([
            'lab_id' => 'required'
        ]);
        $id = $request->lab_id;
        $lab = Lab::find($id);
        $user = $request->user();

        if ($lab == NULL) {
            return back()->with('message', 'Invalid lab selection.');;
        }

        $user->lab_id = $id;
         $user->save();

        if ($user->hasRole('student')) {
            return view('labs.seat', ['lab' => $lab]);
        }

        return view('dashboard');
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
    public function destroy(Request $request)
    {
        $user = $request->user();
        $user->lab_id = NULL;
        $user->save();
        return view('dashboard');
    }
}
