<!DOCTYPE html>
<html lang="en">
@include('system.layouts.layoutHeader')

<body class="rtl">
<!-- Loader starts-->
@include('system.partials.loader')
<!-- Loader ends-->
<!-- tap on top starts-->
<div class="tap-top"><i data-feather="chevrons-up"></i></div>
<!-- tap on tap ends-->
<!-- page-wrapper Start-->
<div class="page-wrapper compact-wrapper" id="pageWrapper">
    <!-- Page Header Start-->
    @include('system.partials.header')
    <!-- Page Header Ends -->
    <!-- Page Body Start-->
    <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        @include('system.partials.sidebar')
        <div class="page-body">
            <div class="container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <h3>{{ $title ?? '' }}</h3>
                        </div>
                        <div class="col-12 col-sm-6">
                            @include('system.partials.breadcrumb')
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="card">
                        @section('create')
                            <div class="col-12 mt-2">
                                @if (hasPermission($indexUrl . '/create'))
                                    <a class="btn btn-primary pull-right btn-sm" id="addNew"
                                       href="{{ url($indexUrl . '/create') }}">
                                        <em class="fa fa-plus"></em> {{ translate('Add New') }}
                                    </a>
                                @endif
                            </div>
                        @show

                        <div class="card-header pb-0 ">
                            @yield('header')
                            <div class="panel">
                                <div class="panel-box">
                                    @include('system.partials.message')
                                    <div class="table-responsive mt-3">
                                        <table class="table table-striped table-bordered"
                                               aria-describedby="general table">
                                            <thead>
                                            @yield('table-heading')
                                            </thead>
                                            <tbody>
                                            @if ($items->isEmpty())
                                                <tr>
                                                    <td colspan="100%" class="text-center">
                                                        {{ translate('No data available') }}</td>
                                                </tr>
                                            @else
                                                @yield('table-data')
                                            @endif
                                            </tbody>
                                        </table>
                                        @include('system.partials.pagination')
                                        <br>
                                    </div>
                                </div>
                            </div><!-- panel -->
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- ends content-display -->

    </div>
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form method="post">
                <div class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">
                            {{ translate('Confirm Delete') }}
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body message-body">
                        {{ translate('Are you sure you want to delete?') }}

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
                            <em class="glyph-icon icon-close"></em>
                            {{ translate('Cancel') }}
                        </button>
                        <button type="submit" class="btn btn-sm btn-danger" id="confirmDelete">
                            <em class="glyph-icon icon-trash"></em>
                            {{ translate('Delete') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="statusChangeModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="statusForm" method="GET" action="">
                <div class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="statusChangeModal">{{ translate('Confirm Update') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body message-body">
                        <strong>{{ translate('Are you sure you want to update status?') }}</strong>
                    </div>
                    <div class="modal-footer">
                        <a type="button" href="{{$indexUrl}}" class="btn btn-sm btn-secondary" data-dismiss="modal">
                            <em class="glyph-icon icon-close"></em>
                            {{ translate('Cancel') }}
                        </a>
                        <button type="submit" class="btn btn-sm btn-primary" id="confirmUpdate">
                            <em class="glyph-icon icon-trash"></em>
                            {{ translate('Update') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Page Sidebar Ends-->

    <!-- footer start-->
    @include('system.layouts.layoutFooter')
    @yield('scripts');

</div>
</body>

</html>
