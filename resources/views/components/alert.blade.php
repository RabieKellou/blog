@if(session()->has('status'))
    <div class="alert alert-primary" role="alert">
        <strong>Info: </strong> {{ session()->get('status') }}
    </div>
@endif
