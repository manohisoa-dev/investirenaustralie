<div class="footer">
    <div class="float-right">
        {{__('app.footer_description')}}
    </div>
    <div>
        <strong>Copyright</strong> <a href="{{URL::to('/')}}">Investir en Australie</a> &copy; 2019 {{\Carbon\Carbon::now()->year != "2019" ? "- " . \Carbon\Carbon::now()->year : ""}}
    </div>
</div>