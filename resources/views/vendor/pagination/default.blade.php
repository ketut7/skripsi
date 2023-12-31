@if ($paginator->hasPages())
    <div div="row">
        <ul class="pagination pagination-lg justify-content-end">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
{{--                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">--}}
{{--                    <a class="page-link active rounded-0 mr-3 shadow-sm border-top-0 border-left-0" aria-hidden="true" href="#">&lsaquo;</a>--}}
{{--                </li>--}}
            @else
                <li class="page-item">
                    <a class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
                                <a class="page-link active rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-white" href="{{ $url }}">
                                    {{ $page }}
                                </a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark" href="{{ $url }}">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark"
                       href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
{{--                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">--}}
{{--                    <a class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0" href="#" aria-hidden="true">&rsaquo;</a>--}}
{{--                </li>--}}
            @endif
        </ul>
    </div>
@endif
