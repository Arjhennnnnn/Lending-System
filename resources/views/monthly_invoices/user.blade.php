<x-layout>
    <x-navbar/>
    <div class="row">
    <x-sidebar/>
    <div class="col-10 ps-3 pe-5 mt-2 ">
    <x-alert/>

    <form method="post" action="/search/user/invoice" class="row">
        @csrf
        <div class="col-3 offset-8">
            <select class="form-select form-select-md my-2" name="search_user">
                <option value="0">Choose User</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">Reference Number : {{ $user->reference }}</option>
                 @endforeach
            </select>
        </div>
        <div class="col-1">
            <input type="submit" value="show" class="btn btn-primary my-2">
        </div>
    </form>
    <div class="card row mt-3 ms-2 bg-transparent shadow-0 shadow-5" style="background-color: #94b0e3;">
                @if ($type=='borrower')
                    <div class="mb-3 ps-1 fw-bold h3 text-center mt-2"><span class="text-primary"> Your </span> Monthly Invoice</div>
                @else
                    <div class="mb-3 ps-1 fw-bold h3 text-center mt-2"><span class="text-primary"> {{ $payer->name }} </span> Monthly Invoice</div>

                @endif
            <div class="tablebigFixHead">
            
            <table class="table align-middle mb-0 bg-white ">
                <thead class="bg-primary bg-opacity-75">
                    <tr class="fw-bold">
                        <th>Payment Date</th>
                        <th>Monthly Payment</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>

                    </tr>
                </thead>
                <tbody>
                @foreach ($payments as $payment)
                <tr>

                    <td> <p class="fw-normal mb-1">{{$payment->month}}</p> </td>
                    <td> <p class="fw-normal mb-1">₱ {{$payment->monthly_payment}}</p> </td>

                    <td class="text-center">
                        {!! $payment->stats->name !!}
                    </td>
                    <td class="text-center">
                        <a href="/show/request/{{ $payment->id }}"><i class="h3 fas fa-pen-to-square"></i></a>
                    </td>
                </tr>
                @endforeach


                </tbody>
            </table>
        </div>
    </div>
    </div>
</x-layout>
