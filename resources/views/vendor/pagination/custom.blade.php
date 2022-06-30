@if ($paginator->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">

            @if ($paginator->onFirstPage())
                <li class="page-item"><a href="" class="page-link"><span>← Previous</span></a></li>
            @else
                <li><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">← Previous</a></li>
            @endif



            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item"><span>{{ $element }}</span></li>
                @endif



                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class=" page-link active my-active"><span>{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link"
                                    href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach



            @if ($paginator->hasMorePages())
                <li class="page-item"><a href="{{ $paginator->nextPageUrl() }}" class="page-link" rel="next">Next
                        →</a></li>
            @else
                <li class="page-item"><a href="" class="page-link"><span>Next →</span></a></li>
            @endif
        </ul>
    </nav>
@endif
