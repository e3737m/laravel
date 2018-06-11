<!DOCTYPE html>
<html>
 <head>
      <title>Laravel</title>

     <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
     <style type="text/css">
         body{
             background: white;
             height: 2000px;
             width: 960px;/*768px;*/
             margin: 0 auto;


             /* IE10 */
             background-image: -ms-linear-gradient(top right, #B06000 0%, #482A00 100%);

             /* Mozilla Firefox */
             background-image: -moz-linear-gradient(top right, #B06000 0%, #482A00 100%);

             /* Opera */
             background-image: -o-linear-gradient(top right, #B06000 0%, #482A00 100%);

             /* Webkit (Safari/Chrome 10) */
             background-image: -webkit-gradient(linear, right top, left bottom, color-stop(0, #B06000), color-stop(1, #482A00));

             /* Webkit (Chrome 11+) */
             background-image: -webkit-linear-gradient(top right, #B06000 0%, #482A00 100%);

             /* Regola standard */
             background-image: linear-gradient(to top right, #B06000 0%, #482A00 100%);}

         #wrapper{
             background: silver;
             z-index: 1;
             height: 100%;
             width: 100%;
             margin: 0 auto;
         }
		 .imgbox{
			 background: white;
			 height: 300px;
			 width: 200px;
			 float: left;
			 margin-top: 10px;
			 margin-left: 30px;
             
			 border: 1px solid black;
		 }
        img{
			display: block;
            margin-left: auto;
            margin-right: auto;

		}
		.text{
			
			text-align: center;
		}


         
     </style>
 </head>
 <body>
 <div id="wrapper">
     <nav class="navbar navbar-expand-lg navbar-light bg-light">
         <div class="navbar-brand" >Album Gallery</div>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>

         <div class="collapse navbar-collapse" id="navbarSupportedContent">

                 @guest
                 <div class="nav-item active">
                     <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                 </div>
                 <div class="nav-item active">
                     <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </div>
                 @else

                     <div class="nav-item active">
                         <div class="nav-link">{{ Auth::user()->name }}</div>
                     </div>
                     <div class="nav-item active">
                     <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                         {{ __('Logout') }}</a>
						  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                     </div>
                 @endguest

         </div>
     </nav>
	 @yield("content")
 </div><!-- END WRAPPER -->
 
 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 <script src="/bootstrap/css/bootstrap.min.css"></script>
</body>
</html>