@extends('./layouts/master-layout')
{{-- href="{{ asset('assets/vendor/fonts/boxicons.css') }}" --}}
@section('page_title', 'لیست رسیدوبرد')

@push('styles')
      <!-- Jalali Picker -->
  <link href="{{asset('assets/css/flatpickr.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/css/flatpicker-rtl.css')}}" rel="stylesheet">
@endpush

@push('scripts')
<script src="{{ asset('assets/js/myjs/myjalalidate.js') }}"></script>
<script src="{{ asset('assets/js/myjs/ajaxformsubmit.js') }}"></script>
<script>


$(document).ready(function() {
            $('#customer').select2({
                placeholder: "مشتری را انتخاب کنید",
                allowClear: true,
                width: '100%' // Ensures it adapts to the form width
            });
        });



$(document).ready(function () {
    $('#currency').on('change', function () {
        const selectedCurrencyId = $(this).val();

        if (selectedCurrencyId) {
            $.ajax({
                url: `/getbanksbycurrencyid/${selectedCurrencyId}`,
                method: 'GET',
                success: function (response) {
                    // Update the bank dropdown
                    const $bankDropdown = $('#bankDropdown');
                    $bankDropdown.empty();
                    $bankDropdown.append('<option value="">بانک را انتخاب کنید</option>');

                    if (response.banks && response.banks.length > 0) {
                        response.banks.forEach(bank => {
                            $bankDropdown.append(`<option value="${bank.id}">${bank.account_name}</option>`);
                        });
                        $bankDropdown.val(response.banks[0].id).change();
                    } else {
                        alert('بانک مربوط به این واحد پولی یافت نشد!');
                    }

                    // Update the currency dropdown
                    const $currencyEqualDropdown = $('#currencyequal');
                    $currencyEqualDropdown.empty();
                    $currencyEqualDropdown.append('<option value="">واحد پول رسید را انتخاب کنید</option>');

                    if (response.financeAccCurrencies) {
                        // Since financeAccCurrencies is a single object, append it directly
                        const currency = response.financeAccCurrencies;
                        $currencyEqualDropdown.append(`<option value="${currency.id}">${currency.name}</option>`);

                        // Automatically select the same currency if it matches the selected currency
                        if (currency.id == selectedCurrencyId) {
                            $currencyEqualDropdown.val(selectedCurrencyId).change();
                        }
                    } else {
                        alert('برای این واحد پولی ،واحد پولی یافت نشد!');
                    }
                },
                error: function () {
                    alert('مشکلی رخ داده است');
                },
            });
        } else {
            // Reset the bank and currencyequal dropdowns
            $('#bankDropdown').empty().append('<option value="">بانک را انتخاب کنید</option>');
            $('#currencyequal').empty().append('<option value="">واحد پول رسید را انتخاب کنید</option>');
        }
    });
});


</script>

<script>
    // for add new customer
    $(document).ready(function () {
               ajaxFormSubmit('#addrasid_bord', "{{ route('rasid_bord.store') }}");
           });
   </script>
@endpush
@section('content')

<p class="fw-bold py-2 mb-4">
    <span class="text-muted fw-light">رسید و برد /</span> لیست رسید و برد
</p>


<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <form id="search-form" method="GET" action="{{ route('rasid_bord.index') }}" class="d-flex align-items-center gap-2">
                            <label for="searchCustomer" class="form-label mb-0">جستجوی رسیدوبرد:</label>
                            <input type="text" name="search" id="search" class="form-control w-auto" placeholder="برای جستجو..." value="{{ request('search') }}">
                            
                            <button type="submit" class="btn btn-sm btn-primary">
                                جستجو <iconify-icon icon="solar:search" class="align-middle fs-18"></iconify-icon>
                            </button>
                
                            @if(request('search'))
                                <a href="{{ route('rasid_bord.index') }}" class="btn btn-sm btn-secondary">
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
                <h4 class="card-title flex-grow-1">لیست همه رسیدوبرد</h4>
                <a type="submit" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                data-bs-target="#exampleModal">
                    رسید وبرد جدید
                    <i class="">+</i>
                    {{-- <iconify-icon icon="solar:plus" class="align-middle fs-18"></iconify-icon> --}}
                </a>
            </div>

            <div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0 table-hover table-centered" id="customerTable">
                        <thead class="bg-light-subtle">
                            <tr>
                                <th>نمبر چک</th>
                                <th>رسیدوبرد</th>
                                <th>نام مشتری</th>
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
                                <td>{{ $transaction->customer->name ?? "وجود ندارد"}}</td>
                                {{-- <td> --}}
                                    {{-- {{ $transaction->amount }}
                                    {{$transaction->tr_currency->name}} از 
                                    {{$transaction->bank_account->account_name}}</span>
                                                <span v-else>{{ $transaction->finance_account?.account_name}}</span> --}}
                                                
                                {{-- </td> --}}
                                <td>{{$transaction->amount}} {{$transaction->tr_currency->name}} از 
                                    @if($transaction->bank_account!=null)
    
                                    {{$transaction->bank_account->account_name}}
    
                                    @else
                                    {{ $transaction->finance_account->account_name}}
                                    @endif
                                    </td>
                                {{-- <td>{{ $transaction->currency }}</td> --}}
                                <td>
                                    {{$transaction->amount_equal}} {{$transaction->eq_currency->name}}
    
                                    به 
                                        @if($transaction->bank_account!=null)
                                        {{$transaction->bank_account->account_name}}
                                        @else
                                    {{-- {{ $transaction->finance_account->account_name}} --}}
                                    {{ $transaction->bank_account->account_name }} 
                                    @endif
                                </td>
                                {{-- <td>{{ $transaction->currency_equal }}</td> --}}
                                {{-- <td>{{ $transaction->desc }}</td> --}}
                                <td>{{ $transaction->date }}</td>
                                {{-- <td>{{ $transaction->finance_acount_id }}</td> --}}
                                {{-- <td>{{ $transaction->bank_id }}</td> --}}
                                {{-- <td>{{ $transaction->state }}</td> --}}
                                <td>{{ $transaction->user->name }}</td>
    
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




   <!-- Modal -->
   <div class="modal fade" id="exampleModal" tabindex="-1"
   aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">رسید و برد جدید</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal"
                   aria-label="بستن"></button>
           </div>
           <div class="modal-body">
           
            <form action="{{ route('rasid_bord.store') }}" method="POST" id="addrasid_bord">
                @csrf

                <div>
                  
                    <div class="row">
                        <div class="col-md-6">
                            <label for="rasidbord">رسیدوبرد:</label>
                            <select class="form-control form-control  required" 
                            name="rasid_bord" value="{{ old('rasid_bord') }}" id="rasidbord">
                                <option disabled value="">ابتدا نوعیت را انتخاب کنید.</option>
                                <option value="rasid">رسید</option>
                                <option value="bord">برد</option>
                            </select>
                            @error('rasid_bord')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-1">
                            <label for="customer">انتخاب مشتری:</label>
                            <select id="customer" name="customer" class="select2
                            form-select" aria-label="انتخاب مشتری" value="{{ old('customer') }}">
                                <option value="" selected disabled>مشتری را انتخاب کنید</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}"
                                        {{ old('customer') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('customer')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                   <div class="row">
                         <div class="col mb-1">
                            <label for="currency" class="form-label">واحد پول</label>
                            <select id="currency" name="currency"
                            class="form-select @error('currency') is-invalid @enderror"
                            value="{{ old('currency') }}">
                            <option value="">واحد پول را انتخاب کنید</option>
                            @foreach ($currencies as $currency)
                            <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                        @endforeach
                        </select>
                            @error('currency')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col mb-1">
                            <label for="amount" class="form-label">مبلغ</label>
                            <input type="number" id="amount" class="form-control @error('amount') is-invalid @enderror"
                                   name="amount" placeholder="0" value="{{ old('amount') }}">
                            @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Dakhl -->
                    <div class="row">
                        <div class="col mb-1">
                            <label for="bankDropdown" class="form-label">بانک</label>
                            <select id="bankDropdown" name="bank_id" class="form-select"  @error('bank_id') is-invalid @enderror" value="{{ old('bank_id') }}">
                                <option value="">بانک را انتخاب کنید</option>
                                @foreach ($banks  as $bank)
                                    <option value="{{ $bank->id }}">{{ $bank->account_name }}</option>
                                @endforeach
                            </select>
                            @error('bank_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-1">
                            <label for="rate" class="form-label">نرخ ارز</label>
                            <input type="number" step="0.0001" id="rate" class="form-control @error('rate') is-invalid @enderror"
                            name="rate" placeholder="0" value="{{ old('rate') }}">
                            @error('rate')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col mb-1">
                            <label for="date" class="form-label">تاریخ</label>
                            <input type="date" id="basic-datepicker"
                            class="form-control  placeholder="تاریخ انتخاب اولیه" name="date" id="date"
                              old="{{old('date')}}" required>
                            
                            @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">

                        <div class="col mb-1">
                           <label for="currencyequal" class="form-label">واحد پول رسید</label>
                           <select id="currencyequal" name="currencyequal"
                           class="form-select @error('currencyequal') is-invalid @enderror"
                           value="{{ old('currencyequal') }}">
                           <option value="">واحد پول رسید را انتخاب کنید</option>
                           @foreach ($currencies as $currency)
                           <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                       @endforeach
                       </select>
                           @error('currencyequal')
                           <div class="invalid-feedback">{{ $message }}</div>
                           @enderror
                       </div>
                       <div class="col mb-1">
                           <label for="amountequal" class="form-label">مبلغ</label>
                           <input type="number" id="amountequal" class="form-control @error('amountequal') is-invalid @enderror"
                                  name="amountequal" placeholder="0" value="{{ old('amountequal') }}">
                           @error('amountequal')
                           <div class="invalid-feedback">{{ $message }}</div>
                           @enderror
                       </div>
                   </div>
                    <div class="row">
                        <div class="col mb-1">
                            <label for="desc" class="form-label">توضیحات</label>
                            <textarea id="desc" class="form-control @error('desc') is-invalid @enderror"
                                      name="desc" rows="3" placeholder="توضیحات">{{ old('desc') }}</textarea>
                            @error('desc')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mt-3">


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
