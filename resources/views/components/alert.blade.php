

@switch($type)
    @case('success')
        <div class="alert alert-success d-flex" role="alert">
            {{-- <span class="badge badge-center rounded-pill bg-success border-label-success p-3 me-2"><i class="bx bx-badge-check fs-4"></i></span> --}}
            <div class="d-flex flex-column ps-1">
                <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">پیام موفقیت!</h6>
                <span>{{$message}}</span>
            </div>
        </div>
        @break

    @case('error')
        <div class="alert alert-danger d-flex" role="alert">
          {{-- <span class="badge badge-center rounded-pill bg-danger border-label-danger p-3 me-2"><i class="bx bx-message-error fs-4"></i></span> --}}
          <div class="d-flex flex-column ps-1">
            <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">
                پیام خطا!
            </h6>
            <span>{{$message}}</span>
          </div>
        </div>
        @break
    
    @case('warning')
        <div class="alert alert-warning d-flex" role="alert">
          <span class="badge badge-center rounded-pill bg-warning border-label-warning p-3 me-2">
            <i class="bx bx-error fs-4"></i></span>
          <div class="d-flex flex-column ps-1">
            <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">هشدار!</h6>
            @if( is_array($message) )
              @foreach($message as $msg)
                <li>{{$msg}}</li>
              @endforeach
            @else
              <span>{{$message}}</span>
            @endif
          </div>
        </div>
        @break

    @default
        <div class="alert alert-info d-flex" role="alert">
          <span class="badge badge-center rounded-pill bg-info border-label-info p-3 me-2"><i class="bx bx-info-circle fs-4"></i></span>
          <div class="d-flex flex-column ps-1">
            <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">
                پیام معلوماتی!!
            </h6>
            <span>{{$message}}</span>
          </div>
        </div>
@endswitch