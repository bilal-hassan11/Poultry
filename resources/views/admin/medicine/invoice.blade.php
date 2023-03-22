
<!DOCTYPE html>
<html>
<head>
	<title>Inovice </title>

	<style>
		*{
			font-family: sans-serif;
		}
	</style>

</head>

<body>

<div style="width: 100%">
	<div style="width: 49%; display: inline-block">
		<img src="" alt="Raymeem" style="width: 150px;">
	</div>
	<div style="width: 50%; display: inline-block; text-align: right;">
		<h1 style="font-size: 50px; margin: 0; color: #590259; font-family: sans-serif;position: relative;">INVOICE</h1>
	</div>
</div>

<div style="width: 100%; margin-top: 40px">
	<div style="width: 49%; display: inline-block;">
		<p style="margin: 0;color: #7c7c7c; font-weight: 500; text-transform: uppercase">invoice to:</p>
		<h3 style="margin: 0; color: #272c2b; font-weight: 500">{{ @$sale->name }}</h3>
		{{-- <p style="margin: 0; color: #7c7c7c">309 West Bridgeton Circle Rocklin,  <br>
		CA 95677</p> --}}
		<p style="margin: 0;">{{ @$sale->phone_no }}</p>
		<p style="margin: 0;">{{ @$sale->email }}</p>
	</div>
	<div style="width: 50%; display: inline-block; text-align: right;">
		<p style="margin: 0;">Purchase Amount: {{ $sale->purchase_ammount }}</p>
		<p style="margin: 0;">Discount: {{ $sale->discount }}</p>
		<p style="margin: 0;">Commission: {{ $sale->commission }}</p>
		<p style="margin: 0;">Other charges: {{ $sale->other_charges }}</p>
		<p style="margin: 0;">Remarks: {{ $sale->remarks }}</p>
		<p style="margin: 0;">Invoice date: {{ date('d-M-Y', strtotime(@$sale->date)) }}</p>

		<h2 style="margin-top: 20px; color: #590259; font-weight: bold; font-size: 25px; text-transform: uppercase">Invoice total: {{ number_format(@$sale->net_ammount, 2) }}</h2>
	</div>
</div>

<div style="width: 100%; min-height: 700px">
	<table style="width: 100%; border-top: 1px solid #590259; border-collapse:collapse" cellpadding="10">
		<thead>
			<tr>
				<th style="text-transform: uppercase;font-size: 12px; color: #7c7c7c; font-weight: 600; text-align: left;">Company</th>
				<th style="text-transform: uppercase;font-size: 12px; color: #7c7c7c; font-weight: 600; text-align: right">Item</th>
				<th style="text-transform: uppercase;font-size: 12px; color: #7c7c7c; font-weight: 600; text-align: right;">Quantity</th>
			</tr>
		</thead>
		<tbody>
			@foreach($sale->sale_details AS $detail)
				<tr>
					<td style="font-weight: bold; font-size: 14px;border-bottom: 1px solid #cccccc; padding-top: 15px; padding-bottom: 15px; color: #272c2b">{{ @$detail->company->name }}</td>
					<td style="text-align: right;font-weight: bold; font-size: 14px;border-bottom: 1px solid #cccccc; padding-top: 15px; padding-bottom: 15px; color: #272c2b">{{ @$detail->item->name }}</td>
					<td style="text-align: right;font-weight: bold; font-size: 14px;border-bottom: 1px solid #cccccc; padding-top: 15px; padding-bottom: 15px; color: #272c2b">{{ $detail->quantity }}</td>
				</tr>
			@endforeach
			<tr>
				<td></td>
				<td style="text-align: right;font-weight: bold; font-size: 14px; padding-top: 5px; padding-bottom: 5px; color: #272c2b">TOTAL:</td>
				<td style="text-align: right;font-weight: bold; font-size: 14px; padding-top: 5px; padding-bottom: 5px; color: #272c2b">{{ number_format(@$sale->net_ammount, 2) }}</td>
			</tr>

		</tbody>
	</table>
</div>

<div style="width: 100%;">
	<h3 style="margin: 0; font-weight: 500;color: #272c2b"></h3>
</div>

	<!-- <script>
		window.print();
	</script> -->

</body>

</html>
