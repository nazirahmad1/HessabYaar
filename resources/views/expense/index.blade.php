@extends('./layouts/master-layout')

@section('page_title', 'لیست مصارف')


@push('styles')
      <!-- Jalali Picker -->
  {{-- <link href="{{asset('assets/css/flatpickr.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/css/flatpicker-rtl.css')}}" rel="stylesheet"> --}}
@endpush

@push('scripts')
{{-- <script src="{{ asset('assets/js/myjs/jquery.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/js/myjs/myjalalidate.js') }}"></script> --}}


<script>


$(document).ready(function () {
    $('#financeAccount').on('change', function () {
        const accountId = $(this).val();

        if (accountId) {
            $.ajax({
                url: `/finance_acc_with_currency/${accountId}`,
                method: 'GET',
                success: function (response) {
                    if (response.financeAccCurrencies && response.banks) {
                        // Set the currency dropdown
                        const currencyId = response.financeAccCurrencies.id;
                        $('#currency').val(currencyId).change();

                        // Find the first bank with the matching currency ID
                        const matchingBank = response.banks.find(bank => bank.currency === currencyId);
                        if (matchingBank) {
                            $('#bankDropdown').val(matchingBank.id).change();
                        } else {
                            $('#bankDropdown').val('').change(); // Clear if no match
                        }
                    } else {
                        alert('No currency or bank data found for the selected account.');
                    }
                },
                error: function () {
                    alert('An error occurred while fetching account details.');
                },
            });
        } else {
            // Reset dependent dropdowns
            $('#currency').val('').change();
            $('#bankDropdown').val('').change();
        }
    });

   
    $('#expenseform').submit(function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        let submitButton = $(this).find('button[type="submit"]');

        // Disable the submit button and change text
        submitButton.prop("disabled", true).text("در حال ثبت...");

        $.ajax({
            type: 'POST',
            url: "{{ route('expense.store')}}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.type === "success") {
                    $('#exampleModal').modal('hide'); // Hide modal on success
                    $('#expenseform').trigger("reset");
                    toastr.success(data.msg); // Show success toast
                    location.reload();
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $(formSelector).find('.invalid-feedback').remove(); // Remove old validation messages
                    $(formSelector).find('.is-invalid').removeClass('is-invalid'); // Reset invalid fields

                    $.each(errors, function (field, messages) {
                        let input = $(`[name="${field}"]`);
                        input.addClass('is-invalid');
                        input.after(`<div class="invalid-feedback">${messages[0]}</div>`);
                    });

                    toastr.error("لطفاً خطاهای ورودی را بررسی کنید."); // Show error toast
                } else {
                    toastr.error("خطایی رخ داده است. لطفاً دوباره تلاش کنید."); // General error
                }
            },
            complete: function () {
                // Re-enable button after request completes
                submitButton.prop("disabled", false).text("ثبت");
            }
        });
    });

    $("#search").on("keyup", function () {
        let search = $(this).val().trim();

        // Avoid empty requests
        if (search.length === 0) {
            $("#expenseTable tbody").html("<tr><td colspan='5' class='text-center'>نتیجه‌ای یافت نشد!</td></tr>");
            return;
        }

        $.ajax({
            url: "{{ route('expense.index') }}",
            type: "GET",
            data: { search: search },
            dataType: "json",
            success: function (response) {
                let expenses = response.expenses;
                let tableBody = $("#expenseTable tbody");
                tableBody.empty();

                if (expenses.length > 0) {
                    expenses.forEach(function (expense) {
                        tableBody.append(
                            `<tr>
                                <td>${expense.id}</td>
                                <td>${expense.date}</td>
                                <td>${expense.expense_acount.account_name}</td>
                                <td>${$expense.type}</td>
                                <td>${ $expense.amount} ${ $expense.expense_currency.name }</td>
                                <td>${ $expense.desc }</td>
                                <td>${ $expense.user.name }</td>
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
@section('content')

<p class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">مصارف /</span> لیست مصارف
</p>



<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <form id="search-form" method="GET" action="{{ route('expense.index') }}" class="d-flex align-items-center gap-2">
                            <label for="searchCustomer" class="form-label mb-0">جستجوی مصرف:</label>
                            <input type="text" name="search" id="search" class="form-control w-auto" placeholder="برای جستجو..." value="{{ request('search') }}">
                            
                            <button type="submit" class="btn btn-sm btn-primary">
                                جستجو <iconify-icon icon="solar:search" class="align-middle fs-18"></iconify-icon>
                            </button>
                
                            @if(request('search'))
                                <a href="{{ route('expense.index') }}" class="btn btn-sm btn-secondary">
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
                <h4 class="card-title flex-grow-1">لیست همه مشتریان</h4>
                <a type="submit" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                data-bs-target="#exampleModal">
                    مصرف جدید
                    {{-- <i class="">+</i> --}}
                    {{-- <iconify-icon icon="solar:plus" class="align-middle fs-18"></iconify-icon> --}}
                    <i class="bx bx-plus"></i>
                </a>
            </div>

            <div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0 table-hover table-centered" id="expenseTable">
                        <thead class="bg-light-subtle">
                            <tr>
                                <th>آیدی</th>
                                <th>تاریخ</th>
                                <th>حساب</th>
                                <th>نوع</th>
                                <th>مقدار پول</th>
                                <th>تفصیلات</th>
                                <th>توسط</th>
                                {{-- <th>وضعیت</th> --}}
                                {{-- <th>عملیه</th> --}}

                            </tr>
                        </thead>

                        <tbody>

                            @if(isset($expenses) && $expenses->isNotEmpty())
                            @foreach($expenses as $expense)
                                <tr>
                                    <td>{{ $expense->id }}</td>
                                    <td>{{ $expense->date }}</td>
                                    <td> {{$expense->expense_acount->account_name}}</td>
                                    {{-- <td>{{ $expense->account_name }}</td> --}}
                                    <td>{{ $expense->type ? "مصرف" :"" }}</td>
                                    <td>{{ $expense->amount }} {{ $expense->expense_currency->name }}
    
                                         از {{$expense->expense_bank->account_name}}
                                    </td>
                                    <td>{{ $expense->desc }}</td>
                                    <td>{{ $expense->user->name ?? "وجود ندارد"}}</td>
                                    {{-- <td>{{ $expense->bank_id }}</td> --}}
                                    {{-- <td>
                                        @if($expense->status == '1')
                                            <span class="badge bg-success">فعال</span>
                                        @else
                                            <span class="badge bg-danger">غیر فعال</span>
                                        @endif
                                    </td> --}}
                                    {{-- <td>
                                       
                                            <form 
                                             method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a herf="#!" class="btn btn-soft-primary btn-sm"  onclick="return confirm('آیا برای حذف مطمئن استید؟');" >
                                                <iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon>
                                            </a>
                                        </form>
                                        </div>
                                    </td> --}}
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">هیچ مصرفی یافت نشد!</td>
                            </tr>
                        @endif

                        </tbody>
                    </table>

                </div>
                <!-- end table-responsive -->
            </div>
            <div class="card-footer border-top">
                <nav aria-label="Page navigation example">

                    @if(isset($expenses) && $expenses->isNotEmpty())
                <div class="mt-3 d-flex justify-content-center">
                    {{ $expenses->links('pagination::bootstrap-4') }}
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
               <h5 class="modal-title" id="exampleModalLabel">اضافه کردن مصرف جدید</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal"
                   aria-label="بستن"></button>
           </div>
           <div class="modal-body"><form action="{{ route('expense.store') }}"
             method="POST" id="expenseform">
                @csrf
                {{-- <h5>اضافه کردن مصرف جدید :</h5> --}}

                <div>
                    <!-- Name and Lastname -->
                    <div class="row">
                        <div class="col">
                            <label for="financeAccount" class="form-label">انتخاب حساب:</label>
                            <select id="financeAccount" name="financeAccount"
                            class="form-select @error('financeAccount') is-invalid @enderror">
                            value="{{ old('financeAccount') }}">
                            <option value="">حساب را انتخاب کنید</option>
                            @foreach ($financeAccounts as $financeAccount)
                            <option value="{{ $financeAccount->id }}">{{ $financeAccount->account_name }}</option>
                        @endforeach
                        </select>
                            @error('financeAccount')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>


                    <div class="row">
                        <div class="col mb-3">
                            <label for="amount" class="form-label">مبلغ</label>
                            <input type="number" id="amount" class="form-control @error('amount') is-invalid @enderror"
                                   name="amount" placeholder="5000" value="{{ old('amount') }}">
                            @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                         <div class="col mb-3">
                            <label for="email" class="form-label">واحد پول</label>
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

                    </div>

                    <!-- Dakhl -->
                    <div class="row">
                        <div class="col mb-3">
                            <label for="bankDropdown" class="form-label">بانک</label>
                            <select id="bankDropdown" name="bank_id" class="form-select"  @error('bank_id') is-invalid @enderror">
                                <option value="">بانک را انتخاب کنید</option>
                                @foreach ($banks  as $bank)
                                    <option value="{{ $bank->id }}">{{ $bank->account_name }}</option>
                                @endforeach
                            </select>
                            @error('bank_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                         <div class="col mb-3">
                            <label for="date" class="form-label">تاریخ</label>
                            <input type="date" 
                            class="form-control" placeholder="تاریخ انتخاب را انتخاب کنید" name="date" id="date"
                              old="{{old('date')}}">
                            @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="row">
                        <div class="col mb-3">
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
