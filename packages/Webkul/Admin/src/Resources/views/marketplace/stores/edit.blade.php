@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.marketplace.stores.edit-title') }}
@stop

@section('content')
    <div class="content">
        <?php $locale = request()->get('locale') ?: app()->getLocale(); ?>

        <form method="POST" action="" @submit.prevent="onSubmit" enctype="multipart/form-data">

            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/admin/dashboard') }}';"></i>

                        {{ __('admin::app.marketplace.stores.edit-title') }}
                    </h1>

                    <div class="control-group">
                        <select class="control" id="locale-switcher" onChange="window.location.href = this.value">
                            @foreach (core()->getAllLocales() as $localeModel)

                                <option value="{{ route('admin.marketplace.stores.update', $store->id) . '?locale=' . $localeModel->code }}" {{ ($localeModel->code) == $locale ? 'selected' : '' }}>
                                    {{ $localeModel->name }}
                                </option>

                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('admin::app.marketplace.stores.save-btn-title') }}
                    </button>
                </div>
            </div>

            <div class="page-content">
                @csrf()

                <accordian :title="'{{ __('admin::app.marketplace.stores.general') }}'" :active="true">

                    <div slot="body">

                        <div class="control-group" :class="[errors.has('{{$locale}}[name]') ? 'has-error' : '']">
                            <label for="name" class="required">{{ __('admin::app.marketplace.stores.name') }}</label>
                            <input type="text" v-validate="'required'" class="control" id="name" name="{{$locale}}[name]" value="{{ old($locale)['name'] ?: $store->translate($locale)['name'] }}" data-vv-as="&quot;{{ __('admin::app.marketplace.stores.name') }}&quot;"/>
                            <span class="control-error" v-if="errors.has('{{$locale}}[name]')">@{{ errors.first('{!!$locale!!}[name]') }}</span>
                        </div>

                        <div class="control-group" :class="[errors.has('tax_number') ? 'has-error' : '']">
                            <label for="tax_number">{{ __('admin::app.marketplace.stores.tax-number') }}</label>
                            <input type="text" class="control" id="tax_number" name="tax_number" value="{{$store->tax_number}}"/>
                            <span class="control-error" v-if="errors.has('tax_number')">@{{ errors.first('tax_number') }}</span>
                        </div>

                        @include ('admin::marketplace.stores.country-state', ['countryCode' => 'SY', 'stateCode' => 'DMSC'])

                        <div class="control-group" :class="[errors.has('{{$locale}}[address]') ? 'has-error' : '']">
                            <label for="address" class="required">{{ __('admin::app.marketplace.stores.address') }}</label>
                            <input type="text" v-validate="'required'" class="control" id="address" name="{{$locale}}[address]" value="{{ old($locale)['address'] ?: $store->translate($locale)['address'] }}" data-vv-as="&quot;{{ __('admin::app.marketplace.stores.address') }}&quot;"/>
                            <span class="control-error" v-if="errors.has('{{$locale}}[address]')">@{{ errors.first('{!!$locale!!}[address]') }}</span>
                        </div>

                        <div class="control-group" :class="[errors.has('status') ? 'has-error' : '']">
                            <label for="status" class="required">{{ __('admin::app.marketplace.stores.status') }}</label>
                            <select class="control" v-validate="'required'" id="status" name="status" data-vv-as="&quot;{{ __('admin::app.marketplace.stores.status') }}&quot;">
                                <option value="1" {{ $store->status ? 'selected' : '' }}>
                                    {{ __('admin::app.marketplace.stores.yes') }}
                                </option>
                                <option value="0" {{ $store->status ? '' : 'selected' }}>
                                    {{ __('admin::app.marketplace.stores.no') }}
                                </option>
                            </select>
                            <span class="control-error" v-if="errors.has('status')">@{{ errors.first('status') }}</span>
                        </div>
                        <div class="control-group"></div>

                    </div>
                </accordian>

                <accordian :title="'{{ __('admin::app.marketplace.stores.social-links') }}'" :active="true">

                </accordian>

                <input name="_method" type="hidden" value="PUT">

            </div>

        </form>

    </div>
@stop

@push('scripts')
    <script src="{{ asset('vendor/webkul/admin/assets/js/tinyMCE/tinymce.min.js') }}"></script>

    <script>
        $(document).ready(function () {

            tinymce.init({
                selector: 'textarea#description, textarea#short_description',
                height: 200,
                width: "100%",
                plugins: 'image imagetools media wordcount save fullscreen code',
                toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent  | removeformat | code',
                image_advtab: true
            });
        });
    </script>

@endpush