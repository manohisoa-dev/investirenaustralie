<div class="table-responsive">
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">ID <span class="column-sorter"></span></th>
            <th scope="col">Client<span class="column-sorter"></span></th>
            <th scope="col">TMA Total<span class="column-sorter"></span></th>
            <th scope="col">Nombre de produit<span class="column-sorter"></span></th>
            <th scope="col">Date <span class="column-sorter"></span></th>
            <th scope="col">Status<span class="column-sorter"></span></th>
            <th scope="col">Action<span class="column-sorter"></span></th>
        </tr>
    </thead>
    <tbody>
      @foreach($carts as $cart) 
        <tr>
            <td>{{$cart->id}}</td>
            <td>{{$cart->author?$cart->author->name:''}}</td>
            <td>{{$cart->totalPrice}}</td>
            <td>{{$cart->totalQuantity}}</td>
            <td>{{$cart->created_at->diffForHumans()}}</td>
            <td>{{$cart->status}}</td>
            <td><a class="btn btn-primary" href="{{Auth::user()->isAdminDelegate()?route('admin.collaborators.admin.cart.show',$cart):route('admin.cart.show',$cart)}}">@lang('app.btn.view')</a></td>
        </tr>
       @endforeach
    </tbody>
</table>
</div>