
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>BCIC</title>
  <meta content="" name="description">
  <meta content="" name="keywords">


  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href=" {{ url('assets/css/bootstrap.min.css') }} " rel="stylesheet">
  <link href="{{ url('assets/css/fontawesome.min.css') }} " rel="stylesheet">
  <link href="{{ url('assets/css/tabler-icons.css') }} " rel="stylesheet">




  <!-- Template Main CSS File -->
  <link href="{{ url('assets/css/style.css') }} " rel="stylesheet">

</head>

<body>

  <main>
      <section class="login-section">
        <div class="b2smgmt-bg">


          <div class="position-relative overflow-hidden auth-bg min-vh-100 w-100 d-flex align-items-center justify-content-center">
          <div class="container">
            <div class="card shadow">
              <div class="card-body p-4">
            <div class="row">

              <div class="col-lg-6 col-md-6 ">
                <div class="login-l-box">
                  <h2 class="fw-lg fw-bold text-white">The Easiest way to manage team project & task</h2>
                  <p class="text-white">Take a tour of the work management platform to see how you can do more of your best work.</p>
                  <img class="pt-4" src="{{ url('assets/img/login-l-img.jpg') }} " alt=""/>
                </div>
              </div>

              <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">
                    <div class="p-5 login-right-section">
                      <img class="logo mb-2" src="{{ url('assets/img/Logo-1.png') }}" alt="logo"/>
                      <h4 class="card-title"> <img class="shadow-sm " src="{{ url('assets/img/hugging-hand.webp') }}" alt=""> Welcome Back!</h4>
                      <p class="small">Please enter your username and password below to log in to the bcic.com.au administration zone.</p>

                      @if(session()->has('message'))
                          <div class="alert alert-danger">
                          {{ session()->get('message') }}
                      </div>
                      @endif

                     <form class="m-login__form m-form" method="post" action="{{ route('login') }}">
                         @csrf

                        <div class="col-12">
                          <label for="yourUsername" class="form-label">UserName/ Email ID</label>
                          <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend"><i class="ti ti-user-circle"></i></span>
                            <input type="text" id="username"  value="{{ old('username') }}"  class="form-control" name="username" placeholder="User Name" >
                            @if(!empty($errors->first('username')))
                            <span class="error_show alert alert-danger"><?php echo $errors->first('username'); ?></span> 
                            @endif
                          </div>
                        </div>
  
                        <div class="col-12">
                          <label for="yourPassword" class="form-label">Password</label>
  
                          <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend"><i class="ti ti-lock-square-rounded"></i></span>
                            <input id="password" value="{{ old('password') }}"  type="password" class="form-control" name="password" placeholder="********">
                              @if(!empty($errors->first('password')))
                                <span class="error_show alert alert-danger"><?php echo $errors->first('password'); ?></span> 
                              @endif
                          </div>
                          
                        </div>
  
                        <div class="col-12">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                          </div>
                        </div>
                        <div class="col-12">
                          <button class="btn bcic-btn-primary w-100 text-white" type="submit">Login Now</button>
                        </div>
                      </form>


                    </div>

                    

                  </div>
                
            </div>

          </div>

            

        </div>


          </div>

          </div>



        </div>

      </section>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


</body>

</html>