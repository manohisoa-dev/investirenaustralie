<!-- pdf.blade.php -->

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>CONJUNCTION AGREEMENT</title>
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

      .pdf-content-p1 .table .list-rigth{
        width: 20%;
        padding-left: 10px;
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

    </style>
  </head>
  <body>
    {{-- Section 1 : CONUUCTION AGREEMENT --}}
    <section class="ca-section-1">
        <div class="pdf-header-p1">
          <h4>CONJUNCTION AGREEMENT</h4>
          <p>Between Listing Agent : {{ $user->afa->name }}</p>
          <p>And Sub-Agent : {{ $iea['name'] }}</p>
        </div>

        <div class="pdf-content-p1">
          <table class="table table-bordered">
            <tr>
              <td class="list-rigth">LISTING AGENT:</td>
              <td>
                <u>Company name</u>: {{ $user->afa->name }} - <u>ABN</u>: {{ $user->afa->userinfos()->first()->orga_abn }} <br>
                <u>Address</u>: {{ $user->afa->location->locality.' '.$user->afa->location->area_level_2.', '.$user->afa->location->area_level_1.' '.$user->afa->location->postalCode }} <br>
                <u>Phone</u>: {{ $user->afa->userinfos()?$user->afa->userinfos()->first()->orga_phone:'' }} - <u>Fax</u>: {{ $user->afa->userinfos()?$user->afa->userinfos()->first()->orga_fax:'' }} - <u>Email</u>: {{ $user->afa->userinfos()?$user->afa->userinfos()->first()->orga_email:'' }} <u>Licence N°</u>: {{ $user->afa->userinfos()?$user->afa->userinfos()->first()->orga_license_number:'' }} <br>
              </td>
            </tr>
    
            <tr>
              <td class="list-rigth">SUB-AGENT:</td>
              <td>
                <u>Company name</u>: {{ $iea['name'] }} - <u>ABN</u>: {{ $iea['abn'] }} <br>
                <u>Licence</u>: {{ $iea['license'] }} - <u>Expiry</u>: {{ $iea['licence_expire_date'] }} <br>
                <u>Address</u>: {{ $iea['address'] }} <br>
                <u>Mobile</u>: {{ $iea['mobile'] }} <br>
                <u>Email</u>: {{ $iea['email'] }} <br>
                <u>Director</u>: <br>
                {{ $iea['director'] }} <br>
                Licence No: {{ $iea['director_license'] }}  <u>Expiry</u>: {{ $iea['directore_licence_expire_date'] }}
              </td>
            </tr>
    
            <tr>
              <td class="list-rigth">BUYER</td>
              <td>{{ $user->name }} - IEA portal Member: {{ $user->immat }}</td>
            </tr>
    
            <tr>
              <td class="list-rigth">PROPERTY</td>
              <td>Any property the Buyer introduced to {{ $user->afa->name }} will want to buy.</td>
            </tr>
    
            <tr>
              <td class="list-rigth">SELLER</td>
              <td>Whichever seller the property the Buyer wants to purchase belongs to.</td>
            </tr>
    
            <tr>
              <td class="list-rigth">APPOINTMENT</td>
              <td>The Sub-Agent, through the "Investir en Australie" (IEA) system and internet portal, introduces the above qualified Buyer to the Listing Agent for the purchase of any property.
                Commencement of this agreement is as per the date of signing by the Listing Agent of this agreement</td>
            </tr>
    
            <tr>
              <td class="list-rigth">PERFORMANCE</td>
              <td>The Sub-Agent shall : <br>
                  - Utilise its own database and investirenaustralie.com portal to promote properties; <br>
                  - Facilitate communication between the interested buyer and the Listing Agent. <br>
                  Conditions, limitations and restrictions on the Performance of the Service include: <br>
                  - The Sub-Agent must comply with the disclosure requirements under any property occupations applicable regulations; <br>
                  - The Sub-Agent shall not engage in conduct that is misleading or is likely to mislead the buyer. The Sub-Agent must not engage in conduct that is, in all circumstances, unconscionable in relation to the prospective buyer; <br>
                  - This agreement can only be terminated by: <br>
                    i- 7 day notice in writing from the listing agent; <br>
                    ii- Mutual agreement in writting between the Listing Agent and the Sub-Agent; <br>
                    iii- Termination (including expiry) of the Agency Agreement between the Listing Agent and the Seller. <br>
              </td>
            </tr>
    
            <tr>
              <td class="list-rigth">COMMISSION</td>
              <td><b>Commission and Bonus</b> are payable where the Sub-Agent is deemed by the Listing Agent to be the effective cause of the sale as per attached Schedule To Conjunction Agreement.
                <b>Shares of Commission and Bonus</b>: as per attached Schedule To Conjunction Agreement.
                Payment of <b>Shares of Commission</b> and Bonus: as per attached Schedule To Conjunction Agreement. <br>
                The shares of commissions and bonuses are only due to the Sub-Agent if they have not been paid to IEA system as per attached Schedule To Conjunction Agreement.
                </td>
            </tr>
    
            <tr>
              <td class="list-rigth">SIGNATURES</td>
              <td>
                <b><u>Signature of (Listing Agent:   )</u></b><br>
                <p>Name : _______________________________</p> <br>
                <p>Signature : __________________________     <span style="margin-left:25px;">Date: ________________</span></p><br>
                <b><u>Signature of Sub-Agent</u></b><br>
                <p>Name : _______________________________</p> <br>
                <p>Signature : __________________________     <span style="margin-left:25px;">Date: ________________</span> </p><br>
              </td>
            </tr>

          </table>
        </div>
    </section>

    {{-- Section 2 : SHEDULE TO CONJUNCTION AGREEMENT --}}
    <section class="ca-section-2">
      <div class="pdf-header-p2">
        <h4>SHEDULE TO CONJUNCTION AGREEMENT</h4>
        <p>Between Listing Agent : {{ $user->afa->name }}</p>
        <p>And Sub-Agent : {{ $iea['name'] }}</p>
      </div>

      <div class="pdf-content-p2">
        <p>When the Sub-Agent is deemed by the Listing Agent to be the effective cause of the sale through IEA system clientele introduction, the Listing Agent will pay the Sub-Agent the below shares of all commissions and bonuses received from the seller.</p>
        <p>1) Amount of commissions and bonuses <br>
          The below shares of commissions and bonuses represent clientele introductory fees.</p>
          <p>a) Commissions <br>
            50% share of all sales commissions paid by the seller. The rate of those commissions is the rate agreed on by the seller when it comes to a sale to a foreign buyer.
          </p>
          <p>b) Bonuses <br>
            50% share of all bonuses the seller may possibly decide to grant to selling agents. The Listing Agent will keep the Sub-Agent informed of the amounts of those bonuses.
          </p>
        <p>2)	When payable <br>
          Commissions and bonuses are payable by the seller as follows :
        </p>
          <p>a) Commissions <br>
            -	50% upon the confirmation of an unconditional contract by the seller's solicitor; <br>
            -	50% upon settlement of the contract.
          </p>
          <p>b) Bonuses <br>
            Bonuses are entirely (100%) payable upon the confirmation of an unconditional contract by the seller's solicitor.
          </p>
          <p>c) Effective payment of the shares of commissions and bonuses between the Listing Agent and the Sub-Agent <br>
            The above shares of commissions and bonuses are in principle owed and directly payable by the Listing Agent to IEA system within 14 days of the Listing Agent receiving their payment by the seller. 
            Therefore, they are not due to the Sub-Agent in case of their effective payment to IEA system by the Listing Agent within that 14 day delay, <br>
            However, on the contrary, they are due to the Sub-Agent if their payment to IEA system has not occurred within the above 14 days. In such default in payment of the shares owed to IEA System, 
            which the Sub-Agent is part of, the Sub-Agent will be legally fully substituted to IEA system and will be entitled, after another 14 day delay, in accordance with the present Conjunction Agreement, 
            to issue an invoice to the Listing Agent for the payment to the Sub-Agent of those shares of commissions and bonuse. The same 14 day delay applies to the payment of that invoice.
          </p>
      </div>

      <div class="pdf-footer-p2">
        <table>
          <tr>
            <td>
              <b><u>Signature of {{ $user->afa->name }}</u></b><br>
              <p>Name : _____________________________</p> <br>
              <p>Signature : __________________________</p><br>
              <p>Date : __________________________</p><br>
            </td>
            <td>
              <b><u>Signature of {{ $iea['name'] }}</u></b><br>
              <p>Name : {{ $iea['director'] }}</p> <br>
              <p>Signature : __________________________</p><br>
              <p></p><br>
              <p></p><br>
            </td>
          </tr>
        </table>
      </div>
    </section>
    
  </body>
</html>