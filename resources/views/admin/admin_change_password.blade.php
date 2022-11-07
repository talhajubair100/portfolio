@extends('admin.admin_master')


@section('content')


<div class="page-content">
        <div class="container-fluid">


        <!-- end page title -->
                        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Change Password</h4>
                        <br>


                        <form action="{{ route ('update.password') }}" method="POST">
                            @csrf
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Old Password</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" name="oldpassword" id="oldpassword">
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">New Password</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" name="newpassword" id="newpassword">
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Confirm Password</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" name="confirm_password" id="confirm_password">
                            </div>
                        </div>

                     

                        <input type="submit" class="btn btn-info" value="Change Password">
                        </form>

                        <!-- end row -->
                       
                        <!-- end row -->
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
      

        </div>
</div>



@endsection