<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\VccLoginRequest;
use App\Http\Controllers\Controller;
use App\VccUser;


class UserAuthController extends Controller
{

    public function getLogin()
    {
        return view('pages.vcclogin');
    }

    public function postLogin(VccLoginRequest $input)
    {
    	$vccUser = VccUser::checkCredentials($input->username, $input->password);

        if($vccUser != null)
        {
            Session::put('domainName', $vccUser->domain_name);
            return redirect("status");
        } else
        {
            return view('pages.vcclogin')->withErrors('Login Failed');
        }
	
    }

    public function getLogout()
    {
        // process logout
        Session::flush();
        return redirect('login')->with('message', 'Successfully logged out.');
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
