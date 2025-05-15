@extends('layouts.app')
@section('title', "Users")
@section('content')
<div class="container-fluid">
          <!-- ============================================================== -->
          <!-- Start Page Content -->
          <!-- ============================================================== -->
          <div class="row">

          @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

              <div class="card">
              <form id="userAdd" action="{{route('userSave')}}" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <input type="hidden" id="id" name="id"  value="<?php if(isset($edit_data) && $edit_data->id!=""){ echo $edit_data->id;} ?>"/>
                  <div class="card-body">
                    <h4 class="card-title">Personal Info</h4>
                    <div class="form-group row">
                      <label
                        for="fname"
                        class="col-sm-3 text-end control-label col-form-label"
                        > Name</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="text"
                          class="form-control"
                          id="fname" name="fname"
                          placeholder="First Name Here" value="<?php if(isset($edit_data) && $edit_data->name!=""){ echo $edit_data->name;} else{ echo old('first_name'); }?>"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="fname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Email</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="text"
                          class="form-control"
                          id="email" name="email"
                          placeholder="Email Here" value="<?php if(isset($edit_data) && $edit_data->email!=""){ echo $edit_data->email;} else{ echo old('email'); }?>"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="password"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Password</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="password"
                          class="form-control"
                          id="password" name="password"
                          placeholder="Password Here" value="<?php if(isset($edit_data) && $edit_data->show_password!=""){ echo decrypt($edit_data->show_password);} else{ echo old('password'); }?>"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="role"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Role</label
                      >
                      <div class="col-sm-9">
                      <select  class="form-control" name="user_role" >
                                                            <option value="">Select </option>
                                                            <?php foreach($role as $key=>$value){?>
                                                            <option value="{{$value->id}}"  <?php if(isset($edit_data) && $edit_data->user_role==$value->id){ echo "selected";} else if(old('user_role') == $value->id) {
                                                echo "selected";
                                            }?> >{{$value->name}}</option>
                                                            <?php } ?>
                                                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="cono1"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Contact No</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="text"
                          class="form-control"
                          id="cono1" name="mobile_no" value="<?php if(isset($edit_data) && $edit_data->mobile_no!=""){ echo $edit_data->mobile_no;} else{ echo old('mobile_no'); }?>"
                          placeholder="Contact No Here"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="cono1"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Address</label
                      >
                      <div class="col-sm-9">
                        <textarea class="form-control" name="address"><?php if(isset($edit_data) && $edit_data->address!=""){ echo $edit_data->address;} else{ echo old('address'); }?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                  <div class="col-sm-6">
                    </div>
                    <div class="col-sm-3">
                  <button type="submit" class="btn btn-primary">
                        Submit
                      </button>
                    </div>
                    </div>
                  
                </form>
              </div>
              </div>

        </div>
    @endsection
    <script>

    
      </script>