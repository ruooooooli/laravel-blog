@if ($paginator->hasPages())
    <div class="ui pagination menu">
        @if ($paginator->onFirstPage())
            <a class="disabled icon item"><i class="left chevron icon"></i></a>
        @else
            <a class="icon item" href="{{ $paginator->previousPageUrl() }}"><i class="left chevron icon"></i></a>
        @endif

        <!-- Pagination Elements -->
        @foreach ($elements as $element)
            <!-- "Three Dots" Separator -->
            @if (is_string($element))
                <a class="disabled item">{{ $element }}</a>
            @endif

            <!-- Array Of Links -->
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="active item">{{ $page }}</a>
                    @else
                        <a class="item" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        <!-- Next Page Link -->
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="icon item"><i class="right chevron icon"></i></a>
        @else
            <a class="disabled icon item"><i class="right chevron icon"></i></a>
        @endif
    </div>
@endif
