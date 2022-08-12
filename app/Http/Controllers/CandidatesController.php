<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CandidatesController extends Controller
{


    private $candidatesModel;

    public function __construct()
    {
        $this->candidatesModel = new \App\Models\CandidatesModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'resume' => 'required|max:30000',
        ]);


        $values = array(
            'job' => @$request->get('job') ?: '',
            'name' => @$request->get('name') ?: '',
            'email' => @$request->get('email') ?: '',
            'phone' => @$request->get('phone') ?: '',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );


        if ($request->file('resume')) {
            $file = $request->file('resume');
            $filename = date('YmdHis') . $file->getClientOriginalName();
            $file->move(public_path('/resume'), $filename);
            $values['resume'] = $filename;
        }
        $id = $this->candidatesModel->save_data($values);

        if ($id > 0) {
            $replyto   = 'do_not_reply@job-board.com';;
            $replyname = 'Job Board';
            $header    = "From: " . $replyname . " <" . $replyto . ">\n";

            $to = @$request->get('email');

            $subject = "New candidate " . @$request->get('name') . " applied for your job post. Reply them to " . @$request->get('email') . "or call to " . @$request->get('phone') . " ASAP";

            $message = "New candidate ";

            mail($to, $subject, $message, $header);
        }

        return redirect()->back()->with("success", "Job Applied Successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
