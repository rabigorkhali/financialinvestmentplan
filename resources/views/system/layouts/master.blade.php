<!DOCTYPE html>
<html lang="en">
@include('system.layouts.layoutHeader')
<body>
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
                @yield('heading-contents')
            </div>
            @yield('contents')
        </div>
        <!-- Page Sidebar Ends-->
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <form method="post">
                    <div class="modal-content">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title">{{ translate('Confirm Delete') }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{ translate('Are you sure you want to delete?') }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
                                <em class="glyph-icon icon-close"></em> {{ translate('Cancel') }}
                            </button>
                            <button type="submit" class="btn btn-sm btn-danger" id="confirmDelete">
                                <em class="glyph-icon icon-trash"></em> {{ translate('Delete') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- footer start-->
        @include('system.layouts.layoutFooter')
        @yield('scripts')
    </div>
</div>
</body>

</html>
