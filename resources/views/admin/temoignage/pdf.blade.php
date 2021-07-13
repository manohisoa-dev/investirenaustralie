<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>@lang('app.txt.detail_testimonial')</h5>
            </div>
            <div class="ibox-content">
                <ul class="list-group">
                    <li class="list-group-item">
                        <h4>@lang('app.txt.member')</h4>
                        <h5>{{$temoignage->author->name}} - {{$temoignage->pays}}</h5>
                    </li>
                    <li class="list-group-item">
                        <h4>@lang('app.message')</h4>
                        <h5>{!! $temoignage->contenu !!}</h5>
                    </li>
                    <li class="list-group-item">
                        <h4>@lang('app.txt.status')</h4>
                        <h5>{{$temoignage->statut}}</h5>
                    </li>
                    <li class="list-group-item">
                        <h4>@lang('app.txt.created_on')</h4>
                        <h5>{{$temoignage->created_at}}</h5>
                    </li>
               </ul>
            </div>
        </div>
    </div>
</div>