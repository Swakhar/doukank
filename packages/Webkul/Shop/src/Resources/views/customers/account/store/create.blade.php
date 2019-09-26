@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.customer.account.store.create.page-title') }}
@endsection

@section('content-wrapper')
    <?php $locale = request()->get('locale') ?: app()->getLocale(); ?>
    <div class="account-content">

        @include('shop::customers.account.partials.sidemenu')

        <div class="account-layout">
            <div class="account-head mb-15">
                <span class="back-icon"><a href="{{ route('customer.account.index') }}"><i class="icon icon-menu-back"></i></a></span>
                <span class="account-heading">{{ __('shop::app.customer.account.store.create.title') }}</span>
                <span></span>
            </div>

            {!! view_render_event('bagisto.shop.customers.account.store.create.before') !!}

            <form method="post" action="{{ route('customer.store.create') }}" @submit.prevent="onSubmit">

                <div class="account-table-content">
                    @csrf
                    <input type="hidden" name="locale" value="all"/>


                    {!! view_render_event('bagisto.shop.customers.account.store.create_form_controls.before') !!}

                    <div class="control-group" :class="[errors.has('name') ? 'has-error' : '']">
                        <label for="name" class="required">{{ __('shop::app.customer.account.store.create.store-title') }}</label>
                        <input type="text" class="control" name="{{$locale}}[name]" id="name" v-validate="'required'" data-vv-as="&quot;{{ __('shop::app.customer.account.store.create.title') }}&quot;">
                        <span class="control-error" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
                    </div>

{{--                    <div class="control-group" :class="[errors.has('url') ? 'has-error' : '']">--}}
{{--                        <label for="url" class="required">{{ __('shop::app.customer.account.store.create.url') }}</label>--}}
{{--                        <input type="text" class="control" name="url" id="url" v-validate="'required'" data-vv-as="&quot;{{ __('shop::app.customer.account.store.create.url') }}&quot;">--}}
{{--                        <span class="control-error" v-if="errors.has('url')">@{{ errors.first('url') }}</span>--}}
{{--                    </div>--}}

                    @if (core()->getConfigData('customer.settings.address.street_lines') && core()->getConfigData('customer.settings.address.street_lines') > 1)
                        <div class="control-group" style="margin-top: -25px;">
                            @for ($i = 1; $i < core()->getConfigData('customer.settings.address.street_lines'); $i++)
                                <input type="text" class="control" name="address1[{{ $i }}]" id="address_{{ $i }}">
                            @endfor
                        </div>
                    @endif

                    @include ('admin::marketplace.stores.country-state', ['countryCode' => 'SY'])

{{--                    <div class="control-group" :class="[errors.has('city') ? 'has-error' : '']">--}}
{{--                        <label for="city" class="required">{{ __('shop::app.customer.account.store.create.city') }}</label>--}}
{{--                        <input type="text" class="control" name="city" v-validate="'required'" data-vv-as="&quot;{{ __('shop::app.customer.account.store.create.city') }}&quot;">--}}
{{--                        <span class="control-error" v-if="errors.has('city')">@{{ errors.first('city') }}</span>--}}
{{--                    </div>--}}

{{--                    <div class="control-group" :class="[errors.has('postcode') ? 'has-error' : '']">--}}
{{--                        <label for="postcode" class="required">{{ __('shop::app.customer.account.address.create.postcode') }}</label>--}}
{{--                        <input type="text" class="control" name="postcode" v-validate="'required'" data-vv-as="&quot;{{ __('shop::app.customer.account.address.create.postcode') }}&quot;">--}}
{{--                        <span class="control-error" v-if="errors.has('postcode')">@{{ errors.first('postcode') }}</span>--}}
{{--                    </div>--}}

                    <div class="control-group" :class="[errors.has('phone') ? 'has-error' : '']">
                        <label for="phone" class="required">{{ __('shop::app.customer.account.store.create.phone') }}</label>
                        <input type="text" class="control" name="phone" v-validate="'required'" data-vv-as="&quot;{{ __('shop::app.customer.account.store.create.phone') }}&quot;">
                        <span class="control-error" v-if="errors.has('phone')">@{{ errors.first('phone') }}</span>
                    </div>

                    {!! view_render_event('bagisto.shop.customers.account.address.create_form_controls.after') !!}

                    <div class="button-group">
                        <input class="btn btn-primary btn-lg" type="submit" value="{{ __('shop::app.customer.account.store.create.submit') }}">
                        {{-- <button class="btn btn-primary btn-lg" type="submit">
                            {{ __('shop::app.customer.account.address.edit.submit') }}
                        </button> --}}
                    </div>

                </div>

            </form>

            {!! view_render_event('bagisto.shop.customers.account.store.create.after') !!}

        </div>
    </div>

@endsection