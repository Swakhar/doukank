@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.customer.account.store.my-store.page-title') }}
@endsection

@section('content-wrapper')

    <div class="account-content">
        @include('shop::customers.account.partials.sidemenu')

        <div class="account-layout">

            <div class="account-head mb-10">
                <span class="back-icon"><a href="{{ route('customer.account.index') }}"><i class="icon icon-menu-back"></i></a></span>
                <span class="account-heading">
                    {{ __('shop::app.customer.account.store.my-store.title') }}
                </span>

                <div class="horizontal-rule"></div>
            </div>

        </div>

    </div>

@endsection