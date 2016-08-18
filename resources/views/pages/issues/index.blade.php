@extends('app')

@section('head')

@stop

@section('content')
	<div class="row">
        <div class="col-lg-12">

            <h1 class="page-header">
                <a href="/admin/issues/add" class="btn btn-primary pull-right">Add Issue</a>
                Issues
            </h1>

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    All Issues
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Issue #</th>
                                    <th>Summary</th>
                                    <th>Opened</th>
                                    <th>Last Update</th>
                                    <!--<th>Closed</th>-->
                                    <th>Type</th>
                                    <th>Services</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($issues as $issue)
                                <tr>
                                    <td><a href="/admin/issues/{{ $issue->id }}">{{ $issue->issue }}</a></td>
                                    <td>{{ $issue->summary }}</td>
                                    <td>{{ $issue->open_date->diffForHumans() }}</td>
                                    <td>{{ $issue->updated_at->diffForHumans() }}</td>
                                    <!--<td>{{ $issue->close_date }}</td>-->
                                    <td>{{ $issue->type }}</td>
                                    <td>{{ str_replace(',', ', ',$issue->services) }}</td>
                                    <td>{{ ($issue->close_date == null ? 'Open': 'Closed') }}</td>
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
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
@stop