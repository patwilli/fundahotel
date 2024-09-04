@extends('base')

@section('contenu')
<div class="py-4 bg-primary">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <a href="{{route('availability-room')}}"><button class="btn btn-info">Book now</button></a>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-box myprofile mt-3">
                    <div class="card-body">
                        <div class="mb-4">
                            <h4 class="main-heading">My Profile</h4>
                            <div class="underline mb-0"></div>
                            <hr class="my-0">
                        </div>

                        <!-- Bloc PHP pour récupérer les données du profil -->
                        <!-- <?php
                                /*
                            $uid = $_SESSION['auth']['auth_id'];
                            $userquery = "SELECT * FROM users where id='$uid' LIMIT 1";
                            $userquery_run = mysqli_query($con, $userquery); 
                            $data = mysqli_fetch_array($userquery_run);
                            
                            if(mysqli_num_rows($userquery_run) > 0)
                            {
                            */
                                ?> -->

                        <!-- Formulaire pour afficher et éditer les informations du profil -->

                        <form action="{{route('updateProfile')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="">First Name</label>
                                        <input type="text" class="form-control" value="{{Auth::user()->fname}}" required name="fname">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="">Last Name</label>
                                        <input type="text" class="form-control" value="{{Auth::user()->lname}}" required name="lname">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="">Phone</label>
                                        <input type="text" onblur="PhoneNumvalidate()" id="mobilenumber" class="form-control" value="{{Auth::user()->phone}}" required name="phone">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="">Email address</label>
                                        <input type="email" required class="form-control" value="{{Auth::user()->email}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="border-bottom pb-1 mb-1">Choose Gender</label>
                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" value="Male" id="male" {{ (Auth::user()->gender == 'Male') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="male">
                                                    Male
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" value="Female" id="female" {{ (Auth::user()->gender == 'Female') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="female">
                                                    Female
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6 my-auto">
                                    <div class="text-end">
                                        <button type="submit" name="update_profile_btn" class="btn btn-primary mt-2">Update Profile</button>
                                    </div>
                                </div>

                            </div>
                        </form>

                        <!-- Fin du formulaire -->

                        <!-- Bloc PHP pour vérifier s'il y a des données -->
                        <!--
                        <?php /*}else{ */ ?>
                            <h4>Something Went Wrong</h4>
                        <?php /*} */ ?>
                        -->
                        <!-- Fin du bloc PHP -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection