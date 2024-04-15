@extends('frontend.layout')

@section('main')

	<div class="breadCrumbBg contacts">
		<div class="container">
			<div class="row">
				<ul class="breadCrumbs col-xs-12">
					<li><a href="/">{{trans('cosmetics.main')}}</a></li>
					<li><a href="/{{ $page->slug }}">{{ $page->name }}</a></li>
				</ul>
			</div>
		</div>
	</div>


	<div class="container">
		<div class="row">
		<div class="pers_area col-xs-12">

			@if (Auth::check())
					<div class="user_info fleft">
						<table>

							@if( $user->firstName )
								<tr>
									<td>{{trans('cosmetics.name')}}</td>
									<td>{{ $user->firstName }}</td>
								</tr>
							@endif

							@if( $user->lastName )
								<tr>
									<td>{{trans('cosmetics.cabinet.last_name')}}</td>
									<td>{{ $user->lastName }}</td>
								</tr>
							@endif

							@if( $user->middleName )
								<tr>
									<td>{{trans('cosmetics.cabinet.family')}}</td>
									<td>{{ $user->middleName }}</td>
								</tr>
							@endif

							<tr>
								<td>E-mail</td>
								<td>{{ $user->email }}</td>
							</tr>
							@if( $user->phone )
								<tr>
									<td>{{trans('cosmetics.phone')}}</td>
									<td>{{ $user->phone }}</td>
								</tr>
							@endif
							@if( count( $orders ) )
								<tr>
									<td>{{trans('cosmetics.cabinet.accumulation')}}</td>
									<td>{{ $total_ordered }} грн @if($total_ordered < $settings->sum) <i style="font-size: 13px;">(нужно еще купить товаров на <b style="font-weight: bold">{{ $settings->sum - $total_ordered }}</b> грн для скидки в <b style="font-weight: bold">{{ $settings->discount }}</b> %) </i> @endif </td>
								</tr>
							@endif
							@if( $total_ordered >= $settings->sum )
								<tr>
									<td>{{trans('cosmetics.cabinet.discount')}}</td>
									<td>{{ $settings->discount }} %</td>
								</tr>
							@endif
						</table>
					</div>
					<div class="relativeBlock">
							<!-- user_info end -->
							<div class="right_section fright">
								<a href="/edit-info">{{trans('cosmetics.cabinet.edit_user')}}</a>
								<a href="/logout">{{trans('cosmetics.cabinet.exit')}}</a>
							</div>
							<div class="notification">
								<a href="/notifications">{{trans('cosmetics.cabinet.memento')}}</a>
								<a href="/service">{{trans('cosmetics.cabinet.service_feedback')}}</a>
							</div>
					</div>
				<!-- fright end -->
				</div>
				<!-- clearfix end -->
				@if( count( $orders ) )
				<table class="ordered_pr">
					<tr>
						<td class="hidden-xs">{{trans('cosmetics.cabinet.number_order')}}</td>
						<td>{{trans('cosmetics.cabinet.data_order')}}</td>
						<td>{{trans('cosmetics.cabinet.order_products')}}</td>
						<td>{{trans('cosmetics.cabinet.order_info')}}</td>
						<td class="hidden-xs">{{trans('cosmetics.cabinet.order_status')}}</td>
					</tr>
					@foreach( $orders as $order )
						<tr>
							<td class="hidden-xs">№ {{ $order->id }}</td>
							<td>{{ $order->created_at->format('d.m.Y h:i') }}</td>
							<td>
								@foreach( $order->orderedproducts as $op )


									@if( $op->product_type != 5 )
										<a href="/product/{{ $op->slug }}" target="_blank">
											<img src="@if( $img = unserialize($op->imgs)[$op->main_img] ) /uploads/products/sm/{{ $img }} @else /uploads/products/sm/no_image.png @endif" alt="{{ $op->product_name}}">
										</a>
									@endif
								@endforeach
								<!--  -->
							</td>
							<td>{{ count($order->orderedproducts) }} {{ Lang::choice('товар|товара|товаров', count($order->orderedproducts), array(), 'ru') }} на {{ $order->total_cost }} грн</td>
							<td class="hidden-xs">
								@if( $order->status == 0 )
									<span class="red">{{trans('cosmetics.status.new')}}</span>
								@elseif( $order->status == 1 )
									<span class="brown">{{trans('cosmetics.status.processing')}}</span>
								@else
									<span class="green">{{trans('cosmetics.status.complete')}}</span>
								@endif
							</td>
						</tr>
					@endforeach
				</table>
				@endif
			@else
				@if( Session::has('error') || $errors->any() )
					@foreach( $errors->all() as $error )
						<li>{{ $error }}
					@endforeach
				@endif

			@endif
	</div>
	</div>
	<!-- wrapper end -->

@endsection

@section('scripts')
<script>

	var status = 1;
	$('.toggle').click(function(){
		if( status == 1 ){
			$(this).text('Войти');
			$('#login_form').hide(300);
			$('#reg_form').show(300);
			status = 0;
		}
		else{
			$(this).text('Зарегистрироваться');
			$('#reg_form').hide(300);
			$('#login_form').show(300);
			status = 1;
		}
		return false;
	});


</script>
@endsection

@section('styles')
	<link rel="stylesheet" href="/frontend/css/contacts.css">
	<link rel="stylesheet" href="/frontend/css/user.css">
@endsection
