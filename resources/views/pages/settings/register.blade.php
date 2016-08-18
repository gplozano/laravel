@extends('app')

@section('head')

@stop

@section('content')
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add User</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">User Details</div>
                        <div class="panel-body">
                            <!--<form role="form" class="form-horizontal">-->
                            {!! Form::open(['class'=> 'form-horizontal']) !!}
                                {!! csrf_field() !!}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <!--<label class="col-sm-3 control-label">Issue #</label>-->
                                            {!! Form::label('name', 'Name', ['class' => 'col-sm-3 control-label']) !!}
                                            <div class="col-md-4 col-sm-9">
                                                
                                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <!--<label class="col-sm-3 control-label">Issue #</label>-->
                                            {!! Form::label('email', 'Email', ['class' => 'col-sm-3 control-label']) !!}
                                            <div class="col-md-4 col-sm-9">
                                                
                                                {!! Form::text('email', null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <!--<label class="col-sm-3 control-label">Issue #</label>-->
                                            {!! Form::label('password', 'Password', ['class' => 'col-sm-3 control-label']) !!}
                                            <div class="col-md-4 col-sm-9">
                                                
                                                {!! Form::password('password', ['class' => 'form-control']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <!--<label class="col-sm-3 control-label">Issue #</label>-->
                                            {!! Form::label('password_confirmation', 'Confirm Password', ['class' => 'col-sm-3 control-label']) !!}
                                            <div class="col-md-4 col-sm-9">
                                                
                                                {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
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
                                    <div class="col-lg-12">
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
<script>
    $(function() {
        
    });
</script>
@stop