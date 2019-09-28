@php(
    $customer = auth()->guard('customer')->user()
)
@if($customer->isSeller() && $customer->store->isActive())
    @include('shop::customers.account.partials.sellersidemenu')
@else
    @include('shop::customers.account.partials.customersidemenu')
@endif()