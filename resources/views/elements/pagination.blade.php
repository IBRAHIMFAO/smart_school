{{-- <div class="pages">
    <a href="#" class="back disabled">
        <span class="fa fa-arrow-circle-left"></span> back
    </a>
    <a href="#" class="page active">1</a>
    <a href="#" class="page">2</a>
    <a href="#" class="page">3</a>
    <a href="#" class="next">forward <span class="fa fa-arrow-circle-right"></span></a>
    <i class="far fa-star"></i>
</div> --}}

<!-- Pagination -->
{{-- <div class="pages">
    {{ $seances->links() }}
</div> --}}

<!-- Pagination -->
<div class="pages d-flex justify-content-center" >
    <ul class="pagination">
        @if ($seances->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link" aria-disabled="true">
                    <span class="fa fa-arrow-circle-left"></span> back
                </span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $seances->previousPageUrl() }}" rel="prev">
                    <span class="fa fa-arrow-circle-left"></span> back
                </a>
            </li>
        @endif

        @foreach ($seances->getUrlRange(1, $seances->lastPage()) as $page => $url)
            @if ($page == $seances->currentPage())
                <li class="page-item active">
                    <span class="page-link">{{ $page }}</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endif
        @endforeach

        @if ($seances->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $seances->nextPageUrl() }}" rel="next">
                    forward <span class="fa fa-arrow-circle-right"></span>
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link" aria-disabled="true">
                    forward <span class="fa fa-arrow-circle-right"></span>
                </span>
            </li>
        @endif
    </ul>
</div>
