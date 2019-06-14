<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use Alert;
use DB;

class OrdersController extends Controller
{
    public function getIndex() {
    	$orders = Order::all();
        return view('admin.pages.order.order', compact('orders'));
    }

    public function delete($id) {
    	if (isset($id)) {
	    	$order = DB::table('orders')->where('id','=', $id)->delete();
	    	if ($order){
                Alert::success(' The Data Deleted successfully', 'Done!');
                $orders = Order::all();
                return view('admin.pages.order.index', compact('orders'));
            }else{
                Alert::error('Something went wrong!', 'Error!');
            }
	    }
    }

}
