<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lab;

class LabController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('labs.lab', ['labs' => Lab::all()]);
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
            'id' => 'required'
        ]);
        $id = $request->id;
        $lab = Lab::find($id);
        $user = $request->user();

        if ($lab == NULL) {
            return back()->with('message', 'Invalid lab selection.');;
        }

        if ($user->hasRole('student')) {
            return view('labs.seat', ['lab' => $lab]);
        } elseif ($user->hasRole('assistant')) {
            $user->lab_id = $id;
            $user->save();
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
