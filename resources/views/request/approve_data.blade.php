<x-layout>
    <x-navbar/>
    <div class="row">
    <x-sidebar/>
    <div class="col-10 ps-3 pe-5 mt-2 ">
    <div class="card row mt-3 ms-2 bg-transparent shadow-0 shadow-5" style="background-color: #94b0e3;">
    <h5 class="text-center bg-primary bg-opacity-75 py-2 fw-bold">Personal Details</h5>
    <div class="row ms-2 mt-3">
        
        <p class="m-0">Name : {{ $user->name }}</p>
        <p class="m-0">Email : {{ $user->email }}</p>
        <p class="m-0">Address : {{ $user->detail->address }}</p>
        <p class="m-0">Work : {{ $user->detail->work }}</p>
        <p class="m-0">Income : ₱ {{ $user->detail->income }} </p>
    </div>
    <h5 class="text-center bg-primary bg-opacity-75 py-2 fw-bold">Payment Details</h5>

    <div class="row ms-2 mt-3">
        <p class="m-0">Amount : ₱ {{ $get['amount'] }}</p>
        <p class="m-0">Interest : {{ $get['interest'] }} %</p>
        <p class="m-0">Monthly Payment : ₱ {{ $get['monthly_payment'] }}</p>
        <p class="m-0">Month : {{ $get['month'] }} month/s</p>
        <p class="m-0">Date Released : {{ $get['date_released'] }}</p>
    </div>



            <div class="mb-3 ps-1 fw-bold h5 text-center mt-2 ">Payment List</div>
            
            <div class="tableFixHead">
            <table class="table align-middle mb-0 bg-white h3" style="overflow-y:scroll">
                <thead class="bg-primary bg-opacity-75 fw-bold">
                <tr class="fw-bold">
                    <th>Date</th>
                    <th>Amount</th>
                </tr>
      

                </thead>
                <tbody>
                @foreach ($datas as $data)
                <tr>
                    <td> <p class="fw-bold mb-1">{{$data}}</p> </td>
                    <td> <p class="mb-0">₱ {{ $get['monthly_payment'] }}</p> </td>
                </tr>
                @endforeach  
                </tbody>
            </table>
            </div>
            </div>

            <form class="row" method="post" action="/approve/loan/{{ $get['id'] }}">
                @csrf
                <input type="hidden" name="monthly_payment" value="{{ $get['monthly_payment'] }}">
                <input type="hidden" name="month" value="{{ $get['month'] }}">
                <div class="col-2 offset-10 my-2">
                    <button type="submit" class="btn btn-primary w-100 mt-3">Approve Loan</button>
                </div>
            </form>
    </div>
</x-layout>

