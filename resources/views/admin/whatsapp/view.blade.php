@php
  $template = (Auth::user()->user_type=="admin") ? 'admin/app' : 'user/app';

  $mobileListingDataTable = (Auth::user()->user_type=="admin") ? 'admin.mobile.listing.dataTable' : 'user.mobile.listing.dataTable';
  $mobileStatusUpdate = (Auth::user()->user_type=="admin") ? 'admin.mobile.status.update' : 'user.mobile.status.update';
@endphp

@extends($template)

@section('mytitle', 'Whatsapp Report')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/pages/page-user-profile.min.css') }}">
<!-- BEGIN: Content-->
<style type="text/css">
  .select2-container {
    width: 100% !important;
  }

  table th {
    font-size: 12px !important;
    padding: 10px !important;
  }
  table tbody td {
    font-size: 13px !important;
    padding: 10px !important;
  }

  .dt-buttons{
    float: left !important;
    padding-bottom: 10px;
  }
</style>

<div class="app-content content mt-2">
  <div class="content-overlay"></div>
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
      <section class="page-user-profile">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    <input type="hidden" id="current-user-type" value="{{Auth::user()->user_type}}">
                    <h5 class="card-title">CAMPAIGN WISE DETAILS</h5>
                    <hr class="mt-0 mb-1" />
                    <div class="row">
                      @if(isset($whatsapp->campaign_unique_id))
                        <div class="col-sm-6 col-12">
                          <h6><small class="text-muted">Unique Id</small></h6>
                          <p>{{$whatsapp->campaign_unique_id}}</p>
                        </div>
                      @endif
                      @if(isset($whatsapp->created_by))
                        <div class="col-sm-6 col-12">
                          <h6><small class="text-muted">Created By</small></h6>
                          <p>{{$whatsapp->created_by}}</p>
                        </div>
                      @endif
                      @if(isset($whatsapp->creator_type))
                        <div class="col-sm-6 col-12">
                          <h6><small class="text-muted">Creator Type</small></h6>
                          <p>{{ucfirst($whatsapp->creator_type)}}</p>
                        </div>
                      @endif
                      @if(isset($whatsapp->created_at))
                        <div class="col-sm-6 col-12">
                          <h6><small class="text-muted">Created At</small></h6>
                          <p>{{date('d-M-Y h:i A', strtotime($whatsapp->created_at))}}</p>
                        </div>
                      @endif
                      @if(isset($whatsapp->status))
                        <div class="col-sm-6 col-12">
                          <h6><small class="text-muted">Status</small></h6>
                          @if($whatsapp->status=="sent")
                            <p class="badge badge-pill badge-success">{{ucfirst($whatsapp->status)}}</p>
                          @elseif($whatsapp->status=="pending")
                            <p class="badge badge-pill badge-info">{{ucfirst($whatsapp->status)}}</p>
                          @elseif($whatsapp->status=="process")
                            <p class="badge badge-pill badge-primary">{{ucfirst($whatsapp->status)}}</p>
                          @else
                            <p class="badge badge-pill badge-danger">{{ucfirst($whatsapp->status)}}</p>
                          @endif
                        </div>
                      @endif
                      @if(isset($whatsapp->campaign_name))
                        <div class="col-sm-6 col-12">
                          <h6><small class="text-muted">Caption</small></h6>
                          <p>{{$whatsapp->campaign_name}}</p>
                        </div>
                      @endif
                      @if(isset($whatsapp->message))
                        <div class="col-12">
                          <hr class="mt-0 mb-1" />
                          <h6><small class="text-muted">Message</small></h6>
                          <p>{!!stripcslashes($whatsapp->message)!!}</p>
                        </div>
                      @endif
                      
                      @if(isset($whatsapp->dp_image))
                        <div class="col-12"><hr class="mt-0 mb-1" /></div>
                        <div class="col-sm-6 col-12">
                          <h6><small class="text-muted">DP Image</small></h6>
                          <p><a href="{{ asset('public/storage/whatsapp/images/'.$whatsapp->dp_image) }}" target="_BLANK"><img src="{{ asset('public/storage/whatsapp/images/'.$whatsapp->dp_image) }}" height="60" width="auto" /></a></p>
                          <p>
                            <a class="btn btn-sm btn-warning" href="{{ asset('public/storage/whatsapp/images/'.$whatsapp->dp_image) }}" download>Download</a>
                          </p>
                        </div>
                      @endif
                      @if(isset($whatsapp->upload_pdf))
                        <div class="col-sm-6 col-12">
                          <h6><small class="text-muted">PDF</small></h6>
                          <p><a href="{{ asset('public/storage/whatsapp/pdf/'.$whatsapp->upload_pdf) }}" target="_BLANK"><img src="{{ asset('public/assets/img/pdf.png') }}" height="60" width="auto" /></a></p>
                          <p>
                            <a class="btn btn-sm btn-warning" href="{{ asset('public/storage/whatsapp/pdf/'.$whatsapp->upload_pdf) }}" download>Download</a>
                          </p>
                        </div>
                      @endif
                      @if(isset($whatsapp->send_video))
                        <div class="col-sm-6 col-12">
                          <h6><small class="text-muted">Video</small></h6>
                          <p>
                            <a href="{{ asset('public/storage/whatsapp/videos/'.$whatsapp->send_video) }}" download>
                              <img src="{{ asset('public/assets/img/video.png') }}" height="60" width="auto" />
                            </a>
                          </p>
                          <p>
                            <a class="btn btn-sm btn-warning" href="{{ asset('public/storage/whatsapp/videos/'.$whatsapp->send_video) }}" download>Download</a>
                          </p>
                        </div>
                      @endif
                      <div class="col-12">
                        <hr class="mt-0 mb-1" />
                        <h6><small class="text-muted">Images</small></h6>
                        <div class="row mt-2">
                          @if(isset($whatsapp->image_one))
                            <div class="col-xl-2 col-lg-2 col-md-2 col-12">
                              <div class="card kb-hover-1 pt-0 pb-0 border">
                                <div class="card-body text-center pt-1 pb-0">
                                  <a href="{{ asset('public/storage/whatsapp/images/'.$whatsapp->image_one) }}" target="_BLANK">
                                    <div class=" mb-1">
                                      <img src="{{ asset('public/storage/whatsapp/images/'.$whatsapp->image_one) }}" height="60" width="auto" />
                                    </div>
                                    <p>Image 1</p>
                                  </a>
                                  <p>
                                    <a class="btn btn-sm btn-warning" href="{{ asset('public/storage/whatsapp/images/'.$whatsapp->image_one) }}" download>Download</a>
                                  </p>
                                </div>
                              </div>
                            </div>
                          @endif
                          @if(isset($whatsapp->image_two))
                            <div class="col-xl-2 col-lg-2 col-md-2 col-12">
                              <div class="card kb-hover-1 pt-0 pb-0 border">
                                <div class="card-body text-center pt-1 pb-0">
                                  <a href="{{ asset('public/storage/whatsapp/images/'.$whatsapp->image_two) }}" target="_BLANK">
                                    <div class=" mb-1">
                                      <img src="{{ asset('public/storage/whatsapp/images/'.$whatsapp->image_two) }}" height="60" width="auto" />
                                    </div>
                                    <p>Image 2</p>
                                  </a>
                                  <p>
                                    <a class="btn btn-sm btn-warning" href="{{ asset('public/storage/whatsapp/images/'.$whatsapp->image_two) }}" download>Download</a>
                                  </p>
                                </div>
                              </div>
                            </div>
                          @endif
                          @if(isset($whatsapp->image_three))
                            <div class="col-xl-2 col-lg-2 col-md-2 col-12">
                              <div class="card kb-hover-1 pt-0 pb-0 border">
                                <div class="card-body text-center pt-1 pb-0">
                                  <a href="{{ asset('public/storage/whatsapp/images/'.$whatsapp->image_three) }}" target="_BLANK">
                                    <div class=" mb-1">
                                      <img src="{{ asset('public/storage/whatsapp/images/'.$whatsapp->image_three) }}" height="60" width="auto" />
                                    </div>
                                    <p>Image 3</p>
                                  </a>
                                  <p>
                                    <a class="btn btn-sm btn-warning" href="{{ asset('public/storage/whatsapp/images/'.$whatsapp->image_three) }}" download>Download</a>
                                  </p>
                                </div>
                              </div>
                            </div>
                          @endif
                          @if(isset($whatsapp->image_four))
                            <div class="col-xl-2 col-lg-2 col-md-2 col-12">
                              <div class="card kb-hover-1 pt-0 pb-0 border">
                                <div class="card-body text-center pt-1 pb-0">
                                  <a href="{{ asset('public/storage/whatsapp/images/'.$whatsapp->image_four) }}" target="_BLANK">
                                    <div class=" mb-1">
                                      <img src="{{ asset('public/storage/whatsapp/images/'.$whatsapp->image_four) }}" height="60" width="auto" />
                                    </div>
                                    <p>Image 4</p>
                                  </a>
                                  <p>
                                    <a class="btn btn-sm btn-warning" href="{{ asset('public/storage/whatsapp/images/'.$whatsapp->image_four) }}" download>Download</a>
                                  </p>
                                </div>
                              </div>
                            </div>
                          @endif

                        </div>
                      </div>
                      
                      <div class="col-12">
                        <hr class="mb-1 pb-0" />
                        <h6>List of Mobile Numbers</h6>
                        <input type="hidden" id="ids" />
                        <input type="hidden" id="send_wp_msgs_id" value="{{$whatsapp->id}}" />
                        <div class="table-responsive">
                          <table class="table table-striped table-bordered w-100" id="mobile-list-table">
                            <thead>
                              <tr>
                                <th>
                                  <div class="checkbox">
                                    <input type="checkbox" class="checkbox-input" id="select-all">
                                    <label for="select-all">ID</label>
                                  </div>
                                </th>
                                <th>Mobile No.</th>
                                <th>Unique Id</th>
                                <th>Username</th>
                                <th>Status</th>
                                <th>Created At</th>
                              </tr>
                            </thead>                                   
                          </table>
                        </div>
                      </div>
                     
                    </div>
                  </div>                     
                </div>

              </div>
            </div>
          </div>
        </div>
      </section>

    </div>
  </div>
</div>
<!-- END: Content-->

<div id="change-status-modal" class="modal fade" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered modal modal-dialog-scrollable" role="document">
    <div class="modal-content tx-size-sm">
      <div class="modal-header pd-x-20">
        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Change Status</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pd-20">
        <form id="change-status-form" method="post">
          @csrf
          <div class="row mb-3">
            <input type="hidden" name="rows" id="selected-rows" value="" required />
            <div class="col-lg-12">
              <div class="form-group">
                <select class="form-control" id="selected-status" name="status" data-placeholder="Choose Status" required>
                  @php
                    $nstatuses = ['pending','process','sent','discard','Failed','Undelivered'];
                  @endphp
                  @foreach($nstatuses as $nstatus)
                    <option value="{{$nstatus}}">{{ucfirst($nstatus)}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="form-layout-footer">
            <button type="submit" class="btn btn-info mg-r-5">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')

<script>

  $(function() {
    var currentUserType = $("#current-user-type").val();

    var selectedRow = [];

    var statusForm = $("#change-status-form").validate({
      // errorPlacement: function (error, element) {}
    });

    $("#change-status-form").submit(function(event) {
      event.preventDefault();
      if (statusForm.valid())
      {
        $.confirm({
          title: 'Confirm!',
          type: 'red',
          content: 'Are you sure want to update status for selected mobile numbers ?',
          buttons: {
            yes: function() {
              $.post("{{ route($mobileStatusUpdate) }}", $('#change-status-form').serialize(), function(data){
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
              }, 'json');
            },
            no: function() {}
          }
        });
      }
    });

    $(document).on('click', '#change-status-btn', function(event) {
      var selIDs = $("#ids").val();
      if(selIDs!="")
      {
        $("#selected-rows").val(selIDs);
        $("#change-status-modal").modal('show');
      }
      else
      {
        var message = 'Please select atleast one row from the table';
        toastr.error(message, '', {
          closeButton: !0,
          tapToDismiss: !1,
          progressBar: true,
          timeOut: 1000
        });
      }
    });

    if(currentUserType=='admin')
    {
      var user_type_name = '/admin/';
    }
    else
    {
      var user_type_name = '/';
    }

    var send_wp_msgs_id = $("#send_wp_msgs_id").val();
    var base_url = "{{url('')}}";
    reportTable(send_wp_msgs_id);

    function reportTable(send_wp_msgs_id) {
      $('#mobile-list-table').DataTable().clear().destroy();

      var whatsappTable = $("#mobile-list-table").DataTable({
        serverSide: true,
        processing: true,
        searching: true,
        dom: 'lBfrtip',
        "aLengthMenu": [[25, 50, 100, 200, 300, 400, 500, 1000, -1], [25, 50, 100, 200, 300, 400, 500, 1000, "All"]],
        "iDisplayLength": 25,
        buttons: [
          {
            text: 'Excel',
            className: 'btn btn-primary btn-sm mr-0',
            titleAttr: 'Add a new record',
            action: function (e, dt, node, config)
            {
                window.location.href = base_url+user_type_name+'export-mobile-listing/'+send_wp_msgs_id;
            }
          },
          {
            text: 'Change Status',
            className: 'btn-success btn-sm mr-1',
            attr: {
              id: 'change-status-btn'
            }
          },
        ],
        order: [],
        ajax: {
            url: "{{ route($mobileListingDataTable) }}",
            type: "POST",
            data: {
              "_token": "{{ csrf_token() }}",
              "send_wp_msgs_id": send_wp_msgs_id
            }
        },
        select: {
          style: 'multi',
          selector: 'td:not(:last-child)'
        },
        columnDefs: [{
            orderable: false,
            className: 'select-checkbox',
            targets: 0
        }],
        "columns": [
          { data: 'id' },
          { data: 'mobile_no' },
          { data: 'unique_id' },
          { data: 'username' },
          { data: 'status' },
          { data: 'created_at' }
        ]
      });

      $('#select-all').on('click', function(){
        var rows = whatsappTable.rows({ 'search': 'applied' }).nodes();
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
        updateSelectedRowValues();
      });

      $('#mobile-list-table tbody').on('change', 'input[type="checkbox"]', function(){
        if(!this.checked)
        {
          var el = $('#select-all').get(0);
          if(el && el.checked && ('indeterminate' in el))
          {
            el.indeterminate = true;
          }
        }
      });

    }


    if(currentUserType!='admin')
    {
      $("#change-status-btn").addClass('d-none');
    }

    function updateSelectedRowValues() {
      $('input.select-ids').each(function(){
        if (this.checked)
        {
          selectedRow.push($(this).val());
          var ids = selectedRow.join(',');
          $("#ids").val(ids);
        }
        else
        {
          selectedRow.splice($.inArray($(this).val(), selectedRow), 1);
          var ids = selectedRow.join(',');
          $("#ids").val(ids);
        }
      });
    }

    $(document).on('change', '.select-ids', function(){
      if(this.checked)
      {
        selectedRow.push($(this).val());
        var ids = selectedRow.join(',');
        $("#ids").val(ids);
      }
      else
      {
        selectedRow.splice($.inArray($(this).val(), selectedRow), 1);
        var ids = selectedRow.join(',');
        $("#ids").val(ids);
      }
    });

  });

</script>

@endsection
