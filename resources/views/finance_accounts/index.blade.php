@extends('./layouts/master-layout')

@section('page_title', 'لیست حسابات')

@section('content')


@push('styles')
 
@endpush



@push('scripts')
<script src="{{ asset('assets/js/myjs/ajaxformsubmit.js') }}"></script>

<script>
 // for add new customer
 $(document).ready(function () {
    $(document).ready(function () {
            ajaxFormSubmit('#addfinanceaccount', "{{ route('finance_accounts.store') }}");
        });
        });


        $(document).ready(function () {
    $("#search").on("keyup", function () {
        let search = $(this).val().trim();

        // Avoid empty requests
        if (search.length === 0) {
            $("#financeTable tbody").html("<tr><td colspan='5' class='text-center'>نتیجه‌ای یافت نشد!</td></tr>");
            return;
        }

        $.ajax({
            url: "{{ route('finance_accounts.index') }}",
            type: "GET",
            data: { search: search },
            dataType: "json",
            success: function (response) {
                let financeAccounts = response.financeAccounts;
                let tableBody = $("#financeTable tbody");
                tableBody.empty();

                if (financeAccounts.length > 0) {
                    financeAccounts.forEach(function (financeAccount) {
                        tableBody.append(
                            `<tr>
                                <td>${financeAccount.id}</td>
                                <td>${financeAccount.account_name}</td>
                                <td>${financeAccount.type}</td>
                                <td>${financeAccount->finance_currency->name}</td>
                                <td>${financeAccount.account}</td>
                                <td>${financeAccount.description}</td>
                                <td>${financeAccount.status}</td>
                                <td>
                                  
                                    </td>
                            </tr>`
                        );
                    });
                } else {
                    tableBody.append("<tr><td colspan='5' class='text-center'>نتیجه‌ای یافت نشد!</td></tr>");
                }
            },
            error: function () {
                console.log("Error fetching search results.");
            }
        });
    });
});

</script>


@endpush
<p class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">فایننس /</span> لیست حسابات فایننس
</p>



<div class="row">
    <div class="col-xl-12">
        <div class="card">

          
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <form id="search-form" method="GET" action="{{ route('finance_accounts.index') }}" class="d-flex align-items-center gap-2">
                            <label for="searchCustomer" class="form-label mb-0">جستجوی حساب:</label>
                            <input type="text" name="search" id="search" class="form-control w-auto" placeholder="برای جستجو..." value="{{ request('search') }}">
                            
                            <button type="submit" class="btn btn-sm btn-primary">
                                جستجو <iconify-icon icon="solar:search" class="align-middle fs-18"></iconify-icon>
                            </button>
                
                            @if(request('search'))
                                <a href="{{ route('finance_accounts.index') }}" class="btn btn-sm btn-secondary">
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
                <h4 class="card-title flex-grow-1">لیست همه حسابات</h4>



                <a type="submit" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                data-bs-target="#exampleModal">
                    حساب جدید
                    {{-- <i class="">+</i> --}}
                    <iconify-icon icon="solar:plus" class="align-middle fs-18"></iconify-icon>
                </a>
            </div>

            <div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0 table-hover table-centered" id="financeTable">
                        <thead class="bg-light-subtle">
                            <tr>
                                <th>آیدی</th>
                                <th>نام حساب</th>
                                <th>نوعیت حساب</th>
                                <th>واحد پولی</th>
                                <th>حساب</th>
                                <th>توضیحات</th>
                                <th>وضعیت</th>
                                <th>عملیه</th>

                            </tr>
                        </thead>

                        <tbody>

                            @if (isset($financeAccounts) && $financeAccounts->isNotEmpty())
                                    @foreach ($financeAccounts as $financeAccount)
                                <tr>
                                   
                                    <td>{{ $financeAccount->id }}</td>
                                    <td>{{ $financeAccount->account_name }}</td>
                                    <td>{{ $financeAccount->type }}</td>
                                    <td>{{ $financeAccount->finance_currency->name }}</td>
                                    <td>{{ $financeAccount->account }}</td>
                                    <td>{{ $financeAccount->description }}</td>
                                    
                                    <td>
                                        @if($financeAccount->status =='1')
                                            <span class="badge bg-success">فعال</span>
                                        @else
                                            <span class="badge bg-danger">غیر فعال</span>
                                        @endif
                                    </td>
                                    <td>
                                           {{-- <div class="d-flex gap-2">
                                               <a href="#!" class="btn btn-soft-primary btn-sm"><iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon></a>
                                              
                                               <form 
                                                method="POST">
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
                                <td colspan="6" class="text-center">هیچ حسابی یافت نشد!</td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                </div>
                <!-- end table-responsive -->
            </div>
            <div class="card-footer border-top">
                <nav aria-label="Page navigation example">

                    @if (isset($financeAccounts) && $financeAccounts->isNotEmpty())
                            <div class="mt-3 d-flex justify-content-center">
                                {{ $financeAccounts->links('pagination::bootstrap-4') }}
                            </div>
                        @endif
                   
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
               <h5 class="modal-title" id="exampleModalLabel">اضافه کردن حساب جدید</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal"
                   aria-label="بستن"></button>
           </div>
           <div class="modal-body">
            <form action="{{ route('finance_accounts.store') }}" method="POST"
            enctype="multipart/form-data" id="addfinanceaccount">
            @csrf
                <div class="row">
                    <div class="col mb-3">
                        <label for="account_name" class="form-label">نام حساب </label>
                        <input type="text" id="account_name"
                            class="form-control @error('account_name') is-invalid @enderror"
                            name="account_name" placeholder="نام حساب را وارد کنید"
                            value="{{ old('account_name') }}">
                        @error('account_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col mb-3">
                        <label for="account_type" class="form-label">نوعیت حساب</label>
                        <select id="account_type" name="account_type"
                            class="form-select @error('account_type') is-invalid @enderror">
                            <option value="">نوعیت حساب را انتخاب کنید</option>
                            <option value="asset">دارایی</option>
                            <option value="liablity">بدهی</option>
                        </select>
                        @error('account_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="currency" class="form-label">واحد پولی</label>
                        <select id="currency" name="currency"
                            class="form-select @error('currency') is-invalid @enderror">
                            <option value="">واحد پولی را انتخاب کنید</option>
                            @foreach ($currencies as $currency)
                                <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                            @endforeach
                        </select>
                        @error('currency')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col mb-3">
                        <label for="firstAsset" class="form-label">مقدار پول</label>
                        <input type="number" id="firstAsset"
                            class="form-control @error('firstAsset') is-invalid @enderror"
                            name="firstAsset" placeholder="230"
                            value="{{ old('firstAsset') }}">
                        @error('firstAsset')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="account" class="form-label">حسابات</label>
                        <select id="account" name="account"
                            class="form-select @error('account') is-invalid @enderror">
                            <option value="">یک حساب را انتخاب کنید</option>
                            <option value="bank">بانک</option>
                            <option value="income">درآمد</option>
                            <option value="expense">مصرف</option>
                        </select>
                        @error('account')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col mb-3">
                        <label for="desc" class="form-label">توضیحات</label>
                        <textarea id="desc" class="form-control @error('desc') is-invalid @enderror" name="desc" rows="3"
                            placeholder="توضیحات">{{ old('desc') }}</textarea>
                        @error('desc')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col text-end">
                            <button type="submit" class="btn btn-primary" name="btn-save">ثبت</button>
                            <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">بستن</button>
                        </div>
                    </div>
                </div>
            </form>
           </div>
       </div>
   </div>
</div>
@endsection
