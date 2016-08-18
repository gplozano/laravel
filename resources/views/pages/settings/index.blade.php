@extends('app')

@section('head')

@stop

@section('content')
	<div class="row">
        <div class="col-lg-12">

            <h1 class="page-header">
                @if (Auth::user()->admin) 
                  <a href="/admin/settings/user/new" class="btn btn-primary pull-right">Add User</a>
                @endif
                Users
            </h1>

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Users
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Last Login</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>   
                                    <td>{{ $user['name'] }}</td>
                                    <td>{{ $user['email'] }}</td>
                                    <td>{{ $user['last_login'] }}</td>
                                    <td>
                                        @if (Auth::user()->admin || Auth::user()->id == $user['id'])
                                        <a href="/admin/settings/user/{{ $user['id'] }}" style="margin-right:5px"><i class="fa fa-edit"></i></a>
                                        @endif
                                        @if ($user['id'] != Auth::user()->id && Auth::user()->admin)
                                            <a href="javascript:;" class="delete-user" data-id="{{ $user['id'] }}"><i class="fa fa-trash-o"></i></a>
                                        @endif
                                        
                                    </td>
                                </tr>
                                @endforeach
                               
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                    <!--<div class="well">
                        <h4>DataTables Usage Information</h4>
                        <p>DataTables is a very flexible, advanced tables plugin for jQuery. In SB Admin, we are using a specialized version of DataTables built for Bootstrap 3. We have also customized the table headings to use Font Awesome icons in place of images. For complete documentation on DataTables, visit their website at <a target="_blank" href="https://datatables.net/">https://datatables.net/</a>.</p>
                        <a class="btn btn-default btn-lg btn-block" target="_blank" href="https://datatables.net/">View DataTables Documentation</a>
                    </div>-->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
@stop

@section('js')
	<!-- DataTables JavaScript -->
    <script src="/assets/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="/assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <script>
    $(document).ready(function() {
        var table = $('#dataTables-example').DataTable({
                responsive: true
        });

        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

        $('#dataTables-example tbody').on('click', 'a.delete-user', function() {
            var $this = $(this);
            var r = confirm("Are you sure you want to delete this user?");
            if(r == true)
            {
                $.ajax({
                    
                    type:'POST', 
                    url: '/admin/settings/user/delete', 
                    data: { '_token' : '{{ csrf_token() }}', 'userId': $this.data('id')},
                    success: function(result) { console.log(result) }
                });
                table.row( $this.parents('tr') ).remove().draw();

            }
            return false;              
            
        });
    });
    </script>
@stop