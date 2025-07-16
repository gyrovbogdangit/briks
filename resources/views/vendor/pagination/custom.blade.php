@if ($paginator->hasPages())
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true"><i
                            class="fa-solid fa-arrow-left"></i></a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link text-primary" href="{{ $paginator->previousPageUrl() }}"><i
                            class="fa-solid fa-arrow-left"></i></a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    {{-- @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span
                                    class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link text-primary"
                                    href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach --}}
                    @php
                        $lastShownPage = null;
                    @endphp

                    @foreach ($element as $page => $url)
                        @php
                            $isNearCurrent = abs($paginator->currentPage() - $page) <= 1;
                            $isEdge = $page === 1 || $page === $paginator->lastPage();
                            $shouldShow = $isNearCurrent || $isEdge;
                        @endphp

                        @if ($shouldShow)
                            @if ($lastShownPage !== null && $page - $lastShownPage > 1)
                                <li class="page-item disabled"><span class="page-link">…</span></li>
                            @endif

                            @if ($page === $paginator->currentPage())
                                <li class="page-item active" aria-current="page">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link text-primary" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif

                            @php
                                $lastShownPage = $page;
                            @endphp
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link text-primary" href="{{ $paginator->nextPageUrl() }}"><i
                            class="fa-solid fa-arrow-right"></i></a>
                </li>
            @else
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true"><i
                            class="fa-solid fa-arrow-right"></i></a>
                </li>
            @endif
        </ul>
    </nav>
@endif
