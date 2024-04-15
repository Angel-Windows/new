<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Admin\AdminBaseController;
use App\Models\Orders;
use App\Models\Delivery;
use App\Models\Payment;
use App\Models\OrderProductCharlist;

use App\Http\Requests\ChangeOrderStatusRequest;

use Response;
use Input;

class AdminOrdersController extends AdminBaseController
{

	public function getIndex()
	{
		$title = 'Заказы';
		$accept_orders = Orders::whereStatus(1)->count();
		$closed_orders = Orders::whereStatus(2)->count();
		$canceled_orders = Orders::whereStatus(3)->count();
		return view('admin.showOrdersTypes', compact(['title', 'accept_orders', 'closed_orders', 'canceled_orders']));
	}

	public function getShow( $type ){

		$title = 'Заказы';
		$types = ['0' => 'new', '1' => 'taken', '2' => 'made', '3' => 'canceled'];
		$status = array_search( $type, $types );

		$orders = Orders::leftJoin('dv_delivery','dv_orders.delivery','=','dv_delivery.id' )
						->select('dv_orders.*','dv_delivery.name AS d_name')
						->where('status', '=', $status )
						->orderBy('id', 'desc');

        $ordersClone = clone $orders;

        $ordersClone = $ordersClone->get();

		// print_r($orders);exit();

        $phones = [
            'all' => 'Все'
        ];
        $fio = [
            'all' => 'Все'
        ];

        if(count($ordersClone)){
            foreach ($ordersClone as $order){
                $phones[str_replace(' ', '', $order->phone)] = str_replace(' ', '', $order->phone);
                $fio[$order->fio] = $order->fio;
            }
        }


        $phones = array_unique($phones);
        $fio = array_unique($fio);


        if($order_id = Input::get('fio')){
            if($order_id != 'all'){
                $orders->where('dv_orders.fio', 'like', '%' . $order_id . '%');
            }
        }


        if($order_id = Input::get('phone')){
            if($order_id != 'all') {
                $orders->where('dv_orders.phone', 'like', '%' . $order_id . '%');
            }
        }






        $orders = $orders->paginate(15);

        $orders_count = Orders::where('status', '=', $status )->count();




		return view('admin.showOrders', compact(['title', 'orders', 'orders_count', 'type', 'phones', 'fio']));
	}


	public function postShow( Request $request ) {

		$ids = $request->get('check');
		if( $request->get('action') == 'delete' )
			Orders::destroy( $ids );

		return redirect()->back();
	}


	public function getEdit( $type, $id ) {

		$post = Orders::findOrFail($id);
		$title = "Просмотр заказа";
		$delivery = Delivery::whereId( $post->delivery )->first();
		$payment = Payment::whereId( $post->payment )->first();
		$ordered_prod = Orders::find( $id )
						->orderedproducts()
						->leftJoin('dv_products', 'dv_orders_products.product_id', '=', 'dv_products.id')
						->select(['dv_orders_products.*', 'dv_products.name AS prod_name', 'dv_products.code AS prod_code', 'dv_products.id AS prod_id'])
						->get();


		return view('admin.editOrdersPost', compact(['title', 'post','ordered_prod', 'type','delivery','payment']));
	}


//	public function postCharlist(Request $request){
//
//        return Response::json($charlist);
//    }



	public function postEdit( Request $request, $type = null, $id = null ){

	    if($request->ajax()){
            $id = $request->get('id');
            $charlist = OrderProductCharlist::where('order_product_id', $id)->get();
            return Response::json($charlist);
        }


		Orders::whereId($id)->update( $request->except('_token') );

		return redirect()->back()->with('success', 'Заказ успешно изменен');
	}
}
