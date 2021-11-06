@extends('layouts.backend.master')

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') User @endslot
        @slot('title') Notifications @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-12 col-md-6">
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3 text-end">
                                <a class="btn btn-primary btn-on-mobile" href="{{ route('notify.readAll') }}">@lang('button.mark_all_read')</a>
                                <a class="btn btn-danger btn-on-mobile" href="{{ route('notify.removeAll') }}">@lang('button.delete_all')</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Nr.</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">@lang('pdrnl.time')</th>
                                        <th scope="col">Info</th>
                                        <th scope="col">@lang('pdrnl.subject')</th>
                                        <th scope="col">@lang('pdrnl.message')</th>
                                        <th scope="col">@lang('button.options')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notifications as $notify)
                                        <tr class="notify-table {{ $notify->read_at == null ? 'notify-table-unread' : '' }}">
                                            <th>{{ $loop->iteration }}</th>
                                            <!-- Status -->
                                            <td>
                                                @if ($notify->read_at == null)
                                                    <span class="badge bg-warning">@lang('pdrnl.unread')</span>
                                                @else
                                                    <span class="badge bg-success">@lang('pdrnl.read')</span>
                                                @endif
                                            </td>
                                            <!-- Time -->
                                            <td>{{ $notify->created_at->diffForHumans() }}</td>
                                            <!-- Info link -->
                                            <td>
                                                @if ($notify->data['link'])
                                                    <a class="btn btn-sm btn-primary" href="{{ route('notify.show', $notify->id) }}">{{__('Click')}}</a>
                                                @endif
                                            </td>
                                            <!-- Title -->
                                            <td>
                                                @if (isset($notify['data']['title']) != null)
                                                    {{ $notify->data['title'] }}
                                                @else
                                                    Platform Drone Racing NL
                                                @endif
                                            </td>
                                            <td>
                                                @if (($notify->data['type']) == "registration")
                                                    {{ __($notify->data['message']) }} <b>{{ __($notify->data['status']) }}</b>
                                                @else
                                                    {{ __($notify->data['message']) }}
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('notify.remove', $notify->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="btn btn-sm btn-success" href="{{ route('notify.read', $notify->id) }}">@lang('button.mark_read')</a>
                                                    <button type="submit" class="btn btn-sm btn-danger">@lang('button.delete')</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection