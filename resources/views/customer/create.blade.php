@extends('./layouts/master-layout')

@section('page_title', 'لیست مشتریان')

@section('content')


@push('scripts')

@endpush
<p class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">مشتریان /</span> لیست مشتریان
</p>

<!-- Show success or error alert messages -->
@if(session('msg'))
    <x-alert :type="session('type')" :message="session('msg')"></x-alert>
@endif

@if($errors->any())
    <x-alert :type="'warning'" :message="$errors->all()"></x-alert>
@endif

<div class="row">
    <!-- Add Customer Form Card -->
    <div class="col-lg-12 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-4">اضافه کردن مشتری جدید</h5>
                <form action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
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
                                <span class="input-group-text">AF (+93)</span>
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
                            <input type="date" id="dob" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}">
                            @error('dob') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                            <button type="submit" class="btn btn-primary">ثبت</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <!-- Customer Table Card -->
    <div class="col-lg-12">
        <div class="card">
            <h5 class="card-header fw-bold">لیست مشتریان</h5>
            <div class="card-body">
                <x-listing-table>
                    <x-slot name="thead">
                        <tr>
                            <th>آیدی مشتری</th>
                            <th>نام</th>
                            <th>شماره تماس</th>
                            <th>پروفایل</th>
                            <th>نوعیت</th>
                            <th>وضعیت</th>
                            <th>عملیه</th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                      
                        @if(isset($customers) && $customers->isNotEmpty())
                            @foreach($customers as $customer)
                                <tr>
                                    <td>{{ $customer->cu_number }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>
                                    <a class="btn btn-sm btn-primary" href="{{ route('customer.show', $customer->id) }}">پروفایل</a>
                                    </td>
                                    <td>{{ $customer->type }}</td>
                                    <td>
                                        @if($customer->status == '1')
                                            <span class="badge bg-label-success">فعال</span>
                                        @else
                                            <span class="badge bg-label-danger">غیر فعال</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#"><i class="bx bx-edit-alt me-1"></i> ویرایش</a>
                                                <a class="dropdown-item" href="#"><i class="bx bx-trash me-1"></i> حذف</a>
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
                @if(isset($customers) && $customers->isNotEmpty())
                    <div class="mt-3 d-flex justify-content-center">
                        {{ $customers->links('pagination::bootstrap-4') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
