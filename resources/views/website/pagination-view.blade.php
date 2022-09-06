<div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <nav aria-label="Page navigation example">
            @if ($paginator->hasPages())
                <ul class="pagination justify-content-center">
                    @if ($paginator->onFirstPage())
                        <li class="page-item " disabled>
                            <a class="page-link text-warning">السابق</a>
                        </li>
                    @else
                        <li class="page-item ">
                            <a href="{{ $paginator->previousPageUrl() }}" class="page-link text-warning">السابق</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item" active><a class="page-link text-secondary" href="#">{{ $page }}</a></li>
                                @else
                                    <li class="page-item"><a class="page-link text-secondary" href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    @if ($paginator->hasMorePages())
                        <li class="page-item ">
                            <a class="page-link text-warning" href="{{ $paginator->nextPageUrl() }}">التالي</a>
                        </li>
                    @else
                        <li class="page-item " disabled>
                            <a class="page-link text-warning" href="#">التالي</a>
                        </li>
                    @endif
                </ul>
            @endif
        </nav>
      </div>
    </div>
  </div>


