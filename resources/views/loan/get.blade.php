<x-layout>
    <x-navbar/>
    <div class="row">
    <x-sidebar/>
    <div class="col-10 ps-3 pe-5 mt-2 ">
    <div class="card row mt-3 bg-transparent shadow-0">
        <div class="col-8 offset-2 my-3 shadow-5 py-4 rounded-5" style="background-color: #94b0e3;">
            <div class="mb-3 ps-1 fw-bold h3">Get Loan</div>
                <form method="post" action="/get/loan" method="post">
                    @csrf
                    <input type="hidden" value="{{ $loan->user_id }}" name="user_id">
                    <input type="hidden" value="{{ $loan->id }}" name="loan_id">
                    <x-form.input name="amount"/>
                    <select class="form-select form-select-md my-2" name="month_interest">
                        @foreach ($interests as $interest)
                            <option value="{{ $interest->month }}{{ $interest->interest }}">{{ $interest->month }} month/s and {{ $interest->interest }}% interest</option>
                        @endforeach
                    </select>
                    <x-form.textarea name="purpose"/>
                    <button type="submit" class="btn fw-bold btn-primary mt-3 w-100">Get Loan</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
