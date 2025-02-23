<header class="topbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <div class="d-flex align-items-center">
                <!-- دکمه toggle منو -->
                <div class="topbar-item">
                    <button type="button" class="button-toggle-menu me-2">
                        <iconify-icon icon="solar:hamburger-menu-broken" class="fs-24 align-middle"></iconify-icon>
                    </button>
                </div>

                <!-- عنوان صفحه -->
                <div class="topbar-item">
                    {{-- <h4 class="fw-bold topbar-button pe-none text-uppercase mb-0">لیست محصولات</h4> --}}
                    <h4 class="fw-bold topbar-button pe-none text-uppercase mb-0">@section('page_title')</h4>
                </div>
            </div>

            <div class="d-flex align-items-center gap-1">

                <!-- تم رنگ (روشن/تاریک) -->
                <div class="topbar-item">
                    <button type="button" class="topbar-button" id="light-dark-mode">
                        <iconify-icon icon="solar:moon-bold-duotone" class="fs-24 align-middle"></iconify-icon>
                    </button>
                </div>

                <!-- اعلان‌ها -->
                <div class="dropdown topbar-item">
                    <button type="button" class="topbar-button position-relative"
                            id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                        <iconify-icon icon="solar:bell-bing-bold-duotone" class="fs-24 align-middle"></iconify-icon>
                        <span
                            class="position-absolute topbar-badge fs-10 translate-middle badge bg-danger rounded-pill">3<span
                                class="visually-hidden">پیام‌های خوانده نشده</span></span>
                    </button>
                    <div class="dropdown-menu py-0 dropdown-lg dropdown-menu-end"
                         aria-labelledby="page-header-notifications-dropdown">
                        <div class="p-3 border-top-0 border-start-0 border-end-0 border-dashed border">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0 fs-16 fw-semibold"> اعلان‌ها</h6>
                                </div>
                                <div class="col-auto">
                                    <a href="javascript: void(0);" class="text-dark text-decoration-underline">
                                        <small>پاک کردن همه</small>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div data-simplebar style="max-height: 280px;">
                            <!-- آیتم -->
                            <a href="javascript:void(0);" class="dropdown-item py-3 border-bottom text-wrap">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <img src="{{asset('images/users/avatar-1.jpg')}}"
                                             class="img-fluid me-2 avatar-sm rounded-circle" alt="avatar-1"/>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="mb-0"><span class="fw-medium">جوزفین تامپسون </span>در مورد پنل مدیر نظر داده
                                            <span>" وای 😍! این پنل مدیر عالی و طراحی جذاب است"</span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <!-- آیتم -->
                            <a href="javascript:void(0);" class="dropdown-item py-3 border-bottom">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <div class="avatar-sm me-2">
                                                   <span
                                                       class="avatar-title bg-soft-info text-info fs-20 rounded-circle">
                                                        D
                                                   </span>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="mb-0 fw-semibold">دونوگویی سوزان</p>
                                        <p class="mb-0 text-wrap">
                                            سلام، حال شما چطور است؟ جلسه بعدی ما چی؟
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <!-- آیتم -->
                            <a href="javascript:void(0);" class="dropdown-item py-3 border-bottom">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <img src="{{asset('images/users/avatar-3.jpg')}}"
                                             class="img-fluid me-2 avatar-sm rounded-circle" alt="avatar-3"/>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="mb-0 fw-semibold">جیکوب گینس</p>
                                        <p class="mb-0 text-wrap">پاسخ داد به کامنت شما در گراف پیش‌بینی جریان نقدی 🔔.</p>
                                    </div>
                                </div>
                            </a>
                            <!-- آیتم -->
                            <a href="javascript:void(0);" class="dropdown-item py-3 border-bottom">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <div class="avatar-sm me-2">
                                                   <span
                                                       class="avatar-title bg-soft-warning text-warning fs-20 rounded-circle">
                                                        <iconify-icon
                                                            icon="iconamoon:comment-dots-duotone"></iconify-icon>
                                                   </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="mb-0 fw-semibold text-wrap">شما <b>20</b> پیام جدید در مکالمه دریافت کرده‌اید</p>
                                </div>
                            </div>
                            </a>
                            <!-- آیتم -->
                            <a href="javascript:void(0);" class="dropdown-item py-3 border-bottom">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <img src="{{asset('images/users/avatar-5.jpg')}}"
                                             class="img-fluid me-2 avatar-sm rounded-circle" alt="avatar-5"/>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="mb-0 fw-semibold">شان بنچ</p>
                                        <p class="mb-0 text-wrap">
                                            نظر داده در پنل مدیر
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="text-center py-3">
                            <a href="javascript:void(0);" class="btn btn-primary btn-sm">مشاهده تمامی اعلان‌ها <i
                                    class="bx bx-left-arrow-alt ms-1"></i></a>
                        </div>
                    </div>
                </div>

                <!-- تنظیمات تم -->
                {{-- <div class="topbar-item d-none d-md-flex">
                    <button type="button" class="topbar-button" id="theme-settings-btn" data-bs-toggle="offcanvas"
                            data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
                        <iconify-icon icon="solar:settings-bold-duotone" class="fs-24 align-middle"></iconify-icon>
                    </button>
                </div> --}}

                <!-- فعالیت -->
                {{-- <div class="topbar-item d-none d-md-flex">
                    <button type="button" class="topbar-button" id="theme-settings-btn" data-bs-toggle="offcanvas"
                            data-bs-target="#theme-activity-offcanvas" aria-controls="theme-settings-offcanvas">
                        <iconify-icon icon="solar:clock-circle-bold-duotone" class="fs-24 align-middle"></iconify-icon>
                    </button>
                </div> --}}

                <!-- کاربر -->
                <div class="dropdown topbar-item">
                    <a type="button" class="topbar-button" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                          <span class="d-flex align-items-center">
                               <img class="rounded-circle" width="32" src="{{asset('images/users/avatar-1.jpg')}}"
                                    alt="avatar-3">
                                   
                          </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        {{-- {{ Auth::user()->name }} {{ Auth::user()->lastname }} --}}
                        <!-- آیتم-->
                        {{-- <h6 class="dropdown-header">به گاستون خوش آمدید!</h6> --}}
                        <a class="dropdown-item" href="{{route('profile.index')}}">
                            <i class="bx bx-user-circle text-muted fs-18 align-middle me-1"></i><span
                                class="align-middle">پروفایل</span>
                        </a>
                    {{-- <a class="dropdown-item" href="chat.html">
                            <i class="bx bx-message-dots text-muted fs-18 align-middle me-1"></i><span
                                class="align-middle">پیام‌ها</span>
                        </a> --}}

                        {{-- <a class="dropdown-item" href="pricing.html">
                            <i class="bx bx-wallet text-muted fs-18 align-middle me-1"></i><span class="align-middle">قیمت‌گذاری</span>
                        </a>
                        <a class="dropdown-item" href="faqs.html">
                            <i class="bx bx-help-circle text-muted fs-18 align-middle me-1"></i><span
                                class="align-middle">راهنما</span>
                        </a>
                        <a class="dropdown-item" href="lock-screen.html">
                            <i class="bx bx-lock text-muted fs-18 align-middle me-1"></i><span class="align-middle">قفل صفحه</span>
                        </a> --}}

                        <div class="dropdown-divider my-1"></div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                            @csrf
                        <a class="dropdown-item text-danger" href="{{ route('logout') }}">
                          
                        </form>
                            <i class="bx bx-log-out fs-18 align-middle me-1"></i><span
                                class="align-middle">خروج</span>
                        </a>
                    </div>
                </div>

                <!-- جستجوی اپ -->
                {{-- <form class="app-search d-none d-md-block ms-2">
                    <div class="position-relative">
                        <input type="search" class="form-control" placeholder="جستجو..." autocomplete="off" value="">
                        <iconify-icon icon="solar:magnifer-linear" class="search-widget-icon"></iconify-icon>
                    </div>
                </form> --}}
            </div>
        </div>

    </div>
</header>