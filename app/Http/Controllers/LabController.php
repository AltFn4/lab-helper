<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lab;
use App\Models\Submission;

class LabController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('select.lab', ['labs' => Lab::all()]);
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

        if ($user->role == 'student') {
            return view('select.seat', ['lab' => $lab]);
        }

        $submissions = Submission::all()->filter(function($submission) use ($id) {
            return $submission->user->seat !== NULL && $submission->user->seat->lab_id == $id;
        });

        return view('review.index', ['submissions' => $submissions]);
        
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
