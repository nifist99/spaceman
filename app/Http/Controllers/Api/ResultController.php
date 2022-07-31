<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Result;
use Validator;

class ResultController extends Controller
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
        $validator = Validator::make($request->all(), [
            'gameid' => 'required',
            'result' => 'required',
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

        $check = Result::where('gameid',$request->gameid)->first();
        if($check){
            return response()->json([
                'status'=>false,
                'code'  =>400,
                'message' => 'data sudah ada',
            ], 400);
        }else{

                $res = Result::create([
                    'gameid'=>$request->gameid,
                    'result'=>$request->result,
                    'created_at'=>Carbon::now(),
                ]);

                if($res){
                    return response()->json([
                        'status'=>true,
                        'code'  =>200,
                        'message' => 'success add data',
                    ], 200);
                }else{
                    return response()->json([
                        'status'=>false,
                        'code'  =>400,
                        'message' => 'failed save data',
                    ], 400);
                }

        }
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
