<?php

namespace App\Http\Controllers;

use App\Models\Estate;
use App\Http\Requests\StoreEstateRequest;
use App\Http\Requests\UpdateEstateRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EstateController extends Controller
{
    public function index()
    {
        $fields = [
            'id'=>'id',
            'title'=>'title',
            'contact'=>'contact',
            'phone'=>'phone',
            'price'=>'price',
            'mapurl'=>'mapurl',
            'buttons'=>'buttons',
        ];

        $data['dataTable'] = \Hattat::createDatatable(route('estate.datatable'), $fields);
        return view('estate.list', $data);
    }

    public function create(Request $request)
    {
        $data['id'] = null;
        return view('estate.edit', $data);
    }

    public function store(StoreEstateRequest $request)
    {
        //
    }

    public function show(Estate $estate)
    {
        //
    }

    public function edit($id)
    {
        if(empty($id)) return redirect(route('estate.create'));
        $data['id'] = $id;
        return view('estate.edit', $data);
    }

    public function update(UpdateEstateRequest $request, Estate $estate)
    {
        //
    }

    public function destroy(Estate $estate)
    {
        //
    }

    public function select2(){
        $rows = Estate::select(['id', 'title'])->get();
        if($rows){
            foreach($rows as $row){
                $result['results'][] = ['id'=>$row->id, 'text'=>$row->title];
            }
        }
        $result['pagination'] = ['more'=>false];
        return $result;
    }

    public function dataDable(){
        $rows = Estate::select(['id', 'title', 'contact', 'phone', 'mapurl', 'embed', 'price', 'image', 'status']);
        $order = 0;
        return Datatables::of($rows)
            ->addColumn('action', function ($row) {
                return '<a href="#edit-'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->editColumn('id', function($row){
                return 2;
            })
            ->editColumn('title', function($row){
                return '<img class="h-8 w-8  object-cover" src="'.$row->image.'" >'.$row->title;
            })
            ->editColumn('mapurl', function($row){
                if($row->mapurl) return '<a href="'.$row->mapurl.'" target="_blank">&#128204;</a>';
            })
            ->editColumn('buttons', function ($row) {
                return $this->getDataTableButtons($row);
            })
            ->rawColumns(['buttons','title', 'mapurl', 'embed'])
            ->make(true);
    }

    private function getDataTableButtons($row){

        $edit_url = route('estate.edit',['id'=>$row->id]);
        $delete_url = route('estate.delete',['id'=>$row->id]);
        $title = _('Estate Deleting!');
        $html = "(".$row->title.") is Deleting. Are you sure?";
        return '<a type="button" class="inline-flex items-center justify-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-900 active:bg-gray-800 disabled:opacity-25 transition " href="'.$edit_url.'">&#128463;</a> <a type="button" class="inline-flex items-center justify-center px-2 py-1 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition confirmModal" title="'.$title.'" html="'.$html.'" href="'.$delete_url.'">&#128473;</a>';
    }

}
