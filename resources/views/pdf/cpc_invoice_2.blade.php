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
		
		<h4>INVOICE N° IICC/{IEA} (ou {IENZ} pour la NZ)/{Année courante système}-{n° de facture incrémenté d'une unité à chaque nouvelle facture} (INVOICE N° IICC/{IEA}/{IENZ}/yy – xxxxx)</h4>
	  <div class="pdf-content-p1">
			<h4><u>Transaction file reference</u> : {RES/FON/IND/COM–xxxxx}</h4>
			<h4><u>Subject</u> : purchase of a property in {Nom programme} (ou {Nom Produit Isolé})</h4>
			<table class="table table-bordered">
				<tr>
					<td>
						<table class="table table-bordered">
							<tr>
								<td width="50%">State : {<em>Nom  Etat</em>}</td>
								<td>City : {<em>Nom  Ville</em>}</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table class="table table-bordered">
							<tr>
								<td width="50%">Buyer : Member {<em>MEM-xxxxx</em>}  - {<em>PrénomMembre</em>} {<em>Nom Membre</em>} / {<em>Nom de l'organisation</em>}</td>
								<td>Seller : {<em>Nom  Vendeur</em>} (éventuellement  {<em>Nom maison mère</em>})</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table class="table table-bordered">
							<tr>
								<td width="33.33%">Sales price : ${<em>Prix  Vente</em>}</td>
								<td width="33.33%">Sales commission rate : {<em>Taux Commission Vente</em>} (hors taxe) (ou {<em>Commission  Sur Vente en Valeur</em>})</td>
								<td width="33.33%">Sales commission : ${<em>Commission  Sur Vente</em>} (ou ${<em>Commission Sur Vente en Valeur</em>})</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table class="table table-bordered">
							<tr>
								<td width="50%">Sales commission distribution key : <em>{Clé Répartition IEA Commission AFA}</em></td>
								<td><strong>Total &quot;<em>Commission de  Présentation de Clentèle</em>&quot;<em> - CPC</em>attributable  to {<em>Nom société gestionnaire IEA</em>} :  ${<em>CPC</em>}</strong></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<p><strong>The present invoice (Deposit balance 90% and settlement) concerns the SECOND/LAST PAYMENT (50%) of the above "Commission de Présentation de Clientèle" - CPCattributable to {Nom société gestionnaire IEA}.</strong></p>
			<p>Consequently, in application of our "Investir en Australie" partnership contract,</p>
			<p>The agency {Nom AFA}</p>
			<p>owes</p>
			<p>to {Nom société gestionnaire IEA}, managing company of "Investir en Australie" portal the amount of 50% of the "Commission de Présentation de Clientèle" on the sales commission:</p>
			<h4 style="text-align:center">{CPC}x50% (en toutes lettres) Dollars Australiens ({$CPC}x50%) (en chiffres précédé du signe $)</h4>
			<p>For your kind payment within the period of FIFTEEN DAYS (15 days) following the perception by {Nom AFA} of the sales commission due by the seller, please use the link <a href="#"><strong>CPC ON COMMISSION SECOND/LAST PAYMENT</strong></a> included in the accompanying message.</p>
			<p>Awaiting the payment of the above amount, and with ourwarmest congratulations.</p>
			<p>{Nom gérant société gestionnaire IEA}</p>
			<p>Director of {Nom société gestionnaire IEA}</p>
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