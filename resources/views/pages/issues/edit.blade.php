@extends('app')

@section('head')
<link rel="stylesheet" type="text/css" href="/assets/dist/css/chosen.min.css" media = "all">
<link rel="stylesheet" type="text/css" href="/assets/dist/css/bootstrap-datetimepicker.css" media = "all">
@stop

@section('content')
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Issue</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    @include ('flash::message')

                    <div class="panel panel-default">
                        <div class="panel-heading">Issue Details</div>
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" style="margin-bottom:10px">
                                <li class="active"><a href="#info" data-toggle="tab" aria-expanded="true">Info</a>
                                </li>
                                <li class=""><a href="#hosts" data-toggle="tab" aria-expanded="false">Hosts</a></li>
                                <li class=""><a href="#domains" data-toggle="tab" aria-expanded="false">Domains</a>
                                @if ($domainStatus[0]['farm'])
                                <li class=""><a href="#farms" data-toggle="tab" aria-expanded="false">Farms</a>
                                 @endif
                                </li>

                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="info">
                                <!--<form role="form" class="form-horizontal">-->
                                
                                    <div class="row">
                                        <div class="col-lg-6">
                                            {!! Form::open(['class'=> 'form-horizontal']) !!}
                                            <div class="form-group">
                                                
                                                {!! Form::label('issue', 'RF Incident', ['class' => 'col-sm-3 control-label']) !!}
                                                <div class="col-md-4 col-sm-9">
                                                    
                                                    {!! Form::text('issue', $issue->issue, ['class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                
                                                {!! Form::label('services[]', 'Services', ['class' => 'col-sm-3 control-label']) !!}
                                                <div class="col-sm-4">
                                                    <div class="checkbox">
                                                        <label>
                                                        {!! Form::checkbox('services[]', 'VCC', !empty($services['VCC']), ['disabled']) !!} VCC
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                        {!! Form::checkbox('services[]', 'API', !empty($services['API']), ['disabled']) !!} API
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                        {!! Form::checkbox('services[]', 'FTP', !empty($services['FTP']), ['disabled']) !!} FTP
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                        {!! Form::checkbox('services[]', 'SCC', !empty($services['SCC']), ['disabled']) !!} SCC
                                                        </label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                        {!! Form::checkbox('services[]', 'Plus Desktop', !empty($services['Plus Desktop']), ['disabled']) !!} Plus Desktop
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-5">
                                                <div class="checkbox">
                                                    <label>
                                                    {!! Form::checkbox('services[]', 'Voice', !empty($services['Voice']), ['disabled']) !!} Voice
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                    {!! Form::checkbox('services[]', 'Network', !empty($service['Network']), ['disabled']) !!} Network
                                                    </label>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                                
                                                {!! Form::label('open_date', 'Open Date', ['class' => 'col-sm-3 control-label']) !!}
                                                <div class="col-sm-5">
                                                    <div class='input-group date cal'>
                                                        {!! Form::text('open_date', date('m/d/Y', strtotime($issue->open_date)), ['class' => 'form-control', 'disabled' => 'disabled']) !!}
                                                        <!-- <input type='text' class="form-control" /> -->
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class='input-group date clock'>
                                                        
                                                        {!! Form::text('open_time', date('h:i A', strtotime($issue->open_date)), ['class' => 'form-control', 'disabled' => 'disabled']) !!}
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-time"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                
                                                {!! Form::label('close_date', 'Close Date', ['class' => 'col-sm-3 control-label']) !!}
                                                <div class="col-sm-5">
                                                    <div class='input-group date cal'>
                                                        {!! Form::text('close_date', ($issue->close_date != NULL ? date('m/d/Y', strtotime($issue->close_date)) : '' ), ['class' => 'form-control']) !!}
                                                        <!-- <input type='text' class="form-control" /> -->
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class='input-group date clock'>
                                                        
                                                        {!! Form::text('close_time', ($issue->close_date != NULL ? date('h:i A', strtotime($issue->close_date)) : '' ), ['class' => 'form-control']) !!}
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-time"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('summary', 'Summary', ['class' => 'col-sm-3 control-label']) !!}
                                                
                                                <div class="col-sm-9">
                                                    
                                                    {!! Form::text('summary', $issue->summary, ['class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                         
                                            <div class="form-group">
                                                {!! Form::label('type', 'Type', ['class' => 'col-sm-3 control-label']) !!}
                                                <!-- <label class="col-sm-3 control-label">Type</label> -->
                                                <div class="col-md-6 col-sm-9">
                                                    {!! Form::select('type', array ('' => '-- Select Type --', 'Performance Degredation' => 'Performance Degredation', 'Service Down' => 'Service Down'), $issue->type, ['class' => 'form-control']) !!}
                                                   
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label"></label>
                                                <div class="col-sm-9">
                                                    {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
                                                    <!-- <button type="submit" class="btn btn-success">Save</button> -->
                                                </div>
                                            </div>
                                            <!-- put the save and form close here -->
                                            {!! Form::close() !!}
                                        </div><!-- ./col-lg-6 -->
                                        <div class="col-lg-6">
                                            {!! Form::open(['action' => 'NotesController@store', 'class'=> 'form-horizontal']) !!}
                                            <div style="position:relative"><a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false"><strong>Notes</strong> <i class="fa fa-caret-down"></i></a>
                                                        <ul class="dropdown-menu dropdown-tasks" style="width:500px;left:50px">
                                                        @if (!empty($cannedResponses))
                                                            @foreach ($cannedResponses as $r)
                                                            <li>
                                                                <a href="#" data-id="{{$r->id}}" class="cannedResponse">
                                                                    <div>
                                                                        <p>
                                                                            <strong>{{ $r->title }}</strong>
                                                                            <span class="text-muted">
                                                                                
                                                                            </span>
                                                                        </p>
                                                                        <p class="text-muted">
                                                                            {{ str_limit($r->content, 60, '...') }}
                                                                        </p>
                                                                        
                                                                    </div>
                                                                </a>
                                                            </li>
                                                            @if($r != $cannedResponses->last()) <li class="divider"></li> @endif
                                                            
                                                            @endforeach
                                                        @endif
                                                        
                                                        
                                                    </ul></div>
                                                   
                                            
                                                    <textarea class="form-control" style="margin-bottom:15px" name="note" id="newNote" cols="50" rows="5"></textarea>
                                                
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="input-group date cal">
                                                        <input class="form-control" name="note_date" type="text" value="{{ date("m-d-Y") }}" id="note_date">
                                                        <!-- <input type='text' class="form-control" /> -->
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="input-group date clock">
                                                        <!-- <input type='text' class="form-control" /> -->
                                                        <input class="form-control" name="note_time" type="text" id="note_time" value="{{ date("H:i A") }}">
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-time"></span>
                                                        </span>
                                                    </div>
                                                </div>    
                                                <div class="col-sm-4">
                                                    {!! Form::hidden('issue_id', $issue->id) !!}
                                                    {!! Form::submit('Add Note', ['class' => 'btn btn-primary', 'style' => 'margin-bottom:15px;width:100%']) !!}
                                                    <!--<button class="btn btn-primary" style="margin-bottom:15px;width:100%" id="addNote">Add Note</button>-->
                                                </div>
                                            </div>
                                            {!! Form::close() !!}   
                                           
                                            @if (is_object($notes))
                                            <table class="zebra-table" style="margin-bottom:15px" id="noteTable">
                                              @foreach ($notes as $n)
                                                <tr>
                                                    <td style="position:relative">
                                                        {!! Form::open(['url' => '/admin/issues/notes/'.$n->id]) !!}
                                                            {!! Form::hidden('id', $n->id) !!}
                                                            {!! Form::hidden('_method', 'DELETE') !!}
                                                            <a href="#" class="pull-right delete" data-id="{{$n->id }}"><i class="fa fa-trash"></i></a>
                                                        {!! Form::close() !!}
                                                        <strong>{{ Carbon\Carbon::parse($n->created_date)->format('m/d/Y H:i A') }}</strong><br />
                                                        {!! nl2br(e($n->note)) !!}
                                                        @if (!empty($n->user)) <span class="author" style="position:absolute;bottom:5px;right:5px;color:#aaa;font-size:0.9em">Posted By: {{ $n->user['name'] }}</span> @endif
                                                    </td>
                                                </tr>
                                              @endforeach
                                            </table>
                                            @endif
                                                   
                                            @if ($errors->any())
                                            <div class="alert alert-danger" role="alert">

                                                @foreach ($errors->all() as $error)
                                                   
                                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                                    <span class="sr-only">Error:</span>
                                                    {{ $error }}
                                                    <br />
                                                   
                                                @endforeach

                                            </div>
                                            @endif
                                            
                                        </div><!-- ./col-lg-6 -->
                                    </div><!-- ./row -->
                                
                        
                                
                                </div><!-- ./tab-pane #info -->

                                <div class="tab-pane" id="hosts">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="dataTable_wrapper">
                                                <table class="table table-striped table-bordered table-hover" id="domainHosts">
                                                    <thead>
                                                        <tr>
                                                            <th>Domain Host</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (is_array($domainHosts))
                                                            @foreach ($domainHosts as $d)
                                                            <tr><td>{{ $d->domain_host }}  <button type="button" class="btn btn-primary btn-xs pull-right" data-name="{{ $d->domain_host }}" data-domain-host-id="{{ $d->domain_host_id }}" data-toggle="modal" data-target="#closeModal">Close Issue</button> <a href="javascript:;" data-id="{{ $d->domain_host_id }}" class="delete delete-dhost pull-right" style="margin-right:10px;"><i class="fa fa-trash"></i></a></td></tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div><!-- col-md-6 -->
                                        <div class="col-md-6">
                                            {!! Form::open(['action' => 'IssuesController@addDomainHost', 'class'=> 'form-horizontal']) !!}
                                            <div class="form-group">
                                                {!! Form::label('new_domain_hosts[]', 'Add Domain Hosts', ['class' => 'col-sm-3 control-label']) !!}
                                                <div class="col-sm-9" style="margin-bottom:15px">
                                                    {!! Form::select('new_domain_hosts[]', $availableDomainHosts, null, ['class' => 'form-control', 'id' => 'availableDomainHostList', 'multiple' => 'multiple']) !!}
                                                    
                                                </div>
                                            </div>
                                            {!! Form::hidden('issue_id', $issue->id) !!}
                                            
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label"></label>
                                                <div class="col-sm-9">
                                                    {!! Form::submit('Add Domain Host', ['class' => 'btn btn-primary pull-right']) !!}
                                                </div>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                   
                                </div><!-- ./tab-pane #domains -->
                                 <div class="tab-pane" id="hosts">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="dataTable_wrapper">
                                                <table class="table table-striped table-bordered table-hover" id="domainHosts">
                                                    <thead>
                                                        <tr>
                                                            <th>Domain Host</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (is_array($domainHosts))
                                                            @foreach ($domainHosts as $d)
                                                            <tr><td>{{ $d->domain_host }}  <button type="button" class="btn btn-primary btn-xs pull-right" data-name="{{ $d->domain_host }}" data-domain-host-id="{{ $d->domain_host_id }}" data-toggle="modal" data-target="#closeModal">Close Issue</button> <a href="javascript:;" data-id="{{ $d->domain_host_id }}" class="delete delete-dhost pull-right" style="margin-right:10px;"><i class="fa fa-trash"></i></a></td></tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div><!-- col-md-6 -->
                                        <div class="col-md-6">
                                            {!! Form::open(['action' => 'IssuesController@addDomainHost', 'class'=> 'form-horizontal']) !!}
                                            <div class="form-group">
                                                {!! Form::label('new_domain_hosts[]', 'Add Domain Hosts', ['class' => 'col-sm-3 control-label']) !!}
                                                <div class="col-sm-9" style="margin-bottom:15px">
                                                    {!! Form::select('new_domain_hosts[]', $availableDomainHosts, null, ['class' => 'form-control', 'id' => 'availableDomainHostList', 'multiple' => 'multiple']) !!}
                                                    
                                                </div>
                                            </div>
                                            {!! Form::hidden('issue_id', $issue->id) !!}
                                            
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label"></label>
                                                <div class="col-sm-9">
                                                    {!! Form::submit('Add Domain Host', ['class' => 'btn btn-primary pull-right']) !!}
                                                </div>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                   
                                </div><!-- ./tab-pane #domains -->
                                <div class="tab-pane" id="domains">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="dataTable_wrapper">
                                                <table class="table table-striped table-bordered table-hover" id="domainStatus">
                                                    <thead>
                                                        <tr>
                                                            <th>Domain</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($domainStatus as $domain)
                                                        <tr>
                                                            <td>{{ $domain['name'] }} @if($domain['end_time'] == NULL)<button type="button" class="btn btn-primary btn-xs pull-right" data-name="{{ $domain['name'] }}" data-domain-id="{{ $domain['domain_id'] }}" data-toggle="modal" data-target="#closeModal">Close Issue</button> <a href="javascript:;" data-id="{{ $domain['domain_id'] }}" class="delete delete-domain pull-right" style="margin-right:10px"><i class="fa fa-trash"></i></a>@else<span class="pull-right">{{ $domain['end_time'] }}</span>@endif</td>
                                                           
                                                        </tr>
                                                        @endforeach
                                                       
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            {!! Form::open(['action' => 'IssuesController@addDomain', 'class'=> 'form-horizontal']) !!}

                                            <div class="form-group">
                                                {!! Form::label('domainAutocomplete', 'Domains', ['class' => 'col-sm-3 control-label']) !!}
                                                <div class="col-sm-9">
                                                    {!! Form::text('domainAutocomplete', null, ['class' => 'form-control', 'id' => 'domainList']) !!}
                                                    
                                                    <ul class="tags" id="domainTags">
                                                        <!--<li class="domainTag">Test Domain <input type="hidden" name="domains[]" value="1"><button type="button" class="close" data-dismiss="domainTag" aria-hidden="true">×</button></li>-->
                                                    </ul>
                                                    
                                                </div>
                                            </div>
                                            {!! Form::hidden('issue_id', $issue->id) !!}
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label"></label>
                                                <div class="col-sm-9">
                                                    {!! Form::submit('Add Domain', ['class' => 'btn btn-primary pull-right']) !!}
                                                </div>
                                            </div>
                                            {!! Form::close() !!}

                                        </div>
                                    </div><!-- .row -->
                                </div><!-- ./tab-pane #domains -->
                                @foreach ($domainStatus as $domain)
                                 @if ($domain['farm'])
                                <div class="tab-pane" id="farms">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="dataTable_wrapper">
                                                <table class="table table-striped table-bordered table-hover" id="domainStatus">
                                                    <thead>
                                                        <tr>
                                                            <th>Farms</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (is_array($domainStatus))
                                                            @foreach ($domainStatus as $domain)
                                                        <tr>
                                                            <td>{{ $domain['farm'] }} @if($domain['end_time'] == NULL)<button type="button" class="btn btn-primary btn-xs pull-right" data-name="{{ $domain['name'] }}" data-domain-id="{{ $domain['domain_id'] }}" data-toggle="modal" data-target="#closeModal">Close Issue</button> <a href="javascript:;" data-id="{{ $domain['domain_id'] }}" class="delete delete-domain pull-right" style="margin-right:10px"><i class="fa fa-trash"></i></a>@else<span class="pull-right">{{ $domain['end_time'] }}</span>@endif</td>
                                                           
                                                        </tr>
                                                        @endforeach
                                                        @endif
                                                       
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            {!! Form::open(['action' => 'IssuesController@addDomain', 'class'=> 'form-horizontal']) !!}

                                            <div class="form-group">
                                                {!! Form::label('domainAutocomplete', 'Domains', ['class' => 'col-sm-3 control-label']) !!}
                                                <div class="col-sm-9">
                                                    {!! Form::text('domainAutocomplete', null, ['class' => 'form-control', 'id' => 'domainList']) !!}
                                                    
                                                    <ul class="tags" id="domainTags">
                                                        <!--<li class="domainTag">Test Domain <input type="hidden" name="domains[]" value="1"><button type="button" class="close" data-dismiss="domainTag" aria-hidden="true">×</button></li>-->
                                                    </ul>
                                                    
                                                </div>
                                            </div>
                                            {!! Form::hidden('issue_id', $issue->id) !!}
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label"></label>
                                                <div class="col-sm-9">
                                                    {!! Form::submit('Add Domain', ['class' => 'btn btn-primary pull-right']) !!}
                                                </div>
                                            </div>
                                            {!! Form::close() !!}

                                        </div>
                                    </div><!-- .row -->
                                </div><!-- ./tab-pane #domains -->
                                 @endif
                                 @endforeach
                            </div>
                        </div><!-- ./panel-body -->
                </div><!-- ./col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="modal fade" id="closeModal" tabindex="-1" role="dialog" aria-labelledby="closeModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        {!! Form::open(['url'=> '/admin/issues/closedomain']) !!}
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">Close Issue</h4>
                        </div>
                        <div class="modal-body">
                            <p>This will close the issue for this domain or domain host (and related domains) only.</p>
                            
                                <div class="form-group">
                                    {!! Form::label('domain', 'Domain') !!}
                                    <p class="form-control-static" id="domainName"></p>
                                </div>
                                <div class="form-group">
                                    
                                    {!! Form::label('close_date', 'Close Date') !!}
                                    <!--<div class="col-sm-12">-->
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <div class='input-group date cal'>
                                                    {!! Form::text('close_date', '', ['class' => 'form-control']) !!}
                                                    <!-- <input type='text' class="form-control" /> -->
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class='input-group date clock'>
                                                    
                                                    {!! Form::text('close_time', '', ['class' => 'form-control']) !!}
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-time"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    <!--</div>-->


                                    
                                </div>
                                <div class="form-group">
                                    <div style="position:relative">
                                        <label for="details" class="control-label"><a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">Note <i class="fa fa-caret-down"></i></a>
                                            <ul class="dropdown-menu dropdown-tasks" style="width:500px;left:50px">
                                            @if (!empty($cannedResponses))
                                                @foreach ($cannedResponses as $r)
                                                <li>
                                                    <a href="#" data-id="{{$r->id}}" class="finalCannedResponse">
                                                        <div>
                                                            <p>
                                                                <strong>{{ $r->title }}</strong>
                                                                <span class="text-muted">
                                                                    
                                                                </span>
                                                            </p>
                                                            <p class="text-muted">
                                                                {{ str_limit($r->content, 60, '...') }}
                                                            </p>
                                                            
                                                        </div>
                                                    </a>
                                                </li>
                                                @if($r != $cannedResponses->last()) <li class="divider"></li> @endif
                                                
                                                @endforeach
                                            @endif
                                            </ul>
                                        </label>
                                    </div>
                                    <!-- <label class="col-sm-3 control-label">Summary</label> -->
                                    <div>
                                        <!-- <input class="form-control"> -->
                                        {!! Form::textarea('note', null, ['class' => 'form-control', 'id' => 'finalNote']) !!}
                                    </div>
                                </div><!-- .form-group -->
                                <input type="hidden" id="closeDomainHostId" name="domainHostId" value="">
                                <input type="hidden" id="closeDomainId" name="domainId" value="">
                                <input type="hidden" name="issue_id" value="{{ $issue->id }}">
          
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <!--<button type="button" class="btn btn-primary">Close Issue</button>-->
                            {!! Form::submit('Close Issue', ['class' => 'btn btn-primary']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <!-- /.modal-content -->
                    
                </div>
                <!-- /.modal-dialog -->
            </div>
            {!! Form::open(['action' => 'IssuesController@delDomainHost', 'id' => 'delHostForm']) !!}
            {!! Form::hidden('issue_id', $issue->id) !!}
            {!! Form::hidden('host_id', '', ['id'=>'hostId']) !!}
            {!! Form::close() !!}

            {!! Form::open(['action' => 'IssuesController@delDomain', 'id' => 'delDomainForm']) !!}
            {!! Form::hidden('issue_id', $issue->id) !!}
            {!! Form::hidden('domain_id', '', ['id'=>'domainId']) !!}
            {!! Form::close() !!}

@stop

@section('js')
<script type="text/javascript" src="/assets/js/chosen.jquery.min.js"></script>
<!-- DataTables JavaScript -->
<script src="/assets/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="/assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
<script>

    @if(!empty($cannedResponses))
    var crJson = {!! json_encode($cannedResponses) !!}
    @endif
    $(function() {
        $('#closeModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var domain = button.data('name');
            var domainId = button.data('domain-id');
            var domainHostId = button.data('domain-host-id');
            var modal = $(this);
            modal.find('.modal-body #domainStatusName').val(domain);
            modal.find('.modal-body #domainName').html(domain);
            modal.find('.modal-body #closeDomainId').val(domainId);
            modal.find('.modal-body #closeDomainHostId').val(domainHostId);
        });

        $('.cal').datetimepicker({ format: 'L' });
        $('.clock').datetimepicker({
                    format: 'LT'
                });
        $('#availableDomainHostList').chosen({ width: '100%', search_contains: true });
     
        $('#domainStatus, #domainHosts').DataTable({
                responsive: true,
                lengthMenu: [[50, 100, 250, -1], [50, 100, 250, 'All']]
        });

        $('#addNote').click(function() {
            $noteTable = $('#noteTable tbody');
            $noteDate = $('#note_date').val();
            $noteTime = $('#note_time').val();
            $note = $('#newNote').val();
            $noteTable.prepend("<tr><td><strong>"+$noteDate+" "+$noteTime+"</strong><br>"+$note+"</td></tr>");
            $('#newNote').val('');
            
            return false;
        });

        $('.delete-dhost').click(function() {
            $('#hostId').val($(this).data('id'));
            $('#delHostForm').submit();
            return false;
        });
        $('.delete-domain').click(function() {
            $('#domainId').val($(this).data('id'));
            $('#delDomainForm').submit();
            return false;
        });
        $('.cannedResponse').click(function() {
            var crid = $(this).data('id') -1;
            
            $('#newNote').val(crJson[crid].content);
            
        });
        $('.finalCannedResponse').click(function() {
            var crid = $(this).data('id') -1;
            
            $('#finalNote').val(crJson[crid].content);
            
        });

        $('.delete').click(function() {
            $this = $(this);
            var conf = confirm("Are you sure you want to delete this?");
            if (conf == true) {
                $this.parents('form').submit();
            }

            return false;
        }); 

        $( "#domainList" ).autocomplete({
            source: "/admin/domains/find",
            minLength: 2,
            select: function( event, ui ) {
                $('#domainTags').append('<li>'+ ui.item.label +' <input type="hidden" name="newDomains[]" value="'+ui.item.value+'"><button type="button" class="close deleteTag" data-dismiss="domainTag" aria-hidden="true">×</button></li>');
                $('#domainList').val('');
                return false;
            }

        });
        $('#domainTags').on('click','.deleteTag',function() {
            $(this).parents('li').fadeOut(function() { $(this).remove(); });
        });
    });
</script>


@stop