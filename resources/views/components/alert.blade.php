@if(session()->has('message'))

<div class="alert alert-primary text-center" role="alert">
    {{ session('message') }}
</div>

@endif