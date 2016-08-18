@extends('app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-4 col-lg-push-8">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-meh-o fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $pdIssues }}</div>
                                <div>Performance Degredation</div>
                            </div>
                        </div>
                    </div>
                    <!--<a href="#">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>-->
                </div>
            </div>
            <div class="col-xs-12">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-frown-o fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $sdIssues }}</div>
                                <div>Service Down</div>
                            </div>
                        </div>
                    </div>
                    <!--<a href="#">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>-->
                </div>
            </div>
        </div>
    </div>
    <!-- /.col-lg-4 -->
    <div class="col-lg-8 col-lg-pull-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                Open Issues
                <!--<div class="pull-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                            Actions
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href="#">Action</a>
                            </li>
                            <li><a href="#">Another action</a>
                            </li>
                            <li><a href="#">Something else here</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a>
                            </li>
                        </ul>
                    </div>
                </div>-->
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Issue #</th>
                                <th>Summary</th>
                                <th>Last Update</th>
                                <th>Type</th>
                                <th>Services</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($openIssues as $issue)
                            <tr>
                                <td><a href="issues/{{ $issue->id }}">{{ $issue->issue }}</a></td>
                                <td>{{ $issue->summary }}</td>
                                <td>{{ $issue->updated_at }}</td>
                                <td>{{ $issue->type }}</td>
                                <td>{{ str_replace(',', ', ',$issue->services) }}</td>
                            </tr>
                            @endforeach
                           
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->

 
    </div>
    <!-- /.col-lg-8 -->
    
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