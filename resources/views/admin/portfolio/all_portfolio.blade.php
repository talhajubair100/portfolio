@extends('admin.admin_master')


@section('content')


<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">All Portfolio</h4>

                   

                </div>
            </div>
        </div>
        <!-- end page title -->
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">All Portfolio</h4>
                       

                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Action</th>

                            </tr>
                            </thead>


                            <tbody>

                                @foreach ($portfolio as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->portfolio_name }}</td>
                                    <td>{{ $item->portfolio_title }}</td>

                                    <td><img src="{{ asset($item->portfolio_image) }}" alt="" style="width:60px; height:50px"></td>
                                    <td>
                                        <a href="{{ route ('edit.portfolio', $item->id) }}" class="btn btn-info" title="Edit Data"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route ('delete.portfolio', $item->id) }}" class="btn btn-danger" id="delete" title="Delete Data"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                    
                                </tr>
                                @endforeach
                            
                            
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

   


        <!-- end row-->
        
    </div> <!-- container-fluid -->
</div>

@endsection