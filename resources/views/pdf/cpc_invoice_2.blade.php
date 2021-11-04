<!-- pdf.blade.php -->

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>PARTNERSHIP AGREEMENT WITH AFA</title>
    <style>
      body{
        margin-top: 0px !important;
      }
      
      .ca-section-2{
        padding-top: 575px;
      }

      .pdf-header-p1, .pdf-header-p2{
        text-align: center;
      }
      
      .pdf-align-center{
        text-align: center;
        font-weight: bold;
      }

      .pdf-header-p1 h4, .pdf-header-p2 h4{
        letter-spacing: 5px;
      }

      .pdf-header-p1 p, .pdf-header-p2 p{
        margin-top:-15px;
        font-weight: bold;
      }

      .pdf-content-p1 .table{
        border-collapse: collapse;
      }
      
      .pdf-content-p1 .table tr,td{
        border: 1px solid #000000;
      }

      .pdf-content-p1 .table .list-right{
        width: 20%;
        padding-left: 10px;
      }

      .pdf-content-p1 .table .list-center{
        padding-left: 10px;
        text-align: center;
      }
      
      .pdf-content-p1 .table .list-center-colspan{
        padding-left: 10px;
        text-align: center;
      }

      .pdf-footer-p2{
        margin: 0% 0% 0% 8%;
      }
      
      .pdf-footer-p2 table{
        border-collapse: collapse;
      }

      .pdf-footer-p2 table td{
        padding-left: 10px;
        padding-right: 10px;
      }
	  
	  table{width:100%}
	  
      .table .table-col-1{
          margin-right: -250% !important;
      }
      
      .table .table-row{
        padding-top: 25px !important;
        padding-left: 10px;
        width:10%;
      }
      
      .table .col-p-t > p{
        margin-top: -150px !important;
        margin-left: 0px !important;
      }
      
      .table .table-row p{
        padding-top: 25px !important;
        text-align: center;
      }
      
      .table .table-row p img{
        padding-right: 5px !important;
      }
      
      .table .table-row-footer{
        margin-top: 62px !important;
        text-align: center;
      }

    </style>
  </head>
  <body>
    <section class="ca-section-1">
        <div class="pdf-header-p1">
          <h3>CPC INVOICE</h3>
          <h4>(Second/Last Payment)</h4>		  
        </div>
		<p style="width:100%; text-align:right">IEA, {{Carbon\Carbon::now()->toFormattedDateString()}}</p>
		
		<h4>INVOICE N° {{ $invoice_num }}</h4>
	  <div class="pdf-content-p1">
			<h4><u>Transaction file reference</u> : {{ $dossTrans->numero }}</h4>
			<h4><u>Subject</u> : {{ $product->title }}</h4>
			<table class="table table-bordered">
				<tr>
					<td>
						<table class="table table-bordered">
							<tr>
								<td width="50%">State : <em>{{$product->location->area_level_1}}</em></td>
								<td>City : <em>{{$product->location->locality}}</em></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table class="table table-bordered">
							<tr>
								<td width="50%">Buyer : Member <em>{{$member->immat}}</em>  - <em>{{$member_name}}</em></td>
								<td>Seller : <em>{{$seller->name}}</em> (éventuellement  <em>{{$seller->userinfos->orga_parent_name}}</em>)</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table class="table table-bordered">
							<tr>
								<td width="33.33%">Sales price : $<em>{{number_format($order->final_sales_price, 2, ',',' ')}}</em></td>
								<td width="33.33%">Sales commission rate : <em>{{$order->taux_commission}} {{$order->commission_type}}</em></td>
								<td width="33.33%">Sales commission : $<em>{{ $order->commission_type=='%'?(number_format($order->final_sales_price*$order->taux_commission/100, 2, ',',' ')):number_format($order->taux_commission, 2, ',',' ') }}</em></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table class="table table-bordered">
							<tr>
								<td width="50%">Sales commission distribution key : <em>{{$reglage->seuil_value}}{{$reglage->seuil_unite}}</em></td>
								<td><strong>Total &quot;<em>Commission de  Présentation de Clentèle</em>&quot;<em> - CPC</em>attributable  to <em>{{$iicc['iicc_name']->value}}</em> :  $<em>{{number_format($cpc, 2, ',',' ')}}</em></strong></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<p><strong>The present invoice (Deposit balance 90% and settlement) concerns the SECOND/LAST PAYMENT (50%) of the above "Commission de Présentation de Clientèle" - CPCattributable to {{$iicc['iicc_name']->value}}.</strong></p>
			<p>Consequently, in application of our "Investir en Australie" partnership contract,</p>
			<p>The agency {{$afa->name}}</p>
			<p>owes</p>
			<p>to {{$iicc['iicc_name']->value}}, managing company of "Investir en Australie" portal the amount of 50% of the "Commission de Présentation de Clientèle" on the sales commission:</p>
			<h4 style="text-align:center">{{ucfirst($cpcIeaToLetter)}} Dollars Australiens (${{number_format($cpcIea, 2, ',',' ')}})</h4>
			<p>For your kind payment within the period of FIFTEEN DAYS (15 days) following the perception by {{$afa->name}} of the sales commission due by the seller, please use the link <a href="#"><strong>CPC ON COMMISSION SECOND/LAST PAYMENT</strong></a> included in the accompanying message.</p>
			<p>Awaiting the payment of the above amount, and with ourwarmest congratulations.</p>
			<p>{{$iicc['iicc_dir']->value}}</p>
			<p>Director of {{$iicc['iicc_name']->value}}</p>
			<p><img src="{{asset('images/icc.png')}}" alt="iicc">
			<p style="text-align:center">
				 	International Internet Commerce & Consulting Sarl <br>
					BP 8611 – 98807 NOUMEA DEDEX – Nouvelle Calédonie <br>
					RCS : 1 236 165 RCS Nouméa – RIDET 1 236 165.002 <br>
					Compte bancaire BCI Magenta – IBAN : FR76 1749 9000 0829 5069 0201 459 – BIC : BCADNCNN <br>
			</p>
		</div>
	</section>
  </body>
</html>