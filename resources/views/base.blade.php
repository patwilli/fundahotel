 <!-- header -->
 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <title>Hotel Copacabana Beach Kribi</title>

     <link rel="stylesheet" href="assets/css/bootstrap.css">
     <link rel="stylesheet" href="assets/css/custom.css">
     <link rel="stylesheet" href="assets/css/owl.carousel.css">
     <link rel="stylesheet" href="assets/css/owl.theme.default.css">
     <link rel="stylesheet" href="assets/css/jquery-ui.css">

     <!-- Datatables -->
     <link rel="stylesheet" href="admin/assets/css/dataTables.bootstrap5.min.css" />

     <link rel="preconnect" href="https://fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

 </head>

 <body>

     <!-- header -->

     <!-- navbar -->

     <div class="bg-white sticky-top shadow">
         <nav class="navbar navbar-expand-lg">
             <div class="container">
                 <a class="navbar-brand text-dark fw-bold" href="{{route('home')}}">
                     <img src="https://www.hotelcopacabanabeachkribi.com/images/uploads/125/61b2fbfe91cb9_logo_150.png?0.022259432830688985" alt="Hotel Copacabana Beach Kribi">
                 </a>
                 <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon">&#x7c;&#x7c;&#x7c;</span>
                 </button>
                 <div class="collapse navbar-collapse" id="navbarNav">
                     <ul class="navbar-nav ms-auto">
                         <li class="nav-item">
                             <a class="nav-link <?= isset($page) && $page == "index" ? 'active' : ''; ?>" aria-current="page" href="{{route('home')}}">Home</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link <?= isset($page) && $page == "about" ? 'active' : ''; ?>" href="{{route('about')}}">About Us</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link <?= isset($page) && $page == "all-room" ? 'active' : ''; ?>" href="{{route('availability-room')}}">Rooms</a>
                         </li>
                         @if(Auth::check())
                         <li class="nav-item dropdown">
                             <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                 {{ Auth::user()->fname }} {{ Auth::user()->lname }}
                             </a>
                             <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                 <li><a class="dropdown-item" href="{{route('bookings')}}">My Bookings</a></li>
                                 <li><a class="dropdown-item" href="{{route('profile')}}">My Profile</a></li>
                                 <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
                             </ul>
                         </li>
                         @else
                         <li class="nav-item">
                             <a class="nav-link <?= isset($page) && $page == "login" ? 'active' : ''; ?>" href="{{route('login')}}">Login</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link <?= isset($page) && $page == "register" ? 'active' : ''; ?>" href="{{route('register')}}">Register</a>
                         </li>
                         @endif
                     </ul>
                 </div>
             </div>
         </nav>
     </div>

     <!-- navbar -->

     @yield('contenu')

     <!-- footer-top -->

     <div class="section bg-dark">
         <div class="container">
             <div class="row">

                 <div class="col-md-6">
                     <h4 class="text-white">Hotel Copacabana Beach Kribi</h4>
                     <div class="underline"></div>
                     <p class="text-white">
                         Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
                     </p>
                 </div>
                 <div class="col-md-3">
                     <h4 class="text-white">Quick Links</h4>
                     <div class="underline"></div>
                     <div class="footer-links">
                         <a href="{{route('home')}}">Home</a>
                         <a href="{{route('about')}}">About Us</a>
                     </div>
                 </div>
                 <div class="col-md-3">
                     <h4 class="text-white">Links</h4>
                     <div class="underline"></div>
                     <div class="footer-links">
                         <a href="{{route('login')}}">Login</a>
                         <a href="{{route('register')}}">Register</a>
                         <a href="{{route('bookings')}}">My Bookings</a>
                         <a href="{{route('profile')}}">My Profile</a>
                     </div>
                 </div>
                 <div class="col-md-12">
                     <hr class="bg-white">
                     <p class="text-white f-12">
                         &copy; Copyright at Hotel Copacabana Beach Kribi. All Rights Reserved.
                     </p>
                 </div>
             </div>
         </div>

     </div>

     <!-- footer-top -->

     <!-- footer -->

     <script src="assets/js/jquery-3.5.1.min.js"></script>
     <script src="assets/js/bootstrap.min.js"></script>
     <script src="assets/js/owl.carousel.js"></script>
     <script src="assets/js/popper.min.js"></script>

     <script>
         function cvvvalidate() {
             var filter = /^[0-9][0-9]{2}$/; //PATTERN FOR Card Number

             var a = $("#cvvnumber").val();
             if (!(filter.test(a))) {
                 swal("Enter valid 3 digit cvv number");
                 $("#cvvnumber").val('');
             }
         }

         function cardvalidate() {
             var filter = /^[0-9][0-9]{15}$/; //PATTERN FOR Card Number

             var a = $("#cardnumber").val();
             if (!(filter.test(a))) {
                 swal("Enter valid 16 digit card number");
                 $("#cardnumber").val('');
             }
         }

         function PhoneNumvalidate() {
             var filter = /^[0-9][0-9]{9}$/; //PATTERN FOR MOBILE NUMBER

             var a = $("#mobilenumber").val();
             if (!(filter.test(a))) {
                 alert("Enter valid mobile number");
                 $("#mobilenumber").val('');
             }
         }

         $('.alphaonly').bind('keyup blur', function() {
             var node = $(this);
             node.val(node.val().replace(/[^a-z]/g, ''));
         });
     </script>

     <!-- DataTables -->
     <script src="admin/assets/js/jquery.dataTables.min.js"></script>
     <script src="admin/assets/js/dataTables.bootstrap5.min.js"></script>

     <script src="assets/js/jquery-ui.js"></script>
     <script>
         $(document).ready(function() {
             $('.myTable').DataTable();
         });
         $(function() {
             $(".datepicker").datepicker({
                 dateFormat: 'dd/mm/yy',
             });
         });
     </script>

     <script src="assets/js/sweetalert.min.js"></script>
     <script>
         <?php if (session('success')) : ?>
             swal('<?php echo session('success'); ?>');
         <?php
            endif; ?>

         <?php if ($errors->has('error')) : ?>
             swal('<?php echo $errors->first('error '); ?>');
         <?php
            endif; ?>
     </script>

     @yield('footer-script')
 </body>

 </html>

 <!-- footer -->