@extends('layouts.admin')

@section('content')

<div class="container-fluid page-wrapper">
    <!-- Page Heading -->

    <div class="row mb-2 justify-content-between pl-1 pr-1 align-items-center">
        <div>
            <h1 class="a_dash m-0 p-0 d-inline-block">
                Elevations <small><span class="color-secondary">|</span></small>
            </h1>

            <div class="row breadcrumbs-top pl-2 d-inline-block">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('homes') }}"> {{ $home->title }} </a>
                    </li>

                    <li class="breadcrumb-item active">Gallery</li>
                </ol>
            </div>
        </div>
        <div class="btn-group">
            <a href="{{ route('homes') }}" class="add_button"><i class="fa fa-arrow-left position-relative"></i> Back</a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-content collapse show">
            <div class="card-body p-0">
                <nav>
                    <div class="nav nav-tabs myTabSettings" role="tablist">
                        <a class="nav-item wf-20 nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true" style="line-height: 30px;"> GALLERY</a>
                    </div>
                </nav>

                <div class="tab-content p-2" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="formbox">
                            <form action="javascript:void(0);" id="uploadHomeForm" name="frmupload" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group" id="f_mar">
                                            <label for="logoImage">Upload Image</label>

                                            <div class="imageupload panel panel-default">
                                                <div class="file-tab panel-body">
                                                    <label class="btn btn-default btn-file rounded-0">
                                                        Choose File

                                                        <input type="file" id="uploadHomeImage" onclick="form.submit()" name="uploadHomeImage" style="visibility: hidden; width: 5px;" />
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="logoImage" class="d-block" style="visibility: hidden;"> action</label>

                                        <input id="submitButton" type="submit" name="btnSubmit" class="btn-orange" value="Upload Image" />

                                        <input type="hidden" name="home_id" value="{{$home->id}}" />
                                    </div>

                                    <div class="col-md-4">
                                        <div id="message" style="display: none;"></div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="grid-hover row" id="galleryrow"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-xl_1" id="image-delete" tabindex="-1" role="dialog" aria-labelledby="add_design_groupLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Confirmation</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-times"></i> </span>
                    </button>
                </div>

                <form method="post" action="javascript:void(0)" name="deleteHomeImgForm" id="deleteHomeImgForm">
                    @csrf

                    <input type="hidden" id="hid" name="hid" value="{{ $home->id }}" />

                    <input type="hidden" id="gname" name="gname" value="" />

                    <div class="modal-body">
                        <div class="row">
                            <h6 class="delete_heading">Are you sure you want to delete this Image?</h6>

                            <div class="clearfix"></div>

                            <div class="m-auto">
                                <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr">No</button>

                                <button type="submit" class="btn-orange t_b_s">Yes</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-xl_1" id="image-floor-delete" tabindex="-1" role="dialog" aria-labelledby="add_design_groupLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Confirmation</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-times"></i> </span>
                    </button>
                </div>

                <form method="post" action="javascript:void(0)" name="deleteFloorImgForm" id="deleteFloorImgForm">
                    @csrf

                    <input type="hidden" id="hid" name="hid" value="{{ $home->id }}" />

                    <input type="hidden" id="gname" name="gname" value="" />

                    <div class="modal-body">
                        <div class="row">
                            <h6 class="delete_heading">Are you sure you want to delete this Image?</h6>

                            <div class="clearfix"></div>

                            <div class="m-auto">
                                <button type="button" data-dismiss="modal" class="btn-orange t_b_s d_gr">No</button>

                                <button type="submit" class="btn-orange t_b_s">Yes</button>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="{{ asset('cms/css/gallery.css') }}">

<script>
    function deleteImage(val) {

        $('#deleteHomeImgForm input#gname').val($('#ablock' + val).attr('data-gname'));

        $('#image-delete').modal('show');

    }

    function deleteFloorImage(val) {

        $('#deleteFloorImgForm input#gname').val($('#floorblock' + val).attr('data-gname'));

        $('#image-floor-delete').modal('show');

    }
</script>

@endsection

@push('scripts')

<script>
    var APP_URL = "{{url('/') }}";

    $(document).ready(function() {

        // Home
        $('#uploadHomeForm').on('submit', function(event) {
            event.preventDefault();
            $('#message').css('display', 'block');
            $.ajax({
                url: "/admin/upload-home-file",
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $('#message').css('display', 'none');
                    $('#uploadHomeImage').val('');
                    getHomeGallery();
                },
                error: function(error) {
                    $('#message').css('display', 'none');
                    toastr.error(error.responseJSON.errors.uploadHomeImage);
                }
            })
        });

        $('#deleteHomeImgForm').submit(function() {

            $.ajax({

                type: 'POST',

                url: APP_URL + '/api/delete-home-image',

                data: $('#deleteHomeImgForm').serialize(),

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                },

                /*contentType: 'json',*/

                success: function(response) {

                    getHomeGallery();

                    $('#image-delete').modal('hide');

                    $('#image-delete .modal-footer').html('');

                }

            });

        });
        function getHomeGallery() {

            $.ajax({

                type: 'get',

                url: '/api/get-home-gallery/<?= $home->id?>',

                data: {},

                success: function(data) {

                    $('#galleryrow').html(data.gallery);

                }

            });

        }
        getHomeGallery();

    });
</script>

@endpush