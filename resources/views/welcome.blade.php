<x-layout>
<x-navbar />


<div class="row" style="background-color: #82b0d9; height:100vh;">

    <div class="col-6" style="margin-top: 10rem;">
        <h1 class="text-center" style="font-size: 6rem;"><span class="text-primary">Lending</span> System</h1>
        <p class="ms-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi necessitatibus tempore sapiente blanditiis assumenda. Asperiores ex iusto quaerat excepturi fuga, tenetur quod, totam nam nisi ratione atque, officiis beatae at!</p>
    </div>

    @if($route == 'login')
        <x-login/>
    @else
        <x-register/>
    @endif


</div>

</x-navbar>
