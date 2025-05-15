@extends('layouts.app')
@section('title', "User")
@section('content')
<div class="page-wrapper">
<div class="container-fluid">
          <!-- ============================================================== -->
          <!-- Start Page Content -->
          <!-- ============================================================== -->
          <div class="row">
              <div class="card">
                  <div class="card-body">
                    <h4 class="card-title mb-0">User</h4>
                    <br>
                    <div class="row">
                      <div class="col-sm-8"></div>
                      <div class="col-sm-2">
                    <a href="{{URL('userAdd')}}" class="btn btn-primary btn-sm btn-small">
                            <i class="fa fa-plus-circle"></i> Add User
                        </a>
                        </div>
                      </div>
                    </div>
                    <br>
                      <div class="table-responsive">
                      <meta name="csrf-token" content="{{ csrf_token() }}">
                        <table id="userlist" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th align="left" valign="middle">Name</th>
                                    <th align="left" valign="middle">User Name</th>
                                    <th align="left" valign="middle">Mobile No</th>
                                    <th align="left" valign="middle">Address</th>
                                    <th align="left" valign="middle">Status</th>
                                    <th align="left" valign="middle">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                              @if(count($user)>0)
                              @foreach($user as $key=>$val)
                              <tr>
                              <td>{{ $val->name }}</td>
                              <td>{{ $val->email }}</td>
                              <td>{{ $val->mobile_no }}</td>
                              <td>{{ $val->address }}</td>
                              <td>{{ isset($val->status) && $val->status==1 ? 'Active' : 'Inactive'  }}</td>
                              <td>
                              <a href="{{ URL::route('userEdit',$val->id) }}" class="" title="Edit"><i class="fa fa-eye"></i></a>
                                                    <?php if($val->status=='1'){?>
                                                    <a href="#" class="user_activate" title="Deactivate"  id="<?php echo $val->id; ?>"><i class="fa fa-thumbs-up" style="color:green;"></i></a>
                                                    <?php }
                                                    else {?>
                                                    <a href="#" class="user_deactivate" title="Activate"  id="" data-id="{{ URL::route('user_activate',['id'=>$val->id]) }}"><i class="fa fa-thumbs-down" style="color:red;"></i></a>&nbsp;
                                                    <?php }?>
                              </td>
</tr>
                              @endforeach
                              @endif
                          </tbode>
                        </table>
                      </div>
                   
                    </div>
              </div>
              </div>
              </div>
        </div>
    @endsection
    @section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>
    <script>
  $(document).ready(function () {
        var table = $('#userlist').DataTable({
            dom: 'Bfrtip',
           order: [[0, 'desc']],
            buttons: [
                {
                    extend: 'excel',
                    text: '<i class="fa fa-file-excel-o"></i>',
                    titleAttr: 'Excel'
                },
                {
                    extend: 'pdf',
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    titleAttr: 'PDF'
                },
                {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i>',
                    titleAttr: 'PRINT'
                }
            ],

            language: {
                paginate: {
                    "previous": '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
                    "next": '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
                }
            }
        });

        $("#userlist").on("click", ".user_activate", function () {
        //$('.user_activate').click(function () {
            var link = $(this).data('id');

            swal({
                title: "Are you sure?",
                text: "",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, Deativate!',
                cancelButtonText: "No, cancel plx!",
              }).then((result) => {
              if (result.isConfirmed) {
                  window.location.href = link;
              }
              else{
                swal("Cancelled", "Your User Details is safe :)", "error");
              }
          });
        });


        $("#userlist").on("click", ".user_deactivate", function () {
         //$('.user_deactivate').click(function () {
            var link = $(this).data('id');

            swal({
                title: "Are you sure?",
                text: "",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, Activate!',
                cancelButtonText: "No, cancel plx!",
              }).then((result) => {
              if (result.isConfirmed) {
                  window.location.href = link;
              }
              else{
                swal("Cancelled", "Your User Details is safe :)", "error");
              }
          });
        });

            
          });
        </script>
        @endsection