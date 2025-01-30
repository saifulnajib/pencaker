<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('login_asset/fonts/icomoon/style.css')}}">

    <link rel="stylesheet" href="{{asset('login_asset/css/owl.carousel.min.css')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('login_asset/css/bootstrap.min.css')}}">
    
    <!-- Style -->
    <link rel="stylesheet" href="{{asset('login_asset/css/style.css')}}">

    <title>Pencaker Tanjungpinang</title>
  </head>
  <body>
  

  
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6 order-md-2">
          <!-- <img src="images/undraw_file_sync_ot38.svg" alt="Image" class="img-fluid"> -->
          <img src="{{asset('login_asset/images/fair.png')}}" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
              <h3><strong>PENCAKER</strong></h3>
              <p class="mb-4">Pemerintah Kota Tanjungpinang</p>
            </div>
            <form>
              <div class="form-group first">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username">

              </div>
              <div class="form-group last mb-4">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password">
                
              </div>
              
              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                  <input type="checkbox" checked="checked"/>
                  <div class="control__indicator"></div>
                </label>
                <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span> 
              </div>

              <input type="submit" value="Log In" class="btn text-white btn-block btn-primary">
            </form>
            </div>
          </div>
          
        </div>
        
      </div>
    </div>
    <footer class="footer mt-4">
        <div class="footer-content">
            <p class="text-sm text-gray-600 text-right">©
                <?php echo date('Y');?> Pemerintah Kota Tanjungpinang. All rights reserved.
            </p>
        </div>
    </footer>
  </div>



  
    <script src="{{asset('login_asset/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('login_asset/js/popper.min.js')}}"></script>
    <script src="{{asset('login_asset/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('login_asset/js/main.js')}}"></script>
  </body>
</html>