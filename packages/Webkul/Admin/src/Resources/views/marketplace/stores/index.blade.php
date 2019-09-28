@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.marketplace.stores.title') }}
@stop

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.marketplace.stores.title') }}</h1>
            </div>

            <div class="page-action">
                <div class="export-import" @click="showModal('downloadDataGrid')">
                    <i class="export-icon"></i>
                    <span>
                        {{ __('admin::app.export.export') }}
                    </span>
                </div>

                <a href="{{ route('admin.marketplace.stores.create') }}" class="btn btn-lg btn-primary">
                    {{ __('admin::app.marketplace.stores.add-store-btn-title') }}
                </a>

            </div>
        </div>

        <div class="page-content">
            @inject('sellerGrid', 'Webkul\Admin\DataGrids\StoreDataGrid')
            {!! $sellerGrid->render() !!}
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