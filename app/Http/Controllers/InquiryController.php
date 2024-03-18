<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;
use App\Events\InquiryUpdated;
use Illuminate\Support\Facades\Redirect;

class InquiryController extends Controller
{
    /**
     * Show a list of all requests.
     */
    public function index(Request $request)
    {
        $lab_id = $request->user()->lab_id;

        if ($lab_id == NULL)
        {
            return redirect()->back();
        }

        // Get requests that are in the specified lab and has not been assigned yet.
        $inquiries = Inquiry::all()->filter(function (Inquiry $in) use ($lab_id) {
            return $in->lab->id == $lab_id && $in->assistant_id == null;
        })->sortBy('created_at');

        return view('inquiry.index', ['inquiries' => $inquiries]);
    }

    /**
     * Show the page for editing a request.
     */
    public function edit(Request $request)
    {
        $inquiry = $request->user()->inquiry;

        if ($inquiry != NULL)
        {
            return Redirect::to('dashboard');
        }

        return view('inquiry.edit');
    }

    /**
     * Show the specified request.
     */
    public function show(Request $request)
    {
        $inquiry = Inquiry::find($request->inquiry_id);
        if ($inquiry)
        {
            return view('inquiry.show', ['inquiry' => $inquiry]);
        }

        return Redirect::to('dashboard');
    }

    /**
     * Create a new request.
     */
    public function create(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'link' => 'url|nullable',
        ]);

        // Cancel inquiry creation if there exists one for the same user.
        if ($request->user()->inquiry != NULL)
        {
            return back()->withErrors('A request has already been created.');
        }

        // Reject inquiry creation if user has not chosen lab or seat.
        if ($request->user()->seat == NULL)
        {
            return back()->withErrors('Lab or seat has not been chosen.');
        }

        $inquiry = Inquiry::create([
            'code' => $request->code,
            'type' => $request->type,
            'desc' => $request->desc,
            'link' => $request->link,
            'student_id' => $request->user()->id,
            'assistant_id' => null
        ]);
        $inquiry->save();

        return view('inquiry.show', ['inquiry' => $inquiry]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'inquiry_id' => 'required',
        ]);

        $inq = Inquiry::find($request->inquiry_id);
        $code = $request->code;

        if ($inq)
        {
            $inq->code = $code;
            $inq->update();
            event(new InquiryUpdated($inq));
        }

        return;
    }

    /**
     * Destroy the request.
     */
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

    /**
     * Assign the request to an assistant.
     */
    public function assign(Request $request)
    {
        $request->validate([
            'inquiry_id' => 'required',
        ]);

        $inquiry = Inquiry::find($request->inquiry_id);
        $user = $request->user();
        $isAssistant = $user->role == 'assistant';

        if ($inquiry && $inquiry->assistant_id == NULL && $isAssistant)
        {
            $inquiry->assistant_id = $user->id;
            $inquiry->update();
            event(new InquiryUpdated($inquiry));
        }

        return view('inquiry.show', ['inquiry' => $inquiry]);
    }
}
