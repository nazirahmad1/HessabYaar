@extends('./layouts/master-layout')

@section('page_title', 'پروفایل مشتری')

@section('content')


@push('styles')

@endpush



@push('scripts')

<script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/js/components/apexchart-radialbar.js')}}"></script>
<script src="{{asset('assets/js/components/apexchart-radialbar.js')}}"></script>



{{-- apex-column --}}
<script src="{{asset('assets/js/app.js')}}"></script>
<script src="{{asset('assets/js/layout.js')}}"></script>
<script src="{{asset('../cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.0/dayjs.min.js')}}"></script>
<script src="{{asset('../cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.0/plugin/quarterOfYear.min.js')}}"></script>
<script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/js/components/apexchart-column.js')}}"></script>


{{-- apex-mixed --}}
<script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/js/components/apexchart-mixed.js')}}"></script>


{{-- appex-pie --}}
<script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/js/components/apexchart-pie.js')}}"></script>
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
                    <div class="col-lg-6 col-6">
                        <div class="d-flex align-items-center gap-2 border-end">
                            <iconify-icon icon="solar:clock-circle-bold-duotone" class="fs-28 text-primary"></iconify-icon>
                            <div>
                                <h5 class="mb-1">عمر حساب</h5>
                                <p class="mb-0">{{ \Carbon\Carbon::parse($customer->created_at)->diffForHumans()}}</p>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-lg-2 col-6">
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
                    </div> --}}
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

            <div class="row">
                <div class="card">
                    <div class="container text-center mt-5">
                        <h3>Customer Balance Graphs</h3>
                        <canvas id="barChart" width="400" height="200"></canvas>
                        <canvas id="pieChart" width="400" height="200"></canvas>
                        <canvas id="lineChart" width="400" height="200"></canvas>
                    </div>

                </div>
            </div>


            <div class="row">
                <div class="col-xl-9">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title anchor mb-1" id="overview">
                                بررسی کلی
                            </h5>

                            <p class="mb-0"><span class="fw-medium">فایل JS مربوط به نمودار زیر را در محل زیر پیدا کنید:</span> <code> assets/js/components/apexchart-radialbar.js</code></p>
                        </div><!-- end card-body -->
                    </div><!-- end card -->

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4 anchor" id="basic">نمودار رادیا بار پایه</h4>
                            <div dir="ltr">
                                <div id="basic-radialbar" class="apex-charts"></div>
                            </div>
                        </div>
                        <!-- end card body-->
                    </div>
                    <!-- end card -->

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4 anchor" id="multiple">چندین رادیا بار</h4>
                            <div dir="ltr">
                                <div id="multiple-radialbar" class="apex-charts"></div>
                            </div>
                        </div>
                        <!-- end card body-->
                    </div>
                    <!-- end card -->

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4 anchor" id="circle-angle">نمودار دایره‌ای - زاویه سفارشی</h4>
                            <div class="text-center" dir="ltr">
                                <div id="circle-angle-radial" class="apex-charts"></div>
                            </div>
                        </div>
                        <!-- end card body-->
                    </div>
                    <!-- end card -->

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4 anchor" id="image">نمودار دایره‌ای با تصویر</h4>
                            <div dir="ltr">
                                <div id="image-radial" class="apex-charts"></div>
                            </div>
                        </div>
                        <!-- end card body-->
                    </div>
                    <!-- end card -->

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4 anchor" id="stroked-guage">گیج دایره‌ای با خط</h4>
                            <div dir="ltr">
                                <div id="stroked-guage-radial" class="apex-charts"></div>
                            </div>
                        </div>
                        <!-- end card body-->
                    </div>
                    <!-- end card -->

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4 anchor" id="gradient">نمودار دایره‌ای گرادیان</h4>
                            <div dir="ltr">
                                <div id="gradient-chart" class="apex-charts"></div>
                            </div>
                        </div>
                        <!-- end card body-->
                    </div>
                    <!-- end card -->

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4 anchor" id="semi-circle">گیج نیم دایره</h4>
                            <div dir="ltr">
                                <div id="semi-circle-gauge" class="apex-charts"></div>
                            </div>
                        </div>
                        <!-- end card body-->
                    </div>
                    <!-- end card -->
                </div> <!-- end col -->

                <div class="col-xl-3">
                    <div class="card docs-nav">
                        <ul class="nav bg-transparent flex-column">
                            <li class="nav-item">
                                <a href="#overview" class="nav-link">بررسی کلی</a>
                            </li>
                            <li class="nav-item">
                                <a href="#basic" class="nav-link">نمودار رادیا بار پایه</a>
                            </li>
                            <li class="nav-item">
                                <a href="#multiple" class="nav-link">چندین رادیا بار</a>
                            </li>
                            <li class="nav-item">
                                <a href="#circle-angle" class="nav-link">نمودار دایره‌ای - زاویه سفارشی</a>
                            </li>
                            <li class="nav-item">
                                <a href="#image" class="nav-link">نمودار دایره‌ای با تصویر</a>
                            </li>
                            <li class="nav-item">
                                <a href="#stroked-guage" class="nav-link">گیج دایره‌ای با خط</a>
                            </li>
                            <li class="nav-item">
                                <a href="#gradient" class="nav-link">نمودار دایره‌ای گرادیان</a>
                            </li>
                            <li class="nav-item">
                                <a href="#semi-circle" class="nav-link">گیج نیم دایره</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>




 <div class="row">
                        <div class="col-xl-9">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title anchor mb-1" id="overview">
                                        نمای کلی
                                    </h5>
                
                                    <p class="mb-0"><span class="fw-medium">فایل JS مربوط به نمودار زیر را در این آدرس پیدا کنید:</span> <code> assets/js/components/apexchart-column.js</code></p>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title anchor" id="basic">نمودار ستونی پایه</h4>
                                    <div dir="ltr">
                                        <div id="basic-column" class="apex-charts"></div>
                                    </div>
                                </div>
                                <!-- end card body-->
                            </div>
                            <!-- end card -->
                
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-3anchor" id="datalabels">نمودار ستونی با برچسب‌های داده</h4>
                                    <div dir="ltr">
                                        <div id="datalabels-column" class="apex-charts"></div>
                                    </div>
                                </div>
                                <!-- end card body-->
                            </div>
                            <!-- end card -->
                
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title anchor" id="stacked">نمودار ستونی انباشته</h4>
                                    <div dir="ltr">
                                        <div id="stacked-column" class="apex-charts"></div>
                                    </div>
                                </div>
                                <!-- end card body-->
                            </div>
                            <!-- end card -->
                
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title anchor" id="full-stacked">نمودار ستونی 100% انباشته</h4>
                                    <div dir="ltr">
                                        <div id="full-stacked-column" class="apex-charts"></div>
                                    </div>
                                </div>
                                <!-- end card body-->
                            </div>
                            <!-- end card -->
                
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title anchor" id="markers">نمودار ستونی با نشانگرها</h4>
                                    <div dir="ltr">
                                        <div id="column-with-markers" class="apex-charts"></div>
                                    </div>
                                </div>
                                <!-- end card body-->
                            </div>
                            <!-- end card -->
                
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title anchor" id="group">نمودار ستونی با برچسب گروه</h4>
                                    <div dir="ltr">
                                        <div id="column-with-group-label" class="apex-charts"></div>
                                    </div>
                                </div>
                                <!-- end card body-->
                            </div>
                            <!-- end card -->
                
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title anchor" id="rotate-labels">نمودار ستونی با برچسب‌های چرخان و یادداشت‌ها</h4>
                                    <div dir="ltr">
                                        <div id="rotate-labels-column" class="apex-charts"></div>
                                    </div>
                                </div>
                                <!-- end card body-->
                            </div>
                            <!-- end card -->
                
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title anchor" id="negative-value">نمودار ستونی با مقادیر منفی</h4>
                                    <div dir="ltr">
                                        <div id="negative-value-column" class="apex-charts"></div>
                                    </div>
                                </div>
                                <!-- end card body-->
                            </div>
                            <!-- end card -->
                
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title anchor" id="distributed">نمودار ستونی توزیع‌شده</h4>
                                    <div dir="ltr">
                                        <div id="distributed-column" class="apex-charts"></div>
                                    </div>
                                </div>
                                <!-- end card body-->
                            </div>
                            <!-- end card -->
                
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title anchor" id="range">نمودار ستونی محدوده</h4>
                                    <div dir="ltr">
                                        <div id="range-column" class="apex-charts"></div>
                                    </div>
                                </div>
                                <!-- end card body-->
                            </div>
                            <!-- end card -->
                
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex mb-3">
                                        <h4 class="card-title anchor flex-grow-1" id="dynamic">نمودار بارگذاری‌شده پویا</h4>
                                        <div class="flex-shrink-0">
                                            <select id="model" class="form-select form-select-sm">
                                                <option value="iphone5">آیفون 5</option>
                                                <option value="iphone6">آیفون 6</option>
                                                <option value="iphone7">آیفون 7</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div dir="ltr">
                                        <div id="chart-year"></div>
                                    </div>
                                </div>
                                <!-- end card body-->
                            </div>
                            <!-- end card -->
                        </div> <!-- end col -->
                
                        <div class="col-xl-3">
                            <div class="card docs-nav">
                                <ul class="nav bg-transparent flex-column">
                                    <li class="nav-item">
                                        <a href="#overview" class="nav-link">نمای کلی</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#basic" class="nav-link">نمودار ستونی پایه</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#datalabels" class="nav-link">نمودار ستونی با برچسب‌های داده</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#stacked" class="nav-link">نمودار ستونی انباشته</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#full-stacked" class="nav-link">نمودار ستونی 100% انباشته</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#markers" class="nav-link">نمودار ستونی با نشانگرها</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#group" class="nav-link">نمودار ستونی با برچسب گروه</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#rotate-labels" class="nav-link">نمودار ستونی با برچسب‌های چرخان و یادداشت‌ها</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#negative-value" class="nav-link">نمودار ستونی با مقادیر منفی</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#distributed" class="nav-link">نمودار ستونی توزیع‌شده</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#range" class="nav-link">نمودار ستونی محدوده</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#dynamic" class="nav-link">نمودار بارگذاری‌شده پویا</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>


                    {{-- apex-column --}}

                    <div class="row">
                        <div class="col-xl-9">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title anchor mb-1" id="overview">
                                        نمای کلی
                                    </h5>
                
                                    <p class="mb-0"><span class="fw-medium">فایل JS مربوط به نمودار زیر را در این آدرس پیدا کنید:</span> <code> assets/js/components/apexchart-column.js</code></p>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title anchor" id="basic">نمودار ستونی پایه</h4>
                                    <div dir="ltr">
                                        <div id="basic-column" class="apex-charts"></div>
                                    </div>
                                </div>
                                <!-- end card body-->
                            </div>
                            <!-- end card -->
                
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-3anchor" id="datalabels">نمودار ستونی با برچسب‌های داده</h4>
                                    <div dir="ltr">
                                        <div id="datalabels-column" class="apex-charts"></div>
                                    </div>
                                </div>
                                <!-- end card body-->
                            </div>
                            <!-- end card -->
                
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title anchor" id="stacked">نمودار ستونی انباشته</h4>
                                    <div dir="ltr">
                                        <div id="stacked-column" class="apex-charts"></div>
                                    </div>
                                </div>
                                <!-- end card body-->
                            </div>
                            <!-- end card -->
                
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title anchor" id="full-stacked">نمودار ستونی 100% انباشته</h4>
                                    <div dir="ltr">
                                        <div id="full-stacked-column" class="apex-charts"></div>
                                    </div>
                                </div>
                                <!-- end card body-->
                            </div>
                            <!-- end card -->
                
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title anchor" id="markers">نمودار ستونی با نشانگرها</h4>
                                    <div dir="ltr">
                                        <div id="column-with-markers" class="apex-charts"></div>
                                    </div>
                                </div>
                                <!-- end card body-->
                            </div>
                            <!-- end card -->
                
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title anchor" id="group">نمودار ستونی با برچسب گروه</h4>
                                    <div dir="ltr">
                                        <div id="column-with-group-label" class="apex-charts"></div>
                                    </div>
                                </div>
                                <!-- end card body-->
                            </div>
                            <!-- end card -->
                
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title anchor" id="rotate-labels">نمودار ستونی با برچسب‌های چرخان و یادداشت‌ها</h4>
                                    <div dir="ltr">
                                        <div id="rotate-labels-column" class="apex-charts"></div>
                                    </div>
                                </div>
                                <!-- end card body-->
                            </div>
                            <!-- end card -->
                
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title anchor" id="negative-value">نمودار ستونی با مقادیر منفی</h4>
                                    <div dir="ltr">
                                        <div id="negative-value-column" class="apex-charts"></div>
                                    </div>
                                </div>
                                <!-- end card body-->
                            </div>
                            <!-- end card -->
                
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title anchor" id="distributed">نمودار ستونی توزیع‌شده</h4>
                                    <div dir="ltr">
                                        <div id="distributed-column" class="apex-charts"></div>
                                    </div>
                                </div>
                                <!-- end card body-->
                            </div>
                            <!-- end card -->
                
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title anchor" id="range">نمودار ستونی محدوده</h4>
                                    <div dir="ltr">
                                        <div id="range-column" class="apex-charts"></div>
                                    </div>
                                </div>
                                <!-- end card body-->
                            </div>
                            <!-- end card -->
                
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex mb-3">
                                        <h4 class="card-title anchor flex-grow-1" id="dynamic">نمودار بارگذاری‌شده پویا</h4>
                                        <div class="flex-shrink-0">
                                            <select id="model" class="form-select form-select-sm">
                                                <option value="iphone5">آیفون 5</option>
                                                <option value="iphone6">آیفون 6</option>
                                                <option value="iphone7">آیفون 7</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div dir="ltr">
                                        <div id="chart-year"></div>
                                    </div>
                                </div>
                                <!-- end card body-->
                            </div>
                            <!-- end card -->
                        </div> <!-- end col -->
                
                        <div class="col-xl-3">
                            <div class="card docs-nav">
                                <ul class="nav bg-transparent flex-column">
                                    <li class="nav-item">
                                        <a href="#overview" class="nav-link">نمای کلی</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#basic" class="nav-link">نمودار ستونی پایه</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#datalabels" class="nav-link">نمودار ستونی با برچسب‌های داده</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#stacked" class="nav-link">نمودار ستونی انباشته</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#full-stacked" class="nav-link">نمودار ستونی 100% انباشته</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#markers" class="nav-link">نمودار ستونی با نشانگرها</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#group" class="nav-link">نمودار ستونی با برچسب گروه</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#rotate-labels" class="nav-link">نمودار ستونی با برچسب‌های چرخان و یادداشت‌ها</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#negative-value" class="nav-link">نمودار ستونی با مقادیر منفی</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#distributed" class="nav-link">نمودار ستونی توزیع‌شده</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#range" class="nav-link">نمودار ستونی محدوده</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#dynamic" class="nav-link">نمودار بارگذاری‌شده پویا</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>



                    {{-- apex-mixed --}}
                    <div class="row">
                        <div class="col-xl-9">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title anchor mb-1" id="overview">
                                        نمای کلی
                                    </h5>
                
                                    <p class="mb-0"><span class="fw-medium">فایل JS مربوط به نمودار زیر را در آدرس زیر پیدا کنید:</span> <code> assets/js/components/apexchart-mixed.js</code></p>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-3 anchor" id="line-column">نمودار خط و ستونی</h4>
                                    <div dir="ltr">
                                        <div id="line-column-mixed" class="apex-charts"></div>
                                    </div>
                                </div>
                                <!-- end card body-->
                            </div>
                            <!-- end card -->
                
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-3 anchor" id="multiple-yaxis">نمودار چند محور Y</h4>
                                    <div dir="ltr">
                                        <div id="multiple-yaxis-mixed" class="apex-charts"></div>
                                    </div>
                                </div>
                                <!-- end card body-->
                            </div>
                            <!-- end card -->
                
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-3 anchor" id="line-area">نمودار خط و ناحیه</h4>
                                    <div dir="ltr">
                                        <div id="line-area-mixed" class="apex-charts"></div>
                                    </div>
                                </div>
                                <!-- end card body-->
                            </div>
                            <!-- end card -->
                
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-3 anchor" id="all">نمودار خط، ستونی و ناحیه</h4>
                                    <div dir="ltr">
                                        <div id="all-mixed" class="apex-charts"></div>
                                    </div>
                                </div>
                                <!-- end card body-->
                            </div>
                            <!-- end card -->
                        </div> <!-- end col -->
                
                        <div class="col-xl-3">
                            <div class="card docs-nav">
                                <ul class="nav bg-transparent flex-column">
                                    <li class="nav-item">
                                        <a href="#overview" class="nav-link">نمای کلی</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#line-column" class="nav-link">نمودار خط و ستونی</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#multiple-yaxis" class="nav-link">نمودار چند محور Y</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#line-area" class="nav-link">نمودار خط و ناحیه</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#all" class="nav-link">نمودار خط، ستونی و ناحیه</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>


                    {{-- apx-pie  --}}
                    <div class="row">
                        <div class="col-xl-9">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title anchor mb-1" id="overview">
                                        مروری کلی
                                    </h5>
                                    <p class="mb-0"><span class="fw-medium">فایل JS مربوط به نمودار زیر را در آدرس زیر پیدا کنید:</span> <code> resources/js/components/apexchart-pie.js</code></p>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-3  anchor" id="simple_pie">نمودار پای ساده</h4>
                                    <div dir="ltr">
                                        <div id="simple-pie" class="apex-charts"></div>
                                    </div>
                                </div>
                                <!-- end card body-->
                            </div>
                            <!-- end card -->
                
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-3  anchor" id="simple_donut">نمودار دونات ساده</h4>
                                    <div dir="ltr">
                                        <div id="simple-donut" class="apex-charts"></div>
                                    </div>
                                </div>
                                <!-- end card body-->
                            </div>
                            <!-- end card -->
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-3 anchor" id="monochrome">نمودار پای تک رنگ</h4>
                                    <div dir="ltr">
                                        <div id="monochrome-pie" class="apex-charts"></div>
                                    </div>
                                </div>
                                <!-- end card body-->
                            </div>
                            <!-- end card -->
                
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-3 anchor" id="gradient">نمودار دونات گرادیان</h4>
                                    <div dir="ltr">
                                        <div id="gradient-donut" class="apex-charts"></div>
                                    </div>
                                </div>
                                <!-- end card body-->
                            </div>
                            <!-- end card -->
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-3 anchor" id="patterned">نمودار دونات با الگو</h4>
                                    <div dir="ltr">
                                        <div id="patterned-donut" class="apex-charts"></div>
                                    </div>
                                </div>
                                <!-- end card body-->
                            </div>
                            <!-- end card -->
                
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-3 anchor" id="image">نمودار پای با تصویر</h4>
                                    <div dir="ltr">
                                        <div id="image-pie" class="apex-charts"></div>
                                    </div>
                                </div>
                                <!-- end card body-->
                            </div>
                            <!-- end card -->
                
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-3 anchor" id="update">بروزرسانی دونات</h4>
                                    <div dir="ltr">
                                        <div id="update-donut" class="apex-charts"></div>
                                    </div>
                
                                    <div class="text-center mt-2">
                                        <button class="btn btn-sm btn-primary" id="randomize">تصادفی‌سازی</button>
                                        <button class="btn btn-sm btn-primary" id="add">اضافه کردن</button>
                                        <button class="btn btn-sm btn-primary" id="remove">حذف کردن</button>
                                        <button class="btn btn-sm btn-primary" id="reset">بازنشانی</button>
                                    </div>
                
                                </div>
                                <!-- end card body-->
                            </div>
                            <!-- end card -->
                        </div> <!-- end col -->
                
                        <div class="col-xl-3">
                            <div class="card docs-nav">
                                <ul class="nav bg-transparent flex-column">
                                    <li class="nav-item">
                                        <a href="#overview" class="nav-link">مروری کلی</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#simple_pie" class="nav-link">نمودار پای ساده</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#simple_donut" class="nav-link">نمودار دونات ساده</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#monochrome" class="nav-link">نمودار پای تک رنگ</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#gradient" class="nav-link">نمودار دونات گرادیان</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#patterned" class="nav-link">نمودار دونات با الگو</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#image" class="nav-link">نمودار پای با تصویر</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#update" class="nav-link">بروزرسانی دونات</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
           @endsection
