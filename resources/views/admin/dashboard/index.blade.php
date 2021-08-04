@extends('admin.layouts.app')

@section('custum-css')
    l,knsls
@endsection

@section('title', 'Tableau de bord')

@section('content')
@if(Auth::user()->isAdmin() || Auth::user()->isAdminDelegate())
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    {{--<div class="ibox-tools">--}}
                        {{--<span class="label label-success float-right">Monthly</span>--}}
                    {{--</div>--}}
                    <h5>@lang('app.users')</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{$count['users']}}</h1>
                    {{--<div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>--}}
                    {{--<small>Total income</small>--}}
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    {{--<div class="ibox-tools">--}}
                        {{--<span class="label label-info float-right">Annual</span>--}}
                    {{--</div>--}}
                    <h5>Produits</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{$count['products']}} </h1>
                    {{--<div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>--}}
                    {{--<small>New orders</small>--}}
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    {{--<div class="ibox-tools">--}}
                        {{--<span class="label label-primary float-right">Today</span>--}}
                    {{--</div>--}}
                    <h5>Commandes</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{$count['orders']}}</h1>
                    {{--<div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>--}}
                    {{--<small>New visits</small>--}}
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    {{--<div class="ibox-tools">--}}
                        {{--<span class="label label-danger float-right">Low value</span>--}}
                    {{--</div>--}}
                    <h5>Ventes</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{$count['sales']}}</h1>
                    {{--<div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i></div>--}}
                    {{--<small>In first month</small>--}}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Emails recents</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content ibox-heading">
                    <h3><i class="fa fa-envelope-o"></i> Nouveaux messages</h3>
                    <small>
						<i class="fa fa-tim"></i> 
						Vous avez {{\App\Models\Mail::inboxcount(Auth::user()->id)}} 
						nouveaux messages et {{\App\Models\Mail::draftCount(Auth::user()->id)}} en attente dans le dossier brouillon.
					</small>
                </div>
                <div class="ibox-content">
                    <div class="feed-activity-list">

                        @foreach($recent['mails'] as $mail)
                            <div class="feed-element">
                                <div>
                                    <small class="float-right text-navy">{{$mail->created_at ? $mail->created_at->diffForHumans() : ''}}</small>
                                    <a href="{{route('admin.mail.index')}}/{{$mail->id}}">
                                        <strong>{{$mail->subject}}</strong>
                                    </a>
                                    <div>{{ str_limit(strip_tags($mail->content), "100", "...") }}</div>
                                    <small class="text-muted">{{$mail->created_at ? $mail->created_at->diffForHumans() : ''}}</small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-6">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Utilisateurs recents</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content table-responsive">
                            <table class="table table-hover no-margins">
                                <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Utilisateurs</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($recent['users'] as $user)
                                    <tr>
                                        <td><small>{{ $user->status?trans('app.txt.'.$user->status):'-' }}</small></td>
                                        <td><i class="fa fa-clock-o"></i> {{$user->created_at }}</td>
                                        <td>{{$user->name}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Produits recents</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <ul class="todo-list m-t small-list">
                                @foreach($recent['products'] as $product)
                                    <li>
                                        <span class="m-l-xs">{{$product->title}} - ${{number_format($product->price, 0  , ',',' ')}}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Commandes recentes</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">

                            <div class="row">
                                <div class="col-lg-6">
                                    <table class="table table-hover margin bottom">
                                        <thead>
                                        <tr>
                                            <th style="width: 1%" class="text-center">No.</th>
                                            <th>Libelle</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Prix</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($recent['orders'] as $product)
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td> {{$product->title}}
                                                </td>
                                                <td class="text-center small">16 Jun 2014</td>
                                                <td class="text-center"><span class="label label-primary">{{number_format($product->price, 2, ',',' ') . ' ' . ucfirst($product->currency)}}</span></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-6">
                                    <div id="world-map" style="height: 300px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Ventes recentes</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content table-responsive">
                            @if(count($recent['sales']) > 0)
                                <table class="table table-hover no-margins">
                                    <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Utilisateur</th>
                                        <th>Oix</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($recent['sales'] as $product)
                                        <tr>
                                            <td>
                                                @if($product->status=='published')
                                                    <span class="label label-success">@lang('app.'.$product->status)</span>
                                                @else
                                                    <span class="label label-warning">@lang('app.'.$product->status)</span>
                                                @endif
                                            </td>
                                            <td><i class="fa fa-clock-o"></i> {{$product->created_at}}</td>
                                            <td>{{$product->title}}</td>
                                            <td class="text-navy"> <i class="fa fa-level-up"></i> 24% </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                Aucun vente pour le moment
                            @endif

                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5><i class="fa fa-line-chart"></i> Repartition des utilisateurs par date d'inscription</h5>
                    <div class="ibox-tools">
                        <div class="btn-group">
                            {{--<button type="button" class="btn btn-xs btn-white active">Aujourd'hui</button>
                            <button type="button" class="btn btn-xs btn-white">Mensuel</button>
                            <button type="button" class="btn btn-xs btn-white">Annuel</button>--}}
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="flot-chart">
								<canvas id="canvas_user" height="60"></canvas>                                
                            </div>
                        </div>
                        <div class="col-lg-3">
						@php
							$day = date('Y-m-d');
							$month = date('m');
							$year = date('Y');
							$nb_user_day = \App\Models\User::whereDate('created_at', 'LIKE', $day.'%')->count();
							$nb_user_month = \App\Models\User::whereMonth('created_at', '=', $month)->count();
							$nb_user_year = \App\Models\User::whereYear('created_at', '=', $year)->count();
							$nb_all_user = \App\Models\User::count();    
							
							if($nb_user_day == 0){
								$p_nb_user_day = 0;
							}else{
								$p_nb_user_day = ($nb_user_day / $nb_all_user) * 100;
							}
							
							if($nb_user_month == 0){
								$p_nb_user_month = 0;
							}else{
								$p_nb_user_month = ($nb_user_month / $nb_all_user) * 100;
							}
							
							if($nb_user_year == 0){
								$p_nb_user_year = 0;
							}else{
								$p_nb_user_year = ($nb_user_year / $nb_all_user) * 100;
							}
						@endphp
                            <ul class="stat-list">
                                <li>
                                    <h2 class="no-margins">{{$nb_user_day}} / {{$nb_all_user}}</h2>
                                    <small>@lang('app.txt.dasboard_nb_user_inscrit_jour')</small>
                                    <div class="stat-percent">{{number_format($p_nb_user_day,2)}}%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: {{$p_nb_user_day}}%;" class="progress-bar"></div>
                                    </div>
                                </li>
                                <li>
                                    <h2 class="no-margins ">{{$nb_user_month}} / {{$nb_all_user}}</h2>
                                    <small>@lang('app.txt.dasboard_nb_user_inscrit_mois')</small>
                                    <div class="stat-percent">{{number_format($p_nb_user_month,2)}}%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: {{$p_nb_user_month}}%;" class="progress-bar"></div>
                                    </div>
                                </li>
                                <li>
                                    <h2 class="no-margins ">{{$nb_user_year}} / {{$nb_all_user}}</h2>
                                    <small>@lang('app.txt.dasboard_nb_user_inscrit_annee')</small>
                                    <div class="stat-percent">{{number_format($p_nb_user_year,2)}}%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: {{$p_nb_user_year}}%;" class="progress-bar"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5><i class="fa fa-line-chart"></i> Repartition des produits par date</h5>
                    <div class="ibox-tools">
                        <div class="btn-group">
                            {{--<button type="button" class="btn btn-xs btn-white active">Aujourd'hui</button>
                            <button type="button" class="btn btn-xs btn-white">Mensuel</button>
                            <button type="button" class="btn btn-xs btn-white">Annuel</button>--}}
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="flot-chart">
                                <!--<div class="flot-chart-content" id="flot-line-chart"></div>-->
								<canvas id="canvas_product" height="60"></canvas>    
                            </div>
                        </div>
                        <div class="col-lg-3">
						@php
							$day = date('Y-m-d');
							$month = date('m');
							$year = date('Y');
							$nb_product_day = \App\Models\Product::whereDate('created_at', 'LIKE', $day.'%')->count();
							$nb_product_month = \App\Models\Product::whereMonth('created_at', '=', $month)->count();
							$nb_product_year = \App\Models\Product::whereYear('created_at', '=', $year)->count();
							$nb_all_product = \App\Models\Product::count();    
							
							if($nb_product_day == 0){
								$p_nb_product_day = 0;
							}else{
								$p_nb_product_day = ($nb_product_day / $nb_all_product) * 100;
							}
							
							if($nb_product_month == 0){
								$p_nb_product_month = 0;
							}else{
								$p_nb_product_month = ($nb_product_month / $nb_all_product) * 100;
							}
							
							if($nb_product_year == 0){
								$p_nb_product_year = 0;
							}else{
								$p_nb_product_year = ($nb_product_year / $nb_all_product) * 100;
							}
						@endphp
                            <ul class="stat-list">
                                <li>
                                    <h2 class="no-margins">{{$nb_product_day}} / {{$nb_all_product}}</h2>
                                    <small>@lang('app.txt.dasboard_nb_prd_inscrit_jour')</small>
                                    <div class="stat-percent">{{number_format($p_nb_product_day,2)}}%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: {{$p_nb_product_day}}%;" class="progress-bar"></div>
                                    </div>
                                </li>
                                <li>
                                    <h2 class="no-margins ">{{$nb_product_month}} / {{$nb_all_product}}</h2>
                                    <small>@lang('app.txt.dasboard_nb_prd_inscrit_mois')</small>
                                    <div class="stat-percent">{{number_format($p_nb_product_month,2)}}%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: {{$p_nb_product_month}}%;" class="progress-bar"></div>
                                    </div>
                                </li>
                                <li>
                                    <h2 class="no-margins ">{{$nb_product_year}} / {{$nb_all_product}}</h2>
                                    <small>@lang('app.txt.dasboard_nb_prd_inscrit_annee')</small>
                                    <div class="stat-percent">{{number_format($p_nb_product_year,2)}}%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: {{$p_nb_product_year}}%;" class="progress-bar"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endif

@if (Auth::user()->isAdminBlog())
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>@lang('app.txt.recent_publication') PP</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content table-responsive">
                    <table class="table table-hover no-margins">
                        <thead>
                        <tr>
                            <th>@lang('app.status')</th>
                            <th>@lang('app.date')</th>
                            <th>@lang('app.txt.title')</th>
                            <th>@lang('app.user')</th>
                            <th>@lang('app.txt.role')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($recent['blogs'] as $blog)
                            <tr>
                                <td><small>{{ $blog->status?trans('app.txt.'.$blog->status):'-' }}</small></td>
                                <td><i class="fa fa-clock-o"></i> {{$blog->created_at }}</td>
                                <td>{{$blog->title}}</td>
                                <td>{{$blog->author_id?App\Models\User::find($blog->author_id)->name:'-'}}</td>
                                <td>{{$blog->author_id?App\Models\TypeUser::find(App\Models\User::find($blog->author_id)->type_users_id)->type_user_name:'-'}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5><i class="fa fa-line-chart"></i> Repartition des publications par date</h5>
                    <div class="ibox-tools">
                        <!--<div class="btn-group">
                            <button type="button" class="btn btn-xs btn-white active">Aujourd'hui</button>
                            <button type="button" class="btn btn-xs btn-white">Mensuel</button>
                            <button type="button" class="btn btn-xs btn-white">Annuel</button>
                        </div>-->
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="flot-chart">
                                <canvas id="canvas_user" height="60"></canvas>                                
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <ul class="stat-list">
                                <li>
                                    <h2 class="no-margins">2,346</h2>
                                    <small>Total orders in period</small>
                                    <div class="stat-percent">48% <i class="fa fa-level-up text-navy"></i></div>
                                    <div class="progress progress-mini">
                                        <div style="width: 48%;" class="progress-bar"></div>
                                    </div>
                                </li>
                                <li>
                                    <h2 class="no-margins ">4,422</h2>
                                    <small>Orders in last month</small>
                                    <div class="stat-percent">60% <i class="fa fa-level-down text-navy"></i></div>
                                    <div class="progress progress-mini">
                                        <div style="width: 60%;" class="progress-bar"></div>
                                    </div>
                                </li>
                                <li>
                                    <h2 class="no-margins ">9,180</h2>
                                    <small>Monthly income from orders</small>
                                    <div class="stat-percent">22% <i class="fa fa-bolt text-navy"></i></div>
                                    <div class="progress progress-mini">
                                        <div style="width: 22%;" class="progress-bar"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endif
@endsection

@section('custom-script')	
	<script>
        $(document).ready(function() {
			var data = {!!$data!!};
            var lineData = {
                labels: data.label,
                datasets: [
                    {
                        label: {{$count['users']}}+" Articles publiés",
                        backgroundColor: "rgba(26,179,148,0.5)",
                        borderColor: "rgba(26,179,148,0.7)",
                        pointBackgroundColor: "rgba(26,179,148,1)",
                        pointBorderColor: "#fff",
                        data: data.count
                    }
                ]
            };

            var lineOptions = {
                responsive: true
            };


            var ctx = document.getElementById("canvas_user").getContext("2d");
            new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});
			
			<!-- chart product-->
			var p_lineData = {
                labels: data.p_label,
                datasets: [
                    {
                        label: {{$count['products']}} +" Produits enregistrés",
                        backgroundColor: "rgba(26,179,148,0.5)",
                        borderColor: "rgba(26,179,148,0.7)",
                        pointBackgroundColor: "rgba(26,179,148,1)",
                        pointBorderColor: "#fff",
                        data: data.p_count
                    }
                ]
            };

            var p_lineOptions = {
                responsive: true
            };


            var p_ctx = document.getElementById("canvas_product").getContext("2d");
            new Chart(p_ctx, {type: 'line', data: p_lineData, options:p_lineOptions});
        });
    </script>
@endsection