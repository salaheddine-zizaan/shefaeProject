<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>dashboard</title>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- bootstrap css -->    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- css -->
    <link rel="stylesheet" href="{{url('css/apps.css')}}">
    <link rel="stylesheet" href="{{url('css/dash.css')}}">
    <!-- google material icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    @can('isAdmin')
        <script>

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('96cb027c3945b0e7d60f', {
            cluster: 'eu'
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('appNotifSended', function(data) {
                $('#notif').append('<span  style="z-index:12; background-color:#f00; padding:5px; border-radius:50%; vertical-align:top; margin-left:-10px; top:10px; font-size:0.3px;"></span>');
            });
        </script>
    @endcan
  </head>
  <body>

    
    <div class="wrapper">
        <div class="body-overlay"></div>
        <!-- sidebar-design -->
        <div id="sidebar">
            <div class="sidebar-header">
                <h3><span>SHEFAA</span></h3>
            </div>
            <ul class="list-unstyled component m-0">
                <li class="{{ Request::is('dashboard/home') ? 'active' : '' }}">
                    <a href="{{route('home')}} "  class="dashboard"><i class="material-icons-sharp" class="active">grid_view</i>Dashboard</a>
                </li>
                <li class="{{ Request::is('dashboard/appointment') ? 'active' : '' }}">
                    <a href="{{route('appointment')}}" class="dashboard"><i class="material-icons-sharp">schedule</i>Rendez-vous</a>
                </li>
                <li class="{{ Request::is('dashboard/planning') ? 'active' : '' }}">
                    <a href="{{route('planning')}}" class="dashboard"><i class="material-icons-sharp">calendar_month</i>planning</a>
                </li>
                <li class="{{ Request::is('dashboard/medecin') ? 'active' : '' }}">
                    <a href="{{route('medecin')}}" class="dashboard"><i class="material-icons-sharp">person</i>les médecins</a>
                </li>
                
                @can('isAdmin')
                    <li class="{{ Request::is('dashboard/settings') ? 'active' : '' }}">
                        <a class="dashboard" href="{{route('settings')}}" ><i class="material-icons-sharp">manage_accounts</i>Utilisateurs</a>
                    </li>
                @endcan

                    
                    
                
                
            </ul>
            
        </div>


        <!--sidebar design close-->

        <!-- page content start -->

        <div id="content">
            <!-- top nav bar start -->
            <div class="top-navbar">
                <div class="row">

                    <div class="col">
                        <div class="xp-topbar">
                            <div class="row">
                                <div class="col-2 col-md-1 order-2 ordedr-md-1 align-self-center">
                                    <div class="xp-menubar">
                                        <span class="material-icons-sharp">signal_cellular_alt</span>
                                    </div>
                                </div>
                                <div class="col-2 col-lg-2 order-2 ordedr-md-1 align-self-center">
                                    <div class="xp-menubar"><a >
                                        {{ Request::is('dashboard/home') ? ' dashboard' : '' }}
                                        {{ Request::is('dashboard/appointment') ? "rendez_vous" : '' }}
                                        {{ Request::is('dashboard/planning') ? 'plalnnig' : '' }}
                                        {{ Request::is('dashboard/medecin') ? 'medecins' : '' }}
                                        {{ Request::is('dashboard/facture') ? 'facture' : '' }}
                                        {{ Request::is('dashboard/settings') ? 'Utilisateurs' : '' }}
                                    </a></div>
                                </div>
                            </div>

                        </div>
                    </div>
                   
                    <div class="col">
                        <div class="col-2 col-md-1 col-lg-1 order-2 ordedr-md-1 align-self-center " style="float: right; margin: 9px;">
                            <a class=" " style="color: #333333cc;" type="button" 
                                href="{{ route('logout') }}" style="color: aliceblue;"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
    
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                                </form>
                                <i class="fa fa-sign-out fa-lg" ></i>
                            </a>
                        </div>
                        @can('isAdmin')
                            <div class="col-2 col-md-1 col-lg-1 order-2 ordedr-md-1 align-self-center " style="float: right; margin: 9px;">
                                <a class=" " id="notif" style="color: #333333cc;" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                                    <i class="fa fa-bell fa-lg" style="display: inline-block;"></i>
                                </a>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>

            <!-- top nav bar end -->

            <!-- main-content start -->

            <div class="main-content">
                <main>
                    @yield('content')
                </main>
            </div>

            
            <!-- main-content end -->

            
        </div>
        <!-- footer design -->
    </div>

        



    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Notifications</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="container" id="notifsContainer">
                
                
            </div>
        </div>
    </div>

    
<!-- compelte html -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>               
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    
    <!-- notifications script start -->
    <script>
        $(document).ready(function() {


            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

            $.ajax({   /* to get notifs infos */
                    type: "GET",
                    url:"{{ route('showNotif') }}",
                    success: function(response){
                    console.log(response);
                    
                    if(response.length!=0){
                        $('#notif').append('<span  style="z-index:12; background-color:#f00; padding:5px; border-radius:50%; vertical-align:top; margin-left:-10px; top:10px; font-size:0.3px;"></span>');

                    }
                       
                    },
                    error: function(response){
                        
                    }
                    
                });

            $(document).on('click','#notif',function(e){
                $.ajax({   /* to get notifs infos */
                    type: "GET",
                    url:"{{ route('showNotif') }}",
                    success: function(response){
                    console.log(response);
                    var apps = response.notifs;
                    for( i=1; i<=1000000; i++) {  
                                $('#notification'+i).remove();
                            }
                    response.forEach(item => {
                        $('#notifsContainer').append('<div  class="row" id="notification'+item.id+'" style="margin-top: 10px;"><div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header"><svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#007aff"></rect></svg><small>demande d\'annulation</small></div><div class="toast-body"><small>Patient : </small><p4 class="me-auto" style="font-weight: 500;">'+item.patientFName+' '+item.patientLName+'</p4></br><small>date : </small><p4 class="me-auto" style="font-weight: 500;">'+item.planDate+' '+item.appTime+' </p4></br><p4 class="me-auto" style="font-weight: 500;"><small>dr.</small> '+item.planDoc+'</p4><hr><button id="deleteAppBtn" value="'+item.id+'" type="button" class="btn btn-outline-primary">valider</button> <button value="'+item.id+'" type="button" id="deleteNotifBtn" class="btn btn-outline-danger">annuler</button></div></div></div>');
                        
                    });
                       
                        
                        

                    },
                    error: function(response){
                        
                    }
                    
                });
            })

            $(document).on('click','#deleteAppBtn',function(e){
                var id = $(this).val()
                $.ajax({   /* to get notifs infos */
                    type: "GET",
                    url:"{{ route('app.delete','') }}"+'/'+id,
                    success: function(response){
                    console.log(response);
                    $('#notification'+id).remove();
                        

                    },
                    error: function(response){
                        
                    }
                    
                });
                
            })


            $(document).on('click','#deleteNotifBtn',function(e){
                var id = $(this).val()
                $.ajax({   /* to get notifs infos */
                    type: "GET",
                    url:"{{ route('notif.delete','') }}"+'/'+id,
                    success: function(response){
                    console.log(response);
                    
                    $('#notification'+id).remove();

                        

                    },
                    error: function(response){
                        
                    }
                    
                });
                
            })
            


        })
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $(".xp-menubar").on('click',function(){
                $("#sidebar").toggleClass('active');
                $("#content").toggleClass('active');
            });
            
            $('.xp-menubar,.body-overlay').on('click',function(){
                $("#sidebar,.body-overlay").toggleClass('show-nav');
            });
        });
    </script>
  </body>
</html>
