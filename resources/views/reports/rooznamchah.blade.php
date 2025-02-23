@extends('./layouts/master-layout')

@section('page_title', 'روزنامچه')

@section('content')


@push('styles')

@endpush



@push('scripts')

<script>

</script>


@endpush
<p class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">روزنامچه /</span> لیست ترانزکشن ها
</p>



<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <form id="search-form" method="GET" 
                        {{-- action="{{ route('customer.index') }}" --}}
                         class="d-flex align-items-center gap-2">
                            <label for="searchCustomer" class="form-label mb-0">جستجوی تراکنش:</label>
                            <input type="text" name="search" id="search" class="form-control w-auto" placeholder="برای جستجو..." value="{{ request('search') }}">
                            
                            <button type="submit" class="btn btn-sm btn-primary">
                                جستجو <iconify-icon icon="solar:search" class="align-middle fs-18"></iconify-icon>
                            </button>
                
                            @if(request('search'))
                                <a
                                 {{-- href="{{ route('customer.index') }}"  --}}
                                 class="btn btn-sm btn-secondary">
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
                <h4 class="card-title flex-grow-1">لیست روزنامچه</h4>
               
            </div>

            <div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0 table-hover table-centered" id="customerTable">
                        <thead class="bg-light-subtle">
                            <tr>
                                <th>تاریخ</th>
                                <th>نوع تراکنش</th>
                                <th>رسید وبرد</th>
                                <th>نام مشتری</th>
                                <th>مقدار پول</th>
                                <th>تفصیلات</th>
                                <th>نمبر چک</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if(isset($transactions) && $transactions->isNotEmpty())
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->date }}</td>
                                    <td>
                                        <span class="badge badge-pill badge-soft-success font-bold p-2">
                                            {{ $transaction->transaction_type }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-pill 
                                        {{ $transaction->rasid_bord === 'rasid' ? 'bg-success' : 'badge-soft-danger' }}"
                                        font-bold p-2">
                                            {{ $transaction->rasid_bord==="rasid" ? "رسید" : "بــرد"}}
                                        </span>
                                    </td>
                                    <td>
                                        {{ $transaction->customer->name ?? $transaction->finance_account->account_name ?? "وجود ندارد" }}
                                    </td>
                                    <td>
                                        {{ number_format($transaction->amount) }} {{ $transaction->tr_currency->name }}
                                        {{ $transaction->rasid_bord === 'rasid' ? 'به' : 'از' }}
                                        {{ $transaction->bank_account->account_name ?? $transaction->finance_account->account_name }}
                                    </td>
                                    <td>{{ $transaction->desc }}</td>
                                    <td>{{ $transaction->check_number }}</td>
        

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
                        {{ $transactions->links('pagination::bootstrap-5') }}

                    </div>
                @endif
                </nav>
            </div>
        </div>
    </div>

       </div>



@endsection
