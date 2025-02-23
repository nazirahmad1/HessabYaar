
@extends('./layouts/master-layout')

@section('page_title', 'لیست واحدات پولی')

@section('content')


@push('scripts')
<script src="{{ asset('assets/js/myjs/jquery.js') }}"></script>
<script src="{{ asset('assets/js/myjs/ajaxformsubmit.js') }}"></script>

<script>
 // for add new customer
 $(document).ready(function () {
            ajaxFormSubmit('#addcurrency', "{{ route('currency.store') }}");
        });

</script>

  <p class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">واحد پولی</span> لیست واحد پولی
  </p>




  <!-- Table Card -->
<div class="row mb-4">
    <div class="col-md">
      <div class="card">
        <h5 class="card-header fw-bold">لیست واحدات پولی</h5>
        <div class="col-md-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-sm btn-primary" data-bs-toggle="modal"
            data-bs-target="#exampleModal">
                واحد پولی
                <i class="">+</i>
            </button>
            </div>
        <div class="card-body">
            <div class="row mb-4">
          
             <x-listing-table>
    <h5 class="card-header fw-bold d-flex">لیست واحدات پولی</h5>
    <x-slot name="thead">
        <tr>
            <th>آیدی</th>
            <th>نام واحد پولی</th>
            <th>نشان</th>
            <th>وضعیت</th>
            <th>عملیه</th>
        </tr>
    </x-slot>
    <x-slot name="tbody">
        @if(isset($currencies) && $currencies->isNotEmpty())
            @foreach($currencies as $currency)
                <tr>
                    <td>{{ $currency->id }}</td>
                    <td>{{ $currency->name }}</td>
                    <td>{{ $currency->sign }}</td>
                    {{-- <td>{{ $currency->status }}</td> --}}
                    {{-- <td>{{ $currency->type }}</td> --}}
                    <td>
                        @if($currency->status == '1')
                            <span class="badge bg-success me-1">فعال</span>
                        @else
                            <span class="badge bg-danger me-1">غیر فعال</span>
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="6" class="text-center">هیچ مشتری یافت نشد!</td>
            </tr>
        @endif
    </x-slot>
</x-listing-table>

<!-- Pagination Links -->
@if(isset($currencies) && $currencies->isNotEmpty())
    <div class="mt-3 d-flex justify-content-center">
        {{ $currencies->links('pagination::bootstrap-4') }}
    </div>
@endif
<!-- container -->
        </div><!-- card-body -->
    </div><!-- col-md -->
  </div><



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
             <form action="{{ route('currency.store') }}" method="POST" id="addcurrency">
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