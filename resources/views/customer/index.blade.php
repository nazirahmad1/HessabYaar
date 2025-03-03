@extends('./layouts/master-layout')

@section('page_title', 'لیست مشتریان')

@section('content')


@push('styles')
<!-- Jalali Picker -->
     <link href="{{asset('assets/jalali-date/flatpickr.min.css')}}" rel="stylesheet">
     <link href="{{asset('assets/jalali-date/flatpicker-rtl.css')}}" rel="stylesheet">

@endpush

@push('scripts')

<script src="{{ asset('assets/js/myjs/ajaxformsubmit.js') }}"></script>
 <!-- Flatepicker Demo Js -->
     <!-- <script src="assets/js/pages/form-flatepicker.js"></script> -->
     <script src="{{asset('assets/jalali-date/jdate.min.js')}}"></script>
  <script>window.Date = window.JDate;</script>
     <script src="{{asset('assets/jalali-date/flatpickr.min.js')}}"></script>
     {{-- <script src="{{asset('assets/jalali-date/rangePlugin.js')}}"></script> --}}
     <script src="{{asset('assets/jalali-date/flatpicker-fa.js')}}"></script>
     <script>
          flatpickr("#basic-datepicker", {
               dateFormat: "Y/m/d",
               "locale": "fa",
          });
          
     </script>
<script>
 // for add new customer
 $(document).ready(function () {
            ajaxFormSubmit('#addcustomer', "{{ route('customer.store') }}");
        });


        $(document).ready(function () {
    $("#search").on("keyup", function () {
        let search = $(this).val().trim();

        // Avoid empty requests
        if (search.length === 0) {
            $("#customerTable tbody").html("<tr><td colspan='5' class='text-center'>نتیجه‌ای یافت نشد!</td></tr>");
            return;
        }

        $.ajax({
            url: "{{ route('customer.index') }}",
            type: "GET",
            data: { search: search },
            dataType: "json",
            success: function (response) {
                let customers = response.customers;
                let tableBody = $("#customerTable tbody");
                tableBody.empty();

                if (customers.length > 0) {
                    customers.forEach(function (customer) {
                        tableBody.append(
                            `<tr>
                                <td>${customer.id}</td>
                                <td>${customer.name}</td>
                                <td>${customer.lastname}</td>
                                <td>${customer.phone}</td>
                                <td>${customer.address}</td>
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
    <span class="text-muted fw-light">مشتریان /</span> لیست مشتریان
</p>



 <div class="row">
    <div class="col-xl-12">
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
    </div>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center gap-1">
                <h4 class="card-title flex-grow-1">لیست مشتریان</h4>
                <a type="submit" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                data-bs-target="#exampleModal">
                    مشتری جدید
                    {{-- <i class="">+</i> --}}
                    {{-- <iconify-icon icon="solar:plus" class="align-middle fs-18"></iconify-icon> --}}
                    <i class="bx bx-plus"></i>
                </a>
            </div>

            <div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0 table-hover table-centered" id="customerTable">
                        <thead class="bg-light-subtle">
                            <tr>
                                <th>آیدی مشتری</th>
                                <th>نام</th>
                                <th>شماره تماس</th>
                                <th>پروفایل</th>
                                <th>نوعیت</th>
                                <th>وضعیت</th>
                                <th>عملیه</th>

                            </tr>
                        </thead>

                        <tbody>

                            @if(isset($customers) && $customers->isNotEmpty())
                            @foreach($customers as $customer)
                                <tr>
                                    <td>{{ $customer->cu_number }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>
                                    <a class="btn btn-light btn-sm" href="{{
                                        route('customer.show', $customer->id) }}">
                                        <iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon>
                                        </a>
                                    </td>
                                    <td>{{ $customer->type }}</td>
                                    <td>
                                        @if($customer->status =1)
                                            <span class="badge bg-success">فعال</span>
                                        @else
                                            <span class="badge bg-danger">غیر فعال</span>
                                        @endif
                                    </td>
                                    <td>

                                         {{-- <a href="#!" class="btn btn-soft-primary btn-sm"><iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon> ویرایش</a> --}}
                                        {{--    <div class="d-flex gap-2">
                                                <a href="#!" class="btn btn-soft-primary btn-sm"><iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon></a>
                                                <form action="{{ route('customer.destroy', $customer->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a herf="#!" class="btn btn-soft-primary btn-sm"  onclick="return confirm('آیا برای حذف مطمئن استید؟');" >
                                                    <iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon>
                                                </a>
                                            </form>
                                            --}}
                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">هیچ مشتری یافت نشد!</td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                </div>
                <!-- end table-responsive -->
            </div>
            <div class="card-footer border-top">
                <nav aria-label="Page navigation example">

                    @if(isset($customers) && $customers->isNotEmpty())
                    <div class="mt-3 d-flex justify-content-center">
                        {{ $customers->links('pagination::bootstrap-5') }}
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
                        <span class="text-danger">*</span>
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
                        {{-- <input type="date" id="basic-datepicker"
                        class="form-control flatpickr-input" placeholder="تاریخ انتخاب اولیه" name="dob" id="dob"
                          old="{{old('dob')}}"> --}}
                       
                        <input type="text" name="dob" id="basic-datepicker"
                                                  class="form-control flatpickr-input" placeholder="تاریخ انتخاب اولیه"
                                                  readonly="readonly" old="{{old('dob')}}" >
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
