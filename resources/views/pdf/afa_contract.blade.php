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
    {{-- Section 1 : CONUUCTION AGREEMENT --}}
    <section class="ca-section-1">
        <div class="pdf-header-p1">
          <h3>PARTNERSHIP CONTRACT AUSTRALIAN FRANCOPHONE AGENCY</h3>
          <h4>({{ $user->name }})</h4>
        </div>

        <div class="pdf-content-p1">
            <h4><u>BETWEEN</u></h4>
            <p>1 - "<b>Investir en Australie</b>" ("IEA") system made up of:</p>
            <p>- "<b>L'IMMOBILIERE AUSTRALIENNE Pty Ltd</b>" real estate agency, company incorporated under Australian law, ABN 34 632 675 113, with registered office at 3/8 Petrie Terrace, Brisbane, QLD 4000, Australia,
                duly represented herein by its current director, Mr. Philippe J. Buteri de Préville,hereinafter referred to as "<b>LIA</b>",
            </p>
            <p>and : </p>
            <p>- "<b>INTERNATIONAL INTERNET COMMERCE & CONSULTING Sarl</b>", trading as "<b>IICC Sarl</b>", company incorporated under French law, Ridet 1 236 165.002, registered in the Trade and Companies Register of Nouméa, New Caledonia under the number RCS 1 236 165, which head office is at 4 rue Jules Courtot, Val Plaisance, Nouméa, New Caledonia,
                duly represented herein by its current manager, Mr. Philippe J. Buteri de Préville,
                hereinafter referred to as "<b>IICC</b>",
            </p>
            <p><u>On one hand</u>,</p>
            <h4><u>AND</u></h4>
            <p>2 - "<b>{{ $user->name }}</b>" real estate agency, company incorporated under Australian law, ABN {{ $user->userinfos->orga_abn }}, license {{ $user->userinfos->orga_license_number }}, headquartered at {{ $user->location->locality?$user->location->locality:'' }}, {{ $user->location->area_level_1?$user->location->area_level_1:'' }} {{ $user->location->postalCode?$user->location->postalCode:'' }}, {{ $user->location->country?App\Models\Country::where('code',$user->location->country)->first()->content:'' }},
                duly represented herein by its current manager authorized to bind the company,
                hereinafter referred to as "<b>AFA</b>" or "<b>the AFA</b>".
            </p>
            <p><u>On the other hand</u>,</p>
            <p><b>The following partnership contract has been agreed.</b></p>
            <p class="pdf-align-center"><b><u>RECITALS</u></b></p>
            <p>Given that IEA system is organized and designed to facilitate the purchase in Australia of residential, land, industrial or commercial properties by non-resident French speaking foreign investors registered as "Members" on IEA portal <b>https://investirenaustralie.com</b> managed by IICC Sarl company, by presenting them on this internet portal with Australian properties, allowing them to be assisted by an "Agence Partenaire Locale" (APL) near their home, to select those of these properties that might interest them, to communicate anonymously with the "Agences Francophones Australiennes" (AFA) in whose jurisdiction the selected properties are located, eventually to make a purchase decision and initiate the corresponding purchase procedure on the internet by empowering IICC to reveal their identity and to transmit their file to the seller of the property and to the AFA that the Member will have selected for conducting the purchase operations;</p>
            <p>Given that the IEA system commits itself to its Members to offer them the most complete service possible in French;</p>
            <p>Given that the intervention of IICC above falls within its corporate purpose;</p>
            <p>Given that LIA, an Australian real estate agency with all the regulatory approvals to operate in Queensland, and possibly in the other Australian Commonwealth States, acts as an essential part in the above process in its capacity to supply IEA portal with Australian properties for sale, to facilitate the transaction process, and to respond to any difficulty that may arise, and that, as such, it intervenes "in conjunction" with the AFA in the purchase of properties;</p>
            <p>Given that the AFA has a Francophone capacity, that it is a regularly registered real estate agency, that it has a proven experience in the international sale of real estate, and that, by virtue of the collaborative philosophy of business it displays, it asserts its wish to join IEA system as an AFA and have the opportunity to be appointed by IEA portal Members as a real estate agency responsible for legal, financial and material purchasing operations, with the assistance of LIA as a vital part of the clientele introduction;</p>
            <p>Noting that the parties hereto affirm their concern and their intention to apply the provisions of this contract with the utmost good faith in a spirit of collaboration, loyalty and frankness for the benefit of each and for the greater prosperity of their partnership;</p>
            <p>The above recitals are an integral part of this contract.</p>
            <p class="pdf-align-center"><b><u>Section 1 - Object</u></b></p>
            <p>The purpose of this contract is to define the terms and conditions of the business partnership relationships between the parties, in which {{ $user->name }} acts as an AFA.</p>
            <p>All the provisions of this contract apply to {{$user->name}}.</p>
            <p>IEA system and IEA portal are equally called "IEA".</p>
            <p class="pdf-align-center"><b><u>Section 2 - IEA / AFA partnership operation</u></b></p>
            <h5><u>2.1 - IEA portal membership</u></h5>
            <p>Any visitor has access to the entire IEA portal without restriction by using the search functions if they wish. If the visitor wishes to interact with the portal, they are asked to register as a Member. This will be particularly the case if they wish to contact an APL, an AFA, or initiate a purchasing process.</p>
            <h5><u>2.2 - Content of the IEA portal</u></h5>
            <p>LIA is the real estate agency responsible for finding Australian residential, land, industrial and commercial properties offered for sale by their Australian owners. These properties are presented by their sellers to LIA who will forward them to IEA portal for display and promotion. The purpose of IEA portal is to present these properties to non-resident foreign persons or organizations established outside Australia.</p>
            <p>The functionalities of IEA portal allow any Member interested in a property, without it being obligatory:</p>
            <p>- to register with an APL who will be responsible for informing and assisting them in their choices and the use of the portal;</p>
            <p>- to contact an AFA anonymously for obtaining additional information and negotiating the transaction with the seller.</p>
            <p>IEA portal, with its own features, develops a comprehensive strategy of communication and SEO on the internet to upload and display Australian residential, estate, industrial and commercial properties presented for sale by their Australian sellers, to register visitors as Members, to provide them with information on the legal and economic aspects of the Australian real estate market, to interest them in the properties displayed, to provide them with assistance, to propose them an Australian Francophone Agency for the conduct and completion of the purchase transaction, to pay them a return travel package from their residence territory to Australia in the event of a definitive purchase of a property through IEA portal, and to offer them a series of contacts to francophone Australian specialists whose services they might possibly need.</p>
            <p>The whole above strategy implemented by IEA leading to the introduction of clients likely to make investment decisions, and without which no sales would take place, is the sum of numerous marketing expenses which, in case of an actual sale, must be remunerated in the form of a "Commission de Présentation de Clientèle" - CPC (Clientele Introductory Commission).</p>
            <h5><u>2.3 - Sales process</u></h5>
            <p>When he has made a purchase decision, the Member commits to the transaction and signs an official search for properties mandate for the benefit of the AFA.</p>
            <p>To secure the operation, the AFA signs a "Conjunction Agreement" for the benefit of LIA. This document will only be used in the event of failure of the AFA to pay the CPC due to IICC.</p>
            <p>A procedure is then put in place by IEA and the AFA for the signing of an "Expression Of Interest" (EOI) in order to confirm the availability of the property, its withdrawal from the market and its reservation in the name of the purchasing Member.</p>
            <p>As soon as this confirmation of the withdrawal from the market and the effective reservation of the property by the seller, IEA lifts the anonymity of the buying Member and sends the AFA and the seller the elements of his file necessary for the drafting of the contract and the conclusion of the sale.</p>
            <p>The withdrawal from the market and the effective reservation of the property in the name of the buying Member confirmed by the EOI and the payment of the corresponding "Holding Deposit" make the sales contract legally perfect and, except in the case of withdrawal during the "Cooling- Off" period, it definitively binds the seller and the buyer.</p>
            <p>Upon signing the contract, the Member pays a deposit which, added to the initial Holding deposit, must not exceed 10% of the sale price, excluding registration taxes and fees due to the Foreign Investment Review Board.</p>
            <p class="pdf-align-center"><b><u>Section 3 - Commissions</u></b></p>
            <p>When registering their property, the Seller specifies the percentage or the fixed monetary amount of the commission on the sale that he undertakes to pay to the AFA.</p>
            <p>As soon as the entire marketing process summarized in the 3rd paragraph of 2.2 above has resulted in the signing of the sales contract which has become final, the task of the IEA portal is completed and the entire CPC is due to it. IICC issues an invoice for the amount of CPC due to be charged to AFA. However, this invoice specifies that it can only be honored when the amount of the sales commission, or its fractional amounts have been received by the AFA and they are legally available.</p>
            <p>After having received the sales commission the AFA pays back FIFTY PERCENT (50%) of its amount excluding taxes to IICC as CPC. This same percentage applies to the amount excluding tax of any sales bonuses granted by the Seller.</p>
            <p class="pdf-align-center"><b><u>Section 4 - Payement of commissions</u></b></p>
            <p>The AFA pays IICC the part of any commissions and bonuses due to it under the terms of article 3 above.</p>
            <p>This repayment is made within FIFTEEN DAYS (15 days) following receipt by the AFA of the amount (s) of the sales commission and the amount of any bonuses.</p>
            <p>Refunds to IICC of commissions and bonuses will be made by the AFA on presentation of the corresponding invoices issued by IICC, to IICC's foreign bank account indicated in the invoices.</p>

            <p class="pdf-align-center"><b><u>Section 5 - Obligations of the parties</u></b></p>
            <h5><u>5.1 - Obligation of result for IICC Sarl</u></h5>
            <p>The right of IICC Sarl to receive the CPC is expressly subordinated to the signing of the sales contract which has become final after expiry of the legal withdrawal period and signature of the contract which has become "unconditional".</p>
            <h5><u>5.2 - Exclusivity charged to AFA</u></h5>
            <p>The AFA as a company, and its partners individually signatories of this contract, undertake to respect the exclusivity granted to the IEA system, not to enter into similar partnership agreements or having the same purpose as this contract with, or not to engage, directly or indirectly, in other companies having the same purpose throughout the duration of this contract and during the three years following its termination.</p>
            <p>This principle of exclusivity does not in any way prevent AFA from dealing separately from this contract with matters that come to it through channels other than those of the IEA system.</p>
            <p>Any sales file not falling within the scope defined by this contract or derogating from it may be the subject of a special agreement between the parties.</p>
            <h5><u>5.3 - AFA's additional commitments</u></h5>
            <p>In accordance with the fundamental principles of IEA project, the AFA undertakes to provide IEA portal Members with an integral service in French, both in the phase of the search for properties and in the phase of the complete realization of a sale. This service in French is a sine qua non condition for the application of this contract. The termination of the provision of this service in French by L'AFA for any reason whatsoever may result in unilateral, discretionary, immediate and without compensation termination of this contract by the other party. If the termination of this service in French is only temporary, the application of the contract may be suspended for the duration of this interruption to the decision of IEA.</p>
            <p>The AFA irrevocably undertakes to carry through to a successful conclusion any sales to IEA portal Members regarding residential, land, industrial or commercial property published on IEA portal and located in its perimeter of intervention, which implies:</p>           
            <p>- to inform the Members who request it during their search for property, according to the professional standards in force and under the conditions of anonymity imposed by IEA portal;</p>
            <p>- in the event of a purchase decision by a Member, to proceed with material, financial and legal sales operations, with or without the intervention of a solicitor representing the Member's interests;</p>
            <p>- obligation, if necessary, to cash the sums paid by the Member in the trust account of the agency.</p>
            <p>The AFA irrevocably agrees to pay to LIA and IICC Sarl the commission amounts due to them within the time limits set in article 4 above from their collection and their legal availability.</p>
            <h5><u>5.4 - AFA's extended commitments</u></h5>
            <p>Given the mobilization of the IEA portal's resources towards its Members resulting in the introduction to the AFA of an IEA portal Member intending to acquire a property in Australia, the AFA is bound by the same obligations and in the same terms of payment of CPC to IICC, whether the sale to this portal Member concerns a property displayed on the portal or a property not displayed on the portal, belonging to the AFA's own portfolio or a property which the AFA would have offered to the Member or shown the Member during a stay in Australia.</p>
            <h5><u>5.5 - Special provisions relating to the case of "Seller By AFA"</u></h5>
            <p>The AFA is authorized to register itself properties on IEA portal as a "Seller By AFA". The AFA must make a separate "Seller By AFA" subscription for each new property. Each subscription by the AFA as a "Seller By AFA" can only relate to the sale of a single property. The AFA's subscription as a "Seller By AFA" can only be accepted on condition that the AFA certifies that:</p>
            <p>- the AFA has verified that the seller of the property the AFA wants to publish is the legal owner of the said property and has the right to sell it;</p>
            <p>- the AFA has a selling mandate from the owner-seller for the sale of the property the AFA publishes on the portal;</p>
            <p>- the AFA has explained to the owner-seller IEA portal process regarding "Seller by AFA" and its consequences and has the owner-seller's autorisation to register them on the portal in a "Seller by AFA" subscription and to publish their property on the portal;</p>
            <p>- the AFA accepts without restriction all the legal and financial consequences of those registrations and publication and exonerates IEA portal and the persons and entities directly linked to the portal from any liability relating to these registrations and publications.</p>
            <p class="pdf-align-center"><b><u>Section 6 - AFA's perimeter of intervention</u></b></p>
            <p>The AFA's perimeter of intervention is the area in which the agency undertakes to intervene for the benefit of IEA portal Members.</p>
            <h3 class="pdf-align-center"><b><u>Section 7 - Duration - Modification - Termination - Renewal</u></b></h3>
            <p>This contract is concluded for a period of THREE YEARS (3 years) from the date of its signature. It comes into effect as soon as it is signed.</p>
            <p>It can be modified by simple amendment taken in the same forms as the original contract.</p>
            <p>It is renewable in the same terms by tacit agreement at its expiry, except termination by mail with acknowledgment of receipt or by email with acknowledgment of reading at least THREE MONTHS (3 months) before its term.</p>
            <p>Either party may terminate it at any time by mail with acknowledgment of receipt or by email with acknowledgment of reading with THREE MONTHS (3 months) notice. However, it cannot be denounced before a period of THREE MONTHS (3 months) following its signature or renewal.</p>
            <p class="pdf-align-center"><b><u>Section 8 - Penalties - Penalty clause</u></b></p>
            <p>In the event of a flagrant breach of the obligations of exclusivity or client misappropriation by either party, the injured party will be entitled to payment by the party at fault of the amount that it should have received if the transaction was conducted in accordance with the reciprocal obligations, plus a penalty of the same amount.</p>
            <p>In case of dispute, the parties will seek an amicable agreement.</p>
            <p>In the event of persistent disagreement after ONE MONTH (1 month), each party shall be entitled to appeal to the City Court of Gold Coast, which alone has jurisdiction in first instance.</p>
            <p>If the injured party is an entity that is part of the IEA system, "L'Immobilière Australienne Pty Ltd" company will legally represent "International Internet Commerce & Consulting" SARL company and will be entitled to sue the AFA in Gold Coast court for all of the above indemnities and penalties.</p>
            <p>To serve and assert what is right</p>
            
            <table class="table table-bordered">
                <tr>
                    <td class="list-center">{{ $user->name }}</td>
                    <td colspan="2" class="list-center-colspan">"Investir en Australie" system</td>
                </tr>
                <tr>
                    <td class="table-row col-p-t"><p>Date : _ _ _ _ _ _ _ _ _ _ _ _ _ _ _</p></td>
                    <td class="table-row">Date : _ _ _ _ _ _ _ _ _ _ _ _ _ _ _<p><img src="{{asset('images/ico/lia.jpg')}}" alt="lia">  L'immobilière Australienne Pty Ltd</p><p class="table-row-footer">The Director<br/>Philippe J.Buteri de Préville</p></td>
                    <td class="table-row">Date : _ _ _ _ _ _ _ _ _ _ _ _ _ _ _<p><img src="{{asset('images/ico/iicc.jpg')}}" alt="iicc">  International Internet Commerce & Consulting Sarl</p><p class="table-row-footer">Le gérant<br/>Philippe J.Buteri de Préville</p></td>
                </tr>
            </table>

            <p class="pdf-align-center"><I>(to precede the signature by the handwritten mention "read and approved, good for agreement")</I></p>

        </div>
    </section>
  </body>
</html>