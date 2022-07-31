<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\DataLogin;
use Validator;


class DataLoginController extends Controller
{
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
    public function show(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_cms_users' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $message='';
            $no = 1;
            foreach ($errors->all() as $key) {
                $message.=$no++.'.'.$key.' ';
            }
            return response()->json([
                'status'=>false,
                'code'  =>400,
                'message'=>$message,
            ], 400);
        }

        $check = DataLogin::where('id_cms_users',$request->id_cms_users)->first();
        if($check){
            return response()->json([
                'status'=>true,
                'code'  =>200,
                'message' => 'success get data',
                'data' => $check
            ], 200);
        }else{
            return response()->json([
                'status'=>false,
                'code'  =>400,
                'message' => 'failed get data',
            ], 400);
        }
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
