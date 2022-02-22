<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Invoice</title>

		<style>
			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}
			.text-primary{
				color: :aqua;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
		</style>
	</head>

	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
									<h5 class="text-primary"><p style="color:#72C5FE">Easy </p>Inventory</h5>
									
								</td>
								
							
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								

								<td>
									Invoice #: {{ $invoice->invoice_no }}<br />
									Date: {{ $date }}<br />
									Name:- {{ $invoice->payment->customer->name }}<br />
									Mobile:- {{ $invoice->payment->customer->mobile }}<br />
									{{-- Email:- {{ $invoice->payment->customer->email }}<br/> --}}
									Address:- {{ $invoice->payment->customer->address }}

								</td>
								
							</tr>
						</table>
					</td>
				</tr>

				

				<tr class="heading">
					<td>SL NO.</td>
					<td>Category</td>
					<td>Product</td>
					<td>Quantity</td>
					<td>Unit Price</td>
					<td>Total Price</td>


				</tr>
				@php 
				$subTotal = '0';
				@endphp
			@foreach($invoice->invoiceDetails as $key => $invoiceDetal)
			  <tr>
				<td>{{ $key+1 }}</td>
				<td>{{ $invoiceDetal->category->name }}</td>
				<td>{{ $invoiceDetal->product->product_name }}</td>
				<td>{{ $invoiceDetal->selling_quantity }}</td>
				<td>{{ $invoiceDetal->unit_price }}</td>
				<td>{{ $invoiceDetal->selling_price }}</td>
			  </tr>
			  @php
			  $subTotal += $invoiceDetal->selling_price;
			  @endphp
			@endforeach

			<tr >
				<td colspan="5"  style="text-align: right;">Sub Total:-</td>
				<td>{{ $subTotal }}</td>
			</tr>
			<tr>
				<td colspan="5" style="text-align: right;">Discount Amount:-</td>
				<td>{{ $invoice->payment->discount_amount }}</td>
			</tr>
			<tr>
				<td colspan="5" style="text-align: right;">Paid Amount:-</td>
				<td>{{ $invoice->payment->paid_amount }}</td>
			</tr>
			<tr>
				<td colspan="5" style="text-align: right;">Due Amount:-</td>
				<td>{{ $invoice->payment->due_amount }}</td>
			</tr>
			<tr>
				<td colspan="5" style="text-align: right;">Grand Total:-</td>
				<td>{{ $invoice->payment->total_amount }}</td>
			</tr>

				
			</table>
			
			@php 
$date = new DateTime('now', new DateTimezone('Asia/Dhaka'));
@endphp
<hr>
<br>
<br>
<table width="100%">
	<tbody>
		<tr>
			<td style="text-align: left;">Customer Signature</td>
			<td style="text-align: right;">Seller Signature</td>
		</tr>
	</tbody>
</table>
<br>
<p>
	Printing Time:- {{ $date->format('F j, Y, g:i a') }}
</p>

		</div>
	</body>
</html>