<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function select2(){
        $rows = User::select(['id','name'])->get();
        if($rows){
            foreach($rows as $row){
                $result['results'][] = ['id'=>$row->id, 'text'=>$row->name];
            }
        }
        $result['pagination'] = ['more'=>false];
        return $result;
    }

    public function available_times(Request $request){
        if($id = $request->get('id')){
            $row = User::find($id);
            if($row){
                $data['user'] = $row;
                $data['hours'] = [
                    '00:00'=>'...',
                    '01:00'=>'...',
                    '02:00'=>'...',
                    '03:00'=>'...',
                    '04:00'=>'...',
                    '05:00'=>'...',
                    '06:00'=>'...',
                    '07:00'=>'...',
                    '08:00'=>'...',
                    '09:00'=>'...',
                    '10:00'=>'...',
                    '11:00'=>'...',
                    '12:00'=>'...',
                    '13:00'=>'...',
                    '14:00'=>'...',
                    '15:00'=>'...',
                    '16:00'=>'...',
                    '17:00'=>'...',
                    '18:00'=>'...',
                    '19:00'=>'...',
                    '20:00'=>'...',
                    '21:00'=>'...',
                    '22:00'=>'...',
                    '23:00'=>'...',
                ];
                return view('user.available-times', $data);
            }
        }
    }
}
