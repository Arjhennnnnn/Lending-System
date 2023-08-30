<x-layout>
    <x-navbar/>
    <div class="row">
    <x-sidebar/>
    <div class="col-10 ps-3 pe-5 mt-2 ">
    <div class="card row mt-3 ms-2 bg-transparent shadow-0 shadow-5" style="background-color: #94b0e3;">
    <h5 class="text-center bg-primary bg-opacity-75 py-2 fw-bold">Personal Details</h5>
    <div class="row ms-2 mt-3">
        <p class="m-0">Name : Foobar</p>
        <p class="m-0">Email : foobar@gmail.com</p>
        <p class="m-0">Address : 1000 Address,Bulacan</p>
        <p class="m-0">Work : Back-End Web Developer</p>
        <p class="m-0">Income : xxxxxxxx</p>
    </div>
    <h5 class="text-center bg-primary bg-opacity-75 py-2 fw-bold">Payment Details</h5>

    <div class="row ms-2 mt-3">
        <p class="m-0">Amount : ₱ 10000</p>
        <p class="m-0">Monthly Payment : xxxxxx</p>
        <p class="m-0">Month : 24 month/s</p>
        <p class="m-0">Date Released : August 30 2023</p>
    </div>



            <div class="mb-3 ps-1 fw-bold h5 text-center mt-2">Payment List</div>
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-primary bg-opacity-75">
                <tr class="fw-bold">
                    <th>Date</th>
                    <th>Amount</th>
                </tr>
      

                </thead>
                <tbody>
                @foreach ($datas as $data)
                <tr>
                    <td> <p class="fw-bold mb-1">{{$data}}</p> </td>
                    <td> <p class="mb-0">₱ 300</p> </td>
                </tr>
                @endforeach  
                </tbody>
            </table>
            </div>

            <form class="row" method="post" action="/store/get/loan/">
                @csrf
                <input type="hidden" name="amount" value="{{$attributes['amount']}}">
                <input type="hidden" name="purpose" value="{{$attributes['purpose']}}">
                <input type="hidden" name="month" value="{{$attributes['month']}}">
                <input type="hidden" name="interest" value="{{$attributes['interest']}}">
                <input type="hidden" name="user_id" value="{{$attributes['user_id']}}">
                <input type="hidden" name="lender_id" value="{{$attributes['lender_id']}}">
                <input type="hidden" name="create_loan_id" value="{{$attributes['create_loan_id']}}">
                <input type="hidden" name="status" value="{{$attributes['status']}}">
                <div class="col-2 offset-10 my-2">
                    <button type="submit" class="btn btn-primary w-100 mt-3">Approve</button>
                </div>
            </form>
    </div>
</x-layout>