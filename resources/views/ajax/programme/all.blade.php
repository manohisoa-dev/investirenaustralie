@php $i = 0; @endphp
@foreach($items as $item)
    @if($i%2 === 0)
        <div class="row" id="txtHint">
    @endif
    <div class="col-md-12 view-item layout-item-wrap">
        @include('programme.single', ['item'=>$item])
    </div>
    @php $i++; @endphp
    @if($i%2 === 0)
        </div>
    @endif
@endforeach
@if((($i%2) > 0))
</div>
@endif