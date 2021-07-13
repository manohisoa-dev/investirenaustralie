{{--    PROFILE BLOCK --}}
<li class="nav-header">
    <div class="dropdown profile-element">
        <img alt="image" class="rounded-circle" src="{{Auth::user()->imageUrl()}}" width="50"/>
        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
            <span class="block m-t-xs font-bold">{{ucfirst(Auth::user()->name)}}</span>
            <span class="text-muted text-xs block">{{\App\Models\User::find(Auth::id())->roleUser->role_name}}<b class="caret"></b></span>
        </a>
        <ul class="dropdown-menu animated fadeInRight m-t-xs">
            <li><a class="dropdown-item" href="{{Auth::user()->isAdmin()?route('admin.profile'):(Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.profile'):route('admin.collaborator.admin.profile'))}}">Profile</a></li>
            <li><a class="dropdown-item" href="http://iea.easydata.mg/">Retour à la page d'accueil</a></li>
            <li class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ route('logout') }}">{{__('app.logout')}}</a></li>
        </ul>
    </div>
    <div class="logo-element">
        IEA
    </div>
</li>

{{--    MENU LIST   --}}

<li class="{{Request::is('*/admin/*') || Request::is('*/admin') || Request::is('collaborator') || Request::is('collaborators') ? 'active' : ''}}">
    <a href="{{ Auth::user()->isAdmin()?url('/admin'):(Auth::user()->isAdminDelegate()?url('/collaborators'):url('/collaborator')) }}"><i class="fa fa-tachometer" title="Tableau de bord"></i> <span class="nav-label">Tableau de bord</span></a>
</li>
@if(!Auth::user()->isAdminBlog())
    <li class="{{Request::is('*/chart/*') || Request::is('*/chart') ? 'active' : ''}}">
        <a href="javascript:void('0')"><i class="fa fa-bar-chart-o" title="Statistiques"></i> <span class="nav-label">Statistiques</span><span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse">
            <li><a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.chart', ['type'=>'produit']):route('admin.chart', ['type'=>'produit'])}}">Produits</a></li>
            <li><a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.chart', ['type'=>'user']):route('admin.chart', ['type'=>'user'])}}">Utilisateurs</a></li>
            <li><a href="#">Membres</a></li>
            <li><a href="#">Agence Francophone Australienne</a></li>
            <li><a href="#">Agence Partenaire Locale</a></li>
            <li><a href="#">Vendeur</a></li>
            <li><a href="#">Carts</a></li>
        </ul>
    </li>
    <li class="{{Request::is('*/user/*') || Request::is('*/user') || Request::is('*/role/*') || Request::is('*/role') || Request::is('*/type-user/*') || Request::is('*/type-user') ? 'active' : ''}}">
        <a href="#">
            <i class="fa fa-users" title="Parties prenantes"></i> 
            <span class="nav-label">Parties prenantes </span><span class="fa arrow"></span>
        </a>
        <ul class="nav nav-second-level collapse">
            <li class="">
                <a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.index'):route('admin.user.index')}}">Tous</a>
            </li>
            @forelse (App\Models\Role::where('role_initial','!=','admin')->get() as $item)
                @if($item->role_initial !== 'member' && $item->role_initial !== 'collaborator')
                    <li class="">
                        <a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.show.'.$item->role_initial):route('admin.user.show.'.$item->role_initial)}}">@lang('app.txt.'.$item->role_initial)</a>
                    </li>
                @else
                    <li class="{{Request::is('*/user/show/'.$item->role_initial) || Request::is('*/user/show/'.$item->role_initial.'/*') || Request::is('*/user/create/'.$item->role_initial) ? 'active' : ''}}">
                        <a href="#"> 
                            <span class="nav-label">@lang('app.txt.'.$item->role_initial) </span><span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level collapse">
                            <li class="">
                                <a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.show.'.$item->role_initial):route('admin.user.show.'.$item->role_initial)}}">{{ trans('app.txt.list_of', ['role'=>trans('app.txt.'.$item->role_initial)]) }}</a>
                            </li>
                            @if($item->role_initial == 'member')
                                <li class="">
                                    <a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.show.member.particulier'):route('admin.user.show.member.particulier')}}">@lang('app.txt.list_particulier')</a>
                                </li>
                                <li class="">
                                    <a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.show.member.organisation'):route('admin.user.show.member.organisation')}}">@lang('app.txt.list_organisation')</a>
                                </li>
                            @else
                                <li class="">
                                    <a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.user.create.collaborator'):route('admin.user.create.collaborator')}}">@lang('app.txt.add_collaborator')</a>
                                </li>
                            @endif
                        </ul>
                    </li>    
                @endif
            @empty
                
            @endforelse
            <hr>
            <li class="">
                <a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.role.index'):route('admin.role.index')}}">@lang('app.txt.roles')</a>
            </li>
            <li class="">
                <a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.type-user.index'):route('admin.type-user.index')}}">@lang('app.txt.types')</a>
            </li>
        </ul>
    </li>
    <li class="{{Request::is('*/product/*') || Request::is('*/product') || Request::is('*/programme/*') || Request::is('*/programme') ? 'active' : ''}}">
        <a href="#">
            <i class="fa fa-product-hunt" title="Produits"></i> 
            <span class="nav-label">Produits </span>
            <span class="label label-warning float-right">16/24</span>
        </a>
        <ul class="nav nav-second-level collapse">
            <li><a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.programme'):route('admin.product.programme')}}">Liste des programmes</a></li>
            <li><a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.create'):route('admin.product.create') }}?type=programme">Ajouter programme</a></li>
            <li><a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.index'):route('admin.product.index')}}?nature=Programme immobilier">Liste des produits</a></li>
            <li><a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.product.create'):route('admin.product.create') }}?type=produit">Ajouter produit</a></li>
        </ul>
    </li>
    <li class="{{Request::is('*/sale/*') || Request::is('*/sale') ? 'active' : ''}}">
        <a href="#">
            <i class="fa fa-shopping-cart" title="Ventes"></i> 
            <span class="nav-label">Ventes </span>
            <span class="label label-warning float-right">16/24</span>
        </a>
        <ul class="nav nav-second-level collapse">
            <li><a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.sale.index'):route('admin.sale.index')}}">Toutes les ventes</a></li>
            <?php /*?><li><a href="mail_detail.html">Ventes en attente</a></li>
            <li><a href="mail_compose.html">Ventes en cours</a></li>
            <li><a href="email_template.html">Ventes: APL non payé</a></li>
            <li><a href="email_template.html">Ventes: APL payé</a></li>
            <li><a href="email_template.html">Ventes: AFA non payé</a></li>
            <li><a href="email_template.html">Ventes: AFA payé</a></li>
            <li><a href="email_template.html">Ventes effectué</a></li><?php */?>
        </ul>
    </li>
@endif
<li class="{{Request::is('*/blog/*') || Request::is('*/blog') || Request::is('*/comment') || Request::is('*/comment/') || Request::is('*/comment/*') ? 'active' : ''}}">
    <a href="#"><i class="fa fa-newspaper-o" title="Blogs"></i> <span class="nav-label">Blogs</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="{{ Auth::user()->isAdmin()?route('admin.blog.create'):(Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.blog.create'):route('admin.collaborator.admin.blog.create')) }}">Ajouter un article</a></li>
        <li><a href="{{Auth::user()->isAdmin()?route('admin.blog.index'):(Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.blog.index'):route('admin.collaborator.admin.blog.index')) }}">Liste des blogs</a></li>
        <li><a href="{{Auth::user()->isAdmin()?route('admin.comment.index'):(Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.comment.index'):route('admin.collaborator.admin.comment.index')) }}">Commentaires</a></li>
        <!--<li><a href="form_wizard.html">Articles publiés</a></li>
        <li><a href="form_file_upload.html">Articles en attente</a></li>
        <li><a href="form_editors.html">Articles archivés</a></li>
        <li><a href="form_autocomplete.html">Articles aux corbeilles</a></li>-->
    </ul>
</li>
@if(!Auth::user()->isAdminBlog())
    <li class="{{Request::is('*/category/*') || Request::is('*/category') ? 'active' : ''}}">
        <a href="#"><i class="fa fa-list-ul" title="Catégories"></i> <span class="nav-label">Catégories</span><span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse">
            <li><a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.category.create'):route('admin.category.create')}}">Ajouter une catégorie</a></li>
            <li><a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.category.index'):route('admin.category.index')}}">Liste des catégories</a></li>
        </ul>
    </li>
    <li class="{{Request::is('*/pub/*') || Request::is('*/pub') ? 'active' : ''}}">
        <a href="#"><i class="fa fa-money" title="Publicités"></i> <span class="nav-label">Publicités</span><span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse">
            <li><a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.pub.create'):route('admin.pub.create')}}">Ajouter une publicité</a></li>
            <li><a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.pub.index'):route('admin.pub.index')}}">Liste des publicités</a></li>
        </ul>
    </li>
    <li class="{{Request::is('*/page/*') || Request::is('*/page') ? 'active' : ''}}">
        <a href="#"><i class="fa fa-file" title="Pages"></i> <span class="nav-label">Pages</span><span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse">
            <li><a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.page.index'):route('admin.page.index')}}">Liste des pages</a></li>
            <li><a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.page.create'):route('admin.page.create')}}">Ajouter une page</a></li>
        </ul>
    </li>
    <li class="{{Request::is('*/slider/*') || Request::is('*/slider') ? 'active' : ''}}">
        <a href="#"><i class="fa fa-picture-o" title="Pages"></i> <span class="nav-label">Slider</span><span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse">
            <li><a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.slider.index'):route('admin.slider.index')}}">Liste des slider</a></li>
            <li><a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.slider.create'):route('admin.slider.create')}}">Ajouter un slider</a></li>
        </ul>
    </li>
    <li class="{{Request::is('*/mail/*') || Request::is('*/mail') || Request::is('*/mails-template/*') || Request::is('*/mails-template') || Request::is('*/parameters-email/*') || Request::is('*/parameters-email') || Request::is('*/mailtype/*') ? 'active' : ''}}">
        <a href="#"><i class="fa fa-envelope" title="Liste des mails"></i> <span class="nav-label">@lang('app.admin.mail.list')</span><span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse">
            <li><a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.mail.index'):route('admin.mail.index')}}">@lang('app.admin.mail.list')</a></li>{{-- Liste des mails --}}
            <li><a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.mail.list',['filter'=>'inbox']):route('admin.mail.list',['filter'=>'inbox'])}}">@lang('app.admin.mail.inbox')</a></li>{{-- Boite de reception --}}
            <li><a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.mail.list',['filter'=>'outbox']):route('admin.mail.list',['filter'=>'outbox'])}}">@lang('app.admin.mail.outbox')</a></li>{{-- Boite d'envoie --}}
            <li><a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.mail.list',['filter'=>'draft']):route('admin.mail.list',['filter'=>'draft'])}}">@lang('app.admin.mail.draft')</a></li>{{-- Brouillon --}}
            <li><a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.mail.list',['filter'=>'spam']):route('admin.mail.list',['filter'=>'spam'])}}">@lang('app.admin.mail.spam')</a></li>{{-- Spam --}}
			<li><a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.parameters-email.index'):route('admin.parameters-email.index')}}">Paramètres email</a></li>
            <li><a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.mails-template.index'):route('admin.mails-template.index')}}">@lang('app.admin.mail.model')</a></li>{{-- Messages enregistrees --}}
        </ul>
    </li>
	<li class="{{Request::is('*/temoignage/*') || Request::is('*/temoignage') ? 'active' : ''}}">
		<a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.temoignage.index'):route('admin.temoignage.index')}}">
			<i class="fa fa-quote-left" title="Tableau de bord"></i> 
			<span class="nav-label">Témoignages</span>
		</a>
	</li>
    <li class="{{Request::is('*/badword/*') || Request::is('*/badword') ? 'active' : ''}}">
        <a href="#"><i class="fa fa-th-list" title="Liste des mots interdits"></i> <span class="nav-label">Liste des mots interdits</span><span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse">
            <li><a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.badword.index'):route('admin.badword.index')}}">Liste des mots interdits</a></li>
            <li><a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.badword.create'):route('admin.badword.create')}}">Ajouter un mot interdit</a></li>
        </ul>
    </li>
    {{--<li class="{{Request::is('*/postalcode/*') || Request::is('*/postalcode') ? 'active' : ''}}">--}}
        {{--<a href="#"><i class="fa fa-bars" title="Liste des codes postaux"></i> <span class="nav-label">Liste des codes postaux</span><span class="fa arrow"></span></a>--}}
        {{--<ul class="nav nav-second-level collapse">--}}
            {{--<li><a href="{{route('admin.postalcode.index')}}">Liste des codes postaux</a></li>--}}
            {{--<li><a href="{{route('admin.postalcode.create')}}">Ajouter un code postal</a></li>--}}
        {{--</ul>--}}
    {{--</li>--}}
    {{--<li class="{{Request::is('*/state/*') || Request::is('*/state') ? 'active' : ''}}">--}}
        {{--<a href="#"><i class="fa fa-th-list" title="Liste des etats"></i> <span class="nav-label">Liste des etats</span><span class="fa arrow"></span></a>--}}
        {{--<ul class="nav nav-second-level collapse">--}}
            {{--<li><a href="{{route('admin.state.index')}}">Liste des etats</a></li>--}}
            {{--<li><a href="{{route('admin.state.create')}}">Ajouter un Etat</a></li>--}}
        {{--</ul>--}}
    {{--</li>--}}
    {{--<li class="{{Request::is('*/plan/*') || Request::is('*/plan') ? 'active' : ''}}">--}}
        {{--<a href="#"><i class="fa fa-bars" title="Liste des plans"></i> <span class="nav-label">Liste des plans</span><span class="fa arrow"></span></a>--}}
        {{--<ul class="nav nav-second-level collapse">--}}
            {{--<li><a href="{{route('admin.plan.index')}}">Liste des plans</a></li>--}}
            {{--<li><a href="{{route('admin.plan.create')}}">Ajouter un plan</a></li>--}}
        {{--</ul>--}}
    {{--</li>--}}
    <li class="{{Request::is('*/config/*') || Request::is('*/menu/*') || Request::is('*/menu') || Request::is('*/firb/*') || Request::is('*/firb') || Request::is('*/translation/*') || Request::is('*/translation') || Request::is('*/media/*') || Request::is('*/media') ? 'active' : ''}}">
        <a href="#"><i class="fa fa-wrench" title="Configurations"></i> <span class="nav-label">Configurations</span><span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse">
            <li><a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.config.site'):route('admin.config.site')}}">Information du site</a></li>
            {{--<li><a href="{{route('admin.config.login')}}">Ecran de connexion</a></li>--}}
            <li><a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.config.social'):route('admin.config.social')}}">Réseaux sociaux</a></li>
            {{--<li><a href="{{route('admin.config.payment')}}">Paiement</a></li>--}}
            <li>
                <a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.menu.index'):route('admin.menu.index')}}">
                    <span class="nav-label">Menus</span>
                </a>
            </li>
            <li>
                <a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.media'):route('admin.media')}}">
                    <span class="nav-label">Media</span>
                </a>
            </li>
            <li>
                <a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.firb.index'):route('admin.firb.index')}}">
                    <span class="nav-label">Firb</span>
                </a>
            </li>
            <li>
                <a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.config.translation'):route('admin.config.translation')}}">
                    <span class="nav-label">Translation</span>
                </a>
            </li>
            <li>
                <a href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.config.parameter'):route('admin.config.parameter')}}">
                    <span class="nav-label">Paramètre</span>
                </a>
            </li>
        </ul>
    </li>
@endif
<li class="special_link">
    <a href="{{ route('logout') }}"><i class="fa fa-sign-out" title="Déconnexion"></i> <span class="nav-label">Déconnexion</span></a>
</li>