<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Estate;
use App\Models\Meeting;
use App\Models\User;
use App\Http\Requests\StoreMeetingRequest;
use App\Http\Requests\UpdateMeetingRequest;
use Yajra\DataTables\DataTables;
use Pnlinh\GoogleDistance\GoogleDistance;

class MeetingController extends Controller
{
    public function test(){
        $distance = \Address::calculate('Çobançeşme, Bahçelievler/İstanbul', 'Kız Kulesi, Salacak, 34668 Üsküdar/İstanbul');

        dd([$distance]);
    }
    public function index()
    {
        $fields = [
            'id'=>'id',
            'user_id'=>'user_id',
            'estate_id'=>'estate_id',
            'customer_id'=>'customer_id',
            'start_at'=>'start_at',
            'duration'=>'duration',
            'buttons'=>'buttons',
        ];
        $data['dataTable'] = \Hattat::createDatatable(route('meeting.datatable'), $fields);
        return view('meeting.list', $data);
    }

    public function create()
    {
        $data['id'] = null;
        return view('meeting.edit', $data);
    }

    public function store(StoreMeetingRequest $request)
    {
        //
    }

    public function show(Meeting $meeting)
    {
        //
    }

    public function edit(Meeting $meeting)
    {
        //
    }

    public function update(UpdateMeetingRequest $request, Meeting $meeting)
    {
        //
    }

    public function destroy(Meeting $meeting)
    {
        //
    }

    public function dataDable(){
        $rows = Meeting::select(['id', 'estate_id','user_id','customer_id','start_at','duration']);
        $order = 0;
        return Datatables::of($rows)

            ->addColumn('action', function ($row) {
                return '<a href="#edit-'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->editColumn('estate_id', function($row){
                $estate = Estate::find($row->estate_id);
                if($estate){
                    return $estate->title;
                } else {
                    return $row->estate_id;
                }

            })
            ->editColumn('user_id', function($row){
                $user = User::find($row->user_id);
                if($user){
                    return $user->name;
                } else {
                    return $row->user_id;
                }
            })
            ->editColumn('customer_id', function($row){
                $customer = Customer::find($row->customer_id);
                if($customer){
                    return $customer->name;
                } else {
                    return $row->customer_id;
                }
            })
            ->editColumn('start_at', function($row){
                return $row->start_at;
            })
            ->editColumn('duration', function($row){
                return $row->duration;
            })
            ->editColumn('buttons', function ($row) {
                return $this->getDataTableButtons($row);
            })
            ->rawColumns(['buttons'])
            ->make(true);
    }

    private function getDataTableButtons($row){
        $edit_url = route('meeting.edit',['id'=>$row->id]);
        $delete_url = route('meeting.delete',['id'=>$row->id]);
        $title = _('Meeting Deleting!');
        $html = "(".$row->id .") is Deleting. Are you sure?";
        return '<a type="button" class="inline-flex items-center justify-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-900 active:bg-gray-800 disabled:opacity-25 transition " href="'.$edit_url.'">&#128463;</a> <a type="button" class="inline-flex items-center justify-center px-2 py-1 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition confirmModal" title="'.$title.'" html="'.$html.'" href="'.$delete_url.'">&#128473;</a>';
    }

}
