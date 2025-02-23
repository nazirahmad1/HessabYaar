@extends('./layouts/master-layout')

@section('page_title', 'پروفایل کاربر')

@section('content')


@push('styles')

@endpush



@push('scripts')


<script>
 
</script>


@endpush
<p class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">پروفایل/</span> پروفایل کاربر
</p>


<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card overflow-hidden">
            <div class="card-body">
                <div class="bg-primary profile-bg rounded-top position-relative mx-n3 mt-n3">
                    {{-- @if(isset($user->image))
                    <img src=" {{ asset($user->image) }}" alt="Uploaded Image" id="uploadedImage" class="d-block rounded" height="100" width="100">
                    @else --}}
                      <img src="{{asset('images/users/avatar-1.jpg')}}" alt="" class="avatar-xl border border-light border-3 rounded-circle position-absolute top-100 start-0 translate-middle ms-5"
                    {{-- @endif --}}
                  >
                </div>
                <div class="mt-5 d-flex flex-wrap align-items-center justify-content-between">
                    <div>
                        <h4 class="mb-1"> <span>{{$user->name}} {{$user->lastname}}</span><i class='bx bxs-badge-check text-success align-middle'></i></h4>
                        <p class="mb-0 fs-14"><span class="badge bg-success ms-1">مدیر</span></p>
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
                                <p class="mb-0">{{$user->created_at}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-6">
                        <div class="d-flex align-items-center gap-2 border-end">
                            <iconify-icon icon="solar:cup-star-bold-duotone" class="fs-28 text-primary"></iconify-icon>
                            <div>
                                {{-- <h5 class="mb-1">5 گواهی</h5>
                                <p class="mb-0">دریافت شده</p> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-6">
                        <div class="d-flex align-items-center gap-2">
                            <iconify-icon icon="solar:notebook-bold-duotone" class="fs-28 text-primary"></iconify-icon>
                            <div>
                                {{-- <h5 class="mb-1">2 کارآموزی</h5>
                                <p class="mb-0">تکمیل شده</p> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

@endsection
