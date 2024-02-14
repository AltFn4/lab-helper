<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;

class InquiryController extends Controller
{    
    public function index()
    {
        return view('inquiry.index', ['inquiries' => Inquiry::all()->sortBy('created_at')]);
    }

    public function edit(Request $request)
    {
        $inquiry = Inquiry::find($request->inquiry_id);
        return view('inquiry.edit', ['inquiry' => $inquiry]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'type' => 'required',
        ]);

        $inquiry = Inquiry::create([
            'code' => $request->code,
            'type' => $request->type,
            'desc' => $request->desc,
            'user_id' => $request->user()->id,
        ])->save();

        return back();
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'inquiry_id' => 'required',
        ]);

        $inquiry = Inquiry::find($request->inquiry_id);
        if ($inquiry != NULL) {
            $inquiry->destroy();
        }

        return back();
    }
}
