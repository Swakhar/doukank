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

                        <div class="control-group" :class="[errors.has('category') ? 'has-error' : '']">
                            <label for="category_id" class="required">
                                {{ __('admin::app.marketplace.stores.category') }}
                            </label>
                            <select class="control" id="category_id" name="category_id">
                                <option value="">{{ __('admin::app.marketplace.stores.select-category') }}</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" {{$store->category_id == $category->id ? 'selected' : ''}} v-validate="'required'" >{{$category->translate($locale)['name']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="control-group" :class="[errors.has('tax_number') ? 'has-error' : '']">
                            <label for="tax_number">{{ __('admin::app.marketplace.stores.tax-number') }}</label>
                            <input type="text" class="control" id="tax_number" name="tax_number" value="{{$store->tax_number}}"/>
                            <span class="control-error" v-if="errors.has('tax_number')">@{{ errors.first('tax_number') }}</span>
                        </div>

                        @include ('admin::marketplace.stores.country-state', ['countryCode' => 'SY'])

                        <div class="control-group" :class="[errors.has('{{$locale}}[address]') ? 'has-error' : '']">
                            <label for="address">{{ __('admin::app.marketplace.stores.address') }}</label>
                            <input type="text" class="control" id="address" name="{{$locale}}[address]" value="{{ old($locale)['address'] ?: $store->translate($locale)['address'] }}" data-vv-as="&quot;{{ __('admin::app.marketplace.stores.address') }}&quot;"/>
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
                    <div slot="body">
                        @foreach($socialmedia = ['facebook', 'twitter', 'instagram', 'telegram'] as $item)
                            <div class="control-group" :class="[errors.has({{$item}}) ? 'has-error' : '']">
                                <label for="{{$item}}">{{ __('admin::app.marketplace.stores.'.$item) }}</label>
                                <input type="text" class="control" id="{{$item}}" name="{{$item}}" value="{{$store->$item}}"/>
                            </div>
                        @endforeach
                    </div>
                </accordian>

                <accordian :title="'{{ __('admin::app.marketplace.stores.description-and-images') }}'" :active="true">
                    <div slot="body">

{{--                        {!! view_render_event('bagisto.admin.catalog.category.edit_form_accordian.description_images.controls.before', ['category' => $category]) !!}--}}

                        <description></description>

                        <div class="control-group {!! $errors->has('image.*') ? 'has-error' : '' !!}">
                            <label>{{ __('admin::app.catalog.categories.image') }}

                                <image-wrapper :button-label="'{{ __('admin::app.catalog.products.add-image-btn-title') }}'" input-name="image" :multiple="false"  :images='"{{ $store->image_url }}"'></image-wrapper>

                                <span class="control-error" v-if="{!! $errors->has('image.*') !!}">
                                    @foreach ($errors->get('image.*') as $key => $message)
                                        @php echo str_replace($key, 'Image', $message[0]); @endphp
                                    @endforeach
                                </span>

                        </div>

{{--                        {!! view_render_event('bagisto.admin.catalog.category.edit_form_accordian.description_images.controls.after', ['category' => $category]) !!}--}}

                    </div>
                </accordian>

{{--                {!! view_render_event('bagisto.admin.catalog.category.edit_form_accordian.seo.before', ['category' => $category]) !!}--}}

                <accordian :title="'{{ __('admin::app.marketplace.stores.seo') }}'" :active="true">
                    <div slot="body">

{{--                        {!! view_render_event('bagisto.admin.catalog.category.edit_form_accordian.seo.controls.before', ['category' => $category]) !!}--}}

                        <div class="control-group">
                            <label for="meta_title">{{ __('admin::app.marketplace.stores.meta_title') }}</label>
                            <input type="text" class="control" id="meta_title" name="{{$locale}}[meta_title]" value="{{ old($locale)['meta_title'] ?: $store->translate($locale)['meta_title'] }}"/>
                        </div>

                        <div class="control-group">
                            <label for="meta_description">{{ __('admin::app.marketplace.stores.meta_description') }}</label>
                            <textarea class="control" id="meta_description" name="{{$locale}}[meta_description]">{{ old($locale)['meta_description'] ?: $store->translate($locale)['meta_description'] }}</textarea>
                        </div>

                        <div class="control-group">
                            <label for="meta_keywords">{{ __('admin::app.marketplace.stores.meta_keywords') }}</label>
                            <textarea class="control" id="meta_keywords" name="{{$locale}}[meta_keywords]">{{ old($locale)['meta_keywords'] ?: $store->translate($locale)['meta_keywords'] }}</textarea>
                        </div>

{{--                        {!! view_render_event('bagisto.admin.catalog.category.edit_form_accordian.seo.controls.after', ['category' => $category]) !!}--}}

                    </div>
                </accordian>

{{--                {!! view_render_event('bagisto.admin.catalog.category.edit_form_accordian.seo.after', ['category' => $category]) !!}--}}

                <input name="_method" type="hidden" value="PUT">

            </div>

        </form>

    </div>
@stop

@push('scripts')
    <script src="{{ asset('vendor/webkul/admin/assets/js/tinyMCE/tinymce.min.js') }}"></script>

    <script type="text/x-template" id="description-template">

        <div class="control-group" :class="[errors.has('{{$locale}}[description]') ? 'has-error' : '']">
            <label for="description" :class="isRequired ? 'required' : ''">{{ __('admin::app.marketplace.stores.description') }}</label>
            <textarea v-validate="isRequired ? 'required' : ''" class="control" id="description" name="{{$locale}}[description]" data-vv-as="&quot;{{ __('admin::app.marketplace.stores.description') }}&quot;">{{ old($locale)['description'] ?: $store->translate($locale)['description'] }}</textarea>
            <span class="control-error" v-if="errors.has('{{$locale}}[description]')">@{{ errors.first('{!!$locale!!}[description]') }}</span>
        </div>

    </script>

    <script>
        $(document).ready(function () {
            tinymce.init({
                selector: 'textarea#description',
                height: 200,
                width: "100%",
                plugins: 'image imagetools media wordcount save fullscreen code',
                toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent  | removeformat | code',
                image_advtab: true
            });
        });

        Vue.component('description', {

            template: '#description-template',

            inject: ['$validator'],

            data: function() {
                return {
                    isRequired: true,
                }
            },

            // created: function () {
            //     var this_this = this;
            //
            //     $(document).ready(function () {
            //         $('#display_mode').on('change', function (e) {
            //             if ($('#display_mode').val() != 'products_only') {
            //                 this_this.isRequired = true;
            //             } else {
            //                 this_this.isRequired = false;
            //             }
            //         })
            //
            //         if ($('#display_mode').val() != 'products_only') {
            //             this_this.isRequired = true;
            //         } else {
            //             this_this.isRequired = false;
            //         }
            //     });
            // }
        })
    </script>

@endpush