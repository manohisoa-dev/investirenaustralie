<!-- pdf.blade.php -->

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>CONTRAT DE PARTENARIAT APL</title>
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
      
      .pdf-text-align-center{
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
          <h3>CONTRAT DE PARTENARIAT AGENCE PARTENAIRE LOCALE</h3>
          <h4>({{ $user->userinfos->orga_name }})</h4>
        </div>

        <div class="pdf-content-p1">
            <h4><u>ENTRE</u></h4>
            <p>1 - Le système "<b>Investir en Australie</b>" ("IEA") est constitué de:</p>
            <p>- L'agence immobilière "<b>L'IMMOBILIERE AUSTRALIENNE Pty Ltd</b>" société de droit australien, ABN 34 632 675 113, dont le siège est sis 3/8 Petrie Terrace, Brisbane, QLD 4000, Australie,
              dûment représentée aux présentes par son directeur en exercice, Monsieur Philippe J. Buteri de Préville, ci-après dénommée "<b><u>LIA</u></b>",
            </p>
            <p>et de : </p>
            <p>- La société "<b>INTERNATIONAL INTERNET COMMERCE & CONSULTING Sarl</b>", à l'enseigne "<b>IICC Sarl</b>", société de droit français, Ridet 1 236 165.002, enregistré au Registre du Commerce et des Sociétés de Nouméa, Nouvelle Calédonie sous le numéro du RCS 1 236 165, dont le siège social est sis 4 rue Jules Courtot, Val Plaisance, Nouméa, Nouvelle Caledone,
              dûment représentée aux présentes par son gérant en exercice, Monsieur Philippe J. Buteri de Préville, ci-après dénommée "<b>IICC</b>",
            </p>
            <p><u>D'une part</u>,</p>
            <h4><u>ET</u></h4>
            <p>2 - l'agence immobilière "<b>{{ $user->userinfos->orga_name }}</b>" <br/>
                société de droit {{ trans('app.txt.'.$user->userinfos->orga_type) }}<br/>
                N° Repertoire des entreprises : {{ $user->userinfos->orga_license_number }}<br/>
                N° Registre du Commerce et des Société : {{ $user->userinfos?$user->userinfos->orga_registration_number:'' }}<br/>
                Adresse du siège social : {{ $user->location->area_level_1?$user->location->area_level_1:'' }} {{ $user->location->locality ? $user->location->locality : '' }} {{ $user->location->route ? $user->location->route : '' }}  {{ $user->location->postalCode?$user->location->postalCode:'' }}, {{ $user->location->country?App\Models\Country::where('code',$user->location->country)->first()->content:'' }}<br/>
                dûment représentée aux présentes par {{ $user->userinfos->contact_name }}<br/>
                ci-après dénommée "<b>l'APL</b>" ou "<b>APL</b>".
            </p>
            <p><u>D'autre part</u>,</p>
            <p><b>Il a été convenu le contrat de partenariat d'Agence Partenaire Locale qui suit.</b></p>
            <p class="pdf-align-center"><b><u>PREAMBULE</u></b></p>
            <p>Considérant qu'IICC gère le portail immobilier et d'affaires <b>https://investirenaustralie.com</b> dont l'objet est de:</p>
            <p>-	sélectionner et présenter en français aux internautes francophones des produits résidentiels, fonciers, industriels et commerciaux australiens;</p>
            <p>-	mettre en relation les internautes acheteurs potentiels francophones et des "Agences Francophones Australiennes" (AFA) chargées des opérations de vente dans le but de parvenir à la vente effective de ces produits;</p>
            <p>-	percevoir des AFA pour l'ensemble de ces services une rémunération sous forme de "Commission de Présentation de Clientèle" (<b>CPC</b>);</p>
            <p>Considérant que LIA contribue de manière significative au fonctionnement global du système IEA en démarchant les vendeurs australiens et en les convainquant de publier leurs biens sur le portail IEA, ainsi qu'en sécurisant les relations du système IEA avec les vendeurs et les Agences Francophones Australiennes lors des transactions, et que l'ensemble des services qu'elle fournit doivent recevoir rémunération dans le processus de la vente effective de biens;</p>
            <p>Considérant que l'agence {{ $user->name }}, qui dispose d'une implantation et d'une clientèle établie à {{ $user->location->locality?$user->location->locality:'' }}, {{ $user->location->country?App\Models\Country::where('code',$user->location->country)->first()->content:'' }} souhaite, contre perception de "Commissions de Contribution aux Ventes" - CCV - , élargir son activité et prendre part au développement d'IICC sur le marché australien en assistant les Membres inscrits sur le portail IEA et en mobilisant la clientèle à laquelle elle a accès localement.</p>
            <p>Considérant que, pour la sécurité et la pérennisation du présent contrat, il convient d'envisager que les entités juridiques ci-dessus constituant le système IEA pourraient à l'avenir évoluer ou être remplacées par d'autres entités;</p>
            <p>Le préambule fait partie intégrante du contrat.</p>
            <p class="pdf-align-center"><b><u>Article 1 – Nature de l'accord</u></b></p>
            <p>Par le présent contrat de partenariat le système IEA attribue à l'APL une Mission d'Information, d'Orientation et de Promotion du portail IEA et des biens qui y sont publiés.</p>
            <p>Le contrat continuera à s'appliquer entre l'AFA et le système IEA même après évolution des entités constituant le système IEA ou leur remplacement par de nouvelles entités.</p>
            <p class="pdf-align-center"><b><u>Article 2 - Mission de l'Agence Partenaire Locale</u></b></p>
            <p>La Mission d'Information, d'Orientation et de Promotion (MIOP) couvre les champs suivants:</p>
            <h5>- Information des Membres</h5>
            <p>-  accueillir les personnes éventuellement intéressées par un investissement immobilier résidentiel, foncier, industriel ou commercial en Australie;</p>
            <p>-  faire en sorte que ces personnes s'inscrivent en qualité de Membre de IEA si elles ne le sont déjà, et qu'elles établissent une relation exclusive avec l'APL;</p>
            <p>-  les renseigner, leur expliquer les principes de fonctionnement du système IEA, leur présenter les produits et programmes du portail IEA, leur expliquer succinctement les règles applicables à l'investissement étranger en Australie, et en particulier qu'en principe, en matière résidentielle, il ne leur est possible d'acquérir, sauf rares exceptions, que de l'immobilier neuf.</p>
            <h5>- Orientation des Membres:</h5>
            <p>-  les guider dans leurs recherches et dans leurs choix;</p>
            <p>-	leur suggérer des schémas d'investissement en fonction des raisons qui les poussent à envisager un investissement en Australie;</p>
            <p>-	leur conseiller de parcourir les offres du portail IEA afin d'y faire une sélection des produits qui correspondent le mieux à leurs attentes.</p>
            <h5>- Promotion:</h5>
            <p>-	Participer à l'accroissement de l'audience du portail par l'optimisation de son référencement organique ou naturel auprès des moteurs de recherche;</p>
            <p>-	Jouer un rôle actif dans le développement d'un courant d'affaires vers l'Australie par le développement d'une démarche marketing en exploitant sa propre base de données afin de cibler des segments identifiés de clientèle, lancer ses campagnes marketing et promouvoir des types particuliers de biens.</p>
            <p class="pdf-align-center"><b><u>Article 3 - Limitation de compétences de l'APL</u></b></p>
            <p>L'engagement des deux parties l'une à l'égard de l'autre est subordonné, au regard de la situation d'un client de l'APL, au fait que ce client est, d'une part Membre inscrit sur le portail IEA, et d'autre part en liaison exclusive active avec l'APL.</p>
            <p>La règlementation australienne réserve expressément aux agences immobilières australiennes le droit de traiter les transactions immobilières des biens situés sur le sol australien. Les agences immobilières étrangères n'ont aucune compétence en matière de vente de biens immobiliers australiens. En conséquence, en ce qui concerne les biens publiés sur le portail IEA, l'APL ne dispose que d'un droit de présentation précisé à l'article suivant.</p>
            <p>Le service procuré par l'APL étant rémunéré par l'attribution d'une "Commission de Contribution aux Ventes" - CCV payée par le système IEA, il est fait interdiction à l'APL de demander quelque contribution que ce soit de la part des Membres, en relation avec des biens du portail IEA.</p>
            <p>L'APL ne s'acquittant que d'un rôle d'intermédiaire et de relais entre le système IEA et ses propres clients locaux, d'accueil, de présentation des produits et programmes du portail IEA, d'information et d'accompagnement des personnes qui se présentent à elle, en aucune circonstance l'APL ne peut prendre d'engagement qui engagerait sa propre responsabilité ou celle du système IEA à l'égard de sa propre clientèle locale.</p>
            <p class="pdf-align-center"><b><u>Article 4 - Respect de la réglementation immobilière</u></b></p>
            <p>L'enregistrement par les Vendeurs australiens des biens qu'ils souhaitent proposer à la communauté francophone internationale sur le portail IEA s'accompagne d'un mandat de vente délivré à l'agence immobilière australienne LIA faisant partie du système IEA. Ce mandat de vente précise en particulier que l'agence LIA est autorisée à subdéléguer la présentation de ces biens à des agences étrangères. Ceci constitue le droit permanent pour l'APL de se prévaloir légalement d'une autorisation par le Vendeur de présenter à sa propre clientèle locale les biens publiés sur le portail IEA.</p>
            <p>L'APL s'assure et garantit au système IEA qu'elle est en permanence titulaire de la carte professionnelle correspondant à l'activité d'agence immobilière ou d'affaires et constamment en conformité avec ses obligations réglementaires.</p>
            <p class="pdf-align-center"><b><u>Article 5 - Sécurisation du marché et promotion de l'activité du portail</u></b></p>
            <h5><u>5.1 - Sécurisation du marché de l'APL</u></h5>
            <p>Les Membres inscrits sur le portail IEA peuvent librement décider de s'engager dans une relation avec une l'APL. Cette relation est subordonnée à des règles d'exclusivité.</p>
            <p>Afin de sécuriser le marché de l'APL:</p>
            <p>-	L'APL dispose d'un compte dans lequel elle a accès à son profil modifiable et à des informations concernant les Membres qui lui sont rattachés par relation exclusive, à l'historique des opérations réalisées et aux opérations en cours.</p>
            <p>-	L'APL est tenue informée par message automatique de l'établissement de toute nouvelle relation exclusive avec des Membres, ainsi que des principales étapes des ventes en cours.</p>
            <p>-	Un Membre ne peut s'engager dans une relation exclusive avec plus d'une APL à la fois. Cette relation exclusive est enregistrée dans la base de données du portail IEA.</p>
            <p>-	Cette relation exclusive est établie pour une durée nominale de Cent Quatre-Vingt jours (180 jours). Elle n'est pas renouvelable par tacite reconduction. Elle peut cependant, à tout moment au cours de sa validité, être réinitialisée par le Membre pour une durée identique de 180 jours entre le même Membre et la même APL.</p>
            <p>-	L'APL est informée à l'avance par message automatique de la fin de la relation exclusive avec un Membre.</p>
            <p>-	L'APL peut communiquer avec les Membres qui lui sont rattachés par une relation exclusive au travers de la messagerie interne du portail.</p>
            <p>-	Le paiement de la CCV est automatiquement programmé dès qu'IICC a perçu sa CPC.</p>
            <p>-	IICC Sarl paiera la CCV, sans recours possible, à l'agence titulaire du contrat d'exclusivité avec le Membre acheteur à la date de l'achat.</p>
            <h5><u>5.2 - Sécurisation de la relation d'affaires entre IEA et APL</u></h5>
            <p>Le présent contrat d'APL est exclusif. Toute agence s'engageant dans une relation d'APL avec IEA s'interdit:</p>
            <p>-	De détourner la clientèle des Membres du portail IEA de quelque manière que ce soit qui aurait pour effet de priver son gestionnaire IICC de sa légitime rémunération.
              <br/>L'APL accepte par principe, sans qu'il puisse y être dérogé, qu'en cas de telle manœuvre elle devrait à IICC le montant de la CPC qui aurait été due, ainsi qu'une pénalité du même montant, le tout sans préjudice des indemnités qui pourraient être prononcées par la juridiction judiciaire compétente. Elle reconnaît et accepte également qu'elle s'exposerait à sa radiation pure et simple du portail IEA, à la discrétion du gestionnaire du portail et sans indemnité aucune.
            </p>
            <p>-	De déroger aux engagements pris dans lors de son inscription, aux Conditions Générales d'Utilisation du Portail IEA, aux conditions particulières relatives aux APL et aux dispositions du présent contrat.</p>
            <p>-	Directement ou indirectement, autrement qu'au travers du partenariat exclusif avec IEA, de participer à toute négociation ou transaction entrant dans le cadre de l'activité développée par IEA sur le marché australien durant toute la durée de sa relation avec IEA et pendant l'année calendaire suivant la cessation de cette relation pour quelque cause que ce soit;</p>
            <p>-	Directement ou indirectement, de s'engager avec tout autre personne, organisation ou portail internet dans une relation comparable poursuivant des objectifs identiques ou similaires durant toute la durée de sa relation avec IEA et pendant l'année calendaire suivant la cessation de cette relation pour quelque cause que ce soit;</p>
            <p>-	Directement ou indirectement, de créer ou de participer à la création, pendant toute la durée de la relation avec IEA et pendant l'année calendaire suivant la cessation de cette relation pour quelque cause que ce soit, de quelque portail internet que ce soit, comparable, poursuivant des objectifs identiques ou similaires à ceux du portail IEA concernant le marché australien.</p>
            <p>-	De s'abstenir de diffuser ou d'alimenter, directement ou indirectement, durant toute la durée de sa relation avec IEA, toute critique non sérieusement fondée et justifiée qui serait de nature à porter préjudice à la notoriété ou à la réputation du portail IEA auprès du public, ou d'affecter son référencement auprès des moteurs de recherche sur internet.</p>
            <p>Sauf le non-respect de la part de l'APL des Termes et Conditions d'Utilisation du portail, des conditions particulières relatives aux APL et des dispositions du présent contrat, ou toute cause grave, réelle et sérieuse rendant impossible la poursuite de leur partenariat, ou l'application des dispositions de l'article 4 - "Durée" ci-dessous, le portail IEA et son gestionnaire s'interdisent de mettre unilatéralement un terme au contrat avec une APL.</p>
            <h5><u>5.3 - Promotion du portail IEA</u></h5>
            <p>Afin d'accroître l'audience du portail IEA par l'optimisation de son référencement organique ou naturel auprès des moteurs de recherche dans l'intérêt de tous les partenaires, l'APL s'engage à positionner et à maintenir sur son site professionnel un mot clé en <b>caractères gras</b> et un rétrolien ancré vers le portail <b>https://investirenaustralie.com</b>, du type:</p>
            <p class="pdf-text-align-center"><I>"Si <b>investir en Australie</b> vous intéresse, suivre ce lien: <a href="{{route('home')}}">Investir En Australie</a>"</I></p>
            <p>L'APL pourra, sur demande, recevoir des éléments graphiques et des objets et signes promotionnels du portail IEA.</p>
            <p class="pdf-align-center"><b><u>Article 6 - Rémunération de l'APL</u></b></p>
            <p>L'APL perçoit une CCV uniquement en cas de vente aboutie d'un bien affiché sur le portail IEA. Cette CCV est égale à un pourcentage du montant net de CPC effectivement encaissé par IICC après rémunération forfaitaire de l'ensemble des services fournis par l'agence australienne LIA.</p>
            <p>La CCV est payée par IICC à 30 jours fin de mois après encaissement de la CPC par IICC.</p>
            <p>Pour la détermination de l'existence d'une relation exclusive du Membre acheteur avec l'APL à la date de l'achat, la date à prendre en compte est celle à laquelle la vente est parfaite, c'est-à-dire, au-delà de la date à laquelle l'acheteur a pris la décision personnelle d'acheter, la date à laquelle IEA reçoit le document "Expression Of Interest" signée du Vendeur qui est la confirmation officielle que l'acheteur a demandé à acheter ce bien, que le Vendeur a accepté de le lui vendre, et que le bien considéré est retiré du marché et réservé au nom du Membre acheteur.</p>
            <p>Pour la computation du délai de paiement à 30 jours fin de mois de la CCV à l'APL, la date de départ à prendre en compte est celle à laquelle est enregistré dans les comptes bancaires d'IICC la réception effective du montant de la CPC ou, lorsque ce paiement est échelonné, la réception effective de chaque montant partiel de la CPC.</p>
            <p>En tout état de cause, la CCV n'est pas due si le Membre acheteur a fait valoir son droit de rétractation dans les délais prévus par la loi australienne ("cool-off period").</p>
            <p>L'assiette de calcul de la CCV exprimée en Dollars Australiens (AUD) est le montant net de la CPC encaissée par IICC, c'est-à-dire après déduction de la rémunération due à l'agence australienne LIA. Cette rémunération forfaitaire des services fournis par LIA est égale à 20% du montant brut de la CPC encaissée par IICC. Ainsi, le montant net de la CPC est donné par la formule :</p>
            <p>CPC nette = CPC brute x 80%.</p>
            <p>La CCV due à l'APL est calculée en appliquant un "taux de CCV" sur la CPC nette.</p>
            <p>Le taux de CCV applicable lors d'une année est variable en fonction du chiffre d'affaires des ventes auxquelles l'APL a contribué au cours de l'année calendaire précédente. Il existe 3 taux:</p>
            <p>
              -	Taux Normal : 40%<br>
              -	Taux Intermédiaire : 50%<br>
              -	Taux Supérieur : 60%
            </p>
            <p>L'année de son inscription, quelle que soit la date de son inscription, l'APL est exceptionnellement au taux Intermédiaire pour les ventes auxquelles elle contribue au cours de cette première année calendaire. Pour les années calendaires suivantes:</p>
            <p>-	Si au cours d'une année calendaire l'APL a généré un chiffre d'affaires inférieur au seuil Normal (2,5 millions AUD), c'est le taux Normal qui s'applique aux transactions de l'année calendaire suivante;</p>
            <p>-	si au cours d'une année calendaire l'APL a généré un chiffre d'affaires supérieur au seuil Normal (2,5 millions AUD) et inférieur au seuil Supérieur (25 millions AUD), c'est le taux Intermédiaire qui s'applique aux transactions de l'année calendaire suivante;</p>
            <p>-	Si au cours d'une année calendaire l'APL a généré un chiffre d'affaires supérieur au seuil Supérieur (25 millions AUD), c'est le taux Supérieur qui s'applique aux transactions de l'année calendaire suivante.</p>
            <p>Le taux de la CCV est automatiquement révisé au 1er janvier de chaque année calendaire au vu des performances de l'APL au cours de l'année calendaire précédente.</p>
            <p class="pdf-align-center"><b><u>Article 7 - Durée</u></b></p>
            <p>Le présent contrat entre IICC et l'APL entre en vigueur dès sa signature. Sa signature emporte l'acceptation sans réserves des engagements pris dans lors de son inscription, des Conditions Générales d'Utilisation du Portail IEA, des conditions particulières relatives aux APL et des dispositions du présent contrat. Il est conclu pour une durée minimale de TROIS ANS (3 ans) renouvelable pour la même durée par tacite reconduction. Il peut également, soit ne pas être renouvelé à sa date anniversaire, soit être dénoncé à tout moment par chacune des parties pour quelque cause que ce soit, avec un préavis de TROIS MOIS (3 mois) par courrier recommandé avec accusé de réception ou par courrier électronique avec avis de réception.</p>
            <p class="pdf-align-center"><b><u>Article 8 - Litiges</u></b></p>
            <p>L'APL et le système IEA conviennent de faire tous les efforts nécessaires pour parvenir à un accord amiable en cas de survenance d'un litige entre eux.</p>
            <p>En cas de désaccord persistant après UN MOIS (1 mois), chaque partie aura le droit de faire trancher leur litige par les juridictions compétentes du ressort de la Cour d'Appel de Nouméa, Nouvelle Calédonie.</p>
            <p>Si la partie lésée est une entité faisant partie du système de l'IEA, la société "International Internet Commerce & Consulting" Sarl, ou toute autre société qui viendrait à lui succéder dans la gestion du portail IEA, représentera de droit la société "L'Immobilière Australienne Pty Ltd" et sera en droit de poursuivre l'APL devant les juridictions françaises pour toutes les indemnités et pénalités ci-dessus.</p>
            
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

            <p class="pdf-align-center"><I>(faire précéder la signature de la mention manuscrite: "lu et approuvé, bon pour accord")</I></p>

        </div>
    </section>
  </body>
</html>