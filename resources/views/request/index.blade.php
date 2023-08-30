<x-layout>
    <x-navbar/>
    <div class="row">
    <x-sidebar/>
    <div class="col-10 ps-3 pe-5 mt-2 ">
    <div class="card row mt-3 ms-2 bg-transparent shadow-0 shadow-5" style="background-color: #94b0e3;">
            <div class="mb-3 ps-1 fw-bold h3 text-center mt-2">Request List</div>
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-primary bg-opacity-75">
                    <tr class="fw-bold">
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Month</th>
                        <th>Interest</th>
                        <th>Purpose</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($gets as $get)
                <tr>
                    <td> <p class="fw-bold mb-1">{{$get->requests->name}}</p> </td>
                    <td> <p class="mb-0">{{$get->amount}}</p> </td>
                    <td> <p class="fw-normal mb-1">{{$get->month}} month/s</p> </td>
                    <td> <p class="text-muted mb-0">{{$get->interest}} %</p> </td>
                    <td> <p class="text-muted mb-0">{{$get->purpose}} </p> </td>
                    <td>
                        {!! $get->stats->name !!}
                    </td>
                    <td>
                    <a href="/loan/data/{{ $get->id }}"><i class="fas fa-eye text-primary"></i></a>
                    <i class="fas fa-trash text-danger"></i>
                    </td>
                </tr>
                @endforeach


                </tbody>
            </table>
            </div>
    </div>
</x-layout>
