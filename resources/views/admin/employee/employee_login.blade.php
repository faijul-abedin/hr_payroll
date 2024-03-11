

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Login</title>
    <style>
        .h-custom {
            height: calc(100% - 73px);
        }

        @media (min-width: 768px){
            img{
                margin-left: 55px;
            }
        }

        @media (max-width: 767px) {
            .h-custom {
                height: 100%;
            }
            img {
                max-height: 300px;
                margin-left: 40px;
            }
            .col-md-6 {
                padding: 20px;
            }
        }

        @media (max-width: 575px) {
            .col-md-6 {
                padding: 10px;
            }
            .
            img {
                max-height: 300px;
                margin-left: 35px;
                margin-top: 0;
                padding: 0;
            }
            .total-height{
                height: 95%;
            }
        }
    </style>
</head>

<body>
    <section class="h-custom vh-100 bg-dark">
        <div class="container-fluid h-custom mb-3">
            <div class="row d-flex justify-content-center align-items-center h-100 total-height">
                <div class="col-md-6 col-xl-5">
                    <img src="../admin/images/bengal.png" class="img-fluid p-5" alt="Sample image">
                </div>
                <div class="col-md-6 col-xl-4 offset-xl-1 rounded" style="background-color: #dbf2d9">
                    <form action="{{ route('employee.login.sub') }}" method="post">
                        @csrf
 
                        <div class="divider d-flex justify-content-center my-4">
                            <h5 class="text-center fw-bold mx-3 mb-0">EMPLOYEE LOGIN</h5>
                        </div>
 
                         <!-- Email input -->
                         <div class="form-outline mb-4">
                             <input type="email" id="form3Example3" name="email" class="form-control form-control-lg"
                                 placeholder="Enter email" />
                             <label class="form-label" for="form3Example3">Email address</label>
                         </div>
 
                         <!-- Password input -->
                         <div class="form-outline mb-3">
                             <input type="password" id="form3Example4" name="password" class="form-control form-control-lg"
                                 placeholder="Enter password" />
                             <label class="form-label" for="form3Example4">Password</label>
                         </div>
 
                         <div class="d-flex justify-content-between align-items-center">
                             <!-- Checkbox -->
                             <div class="form-check mb-0">
                                 <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                                 <label class="form-check-label" for="form2Example3">
                                     Remember me
                                 </label>
                             </div>
                             {{-- <a href="#!" class="text-body">Forgot password?</a> --}}
                         </div>
 
                         <div class="text-center text-lg-start my-4 pt-2 d-flex justify-content-end">
                             <button type="submit" class="btn btn-success btn-lg"
                                 style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
 
                         </div>
 
                     </form>
                </div>
            </div>
        </div>
        <div class="d-flex footer flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-success">
            <!-- Copyright -->
            <div class="text-white">
                Copyright © Bengal Software-2023. All rights reserved.
            </div>
            <!-- Copyright -->
        </div>
    </section>
</body>

</html>