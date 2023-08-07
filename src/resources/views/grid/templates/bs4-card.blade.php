<div class="row laravel-grid" id="{{ $grid->getId() }}">
    <div class="col-md-12 col-xs-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <div class="float-left">
                            <h4 class="grid-title">{{ $grid->renderTitle() }}</h4>
                        </div>
                        <div class="float-right">
                            {!! $grid->renderPaginationInfoAtHeader() !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        {!! $grid->renderTabs() !!}
                    </div>
                </div>
            </div>
            <div class="card-body">
                @yield('data')
            </div>
            <div class="card-footer">
                <div class="float-left">
                    {!! $grid->renderPaginationInfoAtFooter() !!}
                </div>
                <div class="float-right">
                    {!! $grid->renderPaginationLinksSection() !!}
                </div>
            </div>
        </div>
    </div>
</div>
