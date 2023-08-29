<x-layout>
    <x-navbar/>
    <div class="row">
    <x-sidebar/>
    <div class="col-10 ps-3 pe-5 mt-2">
       
    @foreach ($users as $user)

    @foreach ($user->loans as $loan)
    <div class="card my-2">
        <div class="card-header">Posted 1 min ago</div>
            <div class="card-body">
                <div class="d-flex flex-row">
                    <img
                    src="{{ asset('storage/images/logo.png') }}"
                    height="27"
                    style="width: 40px;"
                    class="me-2"
                    alt="MDB Logo"
                    loading="lazy"
                    />
                    <h5 class="card-title">{{ $user->name }}</h5>
                </div>
            <p class="card-text mt-2">Desription : {{ $loan->description }}</p>
            <span class="fw-bold">Details : </span> <br>
            <small>Minimum Amount : <span class="text-primary"> ₱ {{ $loan->min_amount }}</span></small> <br>
            <small>Maximum Amount : <span class="text-primary"> ₱ {{ $loan->max_amount }} </span></small> <br>
                @foreach ($user->interests as $interest)
                    @if ( $interest->create_loan_id == $loan->id)
                        <small>Repayment Period : <span class="text-primary"> {{ $interest->month }} months</span></small> 
                        <small>Interest Rate : <span class="text-primary"> {{ $interest->interest }} %</span></small><br>
                    @endif
                @endforeach
            <div class="row">
                <div class="col-3 offset-9">
                    <a href="/show/{{ $loan->id }}" class="btn btn-primary mt-2 w-100">Get Loan</a>
                </div>
            </div>
        </div>
    </div> 
    @endforeach
    @endforeach
    </div>
</x-layout>