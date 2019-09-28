@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.marketplace.categories.title') }}
@stop

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.marketplace.categories.title') }}</h1>
            </div>

            <div class="page-action">
                <div class="export-import" @click="showModal('downloadDataGrid')">
                    <i class="export-icon"></i>
                    <span>
                        {{ __('admin::app.export.export') }}
                    </span>
                </div>

                <a href="{{ route('admin.marketplace.categories.create') }}" class="btn btn-lg btn-primary">
                    {{ __('admin::app.marketplace.categories.add-category-btn-title') }}
                </a>

            </div>
        </div>

        <div class="page-content">
            @inject('categoryGrid', 'Webkul\Admin\DataGrids\StoreCategoryDataGrid')
            {!! $categoryGrid->render() !!}
        </div>
    </div>

    <modal id="downloadDataGrid" :is-open="modalIds.downloadDataGrid">
        <h3 slot="header">{{ __('admin::app.export.download') }}</h3>
        <div slot="body">
            <export-form></export-form>
        </div>
    </modal>

@stop

@push('scripts')
@endpush