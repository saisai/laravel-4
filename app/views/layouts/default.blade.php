<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
		<meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>

    <!-- Bootstrap core CSS -->
    <!--<link href="http://localhost:8888/cn/public/assets/css/bootstrap.min.css" rel="stylesheet">-->
    {{ HTML::style('assets/css/bootstrap.min.css') }}
    <!-- Custom styles for this template -->
   {{ HTML::style('assets/css/jumbotron.css') }}

   {{ HTML::script('assets/ckeditor/ckeditor.js') }}

   {{ HTML::script('assets/js/jquery-1.11.1.min.js') }}
   {{ HTML::script('assets/js/jquery.jscroll.js') }}

   {{ HTML::script('assets/js/jquery_custom.js') }}

   

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!--<script src="../../assets/js/ie-emulation-modes-warning.js"></script>-->

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!--<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
					
          <a class="navbar-brand" href="{{ url('/') }}">Nyein Aye Say</a>
					
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            @if(Auth::check())
						 <li class="dropdown">
              <a data-toggle="dropdown" class="dropdown-toggle" href="{{ url('site') }}">Category <span class="caret"></span></a>
              <ul role="menu" class="dropdown-menu">
                <li><a href="{{ url('category') }}">Add Data</a></li>
                <li><a href="{{ route('list-category') }}">List</a></li>                
              </ul>
            </li>						
						 <li class="dropdown">
              <a data-toggle="dropdown" class="dropdown-toggle" href="{{ url('site') }}">To Do List <span class="caret"></span></a>
              <ul role="menu" class="dropdown-menu">
                <li><a href="{{ url('todo') }}">Add Data</a></li>
                <li><a href="{{ route('list-todolist') }}">List</a></li>                
              </ul>
            </li>						
						 <li class="dropdown">
              <a data-toggle="dropdown" class="dropdown-toggle" href="{{ url('list-post') }}">Posts <span class="caret"></span></a>
              <ul role="menu" class="dropdown-menu">
                <li><a href="{{ url('post') }}">Add Data</a></li>
                <li><a href="{{ route('list-post') }}">List</a></li>                
              </ul>
            </li>            									
						 <li class="dropdown">
              <a data-toggle="dropdown" class="dropdown-toggle" href="{{ url('list-link') }}">Sites <span class="caret"></span></a>
              <ul role="menu" class="dropdown-menu">
                <li><a href="{{ url('site') }}">Add Data</a></li>
                <li><a href="{{ route('list-link') }}">List</a></li>                
              </ul>
            </li>            			
            <li class="dropdown">
              <a data-toggle="dropdown" class="dropdown-toggle" href="{{ url('apply-for') }}">Apply For <span class="caret"></span></a>
              <ul role="menu" class="dropdown-menu">
                <li><a href="{{ url('apply-for') }}">Add Data</a></li>
                <li><a href="{{ route('list_apply_for') }}">List</a></li>                
              </ul>
            </li>            						
						
            <li class="dropdown">
              <a data-toggle="dropdown" class="dropdown-toggle" href="#">File <span class="caret"></span></a>
              <ul role="menu" class="dropdown-menu">
                <li><a href="{{ action('UploadController@showIndex'); }}">Upload</a></li>
                <li><a href="{{ route('list_upload') }}">List</a></li>                
              </ul>
            </li>            
						<li><a href="{{ url('list') }}">Selected</a></li>
            <li class="dropdown">
              <a data-toggle="dropdown" class="dropdown-toggle" href="#">Jobs Thai <span class="caret"></span></a>
              <ul role="menu" class="dropdown-menu">							
							<li><a href="{{ url('job-top-gun') }}">Job Top Gun</a></li>
							<li><a href="{{ url('job-bkk') }}">Jobs BKK</a></li>
							<li><a href="{{ url('job-thai') }}">Jobs Thai</a></li>
							<li><a href="{{ url('job-db') }}">Jobs Db</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a data-toggle="dropdown" class="dropdown-toggle" href="#">Jobs Sg <span class="caret"></span></a>
              <ul role="menu" class="dropdown-menu">
							<li><a href="{{ url('sg-job-db') }}">Jobs Db</a></li>
							<li><a href="{{ url('sg-stjobs') }}">Stjobs.sg</a></li>
							<li><a href="{{ url('sg-jobscentral') }}">Jobscentral.com.sg</a></li>
							<li><a href="{{ url('sg-monster') }}">Jobsearch.monster.com.sg</a></li>
              </ul>
            </li>						
        @endif
				@if(!Auth::check())
						<!--<li><a href="{{-- url('test-jobbkk') --}}">Job BKK</a></li>-->
            <li><a href="{{ url('test-jobthai') }}">Job Thai</a></li>
            <li><a href="{{ url('test-jobdb') }}">Jobs DB</a></li>
						 <li><a href="{{ url('projects') }}">Projects</a></li>
            <li><a href="{{ url('about-us') }}">About</a></li>
				@endif

            @if(Auth::check())
            <li><a href="{{ url('log-out') }}">Log out</a></li>
            @else
            <li><a href="{{ url('login') }}">Log In</a></li>            
            @endif
          </ul>
        </div><!--/.navbar-collapse -->
      </div>
    </div>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <!--
      <div class="container">        
        <h1>Hello, world!</h1>
        <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
        <p><a class="btn btn-primary btn-lg" role="button">Learn more &raquo;</a></p>
        
      </div>
      -->
      @yield('content')
    </div>

    <div class="container">
      @yield('projects')
      <!-- Example row of columns -->
      <!--
      <div class="row">
        <div class="col-md-4">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
        <div class="col-md-4">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
       </div>
        <div class="col-md-4">
          <h2>Heading</h2>
          <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
      </div>
      -->
      <hr>

      <footer>
        <p>&copy; Company 2014</p>
      </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    {{ HTML::script('assets/js/jquery.min.js'); }}
    {{ HTML::script('assets/js/bootstrap.min.js') }}
  </body>
</html>
