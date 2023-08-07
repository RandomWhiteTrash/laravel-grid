@if($grid->wantsPagination() && !$grid->gridNeedsSimplePagination())
    <div class="float-{{ $direction }}">
        <b>
            @if($grid->getData()->total() <= $grid->getData()->perpage())
                @if(!isset($atFooter))
                    {{ __("Showing :i to :k of :n entries", [
                    'i' => $grid->getData()->total()==0?0:($grid->getData()->currentpage() - 1 ) * $grid->getData()->perpage() + 1,
                    'k' => $grid->getData()->total(),
                    'n' => $grid->getData()->total()
                    ]) }}
                @endif
            @else
                {{ __("Showing :i to :k of :n entries", [
                'i' => ($grid->getData()->currentpage() - 1 ) * $grid->getData()->perpage() + 1,
                'k' => $grid->getData()->currentpage() * $grid->getData()->perpage(),
                'n' => $grid->getData()->total()
                ]) }}
            @endif
        </b>
    </div>
@else
    @if(isset($atFooter))
        @if($grid->getData()->count() >= $grid->getData()->perpage())
            <div class="float-{{ $direction }}">
                <b>
                    {{ __("Showing :n records on this page", ['n' => $grid->getData()->count()]) }}
                </b>
            </div>
        @endif
    @else
        <div class="float-{{ $direction }}">
            <b>
                {{ __("Showing :n records on this page", ['n' => $grid->getData()->count()]) }}
            </b>
        </div>
    @endif
@endif
