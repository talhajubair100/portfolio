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

                        <form action="{{ route ('update.about') }}" method="POST" enctype="multipart/form-data">
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
                                
                                <textarea name="short_description" class="form-control" rows="5">
                                    {{ $aboutpage->short_description }}
                                </textarea>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">

                                <textarea id="elm1" name="description">
                                    {{ $aboutpage->description }}
                                </textarea>
                            </div>
                        </div>


                      
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">About Image</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" name="about_image" id="image">
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-sm-10">
                            <label for="example-text-input" class="col-sm-2 col-form-label"></label>

                            <img id="showImage" class="rounde avatar-lg" src="{{ (!empty($aboutpage->about_image))? url($aboutpage->about_image): url('upload/no_image.jpg') }}" alt="Card image cap">
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