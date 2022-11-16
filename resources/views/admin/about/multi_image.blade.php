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

                        <h4 class="card-title">Add Multi Image Page</h4>

                        <hr>
                        <form action="{{ route ('store.multi.image') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                                                 
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">About Multi Image</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" name="multi_image[]" id="image" multiple>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-sm-10">
                            <label for="example-text-input" class="col-sm-2 col-form-label"></label>

                            {{-- (!empty($aboutpage->about_image))? url($aboutpage->about_image):  --}}

                            <img id="showImage" class="rounde avatar-lg" src="{{ url('upload/no_image.jpg') }}" alt="Card image cap">
                            </div>
                        </div>

                        <input type="submit" class="btn btn-info" value="Add Multi Image">
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