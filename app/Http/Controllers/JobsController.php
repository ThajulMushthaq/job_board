<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobsController extends Controller
{

    private $jobsModel;
    private $candidatesModel;

    public function __construct()
    {
        $this->jobsModel = new \App\Models\JobsModel;
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
        $data['data'] = $this->jobsModel->get_data();
        // dd($data['data']);
        return view('home', $data);
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
            'company' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        $values = array(
            'company' => @$request->get('company') ?: '',
            'email' => @$request->get('email') ?: '',
            'phone' => @$request->get('phone') ?: '',
            'location' => @$request->get('location') ?: '',
            'job_title' => @$request->get('job_title') ?: '',
            'job_type' => @$request->get('job_type') ?: '',
            'job_description' => @$request->get('job_description') ?: null,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );

        $id = $this->jobsModel->save_data($values);

        return redirect()->back()->with("success", "Item added successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = 0)
    {
        //
        $data['res'] = $this->jobsModel->get_row($id);
        $data['candidates'] = $this->candidatesModel->get_applied_candidates($id);
        return view('job_detail', $data);
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
