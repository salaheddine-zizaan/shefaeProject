<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="{{url('assets/css/style.css')}}">



</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <span>SHEFAA</span>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Accueil</a></li>
          <li><a class="nav-link scrollto" href="#about">À propos</a></li>
          <li><a class="nav-link scrollto" href="#Rendez-vous">Rendez-vous</a></li>
          <li><a class="nav-link scrollto" href="#services">Services</a></li>
          <li>
          @if (Route::has('login'))
                
                    @auth
                        <a href="{{ route('home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">se connecter</a>
                    @endauth
                
          @endif   
          </li>
          <li><a class="getstarted scrollto" href="#Rendez-vous">Réserver un rendez-vous</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header>
  <!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">

          <h1>Gérer vos rendez-vous avec SHEFAA</h1>
          <h2>Veuillez effectuer une réservation à partir du bouton ci-dessus.</h2>
          <div class="d-flex justify-content-center justify-content-lg-start">
            <a href="#Rendez-vous" class="btn-get-started scrollto">Réserver un rendez-vous</a>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
          <img src="assets/img/A4.png" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <section id="about" class="about">

    <div class="container" data-aos="fade-up">
      <div class="row gx-0">

        <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
          <div class="content">
            <h2>À propos de nous.</h2>
            <p>
                 SHEFFA est une application pratique qui a été conçue pour offrir 
                  une expérience client optimale à la clinique SHEFFA.
                  Elle est très facile à utiliser 
                  et peut être utilisée par les patients pour prendre des rendez-vous.
                  Elle permet à la clinique SHEFFA, 
                  une entreprise de santé moderne situé à Dakhla, 
                  de gérer le flux de rendez-vous plus efficacement et de fournir
                  un meilleur service à ses clients.Grâce à cette application, 
                  les patients peuvent prendre rendez-vous et réserver des séances plus rapidement.
            </p>
            <div class="text-center text-lg-start">
              <a href="#" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                <span>Lire la suite</span>
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>

        <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
          <img src="assets/img/3951637.jpg" class="img-fluid" alt="">
        </div>

      </div>
    </div>

  </section><!-- End About Section -->

<section id="Rendez-vous" class="Rendez-vous" >
  <div class="container-BOX" >
    <div class="contact-box">
      <div class="left"></div>
      <div class="right">
        <h2>Trouvez un rendez-vous adapté à vos besoins</h2>
        <form >
            <div class="form-group">
                <span>Nom</span>
                <input type="text" placeholder="Entrer votre nom" id='rvLName' required>
            </div>
            <div class="form-group">
                <span>Prénom</span>
                <input type="text" placeholder="Entrer votre Prénom" id='rvFName' required>
            </div>
            <div class="form-group">
                <span>Date de naissance</span>
                <input type="date" placeholder="Entrer votre date de naissance" id='rvNais' required>
            </div>
            <div class="form-group">
                <span>Numéro de téléphone</span>
                <input type="number" placeholder="Entrer votre téléphone" id='rvContact' required>
            </div>
            <div class="form-group">
                <span>CIN</span>
                <input type="text" placeholder="Entrer votre CIN" id='rvCin' required>
            </div>
            <div class="form-group">
                <span>Spécialités</span>
                <select class="select" id="spChoose" id='rvSp' name="major" id="major" required>
                <option value="" selected>specialite</option>

                @foreach($speciality as $sp)
                  <option value="{{$sp['speciality']}}" id="spChoose">{{$sp['speciality']}}</option>
                @endforeach
                </select>
            </div>

            <div class="form-group">
                <input type="date" placeholder="date" id="dateInput" required hidden>
            </div>
            <div class="form-group">
                <input type="time" placeholder="time" id="timeInput" required hidden>
            </div>

            <div class="form-group">
                <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" id="dateChoose" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <span  id="dbtn">date de rendez-vous</span> 
                  </button>
                  <ul class="dropdown-menu" id="dropdownh">
                    
                      
                    
                    
                  </ul>
                </div>
                
                  
            </div>
            <div class="form-group">
                    <!-- <select class="form-select" aria-label="Default select example" aria-placeholder="" required>
                      
                    </select> -->
                
                
                <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" id="timeChoose" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <span  id="hbtn"> Heure de rendez-vous</span>
                  </button>
                  <ul class="dropdown-menu" id="dropdownt">
                    <!-- <li><button class="dropdown-item" href="#">8:30</small></button></li>
                    <li><button class="dropdown-item" href="#">8:30</small></button></li>
                    <li><button class="dropdown-item" href="#">8:30</small></button></li>
                    <li><button class="dropdown-item" href="#">8:30</small></button></li> -->

                    <!-- <table class="table">
                      <tbody>
                        <tr>
                          <td><button type="button">8:00</button></td>
                          <td><button type="button">8:15</button></td>
                          <td><button type="button">8:30</button></td>
                          <td><button type="button">8:45</button></td>  
                        </tr>
                        <tr>
                          <td><button type="button">8:00</button></td>
                          <td><button type="button">8:15</button></td>
                          <td><button type="button">8:30</button></td>
                          <td><button type="button">8:45</button></td>  
                        </tr>
                        <tr>
                          <td><button type="button">8:00</button></td>
                          <td><button type="button">8:15</button></td>
                          <td><button type="button">8:30</button></td>
                          <td><button type="button">8:45</button></td>  
                        </tr>
                        <tr>
                          <td><button type="button">8:00</button></td>
                          <td><button type="button">8:15</button></td>
                          <td><button type="button">8:30</button></td>
                          <td><button type="button">8:45</button></td>  
                        </tr>
                        
                      </tbody>
                    </table> -->
                    
                    
                  </ul>
                </div>
            </div>
            <!-- <div class="selectSex">
            <label class="radio-inline"><input type="radio" name="sex" value="Male" required>Male</label>
            <label class="radio-inline"><input type="radio" name="sex" value="Female" required>Female</label>
            </div> -->
            <div id="warningForm"></div>
            <div class="button">
                <input type="button" value="Envoyer" id="valideLeRV">
            </div>
        </form>   
      </div>
    </div>
  </div>

</section>

<section id="services" class="services">

  <div class="container" data-aos="fade-up">

    
    <header class="section-header">
      <h2>Services</h2>
      <p>Services offerts par la clinique</p>
    </header>

    <div class="row gy-4">

      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
        <div class="service-box blue">
          <i class="ri-discuss-line icon"></i>
          <h3>Consultations médicales</h3>
          <p>Les consultations médicales sont l'un des services les plus courants offerts par les cliniques médicales.
             Les médecins effectuent des examens et des consultations pour évaluer les symptômes des patients et fournir des recommandations de traitement.</p>
          <a href="#" class="read-more"><span>Lire la suite</span> <i class="bi bi-arrow-right"></i></a>
        </div>
      </div>

      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
        <div class="service-box orange">
          <i class="ri-discuss-line icon"></i>
          <h3>Soins d'urgence </h3>
          <p>La clinique peuvent offrir des services de soins d'urgence
             pour les patients nécessitant une assistance médicale immédiate.
             Cela peut inclure la prise en charge de maladies aiguës,
              d'urgences mineures et de blessures.</p>
          <a href="#" class="read-more"><span>Lire la suite</span> <i class="bi bi-arrow-right"></i></a>
        </div>
      </div>

      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
        <div class="service-box green">
          <i class="ri-discuss-line icon"></i>
          <h3>Vaccinations</h3>
          <p> La clinique peuvent offrir des vaccinations pour prévenir les maladies contagieuses. 
            Les vaccinations sont souvent recommandées pour les enfants, les voyageurs, 
            les personnes âgées et les personnes atteintes de maladies chroniques.</p>
          <a href="#" class="read-more"><span>Lire la suite</span> <i class="bi bi-arrow-right"></i></a>
        </div>
      </div>

      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
        <div class="service-box red">
          <i class="ri-discuss-line icon"></i>
          <h3>Examens physiques</h3>
          <p>La clinique peuvent effectuer des examens physiques pour évaluer la santé générale des patients. 
            Cela peut inclure des examens de routine pour les enfants, les adultes et les personnes âgées.</p>
          <a href="#" class="read-more"><span>Lire la suite</span> <i class="bi bi-arrow-right"></i></a>
        </div>
      </div>

      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
        <div class="service-box purple">
          <i class="ri-discuss-line icon"></i>
          <h3>Soins dentaire</h3>
          <p>La clinique offrent des services de soins dentaires,
             tels que des nettoyages, des examens et des traitements pour les caries.</p>
          <a href="#" class="read-more"><span>Lire la suite</span> <i class="bi bi-arrow-right"></i></a>
        </div>
      </div>

      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="700">
        <div class="service-box pink">
          <i class="ri-discuss-line icon"></i>
          <h3>Services de santé mentale</h3>
          <p>La clinique peuvent offrir des services de santé mentale,
             tels que des thérapies et des consultations en santé mentale, 
            pour aider les patients à gérer les troubles émotionnels et les problèmes de santé mentale.</p>
          <a href="#" class="read-more"><span>Lire la suite</span> <i class="bi bi-arrow-right"></i></a>
        </div>
      </div>

    </div>

  </div>

</section><!-- End Services Section -->

  <!-- ======= Footer ======= -->
 
<footer  id="footer" class="footer">
  <div class="footer-top">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-info">
          <a href="index.html" class="logo d-flex align-items-center">
            <h4>À propos</h4>
          </a>
          <p>Ce site est conçu pour gérer 
            les rendez-vous des patients</p>
          <div class="social-links mt-3">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Liens rapides</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Accueil</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">À propos</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Rendez-vous</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Services</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4> Nos services</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Consultations </a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Soins d'urgence </a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Vaccinations</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Examens physiques</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Soins dentaire</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Nous contacter</h4>
          <p>
            <strong>Phone:</strong> +212 6060 606 06<br>
            <strong>Email:</strong> shefaa@gamil.com<br>
          </p>

        </div>

      </div>
    </div>
  </div>

  <div class="container">
    <div class="copyright">
      &copy; Copyright <strong><span>SHEFAA</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      
      Designed by 
    </div>
  </div>
</footer>




<!-- validation de rv Modal -->
<div class="modal fade"  id="validate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">prenez se rendez-vous</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="{{ url('welcome/AppointmentSave/') }}" method="POST">
      {{csrf_field()}}
       @method('PUT')
            <div class="form-group">
                <span>Nom</span>
                <input type="text" placeholder="Entrer votre nom" name="LName" id="modalLName" required readonly>
            </div>
            <div class="form-group">
                <span>Prénom</span>
                <input type="text" placeholder="Entrer votre Prénom" id="modalFName" name="FName" required readonly>
            </div>
            <div class="form-group">
                <span>Date de naissance</span>
                <input type="date" placeholder="Entrer votre date de naissance" name="Nais" id="modalNais" required readonly>
            </div>
            <div class="form-group">
                <span>Numéro de téléphone</span>
                <input type="number" placeholder="Entrer votre téléphone" name="Contact" id="modalContact" required readonly>
            </div>
            <div class="form-group">
                <span>CIN</span>
                <input type="text" placeholder="Entrer votre CIN" name="Cin" id="modalCin" required readonly>
            </div>
            <div class="form-group">
                <span>Spécialités</span>
                <input class="select" id="modalSp" name="modalSp"   required readonly>
            </div>

            <div class="form-group">
                <span>date de rendez-vous</span>
                <input type="date" placeholder="date" name="Date" id="modalDate" required readonly>
            </div>
            <div class="form-group">
                <span>heure de rendez-vous</span>
                <input type="time" placeholder="time" name="Time" id="modalTime" required readonly>
                <input type="text"  name="Id" id="modalId" required hidden>
            </div>
            
            <div class="button text-center">
                <input type="submit" value="Envoyer" id="saveApp">

            </div>
        </form>   

      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>               

    <script>
      $(document).ready(function() {
        /* required elements in form */
       /*  $(document).on('click','#valideLeRV',function(e){
          
        })
 */
        $(document).on('click','#spChoose',function(e){
          e.preventDefault();
          for( i=1; i<=30; i++) {  
                    $('#dbtn').remove();
                    $('#hbtn').remove();
                    $('#dropdownitemt').remove();
                    $('#dropdownitemh').remove();
            }
         
            $('#dateChoose').append('<span  id="dbtn">selectioner une date</span>');
            $('#timeChoose').append('<span  id="hbtn">selectioner un rendez-vous</span>');
        })

        $(document).on('click','#dateChoose',function(e){
          
          for( i=1; i<=10; i++) {  
                  $('#dropdownitemh').remove();
          }
          for( i=1; i<=30; i++) {  
                $('#dropdownitemt').remove();
              }

          e.preventDefault();
          var sp = $('#spChoose').val(); /* speciality choosen */
          var a = 1;
          for( i=1; i<=10; i++) {  
                  $('#dropdownitemh').remove();
              }

          $.ajax({ /* to get plans of the speciality */
            type: "GET",
            url:"{{ route('welcome.showPlans' , '') }}"+'/'+sp,
            success: function(response){
              
              
                $.each(response,function(key,item){
                  $('#dropdownh').append('<li id=\'dropdownitemh\'><button type="button" value="'+item.id+','+item.planDoc+','+item.plan_date+'" class="dropdown-item" id="planChoosen" href="#">'+item.planDoc+'  <small> '+item.plan_date+' </small>'+item.id+'</button></li>');
                  a++;
                })
              
            },
            error: function(response){
              if(response.status==500){
              console.log();
              $('#dropdownh').append('<li id=\'dropdownitemh\'>aucun date a choisir</li>');
              }
              if(response.status==404){
              $('#dropdownh').append('<li id=\'dropdownitemh\'>veulliez selectioner une specialite</li>');
              }
              
            }
            
          });
          
        })
        var date = $(this).val(); /* date return plan id */

        

        $(document).on('click','#timeChoose',function(e){
          e.preventDefault();

          for( i=1; i<=10; i++) {  
                    $('#dropdownitemt').remove();
            }

          if($('#planChoosen').val()==false){
              $('#dropdownt').append('<li id=\'dropdownitemt\'>veuillez selectioner une specialite</li>');
          }
          
          $.ajax({   /* to get times disponible in plan */
            type: "GET",
            url:"{{ route('welcome.showPlansTimes' , '') }}"+'/'+date,
            success: function(response){
              var a=1;
              for( i=1; i<=30; i++) {  
                $('#dropdownitemt').remove();
              }
              for( i=1; i<=30; i++) {  
                $('#timeChoosen').remove();
              }
              
              $('#dropdownt').append('<li class="dropdown-item" id=\'dropdownitemt\'>');

              $.each(response,function(key,item){
              
                $('#dropdownt').append('<button class=\'timeButton\' value='+item.appTime.toString('h:MM')+','+item.id+' type=\'button\' id=\'timeChoosen\' href="#"><small>'+item.appTime.toString('h:MM')+'</small></button>');
                a++;
                if(a==3){
                $('#dropdownt').append('</li><li class="dropdown-item" id=\'dropdownitemt\'>');
                a=1;
                }
              
              })
              $('#dropdownt').append('</li>');

            },
            error: function(response){
                if(response.status==500){
                console.log();
                $('#dropdownt').append('<li id=\'dropdownitemt\'>aucun rendez-vous a choisir</li>');
                }
                if(response.status==404){
                console.log();
                $('#dropdownt').append('<li id=\'dropdownitemt\'>veulliez selectioner une date</li>');
                }
                

              }
            
          
          });
        
        })


        $(document).on('click','#planChoosen',function(e){/* if i click on this btn this function recievd a string(id,name,date) */
          e.preventDefault();
          str = $(this).val(); 
          arrSTR = str.split(",");                       /* to split the string to array */
          date = arrSTR[0];                              /* date return plan id */
          $('#dbtn').remove();
          $('#dateChoose').append('<span  id="dbtn"> '+arrSTR[1]+' '+arrSTR[2]+'</span>');
          $('#dateInput').val(arrSTR[2]);
          
        });

        $(document).on('click','#timeChoosen',function(e){/* if i click on this btn this function recievd a string(id,name,date) */
          e.preventDefault();
          console.log('hh');
          
          str = $(this).val(); 
          arrSTR = str.split(",");                       /* to split the string to array */
          time = arrSTR[1]; 
          $('#hbtn').remove();
          $('#timeChoose').append('<span  id="hbtn"> '+arrSTR[0]+'</span>');
          $('#timeInput').val(arrSTR[0]);
        });

        $(document).on('click','#valideLeRV',function(){/* if i click on this btn this function recievd a string(id,name,date) */
          for( i=1; i<=10; i++) {  
                    $('.danger').remove();
            }
          if($('#dateInput').val()==false){
            $('.dateEr').append('<small class=\'danger alert-danger\'>veuillez choisir une date pour le rendez-vous<br/></small>');
          }
          if( $('#timeInput').val()==false){
            $('.dateEr').append('<small class=\'danger alert-danger\'>veuillez choisir un rendez-vous<br/></small>');
          }
        
        });

        

        $(document).on('click','#valideLeRV',function(){/* if i click on this btn this function recievd a string(id,name,date) */
          
          $('#formWarning').remove();
            if($('#rvFName').val()==''||
          $('#rvLName').val()==''||
          $('#rvNais').val()==''||
          $('#rvContact').val()==''||
          $('#rvCin').val()==''||
          $('#spChoose').val()==''||
          $('#dateInput').val()==''||
          $('#timeInput').val()==''){
            $('#warningForm').append('<h6 id=\'formWarning\'>remplir toutes les cases!</h6>');
          }
          else{
            if($('#rvFName').val() && $('#rvLName').val() && $('#rvNais').val() &&
             $('#rvContact').val() && $('#rvCin').val() && $('#spChoose').val() &&
             $('#dateInput').val() && $('#timeInput').val()
          ){
          $('#validate').modal('show');
          $('#modalFName').val($('#rvFName').val());
          $('#modalLName').val($('#rvLName').val());
          $('#modalNais').val($('#rvNais').val());
          $('#modalContact').val($('#rvContact').val());
          $('#modalCin').val($('#rvCin').val());
          $('#modalSp').val($('#spChoose').val());
          $('#modalDate').val($('#dateInput').val());
          $('#modalTime').val($('#timeInput').val());
          $('#modalId').val(time);
          }
            
          }
          
          
        });


      })
    </script>

    <script>
      @if (session('status'))

      Swal.fire({
        icon: 'success',
        title: 'rendez-vous réservé avec succès',
        showConfirmButton: false,
        timer: 1500
      })

      @endif
    </script>
  

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>