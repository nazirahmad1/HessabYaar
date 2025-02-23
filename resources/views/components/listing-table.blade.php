<div class="table-responsive">
    <table class="table table-striped table-borderless table-centered">
         <thead class="table-light">
            {{$thead}}
        </thead>
        <tbody class="table-border-bottom-0">
            {{$tbody}}
        </tbody>
        <tfoot>
            {{ $tfoot ?? $thead }}
        </tfoot>
    </table>
    </div>