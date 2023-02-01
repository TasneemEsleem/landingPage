@extends('cms.parent')
@section('title','Dashboard')
@section('lg_title','information')
@section('main_title','View information')
@section('sm_title','All information')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Index information</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 5%">#</th>
                                    <th>Email</th>
                                    <th>Logo</th>
                                    <th>Status</th>
                                    <th style="width: 20%">Setting</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($informations as $information)
                                <tr>
                                    <td>{{$loop->index +1}}</td>
                                    <td>{{$information->email}}</td>
                                    <td><img src="{{Storage::url($information->logo)}}" style="width: 100px; height: 100px;" alt="Img NotFound"></td>
                                    <td><span class="badge @if ($information->active) bg-success @else  bg-danger
                                    @endif">{{$information->activeStatus}}</span></td>
                                    <td>
                                        <div class="btn-group">
                                            @if($information->active==1)
                                            <a onclick="changeStatus('{{$information->id}}')" class="btn btn-success" title="Status Active">
                                                <i class="fas fa-lock"></i></a>
                                            @else
                                            <a onclick="changeStatus('{{$information->id}}')" class="btn btn-danger" title="Status InActive">
                                                <i class="fas fa-unlock-alt"></i>
                                                @endif
                                            </a>
                                            <a href="{{route('informations.edit', $information->id)}}" class="btn btn-warning btn-flat">
                                                <i class="fas fa-edit"></i></a>
                                            <a href="#" onclick="confirmDelete('{{$information->id}}', this)" class="btn btn-danger">
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
        axios.delete('/cms/informations/' + id)
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
        axios.post('/cms/information/changeStatus/' + id)
            .then(function(response) {
                console.log(response);
                toastr.success(response.data.message);
                window.location.href = '/cms/informations';
            })
            .catch(function(error) {
                console.log(error.response);
                toastr.error(error.response.data.message);
            });
    }
</script>



@endsection