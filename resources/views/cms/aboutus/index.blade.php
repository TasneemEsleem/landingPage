@extends('cms.parent')
@section('title','Dashboard')
@section('lg_title','aboutUs')
@section('main_title','View aboutUs')
@section('sm_title','All aboutUs')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Index aboutUs</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 5%">#</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th style="width: 20%">Setting</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($aboutUss as $aboutus)
                                <tr>
                                    <td>{{$loop->index +1}}</td>
                                    <td>{{$aboutus->title}}</td>
                                    <td><img src="{{Storage::url($aboutus->image)}}" style="width: 100px; height: 100px;" alt="Img NotFound"></td>
                                    <td><span class="badge @if ($aboutus->active) bg-success @else  bg-danger
                                    @endif">{{$aboutus->activeStatus}}</span></td>
                                    <td>
                                        <div class="btn-group">
                                            @if($aboutus->active==1)
                                            <a onclick="changeStatus('{{$aboutus->id}}')" class="btn btn-success" title="Status Active">
                                                <i class="fas fa-lock"></i></a>
                                            @else
                                            <a onclick="changeStatus('{{$aboutus->id}}')" class="btn btn-danger" title="Status InActive">
                                                <i class="fas fa-unlock-alt"></i>
                                                @endif
                                            </a>
                                            <a href="{{route('aboutus.edit', $aboutus->id)}}" class="btn btn-warning btn-flat">
                                                <i class="fas fa-edit"></i></a>
                                            <a href="#" onclick="confirmDelete('{{$aboutus->id}}', this)" class="btn btn-danger">
                                                <i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </div>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
@section('scripts')

<script>
    function confirmDelete(id, reference) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                performDelete(id, reference);
            }
        });
    }

    function performDelete(id, reference) {
        axios.delete('/cms/aboutus/' + id)
            .then(function(response) {
                console.log(response);
                // toastr.success(response.data.message);
                reference.closest('tr').remove();
                showMessage(response.data);
            })
            .catch(function(error) {
                console.log(error.response);
                // toastr.error(error.response.data.message);
                showMessage(error.response.data);
            });
    }

    function showMessage(data) {
        Swal.fire(
            data.title,
            data.text,
            data.icon
        );
    }
</script>
<script>
    function changeStatus(id) {
        axios.post('/cms/aboutus/changeStatus/' + id)
            .then(function(response) {
                console.log(response);
                toastr.success(response.data.message);
                window.location.href = '/cms/aboutus';
            })
            .catch(function(error) {
                console.log(error.response);
                toastr.error(error.response.data.message);
            });
    }
</script>



@endsection