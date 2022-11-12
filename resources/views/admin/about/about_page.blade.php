@extends('admin.admin_master')


@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<div class="page-content">
        <div class="container-fluid">


        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">About Page</h4>

                        <form action="#" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value="{{ $aboutpage->id }}">

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="title" id="example-text-input" value="{{ $aboutpage->title }}">
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Short Title</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="short_title" id="example-text-input" value="{{ $aboutpage->short_title }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Short Description</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="short_description" id="example-text-input" value="{{ $aboutpage->short_description }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="description" id="example-text-input" value="{{ $aboutpage->description }}">
                            </div>
                        </div>


                      
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Profile Image</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" name="about_image" id="image">
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-sm-10">
                            <label for="example-text-input" class="col-sm-2 col-form-label"></label>

                            <img id="showImage" class="rounde avatar-lg" src="{{ (!empty($homeslide->home_slide))? url($homeslide->home_slide): url('upload/no_image.jpg') }}" alt="Card image cap">
                            </div>
                        </div>

                        <input type="submit" class="btn btn-info" value="Update Slider">
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

<script>
    $(document).ready(function () {
       $('#image').change(function(e){
              var reader = new FileReader();
              reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
              }
              reader.readAsDataURL(e.target.files['0']);
       });
    });
</script>


@endsection