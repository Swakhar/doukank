<div class="control-group" :class="[errors.has('state') ? 'has-error' : '']">
    <label for="state_id" class="required">
        {{ __('admin::app.marketplace.stores.state') }}
    </label>
    <select class="control" id="state_id" name="state_id">
        <option value="">{{ __('admin::app.marketplace.stores.select-state') }}</option>
        @foreach(core()->states($countryCode) as $state)
            <option value="{{$state->id}}">{{$state->translate($locale)['name']}}</option>
        @endforeach
    </select>
    <span class="control-error" v-if="errors.has('state')">
        @{{ errors.first('state') }}
    </span>
</div>
{{--@push('scripts')--}}

{{--    <script type="text/x-template" id="country-state-template">--}}
{{--        <div>--}}
{{--            <div class="control-group" :class="[errors.has('state') ? 'has-error' : '']">--}}
{{--                <label for="state" class="required">--}}
{{--                    {{ __('admin::app.marketplace.stores.state') }}--}}
{{--                </label>--}}

{{--                <input type="text" v-validate="'required'" class="control" id="state" name="state" v-model="state" v-if="!haveStates()" data-vv-as="&quot;{{ __('shop::app.customer.account.address.create.state') }}&quot;"/>--}}
{{--                <select v-validate="'required'" class="control" id="state" name="state" v-model="state" v-if="haveStates()" data-vv-as="&quot;{{ __('shop::app.customer.account.address.create.state') }}&quot;">--}}

{{--                    <option value="">{{ __('admin::app.marketplace.stores.select-state') }}</option>--}}

{{--                    <option v-for='(state, index) in countryStates[country]' :value="state.code">--}}
{{--                        $countryCode--}}
{{--                    </option>--}}

{{--                </select>--}}

{{--                <span class="control-error" v-if="errors.has('state')">--}}
{{--                    @{{ errors.first('state') }}--}}
{{--                </span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </script>--}}

{{--    <script>--}}
{{--        Vue.component('country-state', {--}}

{{--            template: '#country-state-template',--}}

{{--            inject: ['$validator'],--}}

{{--            data() {--}}
{{--                return {--}}
{{--                    country: "{{ $countryCode  }}",--}}

{{--                    state: "{{ $stateCode  }}",--}}

{{--                    countryStates: @json(core()->groupedStatesByCountries())--}}
{{--                }--}}
{{--            },--}}

{{--            methods: {--}}
{{--                haveStates() {--}}
{{--                    if (this.countryStates[this.country] && this.countryStates[this.country].length)--}}
{{--                        return true;--}}

{{--                    return false;--}}
{{--                },--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}
{{--@endpush--}}