@extends('./layouts/master-layout')

@section('page_title', 'لیست واحدات پولی')

@section('content')


@push('styles')
  
@endpush



@push('scripts')
<script src="{{ asset('assets/js/myjs/ajaxformsubmit.js') }}"></script>

<script>
 // for add new currency
 $(document).ready(function () {
            ajaxFormSubmit('#addcurrency', "{{ route('currency.store') }}");
        });


        $(document).ready(function () {
    $("#search").on("keyup", function () {
        let search = $(this).val().trim();

        // Avoid empty requests
        if (search.length === 0) {
            $("#currencyTable tbody").html("<tr><td colspan='5' class='text-center'>نتیجه‌ای یافت نشد!</td></tr>");
            return;
        }

        $.ajax({
            url: "{{ route('currency.index') }}",
            type: "GET",
            data: { search: search },
            dataType: "json",
            success: function (response) {
                let currencies = response.currencies;
                console.log(currencies)
                let tableBody = $("#currencyTable tbody");
                tableBody.empty();
                if (currencies.length > 0) {
                    currencies.forEach(function (currency) {
                        tableBody.append(
                            `<tr>
                                <td>${currency.id}</td>
                                <td>${currency.name}</td>
                                <td>${currency.sign}</td>
                                 <td>${currency.status}</td>
                            </tr>`
                        );
                    });
                } else {
                    tableBody.append("<tr><td colspan='5' class='text-center'>نتیجه‌ای یافت نشد!</td></tr>");
                }
            },
            error: function () {
                console.log("عملیه جستجو با خطا مواجه شد");
            }
        });
    });
});

</script>


@endpush
<p class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">واحدات پولی /</span> لیست واحدات پولی
</p>



<div class="row">
    <div class="col-xl-12">
        <div class="card">

          
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <form id="search-form" method="GET" action="{{ route('currency.index') }}" class="d-flex align-items-center gap-2">
                            <label for="searchCurrency" class="form-label mb-0">جستجوی واحد پولی:</label>
                            <input type="text" name="search" id="search" class="form-control w-auto" placeholder="برای جستجو..." value="{{ request('search') }}">
                            
                            <button type="submit" class="btn btn-sm btn-primary">
                                جستجو <iconify-icon icon="solar:search" class="align-middle fs-18"></iconify-icon>
                            </button>
                
                            @if(request('search'))
                                <a href="{{ route('currency.index') }}" class="btn btn-sm btn-secondary">
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
                <h4 class="card-title flex-grow-1">لیست همه واحدات پولی</h4>



                <a type="submit" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                data-bs-target="#exampleModal">
                    واحد پولی جدید
                    {{-- <i class="">+</i> --}}
                    <iconify-icon icon="solar:plus" class="align-middle fs-18"></iconify-icon>
                </a>
            </div>

            <div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0 table-hover table-centered" id="currencyTable">
                        <thead class="bg-light-subtle">
                            <tr>
                                <th>آیدی </th>
                                <th>نام واحد پولی</th>
                                <th>علامه واحد پولی</th>

                                <th>وضعیت</th>
                                <th>عملیه</th>

                            </tr>
                        </thead>

                        <tbody>
                               
                            @if(isset($currencies) && $currencies->isNotEmpty())
                            {{-- {{dd($currencies)}} --}}
                            @foreach($currencies as $currency)
                                <tr>
                                    <td>{{ $currency->id }}</td>
                                    <td>{{ $currency->name }}</td>
                                    <td>{{ $currency->sign }}</td>
                                    <td>
                                        @if($currency->status =1)
                                            <span class="badge bg-success">فعال</span>
                                        @else
                                            <span class="badge bg-danger">غیر فعال</span>
                                        @endif
                                    </td>
                                    <td>
                                            {{-- <div class="d-flex gap-2">
                                                <a 
                                                 href="#!" 
                                                 disabled class="btn btn-soft-primary btn-sm"><iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon></a>
                                                
                                                <form 
                                                 action="{{ route('currency.destroy', $currency->id) }}"  
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a herf="#!" disabled class="btn btn-soft-primary btn-sm cursor-pointer" 
                                                 onclick="return confirm('آیا برای حذف مطمئن استید؟');" >
                                                    <iconify-icon icon="solar:trash-bin-minimalistic-2-broken"
                                                     class="align-middle fs-18"></iconify-icon>
                                                </a>
                                            </form>
                                            </div> --}}

                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">هیچ واحد پولی یافت نشد!</td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                </div>
                <!-- end table-responsive -->
            </div>
            <div class="card-footer border-top">
                <nav aria-label="Page navigation example">

                    @if(isset($currencies) && $currencies->isNotEmpty())
                    <div class="mt-3 d-flex justify-content-center">
                        {{ $currencies->links('pagination::bootstrap-5') }}
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
               <h5 class="modal-title" id="exampleModalLabel">اضافه کردن واحد پولی جدید</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal"
                   aria-label="بستن"></button>
           </div>
           <div class="modal-body">
            <form action="{{ route('currency.store') }}" method="POST" enctype="multipart/form-data" id="addcurrency">
                @csrf
                <div class="">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="name" class="form-label">نام واحد پولی</label>
                            <input type="text" id="currency_name" class="form-control @error('name') is-invalid @enderror" 
                                   name="name" placeholder="نام واحد پولی خود را وارد نمائید" value="{{ old('name') }}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                       
                    </div>
                    <div class="">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="sign" class="form-label">نشان واحد پولی</label>
                            <input type="text" id="email" class="form-control @error('sign') is-invalid @enderror" 
                                   name="sign" placeholder="نشان واحد پولی" value="{{ old('sign') }}">
                            @error('sign')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    </div>


<button type="submit" class="btn btn-primary">ثبت </button>
                    </div><!-- col-12 -->
                  </div>
            </form>
           </div>
       </div>
   </div>
</div>
@endsection
