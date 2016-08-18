@extends('app')

@section('head')
<link rel="stylesheet" type="text/css" href="/assets/dist/css/chosen.min.css" media = "all">
<link rel="stylesheet" type="text/css" href="/assets/dist/css/bootstrap-datetimepicker.css" media = "all">
@stop

@section('content')
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Issue</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Issue Details</div>
                        <div class="panel-body">
                            <!--<form role="form" class="form-horizontal">-->
                            {!! Form::open(['class'=> 'form-horizontal', 'url'=>'/admin/issues']) !!}
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <!--<label class="col-sm-3 control-label">Issue #</label>-->
                                            {!! Form::label('issue', 'RF Incident', ['class' => 'col-sm-3 control-label']) !!}
                                            <div class="col-md-4 col-sm-9">
                                                
                                                {!! Form::text('issue', null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('services[]', 'Services', ['class' => 'col-sm-3 control-label']) !!}
                                            <div class="col-sm-4">
                                                <div class="checkbox">
                                                    <label>
                                                    {!! Form::checkbox('services[]', 'VCC') !!} VCC
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                    {!! Form::checkbox('services[]', 'API') !!} API
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                    {!! Form::checkbox('services[]', 'FTP') !!} FTP
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                    {!! Form::checkbox('services[]', 'SCC') !!} SCC
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                    {!! Form::checkbox('services[]', 'Plus Desktop') !!} Plus Desktop
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="checkbox">
                                                    <label>
                                                    {!! Form::checkbox('services[]', 'Voice') !!} Voice
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                    {!! Form::checkbox('services[]', 'Network') !!} Network
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <!-- <label class="col-sm-3 control-label">Open Date</label> -->
                                            {!! Form::label('open_date', 'Open Date', ['class' => 'col-sm-3 control-label']) !!}
                                            <div class="col-sm-5">
                                                <div class='input-group date cal'>
                                                    {!! Form::text('open_date', null, ['class' => 'form-control']) !!}
                                                    <!-- <input type='text' class="form-control" /> -->
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class='input-group date clock'>
                                                    <!-- <input type='text' class="form-control" /> -->
                                                    {!! Form::text('open_time', null, ['class' => 'form-control']) !!}
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-time"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <!-- <label class="col-sm-3 control-label">Close Date</label> -->
                                            {!! Form::label('close_date', 'Close Date', ['class' => 'col-sm-3 control-label']) !!}
                                            <div class="col-sm-5">
                                                <div class='input-group date cal'>
                                                    {!! Form::text('close_date', null, ['class' => 'form-control']) !!}
                                                    <!-- <input type='text' class="form-control" /> -->
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class='input-group date clock'>
                                                    <!-- <input type='text' class="form-control" /> -->
                                                    {!! Form::text('close_time', null, ['class' => 'form-control']) !!}
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-time"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('summary', 'Summary', ['class' => 'col-sm-3 control-label']) !!}
                                            <!-- <label class="col-sm-3 control-label">Summary</label> -->
                                            <div class="col-sm-9">
                                                <!-- <input class="form-control"> -->
                                                {!! Form::text('summary', null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="details" class="col-sm-3 control-label"><a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">Details <i class="fa fa-caret-down"></i></a>
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
                                                
                                                
                                            </ul>
                                            </label>
                                            <!--{!! Form::label('details', 'Details', ['class' => 'col-sm-3 control-label']) !!}-->





                                            <div class="col-sm-9">


                                           

                                            
                                        

                                                <!-- <textarea class="form-control" rows="3"></textarea> -->
                                                {!! Form::textarea('details', null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('type', 'Type', ['class' => 'col-sm-3 control-label']) !!}
                                            <!-- <label class="col-sm-3 control-label">Type</label> -->
                                            <div class="col-md-6 col-sm-9">
                                                {!! Form::select('type', array ('' => '-- Select Type --', 'Performance Degredation' => 'Performance Degredation', 'Service Down' => 'Service Down'), null, ['class' => 'form-control']) !!}
                                                <!-- <select class="form-control">
                                                    <option>-- Select Type --</option>
                                                    <option>Performance Degredation</option>
                                                    <option>Service Down</option>
                                                </select> -->
                                            </div>
                                        </div>

                                    </div><!-- ./col-lg-6 -->
                                    <div class="col-lg-6">
                                        <div class="form-group" id="selectDomainHosts">
                                            <!-- <label class="col-sm-3 control-label">Domain Host</label> -->
                                            {!! Form::label('domain_hosts[]', 'Domain Hosts', ['class' => 'col-sm-3 control-label']) !!}
                                            <div class="col-sm-9">
                                                {!! Form::select('domain_hosts[]', $domainHostsTable, null, ['class' => 'form-control', 'id' => 'domainHostList', 'multiple' => 'multiple']) !!}
                                                <!-- <select multiple="" class="form-control" id="domainHostList">
                                                    @foreach ($domainHosts as $dh => $domains)
                                                        <option>{{ $dh }}</option>
                                                    
                                                    <option>core001.scl</option>
                                                    <option>core064a.scl</option>
                                                    <option>core001a.atl</option>
                                                    <option>core001a.scl</option>
                                                    <option>core002.atl</option>
                                                    @endforeach
                                                </select> -->
                                                <button class="selectAll">Select all</button>
                                                <button class="selectAllSCL">SCL</button>
                                                <button class="selectAllATL">ATL</button>
                                                <button class="selectAllLDN">LDN</button>
                                                <button class="selectNone">Clear</button>
                                                <a href="#" class="swapSelector"><i class="fa fa-retweet"></i> Switch to Domain Selector</a>
                                            </div>
                                        </div>

                                        <div class="form-group" id="selectDomains">
                                            
                                            {!! Form::label('domainAutocomplete', 'Domains', ['class' => 'col-sm-3 control-label']) !!}
                                            <div class="col-sm-9">
                                                {!! Form::text('domainAutocomplete', null, ['class' => 'form-control', 'id' => 'domainList']) !!}
                                                
                                                <ul class="tags" id="domainTags">
                                                    <!--<li class="domainTag">Test Domain <input type="hidden" name="domains[]" value="1"><button type="button" class="close" data-dismiss="domainTag" aria-hidden="true">×</button></li>-->
                                                </ul>
                                                <a href="#" class="swapSelector"><i class="fa fa-retweet"></i> Switch to Domain Host Selector</a>
                                            </div>
                                        </div>
                                      
                                            <div class="form-group" id="selectFarms">
                                                <!-- <label class="col-sm-3 control-label">Domain Host</label> -->
                                                {!! Form::label('domain_farms[]', 'Farms', ['class' => 'col-sm-3 control-label']) !!}
                                                <div class="col-sm-9">
                                                    {!! Form::select('domain_farms[]', $domainFarms, null, ['class' => 'form-control', 'id' => 'domainFarmList', 'multiple' => 'multiple']) !!}
                                                   <!-- {{!! Form::select('age', ['young' => 'Under 18','adult' => '19 to 30','adult2' => 'Over 30']) !!}} -->
                                                    </select> 
                                                    <button class="selectAllFarm">Select all</button>
                                                    <button class="selectAllFarmSCL">SCL</button>
                                                    <button class="selectAllFarmATL">ATL</button>
                                                    <button class="selectNoneFarm">Clear</button>
                                                    
                                                </div>
                                            </div>
                                        
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
                                        <!--<div class="form-group">
                                            <label class="col-sm-3 control-label">Domain</label>
                                            <div class="col-sm-9">
                                                <select multiple="" class="form-control">
                                                    <option>vcc.five9.com</option>
                                                    <option>101.com</option>
                                                    <option>afford.com</option>
                                                    <option>istorage.com</option>
                                                    <option>jh.com</option>
                                                </select>
                                            </div>
                                        </div>-->
                                    </div><!-- ./col-lg-6 -->
                                </div><!-- ./row -->
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"></label>
                                            <div class="col-sm-9">
                                                {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
                                                <!-- <button type="submit" class="btn btn-success">Save</button> -->
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- ./row -->
                            <!--</form>-->
                            {!! Form::close() !!}


                        </div><!-- ./panel-body -->
                </div><!-- ./col-lg-12 -->
            </div>
            <!-- /.row -->
@stop

@section('js')
<script type="text/javascript" src="/assets/js/chosen.jquery.min.js"></script>
<script>

    var dhfJson = {!! $dhfJson !!}
    console.log(dhfJson);
    var allDomains = {!! $allDomainsJson !!}
    @if(!empty($cannedResponses))
    var crJson = {!! json_encode($cannedResponses) !!}
    @endif
    $(function() {
        $('.cal').datetimepicker({ format: 'L' });
        $('.clock').datetimepicker({
                    format: 'LT'
                });

        //$('#domainList').chosen({ width: '100%', search_contains: true });
        $( "#domainList" ).autocomplete({
            source: "/admin/domains/find",
            minLength: 2,
            select: function( event, ui ) {
                $('#domainTags').append('<li>'+ ui.item.label +' <input type="hidden" name="domains[]" value="'+ui.item.value+'"><button type="button" class="close deleteTag" data-dismiss="domainTag" aria-hidden="true">×</button></li>');
                $('#domainList').val('');
                return false;
            }

        });

        $('#selectDomains').hide();

        $('.swapSelector').click(function() {
            $("#domainHostList option").removeAttr("selected");
            $('#domainHostList').trigger('liszt:updated');
            $('#domainTags').empty();
            $('#selectDomains').toggle();
            $('#selectDomainHosts').toggle();
            return false;
        });

        $('#domainTags').on('click','.deleteTag',function() {
            $(this).parents('li').fadeOut(function() { $(this).remove(); });
        });

        $('#domainHostList').chosen({ width: '100%', search_contains: true });
        $('#domainHostList').change(function() {
            console.log($('#domainHostList').val());
        });
        $('#domainFarmList').chosen({ width: '100%', search_contains: true });
        $('#domainFarmList').change(function() {
            console.log($('#domainFarmList').val());
        });
        $('.selectAll').click(function(e){
            $('#domainHostList option').prop('selected', true);
            $('#domainHostList').trigger('liszt:updated');
            //e.preventDefault();
        });
        $('.selectAllFarm').click(function(e){
            $('#domainFarmList option').prop('selected', true);
            $('#domainFarmList').trigger('liszt:updated');
            //e.preventDefault();
        });

        $('.selectAllSCL').click(function(e){
            $("#domainHostList option:contains('.scl.five9.com')").prop('selected', true);
            $('#domainHostList').trigger('liszt:updated');
            //e.preventDefault();
        });
        $('.selectAllATL').click(function(e){
            $("#domainHostList option:contains('.atl.five9.com')").prop('selected', true);
            $('#domainHostList').trigger('liszt:updated');
            //e.preventDefault();
        });
        $('.selectAllFarmATL').click(function(e){
            $("#domainFarmList option:contains('ATL_90_Farm_')").prop('selected', true);
            $('#domainFarmList').trigger('liszt:updated');
            //e.preventDefault();
        });
        $('.selectAllFarmSCL').click(function(e){
            $("#domainFarmList option:contains('SCL_90_Farm_')").prop('selected', true);
            $('#domainFarmList').trigger('liszt:updated');
            //e.preventDefault();
        });
        $('.selectAllLDN').click(function(e){
            $("#domainHostList option:contains('.ldn.five9.com')").prop('selected', true);
            $('#domainHostList').trigger('liszt:updated');
            //e.preventDefault();
        });
        $('.selectNone').click(function(e){
            $("#domainHostList option, #domainFarmList option").removeAttr("selected");
            $('#domainHostList, #domainFarmList').trigger('liszt:updated');
            //e.preventDefault();
        });
        $('.selectNoneFarm').click(function(e){
            $("#domainFarmList option").removeAttr("selected");
            $('#domainFarmList').trigger('liszt:updated');
            //e.preventDefault();
        });
        $('.cannedResponse').click(function() {
            var crid = $(this).data('id') -1;
            
            $('#details').val(crJson[crid].content);
            
        });
    });
</script>
@stop