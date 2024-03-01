<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;

class InquiryController extends Controller
{
    public function index(Request $request)
    {
        $lab_id = $request->user()->lab_id;
        if ($lab_id == NULL)
        {
            return redirect()->back();
        }
        $inquiries = Inquiry::all()->filter(function (Inquiry $in) use ($lab_id) {
            return $in->user->seat->lab->id == $lab_id;
        })->sortBy('created_at');
        return view('inquiry.index', ['inquiries' => $inquiries]);
    }

    public function edit()
    {
        return view('inquiry.edit');
    }

    public function show(Request $request)
    {
        $inquiry = Inquiry::find($request->inquiry_id);
        return view('inquiry.show', ['inquiry' => $inquiry]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'type' => 'required',
        ]);

        // Cancel inquiry creation if there exists one for the same user or user has not picked a seat.
        if ($request->user()->inquiry || $request->user()->seat == NULL)
        {
            return back();
        }

        $inquiry = Inquiry::create([
            'code' => $request->code,
            'type' => $request->type,
            'desc' => $request->desc,
            'user_id' => $request->user()->id,
        ]);
        $inquiry->save();

        return view('inquiry.show', ['inquiry' => $inquiry]);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'inquiry_id' => 'required',
        ]);

        $inquiry = Inquiry::find($request->inquiry_id);
        if ($inquiry != NULL) {
            $inquiry->delete();
        }

        return view('dashboard');
    }
}
