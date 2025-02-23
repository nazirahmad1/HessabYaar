@extends('./layouts/master-layout')

@section('page_title', 'لیست تراکنش ها')

@section('content')


@push('styles')

@endpush



@push('scripts')

<script>

</script>


@endpush
<p class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">تراکنش ها /</span> لیست تراکنش ها
</p>



<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <form id="search-form" method="GET" action="{{ route('reports.alltransactions') }}" class="d-flex align-items-center gap-2">
                            <label for="searchCustomer" class="form-label mb-0">جستجوی تراکنش:</label>
                            <input type="text" name="search" id="search" class="form-control w-auto" placeholder="برای جستجو..." value="{{ request('search') }}">
                            
                            <button type="submit" class="btn btn-sm btn-primary">
                                جستجو <iconify-icon icon="solar:search" class="align-middle fs-18"></iconify-icon>
                            </button>
                
                            @if(request('search'))
                                <a href="{{ route('reports.alltransactions') }}" class="btn btn-sm btn-secondary">
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
                <h4 class="card-title flex-grow-1">لیست همه تراکنش ها</h4>
               
            </div>

            <div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0 table-hover table-centered" id="customerTable">
                        <thead class="bg-light-subtle">
                            <tr>
                            <th class="">نمبر چک</th>
                            <th class="">تاریخ</th>
                            <th class="">نام مشتری</th>
                            <th class="">رسید برد</th>
                            <th class="">مقدار پول</th>
                            <th class="">تفصیلات</th>
                            <th class="">توسط</th>
                            <th class="">عملیه</th>

                            </tr>
                        </thead>

                        <tbody>

                            @if(isset($transactions) && $transactions->isNotEmpty())
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->check_number }}</td>
                                    <td>{{ $transaction->date }}</td>
                                    <td>{{ $transaction->customer->name ?? $transaction->finance_account->account_name }}</td>
                                    <td>
                                        <span class="badge badge-pill font-bold font-size-12 p-2 {{ $transaction->rasid_bord === 'rasid' ? 'badge-soft-success' : 'badge-soft-warning' }}">
                                            {{ $transaction->rasid_bord === 'rasid' ? 'رسید' : 'برد' }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ number_format($transaction->amount) }} {{ $transaction->tr_currency->name }}
                                        به 
                                        {{ $transaction->bank_account->account_name ?? $transaction->finance_account->account_name ??"وجود ندارد" }}
                                    </td>
                                    <td>{{ $transaction->desc }}</td>
                                    <td>{{ $transaction->user->name ?? "وجود ندارد" }}</td>
                                
                                <td>
                                    <td>

                                         {{-- <a href="#!" class="btn btn-soft-primary btn-sm"><iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon> ویرایش</a> --}}


                                            {{-- <div class="d-flex gap-2">
                                                <a href="#!" class="btn btn-soft-primary btn-sm"><iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon></a>

                                                <form action="
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
                    @if(isset($customers) && $customers->isNotEmpty())
                    <div class="mt-3 d-flex justify-content-center">
                        {{ $transactions->links('pagination::bootstrap-4') }}

                    </div>
                @endif
                </nav>
            </div>
        </div>
    </div>

       </div>


@endsection
