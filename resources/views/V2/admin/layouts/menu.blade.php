{{--    PROFILE BLOCK --}}
<li class="nav-header">
    <div class="dropdown profile-element">
        <img alt="image" class="rounded-circle" src="{{Auth::user()->imageUrl()}}" width="50"/>
        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
            <span class="block m-t-xs font-bold">{{ucfirst(Auth::user()->name)}}</span>
            <span class="text-muted text-xs block">{{ucfirst(Auth::user()->role)}}<b class="caret"></b></span>
        </a>
        <ul class="dropdown-menu animated fadeInRight m-t-xs">
            <li><a class="dropdown-item" href="profile.html">Profile</a></li>
            <li><a class="dropdown-item" href="contacts.html">Contacts</a></li>
            <li><a class="dropdown-item" href="mailbox.html">Mailbox</a></li>
            <li class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ route('logout') }}">{{__('app.logout')}}</a></li>
        </ul>
    </div>
    <div class="logo-element">
        IEA
    </div>
</li>

{{--    MENU LIST   --}}
<li class="active">
    <a href="layouts.html"><i class="fa fa-tachometer"></i> <span class="nav-label">Tableau de bord</span></a>
</li>
<li>
    <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Statistiques</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="graph_flot.html">Produits</a></li>
        <li><a href="graph_morris.html">Utilisateurs</a></li>
        <li><a href="graph_rickshaw.html">Membres</a></li>
        <li><a href="graph_chartjs.html">Agence Francophone Australienne</a></li>
        <li><a href="graph_chartist.html">Agence Partenaire Locale</a></li>
        <li><a href="c3.html">Vendeur</a></li>
        <li><a href="graph_peity.html">Carts</a></li>
    </ul>
</li>
<li>
    <a href="mailbox.html"><i class="fa fa-users"></i> <span class="nav-label">Parties prenantes </span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="mailbox.html">Tous</a></li>
        <li><a href="mail_detail.html">Admin</a></li>
        <li><a href="mail_compose.html">Vendeurs</a></li>
        <li><a href="email_template.html">AFA</a></li>
        <li><a href="email_template.html">APL</a></li>
        <li><a href="email_template.html">Membres</a></li>
    </ul>
</li>
<li>
    <a href="mailbox.html"><i class="fa fa-product-hunt"></i> <span class="nav-label">Produits </span><span class="label label-warning float-right">16/24</span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="mailbox.html">Liste des produits</a></li>
        <li><a href="mail_detail.html">Produits en attente</a></li>
        <li><a href="mail_compose.html">Produits publiés</a></li>
        <li><a href="email_template.html">Produits commandés</a></li>
        <li><a href="email_template.html">Produits vendus</a></li>
        <li><a href="email_template.html">Produits archivés</a></li>
        <li><a href="email_template.html">Produits aux corbeilles</a></li>
    </ul>
</li>
<li>
    <a href="mailbox.html"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Ventes </span><span class="label label-warning float-right">16/24</span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="mailbox.html">Toutes les ventes</a></li>
        <li><a href="mail_detail.html">Ventes en attente</a></li>
        <li><a href="mail_compose.html">Ventes en cours</a></li>
        <li><a href="email_template.html">Ventes: APL non payé</a></li>
        <li><a href="email_template.html">Ventes: APL payé</a></li>
        <li><a href="email_template.html">Ventes: AFA non payé</a></li>
        <li><a href="email_template.html">Ventes: AFA payé</a></li>
        <li><a href="email_template.html">Ventes effectué</a></li>
    </ul>
</li>
<li>
    <a href="#"><i class="fa fa-newspaper-o"></i> <span class="nav-label">Blogs</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="form_basic.html">Ajouter un article</a></li>
        <li><a href="form_advanced.html">Liste des blogs</a></li>
        <li><a href="form_wizard.html">Articles publiés</a></li>
        <li><a href="form_file_upload.html">Articles en attente</a></li>
        <li><a href="form_editors.html">Articles archivés</a></li>
        <li><a href="form_autocomplete.html">Articles aux corbeilles</a></li>
    </ul>
</li>
<li>
    <a href="#"><i class="fa fa-list-ul"></i> <span class="nav-label">Catégories</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="contacts.html">Liste des catégories</a></li>
        <li><a href="profile.html">Ajouter une catégorie</a></li>
    </ul>
</li>
<li>
    <a href="#"><i class="fa fa-money"></i> <span class="nav-label">Publicités</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="search_results.html">Liste des publicités</a></li>
        <li><a href="lockscreen.html">Ajouter une publicité</a></li>
    </ul>
</li>
<li>
    <a href="#"><i class="fa fa-file"></i> <span class="nav-label">Pages</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="toast_notifications.html">Ajouter une page</a></li>
        <li><a href="nestable_list.html">Liste des pages</a></li>
    </ul>
</li>
<li>
    <a href="#"><i class="fa fa-envelope"></i> <span class="nav-label">Liste des mails</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="typography.html">Liste des mails</a></li>
        <li><a href="icons.html">Boite de reception</a></li>
        <li><a href="icons.html">Boite d'envoie</a></li>
        <li><a href="buttons.html">Brouillon</a></li>
        <li><a href="video.html">Spam</a></li>
        <li><a href="tabs_panels.html">Messages enregistrees</a></li>
    </ul>
</li>
<li>
    <a href="#"><i class="fa fa-th-list"></i> <span class="nav-label">Liste des mots interdits</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="toast_notifications.html">Liste des mots interdits</a></li>
        <li><a href="nestable_list.html">Ajouter un mot interdit</a></li>
    </ul>
</li>
<li>
    <a href="#"><i class="fa fa-bars"></i> <span class="nav-label">Liste des codes postaux</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="toast_notifications.html">Liste des codes postaux</a></li>
        <li><a href="nestable_list.html">Ajouter un code postal</a></li>
    </ul>
</li>
<li>
    <a href="#"><i class="fa fa-th-list"></i> <span class="nav-label">Liste des etats</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="toast_notifications.html">Liste des etats</a></li>
        <li><a href="nestable_list.html">Ajouter un Etat</a></li>
    </ul>
</li>
<li>
    <a href="#"><i class="fa fa-bars"></i> <span class="nav-label">Liste des plans</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="toast_notifications.html">Liste des plans</a></li>
        <li><a href="nestable_list.html">Ajouter un plan</a></li>
    </ul>
</li>
<li>
    <a href="#"><i class="fa fa-wrench"></i> <span class="nav-label">Configurations</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="table_basic.html">Information du site</a></li>
        <li><a href="table_data_tables.html">Ecran de connexion</a></li>
        <li><a href="table_foo_table.html">Réseaux sociaux</a></li>
        <li><a href="table_foo_table.html">Paiement</a></li>

    </ul>
</li>
<li class="special_link">
    <a href="package.html"><i class="fa fa-sign-out"></i> <span class="nav-label">Déconnexion</span></a>
</li>