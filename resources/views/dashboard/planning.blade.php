
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
    <!-- fullcaledar cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script> <!-- for IE and Android native browser support -->
 


    
    <link rel="stylesheet" href="{{url('css/planning.css')}}">
    <link rel="stylesheet" href="{{url('css/planning1.css')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">


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
                <li class="{{ Request::is('dashboard/facture') ? 'active' : '' }}">
                    <a href="{{route('facture')}}" class="dashboard"><i class="material-icons-sharp">paid</i>les factures</a>
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
                        <div class="col-2 col-md-1 col-lg-1 order-2 ordedr-md-1 align-self-center " style="float: right; margin: 9px;">
                            <a class=" " style="color: #333333cc;" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                                <i class="fa fa-bell fa-lg" ></i>
                            </a>
                        </div>
                    
                    </div>
                </div>
            </div>

            <!-- top nav bar end -->




            <!-- main-content start -->

            <!-- calendar start -->
            

    
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        
                        <div class="col-mdd-11 offset-1 mt-5 mb-5">
                        @can('isAdmin')
                            <button type="button" class="btn btn-primary text-right" id="addPlan" data-bs-toggle="modal" data-bs-target="#planModal">
                                ajouter
                            </button>                        
                            @endcan
                            <div id="calendar">

                            </div>

                        </div>
                    </div>
                </div>
            </div>
           

            <!-- calendar end -->

            
            <!-- main-content end -->

            
        </div>
    </div>
           

        



        <!-- add plan Modal -->


        <div class="modal fade" id="planModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">ajoter un plan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action=" {{ route('planning.store') }}" method="POST">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="form-group">
                            <label>medecin</label>
                            <select name="DocName" class="form-control" id="DocName">
                                @foreach($docs as $doc)
                                <option value="{{$doc['DocFName']}} {{$doc['DocLName']}}">{{$doc['DocFName']}} {{$doc['DocLName']}}</option>
                                @endforeach
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label>la date</label>
                            <input id="start_date" name="plan-date" class="form-control" type="date" placeholder="entrer la date de debut" required/>
                        </div>
                        <div class="form-group">
                            <label>heure de debut</label>
                            <input id="end_date" name="start-hour" class="form-control" type="time" placeholder="entrer la date de debut" required/>
                        </div>
                        <div class="form-group">
                            <label>heure de fin</label>
                            <input id="end_date" name="end-hour" class="form-control" type="time" placeholder="entrer la date de debut" required/>
                        </div>
                                                    
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="saveBtn" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
        
        <!-- add plan Modal end -->


        <!-- edit plan modal start -->
        @can('isAdmin')

        <div class="modal fade" id="editPlanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">modifier un plan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('dashboard/update/') }}" method="POST">
                    {{csrf_field()}}
                    @method('PUT')
                    <div class="modal-body ">
                        <div class="form-group">
                            <select name="DocName" class="form-control" id="editDocName" >
                                @foreach($docs as $doc)
                                <option value="{{$doc['DocFName']}} {{$doc['DocLName']}}">{{$doc['DocFName']}} {{$doc['DocLName']}}</option>
                                @endforeach
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label>start date</label>
                            <input id="edit-plan-date" name="edit-plan-date" class="form-control" type="date" placeholder="entrer la date de debut" required/>
                        </div>
                        <div class="form-group">
                            <label>end date</label>
                            <input id="edit-start-hour" name="edit-start-hour" class="form-control" type="time" placeholder="entrer la date de debut" required/>
                        </div>
                        <div class="form-group">
                            <label>end date</label>
                            <input id="edit-end-hour" name="edit-end-hour" class="form-control" type="time" placeholder="entrer la date de debut" required/>
                        </div>
                        <input id="editid" name="editid" class="form-control" type="hidden"  required/>
                                                    
                    </div>
                    <div class="modal-footer ">

                        <button type="button" id="deleteBtn" class="btn btn-danger">supprimer</button> 
                        <button type="submit" id="saveEditBtn" class="btn btn-primary">Save changes</button>
                        

                    </div>
                </form>
            </div>
        </div>
        </div>
        @endcan

        @can('isSecretariat')

<div class="modal fade" id="editPlanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">modifier un plan</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ url('dashboard/update/') }}" method="POST">
            {{csrf_field()}}
            @method('PUT')
            <div class="modal-body ">
                <div class="form-group">
                    <select name="DocName" class="form-control" id="editDocName" disabled>
                        @foreach($docs as $doc)
                        <option value="{{$doc['DocFName']}} {{$doc['DocLName']}}">{{$doc['DocFName']}} {{$doc['DocLName']}}</option>
                        @endforeach
                        
                    </select>
                </div>
                <div class="form-group">
                    <label>start date</label>
                    <input id="edit-plan-date" name="edit-plan-date" class="form-control" type="date" placeholder="entrer la date de debut" readonly required/>
                </div>
                <div class="form-group">
                    <label>end date</label>
                    <input id="edit-start-hour" name="edit-start-hour" class="form-control" type="time" placeholder="entrer la date de debut" readonly required/>
                </div>
                <div class="form-group">
                    <label>end date</label>
                    <input id="edit-end-hour" name="edit-end-hour" class="form-control" type="time" placeholder="entrer la date de debut" readonly required/>
                </div>
                <input id="editid" name="editid" class="form-control" type="hidden" readonly required/>
                                            
            </div>
            <div class="modal-footer ">

                
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                

            </div>
        </form>
    </div>
</div>
</div>
@endcan


        <!-- edit plan model end -->


    
    <!-- calendar script start -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var plannings = @json($events);
            var doctors = @json($docs);
            

            $('#calendar').fullCalendar({
                header: {
                    start: 'title', // will normally be on the left. if RTL, will be on the right
                    center: '',
                    end: 'today prev,next' 
                },
                events: plannings,
                height: 650,
                selectable: false,
                selectHelper: false,
                
                    
            
                
                editable:false,
                
                
                eventClick: function(event){
                    var id = event.id;
                        
                        $('#editPlanModal').modal('toggle');
                        $.ajax({
                            
                                url:"{{ route('planning.edit' , '') }}"+'/'+id,
                                type:"GET",
                                /* dataType:'json',
                                data:{ edit_plan_date, edit_start_date ,edit_end_date}, */
                                success:function(response)
                                {
                                    /* swal("Good job!", "plan modifier", "success"); */

                                    if(response.status==404){
                                        /* $('#success_message').html("");
                                        $('#success_message').addClass('alert alert-danger');
                                        $('#success_message').text(response.message); */
                                    }else{
                                        
                                        
                                        $('#editid').val(response.plan.id);
                                        $('#editDocName').val(response.plan.DocName);
                                        $('#edit-plan-date').val(response.plan.plan_date);
                                        $('#edit-start-hour').val(response.plan.start_time);
                                        $('#edit-end-hour').val(response.plan.end_time);
                                    }

                                },
                                error:function(error)
                                {
                                    console.log(error)
                                },
                            });
                            

                        

                        $('#deleteBtn').click(function() {
                            var id = $('#editid').val();
                            $.ajax({
                                url:"{{ route('planning.destroy' , '') }}"+'/'+id,
                                type:"DELETE",
                                success:function(response)
                                {
/*                                     swal("Good job!", "plan modifier", "success");
 */                                    
                                    swal({title: "Good job!",text: "plan supprimer!",icon: "success",});
                                    setTimeout("location.reload(true);", 1000);


                                },
                                error:function(error)
                                {
                                    console.log(error)
                                },
                            });
                            var id = null;
                            

                        });
                    
                },

                
            });
            $("#calendar").on("hidden.bs.model",function(){
                $(".fc-event").unbind();
            });
            
            $('.fc-event').css('font-size','13px')
            var id = null;
        });
    </script>
   
    
    
    
            
        


    <!-- calendar script end -->


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
