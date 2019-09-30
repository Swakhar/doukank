<input type="hidden" name="locale" value="all"/>


{!! view_render_event('bagisto.shop.customers.account.store.create_form_controls.before') !!}

<div class="control-group" :class="[errors.has('name') ? 'has-error' : '']">
    <label for="name" class="required">{{ __('shop::app.customer.account.store.create.store-title') }}</label>
    <input type="text" class="control" name="{{$locale}}[name]" placeholder="{{__('shop::app.customer.account.store.create.title-placeholder')}}" id="name" v-validate="'required'" data-vv-as="&quot;{{ __('shop::app.customer.account.store.create.title') }}&quot;">
    <span class="control-error" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
</div>

@include ('admin::marketplace.stores.country-state', ['countryCode' => 'SY'])

<div class="control-group" :class="[errors.has('category') ? 'has-error' : '']">
    <label for="category_id" class="required">
        {{ __('shop::app.customer.account.store.create.store-category') }}
    </label>
    <select class="control" id="category_id" name="category_id">
        <option value="">{{ __('shop::app.customer.account.store.create.select-category') }}</option>
        @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->translate($locale)['name']}}</option>
        @endforeach
    </select>
</div>

<div class="control-group" :class="[errors.has('phone') ? 'has-error' : '']">
    <label for="phone" class="required">{{ __('shop::app.customer.account.store.create.phone') }}</label>
    <input type="text" class="control" name="phone" v-validate="'required'" data-vv-as="&quot;{{ __('shop::app.customer.account.store.create.phone') }}&quot;">
    <span class="control-error" v-if="errors.has('phone')">@{{ errors.first('phone') }}</span>
</div>