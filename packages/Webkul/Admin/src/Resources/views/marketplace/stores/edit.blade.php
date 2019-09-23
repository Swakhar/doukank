@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.marketplace.stores.edit-title') }}
@stop

@section('content')
    <div class="content">
        <?php $locale = request()->get('locale') ?: app()->getLocale(); ?>
        <?php $channel = request()->get('channel') ?: core()->getDefaultChannelCode(); ?>

        {!! view_render_event('bagisto.admin.marketplace.store.edit.before', ['store' => $store]) !!}

        <form method="POST" action="" @submit.prevent="onSubmit" enctype="multipart/form-data">

            <div class="page-header">

                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/admin/dashboard') }}';"></i>

                        {{ __('admin::app.marketplace.stores.edit-title') }}
                    </h1>

{{--                    <div class="control-group">--}}
{{--                        <select class="control" id="channel-switcher" name="channel">--}}
{{--                            @foreach (core()->getAllChannels() as $channelModel)--}}

{{--                                <option value="{{ $channelModel->code }}" {{ ($channelModel->code) == $channel ? 'selected' : '' }}>--}}
{{--                                    {{ $channelModel->name }}--}}
{{--                                </option>--}}

{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}

                    <div class="control-group">
                        <select class="control" id="locale-switcher" name="locale" onChange="window.location.href = this.value">
                            @foreach (core()->getAllLocales() as $localeModel)

                                <option value="{{ $localeModel->code }}" {{ ($localeModel->code) == $locale ? 'selected' : '' }}>
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

                <accordian title="Category" :active="true">

                    <div slot="body">

                        <div class="control-group text">
                            <label for="title" class="required">Store Title</label>
                            <input type="text" name="title" name="{{$locale}}[title]" value="{{ old($locale)['title'] ?: $store->translate($locale)['title'] }}" class="control">
                        </div>

                        <div class="control-group boolean">
                            <label for="status" class="required">Status</label>
                            <select name="status" class="control">

                                <option value="0">Inactive</option>
                                <option value="1">Active</option>
                            </select>
                        </div>

                        <div class="control-group"></div>

                    </div>
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
            $('#channel-switcher, #locale-switcher').on('change', function (e) {
                $('#channel-switcher').val()
                var query = '?channel=' + $('#channel-switcher').val() + '&locale=' + $('#locale-switcher').val();

                window.location.href = "{{ route('admin.marketplace.stores.edit', $store->id)  }}" + query;
            })

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