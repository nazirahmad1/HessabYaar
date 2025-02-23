@extends('./layouts/master-layout')

@section('page_title', 'لیست جزئیات بانک')

@section('content')

@push('styles')

@endpush

@push('scripts')

@endpush

<p class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">تراکنش /</span> لیست تراکنشها
</p>







<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <form id="search-form" method="GET" 
                        {{-- action="{{ route('reports.bankdetails', $bank['id'])  }}" --}}
                         class="d-flex align-items-center gap-2">
                            <label for="searchCustomer" class="form-label mb-0">جستجوی رسیدوبرد:</label>
                            <input type="text" name="search" id="search" class="form-control w-auto" placeholder="برای جستجو..." value="{{ request('search') }}">
                            
                            <button type="submit" class="btn btn-sm btn-primary">
                                جستجو <iconify-icon icon="solar:search" class="align-middle fs-18"></iconify-icon>
                            </button>
                
                            @if(request('search'))
                                <a 
                                {{-- href="{{ route('reports.bankdetails', $bank['id'])  }}" --}}
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
                <h4 class="card-title mb-4">جزئیات بانک</h4>
                
            </div>

            <div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0 table-hover table-centered" >
                        <thead class="bg-light-subtle">
                            <tr>
                                <th>نمبر چک</th>
                                <th>تاریخ</th>
                                <th>نام مشتری</th>
                                <th>رسیدوبرد</th>
                                <th>مقدار پول</th>
                                <th>تفصیلات</th>
                                <th>توسط</th>

                            </tr>
                        </thead>

                        <tbody>

                            @if($transactions->isNotEmpty())
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->check_number }}</td>
                                <td>{{ $transaction->date }}</td>
                                <td>
                                    {{-- {{ $transaction->customer->name ?? $transaction->finance_account->account_name }} --}}
                                </td>
                                <td>
                                    <span class="badge font-bold font-size-12 p-2
                                        {{ $transaction->rasid_bord === 'rasid' ? 'bg-success' : 'badge-soft-danger' }}">
                                        {{ $transaction->rasid_bord === 'rasid' ? 'رسید' : 'برد' }}
                                    </span>
                                </td>
                                <td>
                                    {{ number_format($transaction->amount) }} {{ $transaction->tr_currency->name }}
                                    <span>
                                        {{ $transaction->bank_account->account_name ?? $transaction->finance_account->account_name }}
                                    </span>
                                </td>
                                <td>{{ $transaction->desc }}</td>
                                <td>{{ $transaction->user->name ?? "وجود ندارد"}}</td>
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
                    @if(isset($transactions) && $transactions->isNotEmpty())
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
