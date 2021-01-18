$(document).ready(function () {
    // Jscript section 3 home
    $('.sec-three button').click(function(){
        var val = $(this).val();
        var header = "";
        var body = "";
        var footer = "<button type='button' class='btn btn-default' data-dismiss='modal' aria-label='Close'>Fermer</button>";

        switch(val){
            case 'etape_1' : 
                header = "ETAPE 1";
                body = "Sans nécessité d'être inscrit comme Membre, vous pouvez parcourir l'ensemble des produits affichés sur le site. "+
                "Pour vous aider à rechercher les biens qui correspondent à vos attentes: vous sélectionnez dans la barre de menus l'objet de votre choix : immobilier ou business; "+
                "en fonction de votre choix précédent vous disposez d'un panneau qui vous propose différents critères de recherche. "+
                "Le site affiche alors le résultat de la recherche correspondant à vos critères dans la situation géographique sélectionnée.</br>"+
                "L'inscription en qualité de Membre n'est nécessaire que si vous souhaitez enregistrer vos critères de recherche, un produit particulier dans vos <b>Favoris</b>;"+
                "partager un produit avec des amis, contacter une <b>Agence Partenaire Locale</b> près de chez vous ou une <b>Agence Francophone Australienne</b> dans la zone du bien recherché, ou enfin lancer une procédure d'achat.";
            break; 

            case 'etape_2' : 
                header = "ETAPE 2";
                body = "Lorsqu'un bien vous intéresse, vous pouvez, après vous être inscrit comme Membre du site:"+
                "en cliquant <b>Liste des Agences Partenaires Locales</b>, vous rapprocher de l'APL près de chez vous qui pourra vous informer et vous conseiller;"+
                "en cliquant <b>Contacter l'Agence Francophone Australienne</b>, interroger l'AFA à proximité du bien sur lequel vous souhaitez obtenir des renseignements.";
            break; 

            case 'etape_3' : 
                header = "ETAPE 3";
                body = "Une fois que vous aurez obtenu les informations sur un produit particulier, si vous faites le choix d'acquérir ce bien il vous sera demandé de cliquer sur le bouton <b>Je voudrais acheter ce produit</b>. Cela déclenche la procédure d'achat.";
            break; 

            case 'etape_4' : 
                header = "ETAPE 4";
                body = "Après confirmation de la disponibilité du bien, de son retrait du marché et de sa réservation à votre nom, le dossier est transféré à l'AFA qui se chargera de l'accomplissement des formalités de transfert de propriété.</br>"+
                "Les délais de remise des clés dépendront selon que le bien est déjà construit et disponible, en cours de construction ou acheté sur plans.</br>"+
                "<b>Investir En Australie</b> vous suit et vous aide tout au long de la procédure en vous mettant en contact avec des professionnels francophones australiens en tant que de besoin.";
            break; 
        }

        return $('#secThreeModal .modal-content').html(
            '<div class="modal-header"><h3>'+header+'</h3></div>'+
            '<div class="modal-body">'+body+'</div>'+                
            '<div class="modal-footer">'+footer+'</div>');

    })
});