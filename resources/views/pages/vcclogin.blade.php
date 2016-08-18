@extends('trust')

@section('content')
<div class="login-form">
    
    <div class="panel panel-default">
        <div class="panel-heading">Five9 Customer Sign In</div>
        <div class="panel-body">
            @if (isset($message))
            <div class="alert alert-info">
                {{ $message }}
            </div>
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
            <form method="post" role="form">
                <div class="form">
                    <div class="error" id="badLogin">Sorry, the username / password you supplied could not be found.</div>
                    <label>Username</label>
                    <input type="text" name="username" id="username" placeholder="user@vcc.five9.com">
                    <label>Password</label>
                    <input type="password" name="password" id="password" placeholder="********">
                </div>
              
                <div class="submit-spacer"></div>
                <div class="submit-button"><input type="submit" name="login" id="loginBtn" value="Log In" class="btn-primary btn btn-large"></div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
        </div>
        
    </div>
   
</div>

<!--
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <input type="submit" class="btn btn-lg btn-success btn-block" />
                            </fieldset>
			    
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
-->
@stop

@section('js')

    <!-- jQuery -->
    <script src="../resources/assets/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../resources/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../resources/assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../resources/assets/dist/js/sb-admin-2.js"></script>

@stop