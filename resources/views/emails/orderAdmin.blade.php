<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
</head>
<body>

	<a href="{{ config('app.url') }}" style="margin-bottom:20px;"><img src="{{ url('/') }}/uploads/logo/logo.png"></a>

	<h3 style="margin-bottom:20px;">Уведомление о новом заказе</h3>

	<div style="font-size: 14px; line-height: 24px; margin-bottom: 20px;">
		<span style="color: #333333; display: inline-block; width: 150px;">Имя: </span>{{$order['fio']}}<br>
		<span style="color: #333333; display: inline-block; width: 150px;">Телефон: </span>{{$order['phone']}}<br>
		<span style="color: #333333; display: inline-block; width: 150px;">Email: </span>{{$order['email']}}<br>
		<span style="color: #333333; display: inline-block; width: 150px;">Комментарий: </span>{{$order['comment']}}<br>
		<span style="color: #333333; display: inline-block; width: 150px;">Сумма: </span>{{$order['total_cost']}} грн<br>
	</div>

    <a style="color: #336699; font-weight: bold; font-size: 14px;" href="{{ url('/master/orders/edit', ['new', $order['id']]) }}">Просмотр заказа</a>

	<p>Данное письмо создано автоматически, пожалуйста, не отвечайте на него.</p>

</body>
</html>