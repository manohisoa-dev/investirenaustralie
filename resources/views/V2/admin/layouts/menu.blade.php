{{--    PROFILE BLOCK --}}
<li class="nav-header">
    <div class="dropdown profile-element">
        <img alt="image" class="rounded-circle" src="{{Auth::user()->imageUrl()}}" width="50"/>
        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
            <span class="block m-t-xs font-bold">{{ucfirst(Auth::user()->name)}}</span>
            <span class="text-muted text-xs block">{{ucfirst(Auth::user()->role)}}<b class="caret"></b></span>
        </a>
        <ul class="dropdown-menu animated fadeInRight m-t-xs">
            <li><a class="dropdown-item" href="{{route('V2.admin.profile')}}">Profile</a></li>
            <li class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ route('logout') }}">{{__('app.logout')}}</a></li>
        </ul>
    </div>
    <div class="logo-element">
        IEA
    </div>
</li>

{{--    MENU LIST   --}}
<li class="{{Request::is('*/admin') ? 'active' : ''}}">
    <a href="{{url('V2/admin')}}"><i class="fa fa-tachometer" title="Tableau de bord"></i> <span class="nav-label">Tableau de bord</span></a>
</li>
<li>
    <a href="#"><i class="fa fa-bar-chart-o" title="Statistiques"></i> <span class="nav-label">Statistiques</span><span class="fa arrow"></span></a>
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
<li class="{{ @$bloc_mn == 'users' ? 'active' : '' }}">
    <a href="#">
		<i class="fa fa-users" title="Parties prenantes"></i> 
		<span class="nav-label">Parties prenantes </span><span class="fa arrow"></span>
	</a>
    <ul class="nav nav-second-level collapse">
		<li class="">
			<a href="#">Tous</a>
		</li>
        
    </ul>
</li>
<li class="{{Request::is('*/product/*') || Request::is('*/product') ? 'active' : ''}}">
    <a href="mailbox.html"><i class="fa fa-product-hunt" title="Produits"></i> <span class="nav-label">Produits </span><span class="label label-warning float-right">16/24</span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="{{route('V2.admin.product.index')}}">Liste des produits</a></li>
        <!--<li><a href="mail_detail.html">Produits en attente</a></li>
        <li><a href="mail_compose.html">Produits publiés</a></li>
        <li><a href="email_template.html">Produits commandés</a></li>
        <li><a href="email_template.html">Produits vendus</a></li>
        <li><a href="email_template.html">Produits archivés</a></li>
        <li><a href="email_template.html">Produits aux corbeilles</a></li>-->
    </ul>
</li>
<li>
    <a href="mailbox.html"><i class="fa fa-shopping-cart" title="Ventes"></i> <span class="nav-label">Ventes </span><span class="label label-warning float-right">16/24</span></a>
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
<li class="{{Request::is('*/blog/*') || Request::is('*/blog') ? 'active' : ''}}">
    <a href="#"><i class="fa fa-newspaper-o" title="Blogs"></i> <span class="nav-label">Blogs</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="{{route('V2.admin.blog.create')}}">Ajouter un article</a></li>
        <li><a href="{{route('V2.admin.blog.index')}}">Liste des blogs</a></li>
        <li><a href="form_wizard.html">Articles publiés</a></li>
        <li><a href="form_file_upload.html">Articles en attente</a></li>
        <li><a href="form_editors.html">Articles archivés</a></li>
        <li><a href="form_autocomplete.html">Articles aux corbeilles</a></li>
    </ul>
</li>
<li class="{{Request::is('*/category/*') || Request::is('*/category') ? 'active' : ''}}">
    <a href="#"><i class="fa fa-list-ul" title="Catégories"></i> <span class="nav-label">Catégories</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="{{route('V2.admin.category.index')}}">Liste des catégories</a></li>
        <li><a href="{{route('V2.admin.category.create')}}">Ajouter une catégorie</a></li>
    </ul>
</li>
<li class="{{Request::is('*/pub/*') || Request::is('*/pub') ? 'active' : ''}}">
    <a href="#"><i class="fa fa-money" title="Publicités"></i> <span class="nav-label">Publicités</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="{{route('V2.admin.pub.index')}}">Liste des publicités</a></li>
        <li><a href="{{route('V2.admin.pub.create')}}">Ajouter une publicité</a></li>
    </ul>
</li>
<li class="{{Request::is('*/page/*') || Request::is('*/page') ? 'active' : ''}}">
    <a href="#"><i class="fa fa-file" title="Pages"></i> <span class="nav-label">Pages</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="{{route('V2.admin.page.index')}}">Liste des pages</a></li>
        <li><a href="{{route('V2.admin.page.create')}}">Ajouter une page</a></li>
    </ul>
</li>
<li class="{{Request::is('*/mail/*') || Request::is('*/mail') ? 'active' : ''}}">
    <a href="#"><i class="fa fa-envelope" title="Liste des mails"></i> <span class="nav-label">Liste des mails</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="{{route('V2.admin.mail.index')}}">Liste des mails</a></li>
        <li><a href="icons.html">Boite de reception</a></li>
        <li><a href="icons.html">Boite d'envoie</a></li>
        <li><a href="buttons.html">Brouillon</a></li>
        <li><a href="video.html">Spam</a></li>
        <li><a href="tabs_panels.html">Messages enregistrees</a></li>
    </ul>
</li>
<li class="{{Request::is('*/badword/*') || Request::is('*/badword') ? 'active' : ''}}">
    <a href="#"><i class="fa fa-th-list" title="Liste des mots interdits"></i> <span class="nav-label">Liste des mots interdits</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="{{route('V2.admin.badword.index')}}">Liste des mots interdits</a></li>
        <li><a href="{{route('V2.admin.badword.create')}}">Ajouter un mot interdit</a></li>
    </ul>
</li>
<li class="{{Request::is('*/postalcode/*') || Request::is('*/postalcode') ? 'active' : ''}}">
    <a href="#"><i class="fa fa-bars" title="Liste des codes postaux"></i> <span class="nav-label">Liste des codes postaux</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="{{route('V2.admin.postalcode.index')}}">Liste des codes postaux</a></li>
        <li><a href="{{route('V2.admin.postalcode.create')}}">Ajouter un code postal</a></li>
    </ul>
</li>
<li class="{{Request::is('*/state/*') || Request::is('*/state') ? 'active' : ''}}">
    <a href="#"><i class="fa fa-th-list" title="Liste des etats"></i> <span class="nav-label">Liste des etats</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="{{route('V2.admin.state.index')}}">Liste des etats</a></li>
        <li><a href="{{route('V2.admin.state.create')}}">Ajouter un Etat</a></li>
    </ul>
</li>
<li class="{{Request::is('*/plan/*') || Request::is('*/plan') ? 'active' : ''}}">
    <a href="#"><i class="fa fa-bars" title="Liste des plans"></i> <span class="nav-label">Liste des plans</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="{{route('V2.admin.plan.index')}}">Liste des plans</a></li>
        <li><a href="{{route('V2.admin.plan.create')}}">Ajouter un plan</a></li>
    </ul>
</li>
<li class="{{Request::is('*/config/*') ? 'active' : ''}}">
    <a href="#"><i class="fa fa-wrench" title="Configurations"></i> <span class="nav-label">Configurations</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="{{route('V2.config.site')}}">Information du site</a></li>
        <li><a href="table_data_tables.html">Ecran de connexion</a></li>
        <li><a href="table_foo_table.html">Réseaux sociaux</a></li>
        <li><a href="table_foo_table.html">Paiement</a></li>

    </ul>
</li>
<li class="special_link">
    <a href="{{ route('logout') }}"><i class="fa fa-sign-out" title="Déconnexion"></i> <span class="nav-label">Déconnexion</span></a>
</li>