<x-layout>
    <x-navbar/>
    <div class="row">
    <x-sidebar/>
    <div class="col-10 ps-3 pe-5 mt-2 ">
    <div class="card row mt-3 bg-transparent shadow-0">
        <div class="col-8 offset-2 my-3 shadow-5 py-4 rounded-5" style="background-color: #94b0e3;">
            <div class="mb-3 ps-1 fw-bold h3">Add Interest</div>
            @foreach ($interests as $interest)
                    <form class="row">
                        <div class="col-9">
                            <input type="text" class="form-control mt-2" name="month" placeholder="month" value="{{ $interest->month }}" disabled>
                        </div>
                        <div class="col-2">
                            <input type="text" class="form-control mt-2" name="interest" placeholder="interest" value="{{ $interest->interest }}" disabled>
                        </div>
                        <div class="col-1">
                            <i class="fas fa-trash mt-2 text-danger" style="font-size: 30px;"></i>
                        </div>
                </form>
                @endforeach
                <form action="/store/interest/{{ $id }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-9">
                            <x-form.input name="month" type="number"/>
                        </div>
                        <div class="col-3">
                            <x-form.input name="interest" type="number"/>
                        </div>
                    </div>
                    <button type="submit" class="btn fw-bold btn-primary mt-3 w-100">Add Interest</button>
                    <a href="/create/loan" type="button" class="btn fw-bold btn-white text-primary mt-3 w-100">Back</type=></a>
                </form>
            </div>
        </div>
    </div>
</x-layout>
