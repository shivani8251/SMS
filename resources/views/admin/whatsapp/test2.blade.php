@php
  $template = (Auth::user()->user_type=="admin") ? 'admin/app' : 'user/app';
  $whatsappSend = (Auth::user()->user_type=="admin") ? 'admin.whatsapp.send' : 'user.whatsapp.send';
@endphp

@extends($template)

@section('mytitle', 'Send Test Whatsapp SMS')
@section('content')

<!-- BEGIN: Content-->
<style type="text/css">
  .ck-editor__editable_inline {
    min-height: 150px;
  }
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
              <div class="card-header pb-0">
                <h6 class="mb-2">SEND TEST MESSAGE</h6>
              </div>
              <div class="card-body">

                <form method="post" id="send-whatsapp-form" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <label class="form-control-label">Mobile Numbers <span class="text-danger">* </span> </label>
                        <textarea placeholder="Enter mobile numbers*" autocomplete="off" name="mobile" id="mobile" class="form-control" cols="10" rows="5" required></textarea>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <label class="form-control-label">Number Count <span class="text-danger">*</span> </label>
                        <input type="number" placeholder="Enter number count *" autocomplete="off" name="number_count" id="number_count" class="form-control numberOnly" required />
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

@endsection

@section('script')

<script src="{{ asset('public/assets/js/ckeditor.js') }}"></script>
{{-- <script src="{{ asset('public/assets/js/scripts/forms/wizard-steps.min.js') }}"></script> --}}

<script>
  $(function(){

    // var whatsappForm = $("#send-whatsapp-form").validate({
    //   // errorPlacement: function (error, element) {}
    // });

    Array.prototype.chunk = function(size)
    {
      let result = [];
      
      while(this.length)
      {
        result.push(this.splice(0, size));
      }
          
      return result;
    }

    var index = -1;

    $("#send-whatsapp-form").submit(function(event) {
      event.preventDefault();
      recursiveAjaxCall();
    });    

    function recursiveAjaxCall()
    {
      ++index;
      var formData = new FormData($("#send-whatsapp-form")[0]);
      var mobilesArray = $("#mobile").val().split(/\r?\n/);
      var mobilesChunkArrays = mobilesArray.chunk(10000);
      var mobilesChunkArraysLength = mobilesChunkArrays.length;
      var successLength = parseInt(mobilesChunkArraysLength)-1;

      formData.append('mobilenos', JSON.stringify(mobilesChunkArrays[index]));

      $.ajax({
        type: 'POST',
        url: "{{ route('admin.test.send') }}",
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
          if(index<successLength)
          {
            recursiveAjaxCall();
          }
          else
          {
            if (data.status) {
              toastr.success(data.message, '', {
                closeButton: !0,
                tapToDismiss: !1,
                progressBar: true,
                timeOut: 1000
              });
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
          
        }
      });
    }

  });
</script>

@endsection