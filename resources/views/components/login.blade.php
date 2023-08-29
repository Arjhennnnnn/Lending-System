<div class="col-4 offset-1" style="margin-top: 7rem;">

<div class="card">
<form method="post" action="/login/process" class="card-body">            
    <x-alert/>
    @csrf
    <h5 class="card-title text-center">Login your Account</h5>
    <p class="text-start ms-3 fw-bold">Create new account <a href="/register" class="text-primary">here</a></p>

    <x-form.input name="email"/>
    <x-form.input name="password" type="password"/>


    <button type="submit" class="btn btn-primary mt-3 w-100">Login</button>
</form>
</div>
</div>