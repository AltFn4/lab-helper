<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Signoff;
use App\Models\User;
use App\Models\Lab;
use App\Models\Inquiry;

class SignoffController extends Controller
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
    public function create(Request $request)
    {
        $request->validate([
            'inquiry_id' => 'required',
        ]);

        $inq_id = $request->inquiry_id;
        $inq = Inquiry::find($inq_id);

        if ($inq == null)
        {
            return back()->withErrors('Illegal request id provided.');
        }

        $user_id = $inq->student->id;
        $lab_id = $inq->lab->id;

        $inq->delete();

        Signoff::create([
            'user_id' => $user_id,
            'lab_id' => $lab_id,
        ])->save();

        return redirect()->route('dashboard');
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
