<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class CustomerController extends Controller
{

    public function index()
    {

        $fields = [
            'id'=>'id',
            'firstname'=>'firstname',
            'lastname'=>'lastname',
            'email'=>'email',
            'phone'=>'phone',
            'buttons'=>'buttons',
        ];
        $data['dataTable'] = \Hattat::createDatatable(route('customer.datatable'), $fields);
        return view('customer.list', $data);
    }

    public function create(Request $request)
    {
        $data['id'] = null;
        return view('customer.edit', $data);
    }

    public function store(StoreCustomerRequest $request)
    {
        //
    }

    public function show(Customer $customer)
    {
        //
    }

    public function edit($id)
    {
        if(empty($id)) return redirect(route('customer.create'));
        $data['id'] = $id;
        return view('customer.edit', $data);
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
    }

    public function destroy(Customer $customer)
    {
        //
    }

    public function select2(){
        $rows = Customer::select(['id','firstname','lastname','email','phone'])->get();
        if($rows){
            foreach($rows as $row){
                $result['results'][] = ['id'=>$row->id, 'text'=>$row->firstname.' '.$row->lastname];
            }
        }
        $result['pagination'] = ['more'=>false];
        return $result;
    }

    public function dataDable(){
        $rows = Customer::select(['id','firstname','lastname','email','phone']);
        $order = 0;
        return Datatables::of($rows)

            ->addColumn('action', function ($row) {
                return '<a href="#edit-'.$row->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->editColumn('id', function($row){
                return 2;
            })
            ->editColumn('buttons', function ($row) {
                return $this->getDataTableButtons($row);
            })
            ->rawColumns(['buttons'])
            ->make(true);
    }

    private function getDataTableButtons($row){
        $edit_url = route('customer.edit',['id'=>$row->id]);
        $delete_url = route('customer.delete',['id'=>$row->id]);
        $title = _('Customer Deleting!');
        $html = "(".$row->firstname .' '.$row->lastname.") is Deleting. Are you sure?";
        return '
<a type="button" class="inline-flex items-center justify-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-900 active:bg-gray-800 disabled:opacity-25 transition " href="'.$edit_url.'">&#128463;</a> <a type="button" class="inline-flex items-center justify-center px-2 py-1 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition confirmModal" title="'.$title.'" html="'.$html.'" href="'.$delete_url.'">&#128473;</a>';
    }
}
