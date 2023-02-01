@extends('cms.parent')
@section('title','Dashboard')
@section('lg_title','Slider')
@section('main_title','View slider')
@section('sm_title','All slider')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Index Slider</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 5%">#</th>
                                    <th>The First Title</th>
                                    <th>The Second Title</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th style="width: 20%">Setting</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sliders as $slider)
                                <tr>
                                    <td>{{$loop->index +1}}</td>
                                    <td>{{$slider->title_one}}</td>
                                    <td>{{$slider->title_two}}</td>
                                    <td><img src="{{Storage::url($slider->image)}}" style="width: 100px; height: 100px;" alt="Img NotFound"></td>
                                    <td><span class="badge @if ($slider->active) bg-success @else  bg-danger
                                    @endif">{{$slider->activeStatus}}</span></td>
                                    <td>      
                                        <div class="btn-group">
                                        @if($slider->active==1)
                                <a onclick="changeStatus('{{$slider->id}}')" class="btn btn-success" title="Status Active">
                                <i class="fas fa-lock"></i></a>
                                @else
                                <a onclick="changeStatus('{{$slider->id}}')" class="btn btn-danger" title="Status InActive">
                                <i class="fas fa-unlock-alt"></i>
                                    @endif
                                </a>
                                            <a href="{{route('sliders.edit', $slider->id)}}"  class="btn btn-warning btn-flat">
                                                <i class="fas fa-edit"></i></a>
                                            <a href="#" onclick="confirmDelete('{{$slider->id}}', this)" class="btn btn-danger">
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
        axios.delete('/cms/sliders/'+id)
        .then(function (response) {
            console.log(response);
            // toastr.success(response.data.message);
            reference.closest('tr').remove();
            showMessage(response.data);
        })
        .catch(function (error) {
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
    axios.post('/cms/changeStatus/' + id)
        .then(function(response) {
            console.log(response);
            toastr.success(response.data.message);
            window.location.href = '/cms/sliders';
        })
        .catch(function(error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
}
</script>

    

@endsection