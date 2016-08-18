<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="0" />
  <base href="">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  
<title>Trust | Five9</title>
<meta name="robots" content="index, follow"/>
<meta name="googlebot" content="index, follow"/>
<meta http-equiv="Refresh" content="300">

    <link href="static/status/css/bootstrap.min.css" rel="stylesheet">
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="https://fast.fonts.com/cssapi/b4d8e89d-5106-41a5-9b93-f608413a6630.css" media="screen" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="/static/status/css/style.css" />
  
  <!--[if lt IE 9]>
     <script>
        document.createElement('header');
        document.createElement('nav');
        document.createElement('section');
        document.createElement('article');
        document.createElement('aside');
        document.createElement('footer');
     </script>
  <![endif]-->
  


</head>

  
<body>
<!-- Google Tag Manager -->
<noscript>
    <iframe height='0' src='http://www.googletagmanager.com/ns.html?id=GTM-W3WZFQ' style='display:none;visibility:hidden' width='0'></iframe>
</noscript>
<script>
    (function (w, d, s, l, i) {
        w[l] = w[l] || []; w[l].push({
            'gtm.start':
            new Date().getTime(), event: 'gtm.js'
        }); var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
        '//www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-W3WZFQ');
</script>
<!-- End Google Tag Manager -->
<div id="page-wrapper">
  <!-- Top Menu -->
  <div class="header">
      <!--<div>
        <img src="/trust/images/logo-r.png" id="logo">
      
        <ul id="navigation" class="floatright">
          <li><a href="/trust" id="nav-trust">Trust</a></li>
          <li><a href="https://systemstatus.five9.com" target="_blank">Status</a></li>
          <li><a href="/trust/security-privacy" id="nav-security-privacy">Security &amp; Privacy</a></li>
          <li><a href="/trust/network" id="nav-network">Network</a></li>
        </ul>
      </div>-->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="http://www.five9.com/"><img src="static/status/images/logo-r.png"></a>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            
            <ul class="nav navbar-nav navbar-right">
              <li><a href="http://www.five9.com/trust" id="nav-trust">Trust</a></li>
              <li><a href="http://www.five9.com/trust/security-privacy" id="nav-security-privacy">Security &amp; Privacy</a></li>
              <li><a href="http://www.five9.com/trust/network" id="nav-network">Network</a></li>
              <li><a href="http://systemstatus.five9.com/" class="active">Status</a></li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
  </div>
  
  <!-- Page Content -->
  <!--<div id="wrapper" class="container-fluid">-->
  
  



  <!-- Body Content -->
  <div id="wrapper" class="container-fluid">
    @yield('content')
    <div class="row">
      <div class="col-md-12">

        <div class="overall-status">
          <strong>Domain:</strong> {{ $data['domain'] }}
          <!--<span>Refreshed 9 minutes ago</span>-->
          <a href="/logout" class="pull-right logout">Log Out <i class="fa fa-sign-out"></i> </a>
        </div>
        <table id="status-table" class="table table-striped">
          <thead>
            <tr>
              <th style="width:25%" class="textright">Now</th>
              <th colspan="4" class="textright">Past 24 Hours</th>
            </tr>
            <tr>
              <th>Services</th>
              <th>-6h</th>
              <th>-12h</th>
              <th>-18h</th>
              <th>-24h</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              @if (isset($currentIssue['VCC']))
                <td class="incident-trigger {{ $currentIssue['VCC']['class'] }}" data-id="{{ $currentIssue['VCC']['issue_id'] }}">Five9 Applications <i class="fa fa-exclamation-circle"></i></td>
              @else
                <td>Five9 Applications <i class="fa fa-check-circle"></i></td>
              @endif
              
              <td colspan="4">
                <div class="incident-line">
                  @if (isset($status['VCC']))
                  @foreach($status['VCC'] as $s)
                  <div class="incident-trigger incident {{ $s->class }}" data-id="{{ $s->id }}" style="width:{{ $s->width }}%;left:{{ $s->left }}%">
                    
                  </div>
                  @endforeach
                  @endif
                </div>
              </td>
            </tr>
            <tr>
              @if (isset($currentIssue['API']))
                <td class="incident-trigger {{ $currentIssue['API']['class'] }}" data-id="{{ $currentIssue['API']['issue_id'] }}">Five9 API <i class="fa fa-exclamation-circle"></i></td>
              @else
                <td>Five9 API <i class="fa fa-check-circle"></i></td>
              @endif
              
              <td colspan="4">
                <div class="incident-line">
                  @if (isset($status['API']))
                  @foreach($status['API'] as $s)
                  <div class="incident-trigger incident {{ $s->class }}" data-id="{{ $s->id }}" style="width:{{ $s->width }}%;left:{{ $s->left }}%">
                    
                  </div>
                  @endforeach
                  @endif
                </div>
              </td>
            </tr>
            <tr>
              @if (isset($currentIssue['FTP']))
                <td class="incident-trigger {{ $currentIssue['FTP']['class'] }}" data-id="{{ $currentIssue['FTP']['issue_id'] }}">File Transfer (FTP) <i class="fa fa-exclamation-circle"></i></td>
              @else
                <td>File Transfer (FTP) <i class="fa fa-check-circle"></i></td>
              @endif
              
              <td colspan="4">
                <div class="incident-line">
                  @if (isset($status['FTP']))
                  @foreach($status['FTP'] as $s)
                  <div class="incident-trigger incident {{ $s->class }}" data-id="{{ $s->id }}" style="width:{{ $s->width }}%;left:{{ $s->left }}%">
                    
                  </div>
                  @endforeach
                  @endif
                </div>
              </td>
            </tr>
            @if ($data['social'])
            <tr>
              @if (isset($currentIssue['SCC']))
                <td class="incident-trigger {{ $currentIssue['SCC']['class'] }}" data-id="{{ $currentIssue['SCC']['issue_id'] }}">Multi-Channel Services <i class="fa fa-exclamation-circle"></i></td>
              @else
                <td>Multi-Channel Services <i class="fa fa-check-circle"></i></td>
              @endif
              
              <td colspan="4">
                <div class="incident-line">
                  @if (isset($status['SCC']))
                  @foreach($status['SCC'] as $s)
                  <div class="incident-trigger incident {{ $s->class }}" data-id="{{ $s->id }}" style="width:{{ $s->width }}%;left:{{ $s->left }}%">
                    
                  </div>
                  @endforeach
                  @endif
                </div>
              </td>
            </tr>
            <!--new one -->
            @endif
              @if ($data['plusDesktop'])
            <tr>
              @if (isset($currentIssue['Plus Desktop']))
                <td class="incident-trigger {{ $currentIssue['Plus Desktop']['class'] }}" data-id="{{ $currentIssue['Plus Desktop']['issue_id'] }}">Plus Desktop <i class="fa fa-exclamation-circle"></i></td>
              @else
                <td>Plus Desktop <i class="fa fa-check-circle"></i></td>
              @endif

               <td colspan="4">
                <div class="incident-line">
                  @if (isset($status['Plus Desktop']))
                  @foreach($status['Plus Desktop'] as $s)
                  <div class="incident-trigger incident {{ $s->class }}" data-id="{{ $s->id }}" style="width:{{ $s->width }}%;left:{{ $s->left }}%">
                    
                  </div>
                  @endforeach
                  @endif
                </div>
              </td>
            </tr>
            @endif
             <!-- end new One -->
            <tr>
              @if (isset($currentIssue['Voice']))
                <td class="incident-trigger {{ $currentIssue['Voice']['class'] }}" data-id="{{ $currentIssue['Voice']['issue_id'] }}">Voice<i class="fa fa-exclamation-circle"></i></td>
              @else
                <td>Voice<i class="fa fa-check-circle"></i></td>
              @endif
              
              <td colspan="4">
                <div class="incident-line">
                  @if (isset($status['Voice']))
                  @foreach($status['Voice'] as $s)
                  <div class="incident-trigger incident {{ $s->class }}" data-id="{{ $s->id }}" style="width:{{ $s->width }}%;left:{{ $s->left }}%">
                    
                  </div>
                  @endforeach
                  @endif
                </div>
              </td>
            </tr>
            <tr>
              @if (isset($currentIssue['Network']))
                <td class="incident-trigger {{ $currentIssue['Network']['class'] }}" data-id="{{ $currentIssue['Network']['issue_id'] }}">Network<i class="fa fa-exclamation-circle"></i></td>
              @else
                <td>Network<i class="fa fa-check-circle"></i></td>
              @endif
              
              <td colspan="4">
                <div class="incident-line">
                  @if (isset($status['Network']))
                  @foreach($status['Network'] as $s)
                  <div class="incident-trigger incident {{ $s->class }}" data-id="{{ $s->id }}" style="width:{{ $s->width }}%;left:{{ $s->left }}%">
                    
                  </div>
                  @endforeach
                  @endif
                </div>
              </td>
            </tr>
          </tbody>
        </table>

        <ul class="legend">
          <li><span class="legend-normal"></span> Normal</li>
          <li><span class="legend-incident"></span> Performance Degradation</li>
          <li><span class="legend-down"></span> Service Down</li>
        </ul>

        <div class="note">
          <h3>Maintenance</h3>
          <p>If you are experiencing problems with your service please contact customer support at 866.553.1459 (dialing internationally 925.218.2325) or via email at cases@five9.com. </p>

          <p>Five9 regular maintenance windows are Wednesday and Saturday nights from 10pm to 12am PT.</p>
        </div>
      </div>
    </div>
  </div><!-- ./wrapper -->



</div>


  <!--</div>--><!-- end content wrapper -->
  
</div>
<!-- Footer -->
<div class="footer text-center">
    <h2 class="text-center">Need help?</h2>
    <p class="text-center">
      Call our Customer Support Team at <a href="callto:+18665531459">1-866-553-1459</a> or email us at <a href="mailto:cases@five9.com">cases@five9.com</a>
    </p>
    <p>Copyright &copy; {{ date("Y") }}, Five9 Inc. | <a href="http://www.five9.com/" target="_blank">www.five9.com</a><br /> 4000 Executive Parkway, Suite 400, San Ramon, CA 94583, USA</p>
    
</div>

@if (isset($status))
@foreach ($status as $service)
  @foreach ($service as $incident)
    <div class="incident-pane" id="incident-{{ $incident->id }}">
      <span class="incident-popup-closer incident-popup-closer-slider"><div>»</div></span>
      <h2 class="incident-title incident {{ $incident->class }}"><i class="fa fa-exclamation-triangle"></i>{{ $incident->issue->type }}<i class="fa fa-exclamation-triangle"></i></h2>
      <p><strong>Start Time:</strong> {{ $incident->start_time }}</p>
      <p><strong>End Time:</strong> {{ $incident->end_time }}</p>
      <p><strong>Summary:</strong> {{ $incident->issue->summary }}</p>
      <p style="margin-bottom:5px"><strong>Updates:</strong></p>
      <table class="note-table">
        <tbody>
          @if ($incident->issue->finalNote)
            <tr>
              <td>
                <h5>{{ Carbon\Carbon::parse($incident->issue->finalNote->created_date)->format('m/d/Y H:i A') }}</h5>
                {!! nl2br(e($incident->issue->finalNote->note)) !!}
              </td>
            </tr>
          @endif
          @foreach ($incident->issue->notes as $note)
            <tr>
              <td>
                <h5>{{ Carbon\Carbon::parse($note->created_date)->format('m/d/Y H:i A') }}</h5>
                {!! nl2br(e($note->note)) !!}
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endforeach
@endforeach
@endif
  <script type='text/javascript' src="static/status/js/jquery-1.11.2.min.js"></script>
  <script type='text/javascript' src="static/status/js/jquery-ui.min.js"></script>
  <script type='text/javascript' src="static/status/js/bootstrap.js"></script>
   
<!-- Page JS Starts -->
<script type="text/javascript">
$(function() {
      $('.incident-trigger').click(function() {
        $('.incident-pane').hide('slide',{direction:'right'},200);
        $( '#incident-' + $(this).data("id") ).toggle('slide',{direction: 'right'}, 500);
        return false;
      });
      $('.incident-popup-closer').click(function() {
        $(this).parents(".incident-pane").toggle('slide',{direction: 'right'}, 500);
        return false;
      });

      
    });
</script>

<!-- Page JS Ends -->


  
</body>
</html>
