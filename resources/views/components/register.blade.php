<div class="col-4 offset-1" style="margin-top: 7rem;">
    <div class="card">
        <form method="post" action="/user/store" class="card-body">
            @csrf
            <h5 class="card-title text-center">Create User Account</h5>
            <x-alert/>
            <p class="text-start ms-3 fw-bold">Already have an account ? <small>Login <a href="/" class="text-primary">here</a></small></p>

            <x-form.input name="name"/>
            <x-form.input name="email" type="email"/>
            <x-form.input name="password" type="password"/>
            <x-form.input name="password_confirmation" type="password"/>
            <button type="submit" class="btn btn-primary mt-3 w-100">Register</button>
        </form>
    </div>
</div>
