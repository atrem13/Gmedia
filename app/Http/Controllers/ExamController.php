<?php

namespace App\Http\Controllers;

use App\Models\user_hotspot;
use App\Models\user_print;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class ExamController extends Controller
{
    public function check1(Request $request){

        // BEFORE
        // $valid = preg_replace('/[^0-9,.+-]/', '', $request->number);
        // $num = explode(',', $valid);
        // $num1 = (int)$num[0];
        // $num2 = (int)$num[1];
        // if($num1 <= 90 && $num1 >= -90){
        //     if($num2 <= 180 && $num1 >= -180){
        //         return 'valid';
        //     }else{
        //         return 'invalid';
        //     }
        // }else{
        //     return 'invalid';
        // }

        // AFTER
        $valid = preg_replace('/[^0-9,.+-]/', '', $request->number);
        $valid =  preg_match("/^[-+]?([1-8]?\d(\.\d+)?|90(\.0+)?),\s*[-+]?(180(\.0+)?|((1[0-7]\d)|([1-9]?\d))(\.\d+)?)$/", $valid);
        if($valid){
            return 'valid';
        }else{
            return 'invalid';
        }
    }

    public function check2(Request $request){
        $username = $request['username'];
        $password = $request['password'];

        $user = user_hotspot::select('groupname', 'max_device')->where('username', $username)->where('password', $password)->first();

        $newgroupname = explode("_", $user->groupname);
        $test = $newgroupname[0] . '@' . $username . '@' . $password;

        $max_device = $user->max_device;
        $count = user_print::where('user', $test)->count('id');
        $data_dihapus = 'data tidak ada dihapus';

        while($count > $max_device){
                $user_print = user_print::orderBy('uptime', 'DESC')->limit(1)->get();
                $delUser = user_print::where('address', $user_print[0]->address)->first();
                $delUser->delete();
            $count -=1;
            $data_dihapus = 'data terhapus';
        }

        return $data_dihapus;
    }
}
