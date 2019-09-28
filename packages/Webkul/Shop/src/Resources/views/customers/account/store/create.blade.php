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

                    @include ('seller::store.partials.create')

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