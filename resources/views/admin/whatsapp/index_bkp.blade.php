@extends('admin/app')

@section('mytitle', 'Send Whatsapp SMS')
@section('content')
<!-- BEGIN: Content-->
<style type="text/css">
  table th {
    font-size: 10px !important;
    padding: 10px !important;
  }
  table tbody td {
    font-size: 11px !important;
    padding: 10px !important;
  }

  .select2-container {
    width: 100% !important;
  }

  table.picker__table td {
    padding: 0 !important;
    font-size: 12px;
  }
</style>
<div class="app-content content mt-2">
  <div class="content-overlay"></div>
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
      <!-- Dashboard Ecommerce Starts -->          
      <section class="list-group-navigation">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h6 class="mb-1">SEND NEW MESSAGE</h6>
              </div>
              <div class="card-body">
                <form method="post" id="send-whatsapp-form" enctype="multipart/form-data">
                  @csrf

                  <div class="row">

                    <div class="col-12">
                      <div class="form-group">
                        <label class="form-control-label">Caption (Heading) <span class="text-danger">*</span> </label>
                        <input type="text" placeholder="Enter caption *" autocomplete="off" name="campaign_name" class="form-control" required />
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="form-group">
                        <label class="form-control-label">Message <span class="text-danger">*</span></label>
                        <div id="features-container">
                          <div class="editor" id="message" name="message" style="height: 120px;"></div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="form-group">
                        <label class="form-control-label">Mobile Numbers <span class="text-danger">* {{-- (Please Add country code before mobile no.) --}}</span> </label>
                        <textarea placeholder="Enter mobile numbers*" autocomplete="off" name="mobile" id="mobile" class="form-control" cols="10" rows="5" required></textarea>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="form-group">
                        <label class="form-control-label">Number Count <span class="text-danger">*</span> </label>
                        <input type="number" placeholder="Enter number count *" autocomplete="off" name="number_count" id="number_count" class="form-control numberOnly" required />
                      </div>
                    </div>

                  </div>

                  <hr />

                  <div class="row">

                    {{-- <div class="col-12">
                      <h6> Images <small class="text-danger">(Photo should be smaller than 2 MB. Only JPG, JPEG and PNG are allowed)</small></h6>
                    </div> --}}
                    {{-- <div class="col-12">
                      <hr />
                    </div> --}}
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="form-control-label">Image-1</label>
                        <input type="hidden" name="image_one" class="uploaded-image_one-file" />
                        <p class="alert alert-success image_one-upload-status d-none"></p>
                        <button type="button" name="image_one_upload" id="image_one_upload" class="btn btn-outline-primary btn-block"><i class="bx bx-upload"></i> Upload</button>
                      </div>
                    </div>

                    @if(Auth::user()->image_status==1)
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label class="form-control-label">Image-2</label>
                          <input type="hidden" name="image_two" class="uploaded-image_two-file" />
                          <p class="alert alert-success image_two-upload-status d-none"></p>
                          <button type="button" name="image_two_upload" id="image_two_upload" class="btn btn-outline-primary btn-block"><i class="bx bx-upload"></i> Upload</button>
                        </div>
                      </div>

                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label class="form-control-label">Image-3</label>
                          <input type="hidden" name="image_three" class="uploaded-image_three-file" />
                          <p class="alert alert-success image_three-upload-status d-none"></p>
                          <button type="button" name="image_three_upload" id="image_three_upload" class="btn btn-outline-primary btn-block"><i class="bx bx-upload"></i> Upload</button>
                        </div>
                      </div>

                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label class="form-control-label">Image-4</label>
                          <input type="hidden" name="image_four" class="uploaded-image_four-file" />
                          <p class="alert alert-success image_four-upload-status d-none"></p>
                          <button type="button" name="image_four_upload" id="image_four_upload" class="btn btn-outline-primary btn-block"><i class="bx bx-upload"></i> Upload</button>
                        </div>
                      </div>
                    @endif

                  </div>

                  <hr />

                  <div class="row">

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="form-control-label">Select PDF or Video </label>
                        <select id="pdf-or-video" name="pdf_or_video" class="form-control select2">
                          <option value="PDF">PDF</option>
                          <option value="Video">Video</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12" id="upload-pdf-group">
                      <div class="form-group">
                        <label class="form-control-label">Upload PDF</label>
                        <input type="hidden" name="upload_pdf" class="uploaded-upload_pdf-file" />
                        <p class="alert alert-success upload_pdf-upload-status d-none"></p>
                        <button type="button" name="upload_pdf_upload" id="upload_pdf_upload" class="btn btn-outline-primary btn-block"><i class="bx bx-upload"></i> Upload</button>
                      </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 d-none" id="send-video-group">
                      <div class="form-group">
                        <label class="form-control-label">Send Video</label>
                        <input type="hidden" name="send_video" class="uploaded-send_video-file" />
                        <p class="alert alert-success send_video-upload-status d-none"></p>
                        <button type="button" name="send_video_upload" id="send_video_upload" class="btn btn-outline-primary btn-block"><i class="bx bx-upload"></i> Upload</button>
                      </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="form-control-label">DP Image</label>
                        <input type="hidden" name="dp_image" class="uploaded-dp_image-file" />
                        <p class="alert alert-success dp_image-upload-status d-none"></p>
                        <button type="button" name="dp_image_upload" id="dp_image_upload" class="btn btn-outline-primary btn-block"><i class="bx bx-upload"></i> Upload</button>
                      </div>
                    </div>

                  </div>

                  <div class="row group">
                    <label class="text-warning d-none col-12 mt-1 mb-1" id="warning-msg"></label>
                    <div class="col-lg-12 mt-1">
                      <div class="form-group">
                        <button type="submit" id="submit-btn" class="btn btn-success">Submit</button>
                      </div>
                    </div>
                  </div>
                  
                </form>
              </div>
            </div>

          </div>
        </div>
      </section>

    </div>
  </div>
</div>
<!-- END: Content-->

<div class="modal fade text-left w-100" id="upload-image_one-modal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel16" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Choose Image 1</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="bx bx-x"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <form id="choose-image_one-form" method="post" enctype="multipart/form-data">
              @csrf
              <div class="file-loading">
                <input id="image_one-file" name="file" accept=".png, .jfif, .pjpeg, .jpeg, .pjpg, .jpg" class="file doc_file_input" type="file">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade text-left w-100" id="upload-image_two-modal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel16" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Choose Image 2</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="bx bx-x"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <form id="choose-image_two-form" method="post" enctype="multipart/form-data">
              @csrf
              <div class="file-loading">
                <input id="image_two-file" name="file" accept=".png, .jfif, .pjpeg, .jpeg, .pjpg, .jpg" class="file doc_file_input" type="file">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade text-left w-100" id="upload-image_three-modal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel16" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Choose Image 3</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="bx bx-x"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <form id="choose-image_three-form" method="post" enctype="multipart/form-data">
              @csrf
              <div class="file-loading">
                <input id="image_three-file" name="file" accept=".png, .jfif, .pjpeg, .jpeg, .pjpg, .jpg" class="file doc_file_input" type="file">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade text-left w-100" id="upload-image_four-modal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel16" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Choose Image 4</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="bx bx-x"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <form id="choose-image_four-form" method="post" enctype="multipart/form-data">
              @csrf
              <div class="file-loading">
                <input id="image_four-file" name="file" accept=".png, .jfif, .pjpeg, .jpeg, .pjpg, .jpg" class="file doc_file_input" type="file">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade text-left w-100" id="upload-upload_pdf-modal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel16" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Choose PDF File</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="bx bx-x"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <form id="choose-upload_pdf-form" method="post" enctype="multipart/form-data">
              @csrf
              <div class="file-loading">
                <input id="upload_pdf-file" name="file" accept=".pdf" class="file doc_file_input" type="file">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade text-left w-100" id="upload-send_video-modal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel16" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Choose Video</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="bx bx-x"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <form id="choose-send_video-form" method="post" enctype="multipart/form-data">
              @csrf
              <div class="file-loading">
                <input id="send_video-file" name="file" accept=".*" class="file doc_file_input" type="file">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade text-left w-100" id="upload-dp_image-modal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel16" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Choose DP Image</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="bx bx-x"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <form id="choose-dp_image-form" method="post" enctype="multipart/form-data">
              @csrf
              <div class="file-loading">
                <input id="dp_image-file" name="file" accept=".png, .jfif, .pjpeg, .jpeg, .pjpg, .jpg" class="file doc_file_input" type="file">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')

<script>

  /*=====Image 1 upload======*/

    $("#image_one-file").fileinput({
      theme: 'fas',
      uploadUrl: "{{ route('admin.whatsapp.images.upload') }}",
      uploadAsync: false,
      fileActionSettings: {
        showUpload: false
      },
      uploadExtraData: function() {
        return {
          _token: $("input[name='_token']").val(),
        };
      },
      allowedFileExtensions: ['png', 'jfif', 'pjpeg', 'jpeg', 'pjpg', 'jpg'],
      overwriteInitial: false,
      maxFileSize:2048,
      maxFilesNum: 1,
      slugCallback: function (filename) {
        return filename.replace('(', '_').replace(']', '_');
      }
    })
    .on('filebatchuploadsuccess', function(event, data, previewId, index) {
      let nearestInput = $("input.uploaded-image_one-file");
      let nearestBtn = $("button#image_one_upload");
      let nearestStatus = $("p.image_one-upload-status");

      $("input.uploaded-image_one-file").val(data.response.file);
      if (nearestInput.val())
      {
        $(nearestBtn).addClass("d-none");
        $(nearestStatus).html(data.response.file+'<span class="float-right">'+
          '<a class="text-danger remove-image_one-btn" href="javascript:void(0);">'+
            '<i class="bx bx-x-circle"></i>'+
          '</a>'+
        '</span>');
        $(nearestStatus).removeClass("d-none");
      }
      else
      {
        $(nearestBtn).removeClass("d-none");
        $(nearestStatus).addClass("d-none");
      }
      $("#upload-image_one-modal").modal('hide');
      $('#choose-image_one-form')[0].reset();

    });

  /*=====Image 1 upload======*/

  /*=====Image 2 upload======*/

    $("#image_two-file").fileinput({
      theme: 'fas',
      uploadUrl: "{{ route('admin.whatsapp.images.upload') }}",
      uploadAsync: false,
      fileActionSettings: {
        showUpload: false
      },
      uploadExtraData: function() {
        return {
          _token: $("input[name='_token']").val(),
        };
      },
      allowedFileExtensions: ['png', 'jfif', 'pjpeg', 'jpeg', 'pjpg', 'jpg'],
      overwriteInitial: false,
      maxFileSize:2048,
      maxFilesNum: 1,
      slugCallback: function (filename) {
        return filename.replace('(', '_').replace(']', '_');
      }
    })
    .on('filebatchuploadsuccess', function(event, data, previewId, index) {
      let nearestInput = $("input.uploaded-image_two-file");
      let nearestBtn = $("button#image_two_upload");
      let nearestStatus = $("p.image_two-upload-status");

      $("input.uploaded-image_two-file").val(data.response.file);
      if (nearestInput.val())
      {
        $(nearestBtn).addClass("d-none");
        $(nearestStatus).html(data.response.file+'<span class="float-right">'+
          '<a class="text-danger remove-image_two-btn" href="javascript:void(0);">'+
            '<i class="bx bx-x-circle"></i>'+
          '</a>'+
        '</span>');
        $(nearestStatus).removeClass("d-none");
      }
      else
      {
        $(nearestBtn).removeClass("d-none");
        $(nearestStatus).addClass("d-none");
      }
      $("#upload-image_two-modal").modal('hide');
      $('#choose-image_two-form')[0].reset();

    });

  /*=====Image 2 upload======*/

  /*=====Image 3 upload======*/

    $("#image_three-file").fileinput({
      theme: 'fas',
      uploadUrl: "{{ route('admin.whatsapp.images.upload') }}",
      uploadAsync: false,
      fileActionSettings: {
        showUpload: false
      },
      uploadExtraData: function() {
        return {
          _token: $("input[name='_token']").val(),
        };
      },
      allowedFileExtensions: ['png', 'jfif', 'pjpeg', 'jpeg', 'pjpg', 'jpg'],
      overwriteInitial: false,
      maxFileSize:2048,
      maxFilesNum: 1,
      slugCallback: function (filename) {
        return filename.replace('(', '_').replace(']', '_');
      }
    })
    .on('filebatchuploadsuccess', function(event, data, previewId, index) {
      let nearestInput = $("input.uploaded-image_three-file");
      let nearestBtn = $("button#image_three_upload");
      let nearestStatus = $("p.image_three-upload-status");

      $("input.uploaded-image_three-file").val(data.response.file);
      if (nearestInput.val())
      {
        $(nearestBtn).addClass("d-none");
        $(nearestStatus).html(data.response.file+'<span class="float-right">'+
          '<a class="text-danger remove-image_three-btn" href="javascript:void(0);">'+
            '<i class="bx bx-x-circle"></i>'+
          '</a>'+
        '</span>');
        $(nearestStatus).removeClass("d-none");
      }
      else
      {
        $(nearestBtn).removeClass("d-none");
        $(nearestStatus).addClass("d-none");
      }
      $("#upload-image_three-modal").modal('hide');
      $('#choose-image_three-form')[0].reset();

    });

  /*=====Image 3 upload======*/

  /*=====Image 4 upload======*/

    $("#image_four-file").fileinput({
      theme: 'fas',
      uploadUrl: "{{ route('admin.whatsapp.images.upload') }}",
      uploadAsync: false,
      fileActionSettings: {
        showUpload: false
      },
      uploadExtraData: function() {
        return {
          _token: $("input[name='_token']").val(),
        };
      },
      allowedFileExtensions: ['png', 'jfif', 'pjpeg', 'jpeg', 'pjpg', 'jpg'],
      overwriteInitial: false,
      maxFileSize:2048,
      maxFilesNum: 1,
      slugCallback: function (filename) {
        return filename.replace('(', '_').replace(']', '_');
      }
    })
    .on('filebatchuploadsuccess', function(event, data, previewId, index) {
      let nearestInput = $("input.uploaded-image_four-file");
      let nearestBtn = $("button#image_four_upload");
      let nearestStatus = $("p.image_four-upload-status");

      $("input.uploaded-image_four-file").val(data.response.file);
      if (nearestInput.val())
      {
        $(nearestBtn).addClass("d-none");
        $(nearestStatus).html(data.response.file+'<span class="float-right">'+
          '<a class="text-danger remove-image_four-btn" href="javascript:void(0);">'+
            '<i class="bx bx-x-circle"></i>'+
          '</a>'+
        '</span>');
        $(nearestStatus).removeClass("d-none");
      }
      else
      {
        $(nearestBtn).removeClass("d-none");
        $(nearestStatus).addClass("d-none");
      }
      $("#upload-image_four-modal").modal('hide');
      $('#choose-image_four-form')[0].reset();

    });

  /*=====Image 4 upload======*/

  /*=====Upload PDF======*/

    $("#upload_pdf-file").fileinput({
      theme: 'fas',
      uploadUrl: "{{ route('admin.whatsapp.pdf.upload') }}",
      uploadAsync: false,
      fileActionSettings: {
        showUpload: false
      },
      uploadExtraData: function() {
        return {
          _token: $("input[name='_token']").val(),
        };
      },
      allowedFileExtensions: ['pdf'],
      overwriteInitial: false,
      maxFileSize:2048,
      maxFilesNum: 1,
      slugCallback: function (filename) {
        return filename.replace('(', '_').replace(']', '_');
      }
    })
    .on('filebatchuploadsuccess', function(event, data, previewId, index) {
      let nearestInput = $("input.uploaded-upload_pdf-file");
      let nearestBtn = $("button#upload_pdf_upload");
      let nearestStatus = $("p.upload_pdf-upload-status");

      $("input.uploaded-upload_pdf-file").val(data.response.file);
      if (nearestInput.val())
      {
        $(nearestBtn).addClass("d-none");
        $(nearestStatus).html(data.response.file+'<span class="float-right">'+
          '<a class="text-danger remove-upload_pdf-btn" href="javascript:void(0);">'+
            '<i class="bx bx-x-circle"></i>'+
          '</a>'+
        '</span>');
        $(nearestStatus).removeClass("d-none");
      }
      else
      {
        $(nearestBtn).removeClass("d-none");
        $(nearestStatus).addClass("d-none");
      }
      $("#upload-upload_pdf-modal").modal('hide');
      $('#choose-upload_pdf-form')[0].reset();

    });

  /*=====Upload PDF======*/

  /*=====Send Video======*/

    $("#send_video-file").fileinput({
      theme: 'fas',
      uploadUrl: "{{ route('admin.whatsapp.video.upload') }}",
      uploadAsync: false,
      fileActionSettings: {
        showUpload: false
      },
      uploadExtraData: function() {
        return {
          _token: $("input[name='_token']").val(),
        };
      },
      // allowedFileExtensions: ['pdf'],
      overwriteInitial: false,
      maxFileSize:5120,
      maxFilesNum: 1,
      slugCallback: function (filename) {
        return filename.replace('(', '_').replace(']', '_');
      }
    })
    .on('filebatchuploadsuccess', function(event, data, previewId, index) {
      let nearestInput = $("input.uploaded-send_video-file");
      let nearestBtn = $("button#send_video_upload");
      let nearestStatus = $("p.send_video-upload-status");

      $("input.uploaded-send_video-file").val(data.response.file);
      if (nearestInput.val())
      {
        $(nearestBtn).addClass("d-none");
        $(nearestStatus).html(data.response.file+'<span class="float-right">'+
          '<a class="text-danger remove-send_video-btn" href="javascript:void(0);">'+
            '<i class="bx bx-x-circle"></i>'+
          '</a>'+
        '</span>');
        $(nearestStatus).removeClass("d-none");
      }
      else
      {
        $(nearestBtn).removeClass("d-none");
        $(nearestStatus).addClass("d-none");
      }
      $("#upload-send_video-modal").modal('hide');
      $('#choose-send_video-form')[0].reset();

    });

  /*=====Send Video======*/

  /*=====DP Image upload======*/

    $("#dp_image-file").fileinput({
      theme: 'fas',
      uploadUrl: "{{ route('admin.whatsapp.images.upload') }}",
      uploadAsync: false,
      fileActionSettings: {
        showUpload: false
      },
      uploadExtraData: function() {
        return {
          _token: $("input[name='_token']").val(),
        };
      },
      allowedFileExtensions: ['png', 'jfif', 'pjpeg', 'jpeg', 'pjpg', 'jpg'],
      overwriteInitial: false,
      maxFileSize:2048,
      maxFilesNum: 1,
      slugCallback: function (filename) {
        return filename.replace('(', '_').replace(']', '_');
      }
    })
    .on('filebatchuploadsuccess', function(event, data, previewId, index) {
      let nearestInput = $("input.uploaded-dp_image-file");
      let nearestBtn = $("button#dp_image_upload");
      let nearestStatus = $("p.dp_image-upload-status");

      $("input.uploaded-dp_image-file").val(data.response.file);
      if (nearestInput.val())
      {
        $(nearestBtn).addClass("d-none");
        $(nearestStatus).html(data.response.file+'<span class="float-right">'+
          '<a class="text-danger remove-dp_image-btn" href="javascript:void(0);">'+
            '<i class="bx bx-x-circle"></i>'+
          '</a>'+
        '</span>');
        $(nearestStatus).removeClass("d-none");
      }
      else
      {
        $(nearestBtn).removeClass("d-none");
        $(nearestStatus).addClass("d-none");
      }
      $("#upload-dp_image-modal").modal('hide');
      $('#choose-dp_image-form')[0].reset();

    });

  /*=====DP Image upload======*/

  $(function() {

    $(document).on('keyup', '#mobile', function(e){
      e.preventDefault();
      var length = $('#mobile').val().split("\n").length;
      $("#number_count").val(length);
    });

    $(document).on('change', '#pdf-or-video', function(e){
      e.preventDefault();

      if(this.value=='PDF')
      {
        if($("#upload-pdf-group").hasClass('d-none'))
        {
          $("#upload-pdf-group").removeClass('d-none')
        }

        if(!$("#send-video-group").hasClass('d-none'))
        {
          $("#send-video-group").addClass('d-none')
        }
      }
      else
      {
        if(!$("#upload-pdf-group").hasClass('d-none'))
        {
          $("#upload-pdf-group").addClass('d-none')
        }

        if($("#send-video-group").hasClass('d-none'))
        {
          $("#send-video-group").removeClass('d-none')
        }
      }
    });

    $("#image_one_upload").on("click", function() {
      $("#upload-image_one-modal").modal('show');
    });

    $(document).on("click", ".remove-image_one-btn", function() {
      $(this).closest('div').find("p.image_one-upload-status").addClass('d-none');
      $(this).closest("div").find("button#image_one_upload").removeClass('d-none');
      $(this).closest("div").find("input.uploaded-image_one-file").val("");
    });

    $("#image_two_upload").on("click", function() {
      $("#upload-image_two-modal").modal('show');
    });

    $(document).on("click", ".remove-image_two-btn", function() {
      $(this).closest('div').find("p.image_two-upload-status").addClass('d-none');
      $(this).closest("div").find("button#image_two_upload").removeClass('d-none');
      $(this).closest("div").find("input.uploaded-image_two-file").val("");
    });

    $("#image_three_upload").on("click", function() {
      $("#upload-image_three-modal").modal('show');
    });

    $(document).on("click", ".remove-image_three-btn", function() {
      $(this).closest('div').find("p.image_three-upload-status").addClass('d-none');
      $(this).closest("div").find("button#image_three_upload").removeClass('d-none');
      $(this).closest("div").find("input.uploaded-image_three-file").val("");
    });

    $("#image_four_upload").on("click", function() {
      $("#upload-image_four-modal").modal('show');
    });

    $(document).on("click", ".remove-image_four-btn", function() {
      $(this).closest('div').find("p.image_four-upload-status").addClass('d-none');
      $(this).closest("div").find("button#image_four_upload").removeClass('d-none');
      $(this).closest("div").find("input.uploaded-image_four-file").val("");
    });

    $("#upload_pdf_upload").on("click", function() {
      $("#upload-upload_pdf-modal").modal('show');
    });

    $(document).on("click", ".remove-upload_pdf-btn", function() {
      $(this).closest('div').find("p.upload_pdf-upload-status").addClass('d-none');
      $(this).closest("div").find("button#upload_pdf_upload").removeClass('d-none');
      $(this).closest("div").find("input.uploaded-upload_pdf-file").val("");
    });

    $("#send_video_upload").on("click", function() {
      $("#upload-send_video-modal").modal('show');
    });

    $(document).on("click", ".remove-send_video-btn", function() {
      $(this).closest('div').find("p.send_video-upload-status").addClass('d-none');
      $(this).closest("div").find("button#send_video_upload").removeClass('d-none');
      $(this).closest("div").find("input.uploaded-send_video-file").val("");
    });

    $("#dp_image_upload").on("click", function() {
      $("#upload-dp_image-modal").modal('show');
    });

    $(document).on("click", ".remove-dp_image-btn", function() {
      $(this).closest('div').find("p.dp_image-upload-status").addClass('d-none');
      $(this).closest("div").find("button#dp_image_upload").removeClass('d-none');
      $(this).closest("div").find("input.uploaded-dp_image-file").val("");
    });

    /*-------------------------------------------------------*/
    
    var whatsappForm = $("#send-whatsapp-form").validate({
      // errorPlacement: function (error, element) {}
    });

    $("#send-whatsapp-form").submit(function(event) {
      event.preventDefault();

      var message = new Quill('#message');
      var messageVal = message.root.innerHTML;

      var formData = new FormData($(this)[0]);
      
      formData.append('message', messageVal);

      if (whatsappForm.valid())
      {
        $.ajax({
          type: 'POST',
          url: "{{ route('admin.whatsapp.send') }}",
          data: formData,
          dataType: 'json',
          contentType: false,
          cache: false,
          processData: false,
          beforeSend: function() {
            $("#warning-msg").removeClass('d-none');
            $("#warning-msg").text('Data is being saved do not refresh or submit again');
            $('#submit-btn').prop('disabled', true);
          },
          success: function(data)
          {
            if (data.status) {
              toastr.success(data.message, '', {
                closeButton: !0,
                tapToDismiss: !1,
                progressBar: true,
                timeOut: 1000
              });
              location.reload();
            }
            else
            {
              toastr.error(data.message, '', {
                closeButton: !0,
                tapToDismiss: !1,
                progressBar: true,
                timeOut: 1000
              });
            }
            setTimeout(function() {
              $("#warning-msg").addClass('d-none');
              $('#submit-btn').prop('disabled', false);
            }, 500);
          }
        });
      }
    });

  });

  $(function() {
    "use strict";
      var o = Quill.import("formats/font");
      o.whitelist = ["sofia", "slabo", "roboto", "inconsolata", "ubuntu"], Quill.register(o, !0);
      new Quill("#features-container .editor", {
          bounds: "#features-container .editor",
          modules: {
              formula: !0,
              syntax: !0,
              toolbar: [
                  [{
                      font: []
                  }, {
                      size: []
                  }],
                  ["bold", "italic", "underline", "strike"],
                  [{
                      color: []
                  }, {
                      background: []
                  }],
                  [{
                      script: "super"
                  }, {
                      script: "sub"
                  }],
                  [{
                      header: "1"
                  }, {
                      header: "2"
                  }, "blockquote", "code-block"],
                  [{
                      list: "ordered"
                  }, {
                      list: "bullet"
                  }, {
                      indent: "-1"
                  }, {
                      indent: "+1"
                  }],
                  ["direction", {
                      align: []
                  }],
                  ["link", "image", "video", "formula"],
                  ["clean"]
              ]
          },
          theme: "snow"
      })
  });
</script>

@endsection
