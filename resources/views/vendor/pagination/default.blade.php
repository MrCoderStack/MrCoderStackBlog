@if ($paginator->hasPages())
    <nav class="pagination" style="opacity: 1; display: block;">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span>&laquo;</span>
        @else
            <a class="extend prev" rel="prev"  href="{{ $paginator->previousPageUrl() }}" rel="prev">
                <i class="fa fa-angle-left"></i>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <a class="page-number">{{ $element }}</a>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="page-number current">{{ $page }}</a>
                    @else
                        <a class="page-number" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="page-number" href="{{ $paginator->nextPageUrl() }}" rel="next">
                <i class="fa fa-angle-right"></i></a>
            </a>
        @else
            {{--<span>&raquo;</span>--}}
        @endif
    </nav>
@endif
{{--<nav class="pagination" style="opacity: 1; display: block;">--}}
{{--<a class="extend prev" rel="prev" href="/page/2/">--}}
{{--<i class="fa fa-angle-left"></i>--}}
{{--</a>--}}
{{--<a class="page-number" href="/">1</a>--}}
{{--<a class="page-number" href="/page/2/">2</a>--}}
{{--<span class="page-number current">3</span>--}}
{{--<a class="page-number" href="/page/4/">4</a>--}}
{{--<a class="extend next" rel="next" href="/page/4/">--}}
{{--<i class="fa fa-angle-right"></i></a>--}}
{{--</nav>--}}