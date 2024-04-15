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

			<form method="POST" action="/edit-info">
				{!! csrf_field() !!}

				<div class="form_group">
					<label for="firstName"></label>
					<input type="text" value="{{ $user->firstName }}" name="firstName" id="firstName" placeholder="{{trans('enter_name')}}">
				</div>


				<div class="form_group">
					<label for="lastName"></label>
					<input type="text" value="{{ $user->lastName }}" name="lastName" id="lastName" placeholder="{{trans('cosmetics.cabinet.enter_family')}}">
				</div>


				<div class="form_group">
					<label for="middleName"></label>
					<input type="text" value="{{ $user->middleName }}" name="middleName" id="middleName" placeholder="{{trans('cosmetics.cabinet.enter_last_name')}}">
				</div>

				<div class="form_group">
					<label for="city"></label>
					<input type="text" value="{{ $user->city }}" name="city" id="city" placeholder="{{trans('cosmetics.cabinet.enter_city')}}">
				</div>

				<div class="form_group">
					<label for="address"></label>
					<input type="text" value="{{ $user->address }}" name="address" id="address" placeholder="{{trans('cosmetics.cabinet.enter_address')}}">
				</div>

				<div class="form_group">
					<label for="email" class="subscr_email"></label>
					<input type="text" value="{{ $user->email }}" name="email" id="email" placeholder="{{trans('cosmetics.cabinet.enter_email')}}">
				</div>

				<div class="form_group">
					<label for="phone" class="subscr_phone"></label>
					<input type="text" value="{{ $user->phone }}" name="phone" id="phone" placeholder="{{trans('cosmetics.cabinet.enter_phone')}}">
				</div>

				<div class="form_group">
					<label for="password" class="password"></label>
					<input type="text" name="password" id="password" placeholder="{{trans('cosmetics.cabinet.new_password')}}">
				</div>
				<input type="submit" value="{{trans('cosmetics.cabinet.edit')}}">
			</form>
		</div>
	</div>
</div>
	<!-- wrapper end -->

@endsection

@section('styles')
	<link rel="stylesheet" href="/frontend/css/contacts.css">
	<link rel="stylesheet" href="/frontend/css/user.css">
@endsection