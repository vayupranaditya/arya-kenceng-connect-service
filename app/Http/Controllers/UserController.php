<?php

namespace App\Http\Controllers;

use App\User;
use App\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    private function db_error() {
        return response()->json([
            'message' => 'Please try again'
        ], 400);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return User::all([
        'id',
        'name',
        'phone_number',
        'profile_pic_url',
        'jro_puri_id',
      ]);
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
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:100',
            'phone_number' => 'required|unique:users,phone_number|min:9|max:12|regex:/08[0-9]{8,10}/',
            'jro_puri_id' => 'required|exists:jro_puri,id',
            'member_type' => 'min:0|max:2'
        ]);
        if ($validator->fails()) return response()->json($validator->errors(), 400);
        $name = $request->name;
        $phone_number = $request->phone_number;
        $jro_puri_id = $request->jro_puri_id;
        isset($request->member_type) ? $member_type = $request->member_type : $member_type = 0;

        $user = new User();
        $user->name = $name;
        $user->phone_number = $phone_number;
        $user->jro_puri_id = $jro_puri_id;
        $user->member_type = $member_type;
        try {
            $user->save();
        } catch (Exception $e) {
            print_r($e);
            return $this->db_error();
        }
        $user_detail = new UserDetail();
        $user_detail->user_id = $user->id;
        try {
            $user_detail->save();
        } catch (Exception $e) {
            print_r($e);
            return $this->db_error();
        }
        return response()->json([
            'message' => 'register success'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  String $user_id
     * @return \Illuminate\Http\Response
     */
    public function show(String $user_id)
    {
        try {
            $user = DB::table('users')
                    ->where('users.id', $user_id)
                    ->join('users_detail', 'users.id', '=', 'users_detail.user_id')
                    ->join('jro_puri', 'users.jro_puri_id', '=', 'jro_puri.id')
                    ->select('users.*', 'jro_puri.name as jro_puri_name', 'users_detail.*')
                    ->first();
            return response()->json($user, 200);
        } catch(Exception $e) {
            print_r($e);
            return $this->db_error();
        }
    }

    /**
     * Search for specific user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'q' => 'required|min:4'
        ]);
        if ($validator->fails()) return response()->json($validator->errors(), 400);
        $is_phone = Validator::make($request->all(), [
            'q' => 'regex:/08[0-9]{8,10}/'
        ]);
        if (!$is_phone->fails()) {
            $result = User::where('phone_number', $request->q)->first([
                'id',
                'name',
                'phone_number',
                'profile_pic_url',
                'jro_puri_id',
                'member_type'
            ]);
        } else {
            $result = DB::table('users')
                        ->where('name', 'like', '%'.$request->q.'%')
                        ->get([
                            'id',
                            'name',
                            'phone_number',
                            'profile_pic_url',
                            'jro_puri_id',
                            'member_type'
                        ]);
        }
        return response()->json($result, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        return response()->json([
            'title' => 'Edit',
            'message' => 'Change this'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
