<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;
use App\Events\InquiryUpdated;
use Illuminate\Support\Facades\Redirect;

use function Laravel\Prompts\error;

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
            return $in->lab_id == $lab_id && $in->assistant_id == null;
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
        $request->validate([
            'inquiry_id' => 'required',
        ]);
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
            'lab_id' => $request->user()->lab->id,
            'student_id' => $request->user()->id,
            'assistant_id' => null
        ]);
        $inquiry->save();

        return redirect()->route('inquiry.show', ['inquiry_id' => $inquiry->id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'code' => 'present',
            'inquiry_id' => 'required',
        ]);

        $inq = Inquiry::find($request->inquiry_id);
        $code = $request->code;

        if ($inq)
        {
            $inq->code = $code;
            $inq->update();
            $user_id = $request->user()->id;
            event(new InquiryUpdated($inq, $user_id));
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

        return redirect()->route('dashboard');
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

        if ($inquiry && $inquiry->assistant_id == NULL && $user->hasRole('assistant'))
        {
            $inquiry->update(['assistant_id' => $user->id]);
        }

        return redirect()->route('inquiry.show', ['inquiry_id' => $inquiry->id]);
    }

    /**
     * Retrieves the current and maximum position of the inquiry or the assignee of the inquiry.
     */
    public function status(Request $request) {
        $user = $request->user();
        $lab = $user->lab;
        $inquiry = $user->inquiry;

        if (!$lab || !$inquiry)
        {
            return http_response_code(200);
        }

        if ($inquiry->assistant_id != NULL)
        {
            return response(array(
                'assignee' => $inquiry->assistant->name,
            ), 201);
        }

        $lab_id = $lab->id;

        $inqs = Inquiry::all()->filter(function (Inquiry $in) use ($lab_id)
        {
            return $in->lab_id == $lab_id && $in->assistant_id == null;
        })->sortBy('created_at');

        $current = $inqs->search($inquiry) + 1;
        $max = $inqs->count();

        return response(array(
            'current' => $current,
            'max' => $max,
        ), 202);
    }
}
