<div>
    @if ($paginator->hasPages())
        <nav>
            <ul class="pagination justify-content-center">
                {{-- Tombol "Previous" --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled"><span class="page-link">‹</span></li>
                @else
                    <li class="page-item"><button type="button" class="page-link" wire:click="previousPage">‹</button></li>
                @endif

                {{-- Nomor Halaman --}}
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><button type="button" class="page-link" wire:click="gotoPage({{ $page }})">{{ $page }}</button></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Tombol "Next" --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item"><button type="button" class="page-link" wire:click="nextPage">›</button></li>
                @else
                    <li class="page-item disabled"><span class="page-link">›</span></li>
                @endif
            </ul>
        </nav>
    @endif
</div>
