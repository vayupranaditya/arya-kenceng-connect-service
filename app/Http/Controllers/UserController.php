<?php

namespace App\Http\Controllers;

use App\User;
use App\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    private function db_error()
    {
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
        $_user = User::with('jro_puri')->inRandomOrder()->simplePaginate(10, [
            'id',
            'name',
            'profile_pic_url',
            'jro_puri_id',
        ]);
        return $_user;
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
        try{
            $_user = User::find($user_id);
            $_jro_puri = $_user->jro_puri;
            $_detail = $_user->detail;
        } catch (Exception $e) {
            print_r($e);
            return $this->db_error();
        }
        $data = [
            'id' => $_user->id,
            'profile_pic_url' => $_user->profile_pic_url,
            'name' => $_user->name,
            'jro_puri_name' => $_jro_puri->name,
            'member_type' => $_user->member_type == 1 ? 'Anggota' : ($_user->member_type == 2 ? 'Pengurus' : 'Admin'),
            'birthdate' => $_detail->birthdate,
            'gender' => $_detail->is_male ? 'Laki-laki' : 'Perempuan',
            'status' => $_detail->is_married ? 'Married' : 'Single',
            'address' => $_detail->current_address,
            'phone_number' => $_user->phone_number,
            'job' => $_detail->job,
            'business' => $_detail->business
        ];
        return response()->json($data, 200);
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
            'q' => array('regex:/(08|62|\+62)(([0-9]{8,10})|([0-9](-([0-9]{3})){3})|[0-9]{2}(-[0-9]{4}){2})/')
        ]);
        if (!$is_phone->fails()) {
            $q = str_replace('-', '', $request->q);
            $q = str_replace('+', '', $q);
            if (substr($q, 0, 2) == '62') {
                $q = substr_replace($q, '0', 0, 2);
            }
            print_r($q);
            $result = User::where('phone_number', $q)->with('jro_puri')->first([
                'id',
                'name',
                'profile_pic_url',
                'jro_puri_id',
                'member_type'
            ]);
        } else {
            print_r('gagal');
            $result = DB::table('users')
                ->where('name', 'like', '%' . $request->q . '%')
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
     * Update the specified resource in storage.
     *
     * @param  String $user_id
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(String $user_id, Request $request)
    {
        // $request->
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
