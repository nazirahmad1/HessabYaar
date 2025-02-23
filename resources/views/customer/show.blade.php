@extends('./layouts/master-layout')

@section('page_title', 'پروفایل مشتری')

@section('content')


@push('styles')

@endpush



@push('scripts')
<script>

</script>


@endpush
 <div class="row">
    <div class="col-xl-9 col-lg-8">
        <div class="card overflow-hidden">
            <div class="card-body">
                <div class="bg-primary profile-bg rounded-top position-relative mx-n3 mt-n3">
                    {{-- @if(isset($customer->image))
                    <img src=" {{ asset($customer->image) }}" alt="Uploaded Image" id="uploadedImage" class="d-block rounded" height="100" width="100">
                    @else --}}
                      <img src="{{asset('images/users/avatar-1.jpg')}}" alt="" class="avatar-xl border border-light border-3 rounded-circle position-absolute top-100 start-0 translate-middle ms-5"
                    {{-- @endif --}}
                  >
                </div>
                <div class="mt-5 d-flex flex-wrap align-items-center justify-content-between">
                    <div>
                        <h4 class="mb-1"> <span>{{$customer->name}} {{$customer->lastname}}</span><i class='bx bxs-badge-check text-success align-middle'></i></h4>
                        <p class="mb-0 fs-14"><span class="badge bg-success ms-1">مشتری</span></p>
                    </div>
                    <div class="d-flex align-items-center gap-2 my-2 my-lg-0">
                        
                        {{-- <a href="#!" class="btn btn-outline-primary"><i class="bx bx-plus"></i> دنبال‌کردن</a> --}}
                       
                    </div>
                </div>
                <div class="row mt-3 gy-2">
                    <div class="col-lg-2 col-6">
                        <div class="d-flex align-items-center gap-2 border-end">
                            <iconify-icon icon="solar:clock-circle-bold-duotone" class="fs-28 text-primary"></iconify-icon>
                            <div>
                                <h5 class="mb-1">عمر حساب</h5>
                                <p class="mb-0">{{$customer->created_at}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-6">
                        <div class="d-flex align-items-center gap-2 border-end">
                            <iconify-icon icon="solar:cup-star-bold-duotone" class="fs-28 text-primary"></iconify-icon>
                            <div>
                                <h5 class="mb-1">5 گواهی</h5>
                                <p class="mb-0">دریافت شده</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-6">
                        <div class="d-flex align-items-center gap-2">
                            <iconify-icon icon="solar:notebook-bold-duotone" class="fs-28 text-primary"></iconify-icon>
                            <div>
                                <h5 class="mb-1">2 کارآموزی</h5>
                                <p class="mb-0">تکمیل شده</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">اطلاعات شخصی</h4>
            </div>
            <div class="card-body">
                <div>
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <div class="avatar-sm bg-light d-flex align-items-center justify-content-center rounded">
                            <iconify-icon icon="solar:backpack-bold-duotone" class="fs-20 text-secondary"></iconify-icon>
                        </div>
                        <p class="mb-0 fs-14">مشتری</p>
                    </div>
                  
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <div class="avatar-sm bg-light d-flex align-items-center justify-content-center rounded">
                            <iconify-icon icon="solar:map-point-bold-duotone" class="fs-20 text-secondary"></iconify-icon>
                        </div>
                        <p class="mb-0 fs-14">محل زندگی: <span class="text-dark fw-semibold">
                            {{$customer->address}}
                            </span></p>
                    </div>
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <div class="avatar-sm bg-light d-flex align-items-center justify-content-center rounded">
                            <iconify-icon icon="solar:users-group-rounded-bold-duotone" class="fs-20 text-secondary"></iconify-icon>
                        </div>
                        <p class="mb-0 fs-14">شماره تماس: <div class="text-dark fw-semibold">{{$customer->phone}}</div></p>
                    </div>
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <div class="avatar-sm bg-light d-flex align-items-center justify-content-center rounded">
                            <iconify-icon icon="solar:letter-bold-duotone" class="fs-20 text-secondary"></iconify-icon>
                        </div>
                        <p class="mb-0 fs-14">ایمیل: <a href="#!" class="text-primary fw-semibold">{{$customer->email}}</a></p>
                    </div>
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <div class="avatar-sm bg-light d-flex align-items-center justify-content-center rounded">
                            <iconify-icon icon="solar:link-bold-duotone" class="fs-20 text-secondary"></iconify-icon>
                        </div>
                        <p class="mb-0 fs-14">تذکره:<span class="fw-semibold">{{$customer->tazId}}</span></p>
                    </div>
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <div class="avatar-sm bg-light d-flex align-items-center justify-content-center rounded">
                            <iconify-icon icon="solar:global-bold-duotone" class="fs-20 text-secondary"></iconify-icon>
                        </div>
                        <p class="mb-0 fs-14">پاسپورت: <span class="text-dark fw-semibold">{{$customer->passId}}</span></p>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <div class="avatar-sm bg-light d-flex align-items-center justify-content-center rounded">
                            <iconify-icon icon="solar:check-circle-bold-duotone" class="fs-20 text-secondary"></iconify-icon>
                        </div>
                        <p class="mb-0 fs-14">وضعیت: <span class="badge bg-success-subtle text-success ms-1">
                            {{$customer->status==1 ? 'فعال':'غیرفعال'}}
                            </span></p>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>

      <div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <form id="search-form" method="GET" action="{{ route('customer.show',$customer->id) }}" class="d-flex align-items-center gap-2">
                            <label for="searchCustomer" class="form-label mb-0">جستجوی رسیدوبرد:</label>
                            <input type="text" name="search" id="search" class="form-control w-auto" placeholder="برای جستجو..." value="{{ request('search') }}">
                            
                            <button type="submit" class="btn btn-sm btn-primary">
                                جستجو <iconify-icon icon="solar:search" class="align-middle fs-18"></iconify-icon>
                            </button>
                
                            @if(request('search'))
                                <a href="{{ route('customer.show',$customer->id) }}" class="btn btn-sm btn-secondary">
                                    نمایش همه <iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon>
                                </a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center gap-1">
                <h4 class="card-title flex-grow-1">لیست همه رسیدوبرد های مشتری</h4>
               
            </div>

            <div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0 table-hover table-centered" id="customerTable">
                        <thead class="bg-light-subtle">
                            <tr>
                                <th>نمبر چک</th>
                                <th>رسیدوبرد</th>
                                {{-- <th>نام مشتری</th> --}}
                                <th>مقدار پول</th>
                                <th>مقدار معادل</th>
                                {{-- <th>توضیحات</th> --}}
                                {{-- <th>حساب فایننس</th> --}}
                                {{-- <th>بانک</th> --}}
                                <th>تاریخ</th>
                                <th>کاربر</th>
                                <th>عملیه</th>
                            </tr>
                        </thead>
    
                        <tbody>
    
                            @if(isset($transactions) && $transactions->isNotEmpty())
                            @foreach($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->check_number }}</td>

                                <td>
                                    @if($transaction->rasid_bord === 'rasid')
                                    <span class="badge bg-success">رسید</span>
                                @else
                                    <span class="badge bg-danger">برد</span>
                                @endif
                                </td>
                                {{-- <td>{{ $transaction->customer->name }}</td> --}}
                                <td>{{ $transaction->amount }}</td>
                                {{-- <td>{{ $transaction->currency }}</td> --}}
                                <td>{{ $transaction->amount_equal }}</td>
                                {{-- <td>{{ $transaction->currency_equal }}</td> --}}
                                {{-- <td>{{ $transaction->desc }}</td> --}}
                                <td>{{ $transaction->date }}</td>
                                {{-- <td>{{ $transaction->finance_acount_id }}</td> --}}
                                {{-- <td>{{ $transaction->bank_id }}</td> --}}
                                {{-- <td>{{ $transaction->state }}</td> --}}
                                <td>{{ $transaction->user_id }}</td>
    
                                
                                <td>
                                    {{-- <div class="d-flex gap-2">
                                        <a href="#!" class="btn btn-soft-primary btn-sm"><iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon></a>
                                       <a href="#!" class="btn btn-soft-danger btn-sm"><iconify-icon icon="solar:trash-bin-minimalistic-2-broken"
                                         class="align-middle fs-18"></iconify-icon></a>

                                        <form action="{{ route('rasid_bord.destroy', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a herf="#!" class="btn btn-soft-primary btn-sm"  onclick="return confirm('آیا برای حذف مطمئن استید؟');" >
                                            <iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon>
                                        </a>
                                    </form>
                                    </div> --}}
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">هیچ تراکنشی یافت نشد!</td>
    
                            </tr>
                        @endif
    
                        </tbody>
                    </table>
    
                </div>
                <!-- end table-responsive -->
            </div>
            <div class="card-footer border-top">
                <nav aria-label="Page navigation example">
                    @if(isset($transactions) && $transactions->isNotEmpty())
                    <div class="mt-3 d-flex justify-content-center">
                        {{ $transactions->links('pagination::bootstrap-4') }}
                    </div>
                    @endif
                    
                </nav>
            </div>
        </div>
    </div>

       </div>



       <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form id="search-form" method="GET" action="{{ route('customer.show',$customer->id) }}" class="d-flex align-items-center gap-2">
                                <label for="searchCustomer" class="form-label mb-0">جستجوی بیلانس:</label>
                                <input type="text" name="search" id="search" class="form-control w-auto" placeholder="برای جستجو..." 
                                value="{{ request('search') }}">
                                
                                <button type="submit" class="btn btn-sm btn-primary">
                                    جستجو <iconify-icon icon="solar:search" class="align-middle fs-18"></iconify-icon>
                                </button>
                    
                                @if(request('search'))
                                    <a href="{{ route('customer.show',$customer->id) }}" class="btn btn-sm btn-secondary">
                                        نمایش همه <iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon>
                                    </a>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center gap-1">
                    <h4 class="card-title flex-grow-1">بیلانس</h4>
                   
                </div>
    
                <div>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0 table-hover table-centered" id="customerTable">
                            <thead class="bg-light-subtle">
                                <tr>
                                    <th>واحد</th>
                                    <th>رسیدها</th>
                                    <th>برداشت ها</th>
                                    <th>بیلانس</th>
                                </tr>
                            </thead>
        
                            <tbody>
        
                                @if(isset($customerBalance))
                                @foreach ($customerBalance as $currencyName => $currency)
                                <tr>
                                    <td>{{ $currencyName }}</td>
                                    <td>
                                        <span class="badge font-size-13 {{ $currency['rasid'] > 0 ? 'bg-success' : 'bg-danger' }}">
                                            {{ number_format($currency['rasid']) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge font-size-13 {{ $currency['bord'] > 0 ? 'bg-success' : 'bg-danger' }}">
                                            {{ number_format($currency['bord']) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge font-size-13 {{ $currency['balance'] > 0 ? 'bg-success' : 'bg-danger text-left' }}">
                                            {{ number_format($currency['balance']) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center">هیچ بیلانسی یافت نشد!</td>
        
                                </tr>
                            @endif
        
                            </tbody>
                        </table>
        
                    </div>
                    <!-- end table-responsive -->
                </div>
                <div class="card-footer border-top">
                    <nav aria-label="Page navigation example">
                        @if(isset($transactions) && $transactions->isNotEmpty())
                        <div class="mt-3 d-flex justify-content-center">
                            {{ $transactions->links('pagination::bootstrap-4') }}
                        </div>
                        @endif
                        
                    </nav>
                </div>
            </div>
        </div>
    
           </div>
@endsection
