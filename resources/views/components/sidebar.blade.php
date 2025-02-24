

<div class="main-nav">
    <!-- Sidebar Logo -->
    <div class="logo-box">
        <a href="/" class="logo-dark">
            {{-- <img src="images/logo-sm.png" class="logo-sm" alt="logo sm">
            <img src="images/logo-dark.png" class="logo-lg" alt="logo dark">
             --}}
             <h3 class="pt-2 text-center text-white">Hessab Yaar</h3>
        </a>

        <a href="/" class="logo-light">
            {{-- <img src="images/logo-sm.png" class="logo-sm" alt="logo sm">
            <img src="images/logo-light.png" class="logo-lg" alt="logo light"> --}}
            <h3 class="pt-2 text-center text-white">Hessab Yaar</h3>
        </a>
    </div>

    <!-- Menu Toggle Button (sm-hover) -->
    <button type="button" class="button-sm-hover" aria-label="Show Full Sidebar">
        <iconify-icon icon="solar:double-alt-arrow-left-bold-duotone" class="button-sm-hover-icon"></iconify-icon>
    </button>

    <div class="scrollbar" data-simplebar>
        <ul class="navbar-nav" id="navbar-nav">

            {{-- <li class="menu-title">عمومی</li> --}}

            <li class="nav-item">
                <a class="nav-link" href="/">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:widget-5-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> داشبورد </span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarProducts" data-bs-toggle="collapse" role="button"
                   aria-expanded="false" aria-controls="sidebarProducts">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:h-home-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> صفحه اصلی </span>
                </a>
                <div class="collapse" id="sidebarProducts">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            {{-- <a class="sub-nav-link" href="products-list.html">لیست</a> --}}
                            <a class="sub-nav-link" href="{{route('customer.index')}}">مشتریان</a>

                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('currency.index')}}">واحد پولی</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link"  href="{{route('finance_accounts.index')}}">حساب های فایننس</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarCategory" data-bs-toggle="collapse" role="button"
                   aria-expanded="false" aria-controls="sidebarCategory">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:clipboard-list-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text">رسید و برد</span>
                </a>
                <div class="collapse" id="sidebarCategory">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('expense.index')}}">ثبت مصرف جدید</a>
                       </li>
                       <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('rasid_bord.index')}}">رسیدو برد</a>
                       </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarInventory" data-bs-toggle="collapse" role="button"
                   aria-expanded="false" aria-controls="sidebarInventory">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:chart-square-outline"></iconify-icon>
                        {{-- <iconify-icon icon="solar:pie-chart-2-bold-duotone"></iconify-icon> --}}
                    </span>
                    <span class="nav-text">گزارشات</span>
                </a>
                <div class="collapse" id="sidebarInventory">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('banksreport.index')}}">گزارش بانکها</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('reports.alltransactions') }}">تمام تراکنش ها</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('reports.rooznamchah') }}">روزنامچه</a>
                        </li>
                    </ul>
                </div>
            </li>

            {{-- <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarOrders" data-bs-toggle="collapse" role="button"
                   aria-expanded="false" aria-controls="sidebarOrders">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:bag-smile-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> سفارشات </span>
                </a>
                <div class="collapse" id="sidebarOrders">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="orders-list.html">لیست</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="orders-details.html">جزئیات</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="orders-cart.html">سبد خرید</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="orders-checkout.html">تسویه‌حساب</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarPurchases" data-bs-toggle="collapse" role="button"
                   aria-expanded="false" aria-controls="sidebarPurchases">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:card-send-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> خریدها </span>
                </a>
                <div class="collapse" id="sidebarPurchases">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="purchase-list.html">لیست</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="purchase-order.html">سفارش</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="purchase-return.html">بازگشت</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarAttributes" data-bs-toggle="collapse" role="button"
                   aria-expanded="false" aria-controls="sidebarAttributes">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:confetti-minimalistic-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> ویژگی‌ها </span>
                </a>
                <div class="collapse" id="sidebarAttributes">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="list.html">لیست</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="edit.html">ویرایش</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="create.html">ایجاد</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarInvoice" data-bs-toggle="collapse" role="button"
                   aria-expanded="false" aria-controls="sidebarInvoice">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:bill-list-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> فاکتورها </span>
                </a>
                <div class="collapse" id="sidebarInvoice">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="invoice-list.html">لیست</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="invoice-details.html">جزئیات</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="invoice-create.html">ایجاد</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="settings.html">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:settings-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> تنظیمات </span>
                </a>
            </li> --}}

            <li class="menu-title mt-2">کاربران</li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('profile.index')}}">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:chat-square-like-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> پروفایل </span>
                </a>
            </li>

            {{-- <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarRoles" data-bs-toggle="collapse" role="button"
                   aria-expanded="false" aria-controls="sidebarRoles">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:user-speak-rounded-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> نقش‌ها </span>
                </a>
                <div class="collapse" id="sidebarRoles">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="role-list.html">لیست</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="role-edit.html">ویرایش</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="role-create.html">ایجاد</a>
                        </li>
                    </ul>
                </div>
            </li> --}}

            {{-- <li class="nav-item">
                <a class="nav-link" href="pages-permission.html">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:checklist-minimalistic-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text"> دسترسی‌ها </span>
                </a>
            </li> --}}



        </ul>
    </div>
</div>
