@extends('./layouts/master-layout')

@section('page_title', 'صفحه خانه')

@section('content')


@push('styles')

@endpush



@push('scripts')



@endpush
<p class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">خانه /</span>  صفحه اصلی
</p>


<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="card-title mb-2">تراکنش های امروز</h4>
                        <p class="text-muted fw-medium fs-22 mb-0">{{$todayTransactions}}</p>
                    </div>
                    <div>
                        <div class="avatar-md bg-primary bg-opacity-10 rounded">
                            <iconify-icon icon="solar:clipboard-remove-broken" class="fs-32 text-primary avatar-title"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="card-title mb-2">بانکها</h4>
                        <p class="text-muted fw-medium fs-22 mb-0">{{$allbanks}}</p>
                    </div>
                    <div>
                        <div class="avatar-md bg-primary bg-opacity-10 rounded">
                            <iconify-icon icon="solar:clock-circle-broken" class="fs-32 text-primary avatar-title"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="card-title mb-2">تعداد مشتریان</h4>
                        <p class="text-muted fw-medium fs-22 mb-0">{{$customers}}</p>
                    </div>
                    <div>
                        <div class="avatar-md bg-primary bg-opacity-10 rounded">
                            <iconify-icon icon="solar:clipboard-check-broken" class="fs-32 text-primary avatar-title"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="card-title mb-2">در حال انجام</h4>
                        <p class="text-muted fw-medium fs-22 mb-0">656</p>
                    </div>
                    <div>
                        <div class="avatar-md bg-primary bg-opacity-10 rounded">
                            <iconify-icon icon="solar:inbox-line-broken" class="fs-32 text-primary avatar-title"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">
    {{-- <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <form id="search-form" method="GET" action="{{ route('customer.index') }}" class="d-flex align-items-center gap-2">
                            <label for="searchCustomer" class="form-label mb-0">جستجوی مشتری:</label>
                            <input type="text" name="search" id="search" class="form-control w-auto" placeholder="برای جستجو..." value="{{ request('search') }}">
                            
                            <button type="submit" class="btn btn-sm btn-primary">
                                جستجو <iconify-icon icon="solar:search" class="align-middle fs-18"></iconify-icon>
                            </button>
                
                            @if(request('search'))
                                <a href="{{ route('customer.index') }}" class="btn btn-sm btn-secondary">
                                    نمایش همه <iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon>
                                </a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center gap-1">
                <h4 class="card-title flex-grow-1">تراکنش های اخیر</h4>
            </div>

            <div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0 table-hover table-centered">
                        <thead class="bg-light-subtle">
                            <tr>
                                <th>تاریخ</th>
                                <th>نوع تراکنش</th>
                                <th>رسید وبرد</th>
                                <th>نام مشتری</th>
                                <th>مقدار پول</th>
                                <th>تفصیلات</th>
                                <th>نمبر چک</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if(isset($lastTransactions) && $lastTransactions->isNotEmpty())
                            @foreach($lastTransactions as $transaction)
                            <tr>
                                {{-- <td>{{ $transaction->date }}</td> --}}
                                <td>{{ \Carbon\Carbon::parse($transaction->date)->diffForHumans() }}</td>
                                {{-- <td>{{ $transaction->date->diffForHumans() }}</td> --}}


                                <td>
                                    <span class="badge badge-pill badge-soft-success font-bold p-2">
                                        {{ $transaction->transaction_type }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-pill
                                    {{ $transaction->rasid_bord === 'rasid' ? 'bg-success' : 'badge-soft-danger' }}"
                                    font-bold p-2">
                                        {{ $transaction->rasid_bord==="rasid" ? "رسید" : "بــرد"}}
                                    </span>
                                </td>
                                <td>
                                    {{ $transaction->customer->name ?? $transaction->finance_account->account_name ?? "وجود ندارد" }}
                                </td>
                                <td>
                                    {{ number_format($transaction->amount) }} {{ $transaction->tr_currency->name }}
                                    {{ $transaction->rasid_bord === 'rasid' ? 'به' : 'از' }}
                                    {{ $transaction->bank_account->account_name ?? $transaction->finance_account->account_name }}
                                </td>
                                <td>{{ $transaction->desc }}</td>
                                <td>{{ $transaction->check_number }}</td>
                            </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6">هیچ تراکنشی یافت نشد!</td>
                                </tr>
                            @endif
                        

                        </tbody>
                    </table>
                </div>
                <!-- end table-responsive -->
            </div>
            <div class="card-footer border-top">
                <nav aria-label="Page navigation example">

                    {{-- @if(isset($customers) && $customers->isNotEmpty())
                    <div class="mt-3 d-flex justify-content-center">
                        {{ $customers->links('pagination::bootstrap-5') }}
                    </div>
                    @endif --}}
                    
                </nav>
            </div>
        </div>
    </div>

       </div>




   <!-- Modal -->
   <div class="modal fade" id="exampleModal" tabindex="-1"
   aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">اضافه کردن مشتری جدید</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal"
                   aria-label="بستن"></button>
           </div>
           <div class="modal-body">
            <form action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data" id="addcustomer">
                @csrf
                <div class="row">
                    <div class="col mb-3">
                        <label for="name" class="form-label">نام</label>
                        <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="نام خود را وارد نمائید" value="{{ old('name') }}">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col mb-3">
                        <label for="lastname" class="form-label">تخلص</label>
                        <input type="text" id="lastname" class="form-control @error('lastname') is-invalid @enderror" name="lastname" placeholder="تخلص خود را وارد نمائید" value="{{ old('lastname') }}">
                        @error('lastname') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col mb-3">
                        <label for="phone" class="form-label">شماره تماس</label>
                        <div class="input-group">
                            <input type="text" id="phone" class="form-control contact-number-mask @error('phone') is-invalid @enderror" name="phone" placeholder="7xx xxx xxx" value="{{ old('phone') }}">
                            {{-- <span class="input-group-text">AF (+93)</span> --}}
                            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col mb-3">
                        <label for="email" class="form-label">ایمیل</label>
                        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="example@gmail.com" value="{{ old('email') }}">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col mb-3">
                        <label for="image" class="form-label">عکس</label>
                        <input type="file" id="image" class="form-control @error('image') is-invalid @enderror" name="image">
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col mb-3">
                        <label for="dob" class="form-label">تاریخ تولد</label>
                        <input type="date" id="basic-datepicker"
                        class="form-control flatpickr-input" placeholder="تاریخ انتخاب اولیه" name="dob" id="dob"
                          old="{{old('dob')}}">
                        {{-- <input type="text" id="basic-datepicker"
                        class="form-control flatpickr-input" placeholder="تاریخ انتخاب اولیه" name="dob" id="dob"
                        readonly="readonly"  old="{{old('dob')}}"> --}}
                    </div>
                </div>

                <div class="row">
                    <div class="col mb-3">
                        <label for="tazId" class="form-label">شماره تذکره</label>
                        <input type="text" id="tazId" class="form-control @error('tazId') is-invalid @enderror" name="tazId" placeholder="123456" value="{{ old('tazId') }}">
                        @error('tazId') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col mb-3">
                        <label for="passId" class="form-label">شماره پاسپورت</label>
                        <input type="text" id="passId" class="form-control @error('passId') is-invalid @enderror" name="passId" placeholder="5467888" value="{{ old('passId') }}">
                        @error('passId') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col mb-3">
                        <label for="address" class="form-label">آدرس</label>
                        <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" rows="3" placeholder="هرات">{{ old('address') }}</textarea>
                        @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col mb-3">
                        <label for="desc" class="form-label">توضیحات</label>
                        <textarea id="desc" class="form-control @error('desc') is-invalid @enderror" name="desc" rows="3" placeholder="توضیحات">{{ old('desc') }}</textarea>
                        @error('desc') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col text-end">
                        <button type="submit" class="btn btn-primary" name="btn-save">ثبت</button>
                        <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">بستن</button>
                    </div>
                </div>
            </form>
           </div>
       </div>
   </div>
</div>
@endsection
