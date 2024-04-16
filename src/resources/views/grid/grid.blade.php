@extends($grid->getRenderingTemplateToUse())
@section('data')
    @if ($grid->shouldRenderSearchForm() || $grid->hasButtons('toolbar'))
        <div class="row">
            @if($grid->shouldRenderSearchForm())
                <div class="col col-md-{{ $grid->hasButtons('toolbar')?$grid->getGridToolbarSize()[0]:12 }}">
                    {!! $grid->renderSearchForm() !!}
                </div>
            @endif

            @if($grid->hasButtons('toolbar'))
                <div class="col col-md-{{ $grid->shouldRenderSearchForm()?$grid->getGridToolbarSize()[1]:12 }}">
                    <div class="float-left text-left">
                        @foreach($grid->getButtons('toolbar') as $button)
                            @if (!empty($button->position_side) && $button->position_side === 'left')
                                @if (is_callable($button->renderIf) && call_user_func($button->renderIf))
                                    {!! !empty($button->separator)?$button->separator:'' !!}
                                @endif
                                {!! $button->render() !!}
                            @endif
                        @endforeach
                    </div>
                    <div class="float-right text-right">
                        @foreach($grid->getButtons('toolbar') as $button)
                            @if (empty($button->position_side) || $button->position_side !== 'left')
                                @if (is_callable($button->renderIf) && call_user_func($button->renderIf))
                                    {!! !empty($button->separator)?$button->separator:'' !!}
                                @endif
                                {!! $button->render() !!}
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    @endif
    <form action="{{ $grid->getSearchUrl() }}" method="GET" id="{{ $grid->getFilterFormId() }}"></form>
    <div class="table-responsive grid-wrapper">
        <table class="{{ $grid->getClass() }}">
            <thead class="{{ $grid->getHeaderClass() }}">
            <tr class="filter-header">
                @foreach($columns as $column)

                    @if($loop->first)

                        @if($column->isSortable)
                            <th scope="col"
                                class="{{ is_callable($column->columnClass) ? call_user_func($column->columnClass) : $column->columnClass }}"
                                title="{{ __("Click to sort by :name", ['name' => $column->name??$column->key]) }}">
                                <a data-trigger-pjax="1" class="data-sort"
                                   href="{{ $grid->getSortUrl($column->key, $grid->getSelectedSortDirection()) }}">
                                    @if($column->useRawHtmlForLabel)
                                        {!! $column->name !!}
                                    @else
                                        {{ $column->name }}
                                    @endif
                                    {!! request()->get('sort_by') == $column->key && request()->get('sort_dir') == 'asc'?"<i class='fas fa-fw fa-caret-up'></i>":"" !!}{!! request()->get('sort_by') == $column->key && request()->get('sort_dir') == 'desc'?"<i class='fas fa-fw fa-caret-down'></i>":"" !!}
                                </a>
                            </th>
                        @else
                            <th class="{{ is_callable($column->columnClass) ? call_user_func($column->columnClass) : $column->columnClass }}">
                                @if($column->useRawHtmlForLabel)
                                    {!! $column->name !!}
                                @else
                                    {{ $column->name }}
                                @endif
                            </th>
                        @endif
                    @else
                        @if($column->isSortable)
                            <th scope="col"
                                class="{{ is_callable($column->columnClass) ? call_user_func($column->columnClass) : $column->columnClass }}"
                                title="{{ __("Click to sort by :name", ['name' => $column->name??$column->key]) }}">
                                <a data-trigger-pjax="1" class="data-sort"
                                   href="{{ $grid->getSortUrl($column->key, $grid->getSelectedSortDirection()) }}">
                                    @if($column->useRawHtmlForLabel)
                                        {!! $column->name !!}
                                    @else
                                        {{ $column->name }}
                                    @endif
                                    {!! request()->get('sort_by') == $column->key && request()->get('sort_dir') == 'asc'?"<i class='fas fa-fw fa-caret-up'></i>":"" !!}{!! request()->get('sort_by') == $column->key && request()->get('sort_dir') == 'desc'?"<i class='fas fa-fw fa-caret-down'></i>":"" !!}
                                </a>
                            </th>
                        @else
                            <th scope="col"
                                class="{{ is_callable($column->columnClass) ? call_user_func($column->columnClass) : $column->columnClass }}">
                                @if($column->useRawHtmlForLabel)
                                    {!! $column->name !!}
                                @else
                                    {{ $column->name }}
                                @endif
                            </th>
                        @endif
                    @endif
                @endforeach
                <th></th>
            </tr>
            @if($grid->shouldRenderGridFilters())
                <tr>
                    {!! $grid->renderGridFilters() !!}
                </tr>
            @endif
            </thead>
            <tbody>
            @if($grid->hasItems())
                @if($grid->warnIfEmpty())
                    <tr>
                        <td class="alert alert-warning" role="alert" colspan="100">
                            <strong><i class="fa fa-exclamation-triangle"></i>&nbsp;<?php echo __("No data present") ?></strong>
                        </td>
                    </tr>
                @endif
            @else
                @foreach($grid->getData() as $index => $item)
                    @if($grid->allowsLinkableRows())
                        @php
                            $callback = call_user_func($grid->getLinkableCallback(), $grid->transformName(), $item);
                        @endphp
                        @php
                            $trClassCallback = call_user_func($grid->getRowCssStyle(), $grid->transformName(), $item, $index);
                        @endphp
                        <tr class="{{ trim("linkable " . $trClassCallback) }}" data-url="{{ $callback }}">
                    @else
                        @php
                            $trClassCallback = call_user_func($grid->getRowCssStyle(), $grid->transformName(), $item, $index);
                        @endphp
                        <tr class="{{ $trClassCallback }}">
                            @endif
                            @foreach($columns as $column)
                                @if(is_callable($column->data))
                                    @if($column->useRawFormat)
                                        <td class="{{ $column->rowClass }}">
                                            {!! call_user_func($column->data, $item, $column->key) !!}
                                        </td>
                                    @else
                                        <td class="{{ $column->rowClass }}">
                                            {{ call_user_func($column->data , $item, $column->key) }}
                                        </td>
                                    @endif
                                @else
                                    @if($column->useRawFormat)
                                        <td class="{{ $column->rowClass }}">
                                            {!! $item->{$column->key} !!}
                                        </td>
                                    @else
                                        <td class="{{ $column->rowClass }}">
                                            {{ $item->{$column->key} }}
                                        </td>
                                    @endif
                                @endif
                                @if($loop->last && $grid->hasButtons('rows'))
                                    <td>
                                        <div class="pull-right">
                                            @foreach($grid->getButtons('rows') as $button)
                                                @if(call_user_func($button->renderIf, $grid->transformName(), $item))
                                                    {!! $button->render(['gridName' => $grid->transformName(), 'gridItem' => $item]) !!}
                                                @else
                                                    @continue
                                                @endif
                                            @endforeach
                                        </div>
                                    </td>
                                @endif
                            @endforeach
                        </tr>
                        @endforeach
                        @if($grid->shouldShowFooter())
                            <tr class="{{ $grid->getGridFooterClass() }}">
                                @foreach($columns as $column)
                                    @if($column->footer === null)
                                        <td></td>
                                    @else
                                        <td>
                                            {!! call_user_func($column->footer) !!}
                                        </td>
                                    @endif
                                    @if($loop->last)
                                        <td></td>
                                    @endif
                                @endforeach
                            </tr>
                        @endif
                    @endif
            </tbody>
        </table>
    </div>
@overwrite
@push('grid_js')
    <script>
        (function ($) {
            var grid = "{{ '#' . $grid->getId() }}";
            var filterForm = "{{ '#' . $grid->getFilterFormId() }}";
            var searchForm = "{{ '#' . $grid->getSearchFormId() }}";
            _grids.grid.init({
                id: grid,
                filterForm: filterForm,
                dateRangeSelector: '.date-range',
                searchForm: searchForm,
                pjax: {
                    pjaxOptions: {
                        scrollTo: false,
                    },
                    // what to do after a PJAX request. Js plugins have to be re-intialized
                    afterPjax: function (e) {
                        _grids.init();
                    },
                },
            });
        })(jQuery);
    </script>
@endpush
