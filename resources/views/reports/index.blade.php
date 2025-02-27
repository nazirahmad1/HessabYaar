@extends('./layouts/master-layout')

@section('page_title', 'گزارشات بانک ها')

@section('content')


@push('styles')

@endpush



@push('scripts')


<script>
 
</script>


@endpush
<p class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">گزارشات بانک ها /</span> لیست گزارشات بانک ها
</p>



<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="avatar-md bg-primary bg-opacity-10 rounded">
                        <iconify-icon icon="solar:users-group-two-rounded-bold-duotone" class="fs-32 text-primary avatar-title"></iconify-icon>
                    </div>
                    <div>
                        <h5 class="mb-0">تعداد حسابات</h5>
                        {{-- <p class="text-muted fw-medium">تعداد حسابات</p> --}}

                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <p class="text-muted fw-medium fs-22 mb-0">{{ $financeAcc_count }}</p>
                    <div>
                        <span class="badge text-success bg-success-subtle fs-12"><i class="bx bx-up-arrow-alt"></i>34.4%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="avatar-md bg-primary bg-opacity-10 rounded">
                        <iconify-icon icon="solar:box-bold-duotone" class="fs-32 text-primary avatar-title"></iconify-icon>
                    </div>
                    <div>
                        <h5 class="mb-0">تعداد واحدات پولی</h5>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <p class="text-muted fw-medium fs-22 mb-0">{{ $currency_counts }}</p>
                    <div>
                        <span class="badge text-danger bg-danger-subtle fs-12"><i class="bx bx-down-arrow-alt"></i>8.1%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="avatar-md bg-primary bg-opacity-10 rounded">
                        <iconify-icon icon="solar:headphones-round-sound-bold-duotone" class="fs-32 text-primary avatar-title"></iconify-icon>
                    </div>
                    <div>
                        <h5 class="mb-0">درخواست خدمات</h5>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <p class="text-muted fw-medium fs-22 mb-0">+1.03k</p>
                    <div>
                        <span class="badge text-success bg-success-subtle fs-12"><i class="bx bx-up-arrow-alt"></i>12.6%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="avatar-md bg-primary bg-opacity-10 rounded">
                        <iconify-icon icon="solar:bill-list-bold-duotone" class="fs-32 text-primary avatar-title"></iconify-icon>
                    </div>
                    <div>
                        <h5 class="mb-0">تمام سرمایه</h5>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <p class="text-muted fw-medium fs-22 mb-0">$38,908.00</p>
                    <div>
                        <span class="badge text-success bg-success-subtle fs-12"><i class="bx bx-up-arrow-alt"></i>45.9%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

  <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center gap-1">
                <h4 class="card-title badge font-size-20 text-center text-black-50">بیلانس</h4>
            </div>
            <div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0 table-hover table-centered" >
                        <thead class="bg-light-subtle">
                            <tr>
                                <th>واحد</th>
                                <th>کل رسید</th>
                                <th>کل برداشتها</th>
                                <th>بیلانس</th>

                            </tr>
                        </thead>

                        <tbody>

                            @if(isset($allbalances))
                            @foreach($allbalances as $balance)
                            <tr>
                                <td>{{ $balance['currency'] }}</td>
                                <td>
                                    <span class="badge font-size-11 {{ $balance['rasid'] > 0 ? 'bg-success' : 'bg-danger' }}">
                                        {{ number_format($balance['rasid']) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge font-size-11 {{ $balance['bord'] > 0 ? 'bg-success' : 'bg-danger' }}">
                                        {{ number_format($balance['bord']) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge font-size-11 {{ $balance['balance'] > 0 ? 'bg-success' : 'bg-danger' }}">
                                        {{ number_format($balance['balance']) }}
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
            {{-- <div class="card-footer border-top">
                <nav aria-label="Page navigation example">

                    @if(isset($allbalances))
                    <div class="mt-3 d-flex justify-content-center">
                        {{ $allbalances->links('pagination::bootstrap-5') }}
                    </div>
                    @endif
                    
                </nav>
            </div> --}}
        </div>
    </div>

      
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <form id="search-form" method="GET" action="{{ route('banksreport.index') }}" class="d-flex align-items-center gap-2">
                            <label for="searchCustomer" class="form-label mb-0">جستجوی گزارشات:</label>
                            <input type="text" name="search" id="search" class="form-control w-auto" placeholder="برای جستجو..." value="{{ request('search') }}">
                            
                            <button type="submit" class="btn btn-sm btn-primary">
                                جستجو <iconify-icon icon="solar:search" class="align-middle fs-18"></iconify-icon>
                            </button>
                
                            @if(request('search'))
                                <a href="{{ route('banksreport.index') }}" class="btn btn-sm btn-secondary">
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
                <h4 class="card-title mb-4">جدول بانک ها</h4>
            </div>

            <div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0 table-hover table-centered" id="customerTable">
                        <thead class="bg-light-subtle">
                            <tr>
                                <th class="align-middle">آیدی</th>
                                <th class="align-middle">نام حساب</th>
                                <th class="align-middle">واحدات پولی</th>
                                <th class="align-middle">تمام رسیدها</th>
                                <th class="align-middle">تمام بردها</th>
                                <th class="align-middle">بیلانس</th>
                                <th class="align-middle">جزئیات</th>
    
                            </tr>
                        </thead>
    
                        <tbody>
                            @if(isset($bank_balance) && $bank_balance->isNotEmpty())
                            @foreach($bank_balance as $bank)
                                <tr>
                                    <td>{{ $bank['id'] }}</td>
                                    <td>{{ $bank['account_name'] }}</td>
                                    <td>{{ $bank['currencyname'] }}</td>
                                    <td>
                                        <span class="badge font-size-13 {{ $bank['total_rasid'] > 0 ? 'bg-success' : 'bg-warning' }}">
                                            {{ number_format($bank['total_rasid']) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge font-size-13 {{ $bank['total_bord'] > 0 ? 'bg-danger' : 'bg-warning' }}">
                                            {{ number_format($bank['total_bord']) }}
                                        </span>
                                    </td>
                                    <td style="direction:rtl !important">
                                        <span class="badge font-size-13 {{ $bank['blance'] > 0 ? 'bg-success' : ($bank['blance'] === 0 ? 'bg-warning' : 'bg-danger') }}">
                                            {{ number_format($bank['blance']) }}
                                        </span>
                                    </td>
                                    <td>

                                        <a href="{{ route('reports.bankdetails',  $bank->id) }}" class="">
                                            {{-- <a href="{{ route('reports.bankdetails', $bank->id) }}"> --}}

                                            <iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                               @else
                    <tr>
                        <td colspan="6" class="text-center">هیچ بانکی یافت نشد!</td>
                    </tr>
                @endif
                        </tbody>
                    </table>
    
                </div>
                <!-- end table-responsive -->
            </div>
            <div class="card-footer border-top">
                <nav aria-label="Page navigation example">
                    @if(isset($bank_balance) && $bank_balance->isNotEmpty())
                    <div class="mt-3 d-flex justify-content-center">
                        {{ $bank_balance->links('pagination::bootstrap-4') }}
                    </div>
                @endif
                    
                </nav>
            </div>
        </div>
    </div>

@endsection
