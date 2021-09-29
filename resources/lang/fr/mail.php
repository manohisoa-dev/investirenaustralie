<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Mailer Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during sending email for various
    | messages that we need to send to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'admin' => 'ADMIN',
    'apl' => 'APL',
    'afa' => 'AFA',
    'seller' => 'Vendeur',
    'member' => 'Acheteur',
    'customer' => 'Client',
    
    'id' => 'Identifiant',
    'login' => 'Login',
    'password' => 'Mot de passe',
    
    'btn.active' => 'Activer le compte',
    'btn.more' => 'Savoir Plus',
    'btn.invoice' => 'Télécharger la facture',
    'btn.view.user' => 'Voir :role',
    'btn.contact_admin' => 'Contacter Admin',
    'btn.login' => 'Se connecter',
    
    'default_password' => 'Votre mot de passe par défaut est &ldquo;<b>:password</b>&rdquo;<br />',
    'quantity' => 'Quantité :value',
    'amount' => 'Valeur :value',
    'tma' => 'TMA :value',
    
    'greeting' => 'Bonjour :Name',
    'thank' => "Merci d&lsquo;utiliser notre application.",
    
    'created.subject' => '[:app] Compte créé',
    'disabled.subject' => '[:app] Compte suspendu',
    'created.content.1' => "Quelqu&lsquo;un a créé un compte á cette adresse email.",
    'created.content.2' => "Veuillez confirmer votre inscription en cliquant le lien ci-dessous.",
    
    'activated.subject' => '[:app] Inscription confirmée',
    'activated.content' => 'Votre inscription a été bien confirmée.',
    'activated.collaborator.account.content' => 'Votre compte en tant que Collaborateur est activé.',
    
    'reseted.subject' => "[:app] Demande d&lsquo;un nouveau mot de passe",
    'reseted.content' => "Nous avons reçu une demande de réinitialisation de votre mot de passe. Si vous n&lsquo;avez pas fait la demande, ignorez simplement cet e-mail. Sinon, vous pouvez réinitialiser votre mot de passe en utilisant ce lien :",
    
    'subscribed.subject' => '[:app] Nouvelle inscription (:plan)',
    'subscribed.content' => "Quelqu'un a souscrit au \":plan\" (:count jours).",
    
    'disabled.subject' => '[:app] Compte suspendu',
    'disabled.content' => 'Votre compte a été suspendu.',
    
    'order.subject' => '[:app] :ROLE - Nouvelle commande',
    'order.content' => "Quelqu&lsquo;un a commandé un produit.",
    
    'payment.subject' => '[:app] :ROLE - Nouveau paiement',
    'payment.content' => "Quelqu&lsquo;un a payé un produit.",
    
    'registration.metatitle' => 'Vérification de compte',
    'registration.title' => 'Felicitation, votre inscription a été approuvé, voici les informations concernants votre compte',
    'registration.foot' => 'Veuillez suivre ce lien pour vous connecter.',
    'registration.clic_here' => 'Cliquez ici',

    'btn.reset.password' => 'Cliquez ici pour réinitialiser votre mot de passe',

    'document.sent' => 'Veuillez télécharger les documents ci-dessous.',
    'suspended.user.logged' => 'Un utilisateur suspendu vient de se connecter.',
    'suspended.user' => 'Nom d&lsquo;utilisateur: <b>&ldquo; :user &rdquo;</b>',
    'txt.contact_admin' => 'Pour la récupération de votre compte, Veuillez contacter l&lsquo;admin par l&lsquo;adresse e-mail <b>&ldquo; :mail &rdquo;</b>.',
    'activated.login.info' => 'Ci-dessous vos informations de connexion : <br /> - Login: <b> :login </b> <br /> - Password: <b> :password </b>',
    'txt.end_exclusive_relationship_with_member' => 'Fin de la relation exclusive avec le membre <b>&ldquo; :user &rdquo;</b>, matricule <b>&ldquo; :immat &rdquo;</b> dans :day jours.',
    'message_from_iea.subject' => '[:app] Message venant de IEA',
    'confirm.registration.message.member.1' => '<p>Bonjour,</p> <p class=&quot;p-10px-tb&quot;>Nous vous remercions de l&rsquo;envoi de votre formulaire d&rsquo;inscription sur le portail &quot;Investir en Australie&quot;.</p><p class=&quot;p-10px-tb&quot;>Merci de bien vouloir confirmer votre inscription en cliquant sur le lien ci-dessous.</p>',
    'confirm.registration.message.member.2' => '<p class=&quot;p-10px-tb&quot;>En cas de difficulté, veuillez copier le lien et le coller dans la barre d&rsquo;adresse de votre browser.</p> <p class=&quot;p-10px-tb&quot;>Dès que vous aurez cliqué sur le lien de confirmation d&rsquo;inscription ci-dessus nous enverrons à votre adresse électronique un courriel contenant vos divers identifiants et votre mot de passe généré par le système. Il vous sera demandé de remplacer ultérieurement ce mot de passe système par un mot de passe qui vous sera personnel.</p><p class=&quot;p-10px-tb&quot;>Dans l&rsquo;attente,</p><p class=&quot;p-10px-tb&quot;>Très cordiales salutations</p><p class=&quot;p-10px-tb&quot;>L&rsquo;équipe Investir en Australie</p>',
    'btn.confirm.registration'=>'Lien de confirmation inscription',
    'registration.confirmed.member'=>'<p class=&quot;p-10px-tb&quot;>Bonjour <b>:name</b>, </p><p class=&quot;p-10px-b&quot;>Nous vous souhaitons la bienvenue en qualité de Membre du portail &quot;Investir en Australie&quot;. Nous utiliserons le plus souvent l&rsquo;abréviation IEA pour désigner le système ou le portail &quot;Investir en Australie&quot;. Pour une première approche la rubrique &quot;Comment fonctionne le portail Investir en Australie&quot; de la page d&rsquo;accueil vous offre une vue synthétique des opérations que vous pouvez effectuer via le portail.</p><p class=&quot;p-10px-b&quot;>Vous avez à présent un compte de Membre du portail IEA. Nous vous communiquons et rappelons ci-dessous vos identifiants et mot de passe qui vous permettront de vous connecter au portail par l&rsquo;onglet &quot;Connexion&quot; en tête de page d&rsquo;accueil. Le mot de passe  qui vous est fourni est généré aléatoirement par le système. Il vous est recommandé de le remplacer par un mot de passe personnel et secret. Votre mot de passe personnel que vous enregistrerez devra être de 8 caractères au moins et comporter au moins 1 lettre minuscule, 1 lettre majuscule, 1 chiffre et 1 caractère spécial.</p><p class=&quot;p-10px-b&quot;>Vos identifiants et mot de passe sont les suivants :</p><p class=&quot;p-10px-b&quot;>- <b>Matricule : :immat</b><br/>- <b>Login : :login</b><br/>- <b>Adresse email : :email</b><br/>- <b>Mot de passe : :password</b><br/></p><p class=&quot;p-10px-b&quot;>Seuls l&rsquo;adresse email et le mot de passe seront nécessaires pour vous connecter en qualité de Membre, ce qui vous permettra d&rsquo;accéder à votre profil, à votre compte et à votre tableau de bord personnels par l&rsquo;onglet &quot;Compte&quot; dans la barre de menu.</p><p class=&quot;p-10px-b&quot;>Dans votre profil vous trouverez, au fil de votre pratique sur le portail, les différentes informations utiles, telles que vos situations d&rsquo;affiliation avec les &quot;Agences Partenaires Locales&quot; et les &quot;Agences Francophones Australiennes&quot;. Vous pourrez communiquer avec ces agences via la messagerie interne du portail :</p><p class=&quot;p-10px-tb&quot;>Les &quot;Agences Partenaires Locales&quot; (APL) </p><p class=&quot;p-10px-tb&quot;>Ce sont les agences qui sont chargées de conduire les dossiers de transaction immobilière en Australie. Au cours de sa recherche de biens il est possible au Membre de contacter diverses AFA pour obtenir des renseignements. Cependant, lorsqu&rsquo;il aura décidé d&rsquo;initier une opération d&rsquo;achat précise, il lui sera demandé de sélectionner une AFA particulière qui se verra alors confier la conduite de la transaction.</p><p class=&quot;p-10px-tb&quot;>Le recours à une AFA est entièrement gratuit pour le Membre.</p><p class=&quot;p-10px-tb&quot;>Les échanges avec les AFA sont protégés par l&rsquo;anonymat, ce qui emporte interdiction de communiquer des contacts emails ou téléphoniques. Cette règle est indispensable pour mettre le Membre à l&rsquo;abri des sollicitations inopportunes des agences. Si une partie enfreint cette règle, son message est automatiquement brouillé par le système. Cette règle de l&rsquo;anonymat est levée dès lors que le Membre a initié une opération d&rsquo;achat.</p><p class=&quot;p-10px-tb&quot;>Les transactions réalisées au travers du portail IEA ne donnent lieu à aucun versement de frais d&rsquo;intervention au portail IEA. Seuls sont à régler au vendeur ou à son avocat (solicitor) le prix d&rsquo;achat du bien, les taxes et frais publics liés à l&rsquo;achat, ainsi que les émoluments de votre propre solicitor. Nous vous engageons à parcourir les articles du blog du portail et notre &quot;{Guide de l&rsquo;Investisseur}&quot; qui vous vous apporteront les renseignements essentiels relatifs aux principaux aspects d&rsquo;un investissement de ce type.</p><p class=&quot;p-10px-tb&quot;>Lorsque vous aurez entamé une opération d&rsquo;achat, le portail vous apportera en tant que de besoin les contacts de professionnels francophones australiens dont les services vous seraient nécessaires ou utiles.</p><p class=&quot;p-10px-tb&quot;>Nous voulons vous remercier de la confiance que vous nous avez accordée en vous inscrivant comme Membre sur le portail IEA. Bien qu&rsquo;il soit encore très limité, il a vocation à couvrir l&rsquo;ensemble des huit Etats et Territoires de l&rsquo;Australie.</p><p class=&quot;p-10px-tb&quot;>Vous souhaitant bonne navigation et en formulant le vœu que vous trouviez un bien qui correspondra à votre attente.</p><p class=&quot;p-10px-tb&quot;>Avec nos plus cordiales salutations</p><p class=&quot;p-10px-tb text-right&quot;>L&rsquo;équipe &quot;Investir en Australie&quot;</p>',
];
