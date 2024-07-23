@extends('layouts.Dashboard')

@section('content')

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

<!-- cards start -->

<div class="container-cards">
    <div class="row">
        <!-- <div class="col">
            <div class="carde">
                <div class="card-body">
                    <h4  class="card-title">Rendez-vous en cours</h4>                        
                        <div class="user-info">
                            <div class="user-info__img">                 
                            <img src="{{url('assets/img/patient.png')}}" alt="User Img">               
                            </div>                 
                            <div class="user-info__basic">
                            <h5 class="mb-0">Ahmed Badr</h5>
                            <p class="text-muted mb-0">28 yrs, Male</p>

                            </div>
                        </div>
                                            
                        <div class="d-flex justify-content-between mt-4">
                            <div>
                            <h6 class="mb-0">DR. ahmed ahmed</h6>
                                <h5 class="mb-0">06:00 PM</h5>
                            </div>
                                                
                            <button class="btn btn-success">Payer</button> 
                        </div>
                        <br/>

                </div>
                                        
            </div>                 
                                            
        </div> -->
        <div class="col">
            <div class="row">
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-info">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">planifiés</p>
                                        
                                    <h4 class="my-1 text-info">{{$statics['reserved']}}</h4>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class="fa fa-heartbeat"></i>
                                </div>
                            </div>
                        </div>
                </div>

                </div>
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-danger">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                <p class="mb-0 text-secondary">passer </p>
                                <h4 class="my-1 text-danger">{{$statics['passed']}}</h4>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i class="fa fa-heart"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">confirmés</p>
                                <h4 class="my-1 text-success">{{$statics['confirmed']}}</h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class="fa fa-check-square"></i>
                            </div>
                        </div>
                    </div>
                </div>


                </div>
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-warning">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">controle</p>
                                    <h4 class="my-1 text-warning">{{$statics['controle']}}</h4>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class="fa fa-plus-square"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="main-content">
    <div class="container">
    
        <table class="table">
        @if(isset($rvs))
        <thead>
            <tr>
            <th>Patient</th>
            <th>Status</th>
            <th>Appointment</th>
            <th>Phone</th>
            <th>Doctor</th>
            <th>Actions</th>
            </tr>
        </thead>
        
        @foreach($rvs as $rv)
        <tbody>
        
            <tr>
            <td>
                <div class="user-info">
                
                <div class="user-info__basic" style=" Padding-right:30px; ">
                    <h5 class="mb-0" style="font-size: 16px; font-weight:500;">{{$rv['patientFName']}} {{$rv['patientLName']}} </h5>
                    <p class="text-muted mb-0">{{$rv['appType']}}</p>
                </div>
                </div>
            </td>
            <td>
                <span class="btn btn-success" >{{$rv['appStatus']}}</span>
            </td>
            <td>
                <h6 class="mb-0">{{ date ('H:i',strtotime($rv['appTime']))}} PM</h6>
                <small>{{$rv['planDate']}}</small>
            </td>
            <td>
                <h6 class="mb-0">{{$rv['patientContact']}}</h6>
            </td>
            <td>
                <h6 class="mb-0">Dr. {{$rv['planDoc']}}</h6>
            </td>
            <td>
                <div class="row">
                    
                  <div class="col">
                    <button type="button" class="dropdown-item" id="patientInfos" value="{{$rv['id']}}" href="#"><i class="fa fa-plus mr-1"></i> </button>
                  </div>
                  @if($rv['patientContact']!='')
                  <div class="col">
                    <button type="button" class="dropdown-item" id="payeApp" value="{{$rv['id']}}" href="#"><i class="fa fa-credit-card  mr-1"></i> </button>
                  </div>
                  @endif
                    
                  <!-- <div class="col">
                    <button type="button" id="appDelete" class="dropdown-item text-danger" value="{{$rv['id']}}" href="#"><i class="fa fa-trash mr-1"></i> </button>
                  </div> -->
                  
                </div>
            </td>
            </tr>
            @endforeach
            @else
            <th style="padding: 20px; padding-left:50px; border: 1px #eee" ><div class="row text-danger">{{$msg}}</div></th>
            @endif
            
        </tbody>
        </table>
    </div>
</div>

<!-- informations modal -->

<div class="modal fade" id="infosModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="patientInfoBody">
        <form>

        </form>
      </div>
      <div class="modal-footer" style="display: inline-block;">
        <button type="button" id="saveDesc" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-primary" id="downloadPDF"> telecharger pdf </button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade"  id="validate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog"style="max-width: 40rem">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">prenez se rendez-vous</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="{{ url('appointment/AppSave/') }}" method="POST">
      {{csrf_field()}}
       @method('PUT')
            <div class="form-group">
                <span>Nom</span>
                <input type="text" placeholder="Entrer votre nom" name="LName" id="modalLName" required >
            </div>
            <div class="form-group">
                <span>Prénom</span>
                <input type="text" placeholder="Entrer votre Prénom" id="modalFName" name="FName" required >
            </div>
            <div class="form-group">
                <span>Date de naissance</span>
                <input type="date" placeholder="Entrer votre date de naissance" name="Nais" id="modalNais" required >
            </div>
            <div class="form-group">
                <span>Numéro de téléphone</span>
                <input type="number" placeholder="Entrer votre téléphone" name="Contact" id="modalContact" required >
            </div>
            <div class="form-group">
                <span>CIN</span>
                <input type="text" placeholder="Entrer votre CIN" name="Cin" id="modalCin" required >
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


<!-- DELET modal start -->
<div class="modal fade" tabindex="-1" id="deletAppModal" role="dialog">
    <div class="modal-dialog" role="document" style="max-width: 40rem">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">supprimer</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            
            <p class="text-danger">vous voulez vider se rendez-vous ?</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Annuler</button>
            <button type="button" class="btn btn-success" id="deleteApp">supprimer</button>
        </div>
        </div>
    </div>
    </div>
    
<!-- DELET modal end -->


<!-- payer modal start -->
<div class="modal fade" id="payeAppModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

<div class="modal-dialog  modal-lg mt-5" style=" max-width: 50rem;  padding:1rem; border-radius:10px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel" style="user-select: none;">paiement de consultation</h1>
                        </div>
                        <div class="modal-body">

                            <form action="{{ url('dashboard/payeFacture') }}" method="POST" id="ajout_vidange">
                        {{csrf_field()}}

                            <div class="container text-center">

                                <div class="row g-3 mb-3">

                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="ppatientLName" id="floatingInputGrid" name="ppatientLName"  readonly required>
                                            <label for="floatingInputGrid">Nom</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control"  name="ppatientFName" id="ppatientFName" id="floatingInputGrid" readonly required>
                                            <label for="floatingInputGrid">Prenom</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="ppatientSexe" id="floatingInputGrid" name="ppatientSexe"  readonly required>
                                            <label for="floatingInputGrid">sexe</label>
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="row g-3 mb-3">

                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="pplanDoc" id="floatingInputGrid" name="pplanDoc"  readonly required>
                                            <label for="floatingInputGrid">dr.</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="datetime" class="form-control" id="pplanDateTime" id="floatingInputGrid" name="pplanDateTime"  readonly required>
                                            <label for="floatingInputGrid">date et heure</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="pspeciality" id="floatingInputGrid" name="pspeciality"  readonly required>
                                            <label for="floatingInputGrid">specialite</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="row g-3 mb-3">

                                    
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" id="consulteP" id="floatingInputGrid" name="consulteP"   required>
                                            <label for="floatingInputGrid">consultation (DH)</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="number" min="0" class="form-control" id="medicamentP" id="floatingInputGrid" name="medicamentP"  required>
                                            <label for="floatingInputGrid">medicament (DH)</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="number" min="0" class="form-control" id="totalP" id="floatingInputGrid" name="totalP"  required>
                                            <label for="floatingInputGrid">Total a payer (DH)</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="row g-3 mb-3">

                                    
                                    <div class="col-lg">
                                        <div class="form-floating">
                                            <textarea type="text" class="form-control" id="pdescription" id="floatingInputGrid" name="pdescription"  required></textarea>
                                            <label for="floatingInputGrid">description</label>
                                        </div>
                                    </div>

                                </div>

                                
                                

                                <div class="modal-footer">
                                    <input type="number"  class="form-control" id="appId" id="floatingInputGrid" name="appId" hidden required>
                                    <button type="submit" class="btn btn-primary" id="saveFacBtn">Enregistrer</button>
                                </div>
                                </div>

                            </form>
                            


                        </div>
                    </div>
                </div>
</div>
    
<!-- DELET modal end -->



<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>               

<script>

    $(document).ready(function() {

         

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        /* more infos modal - pdf download  */
        
        $(document).on('click','#patientInfos',function(e){
            

            var id = $(this).val()
            $('#downloadPDF').val(id);
            $.ajax({   /* to get patient infos */
            type: "GET",
            url:"{{ route('patientInfos' , '') }}"+'/'+id,
            success: function(response){
              console.log(response);
              if(response.appStatus=='reserver' || response.appStatus=='valider'){
                $('#infosModal').modal('show');
                $('#patientMore').remove();
                $('#patientInfoBody').append('<div id=\'patientMore\'> <ul class="list-group"> <li class="list-group-item">Nom :     '+response.patientFName+'</li> <li class="list-group-item">Prenom :     '+response.patientLName+'</li> <li class="list-group-item">Dr :     '+response.planDoc+'</li> <li class="list-group-item">Date de rv :     '+response.planDate+'   '+response.appTime+'</li> <li class="list-group-item">sexe : </li> <li class="list-group-item">Contact :     '+response.patientContact+'</li> <li class="list-group-item"> - '+response.appType +' '+response.appStatus+'</li> <label for="floatingInputGrid">description</label> <textarea class="form-control" id="description" id="floatingInputGrid" aria-label="With textarea">'+response.appDesc+'</textarea>  </ul><input type="text" value="'+response.id+'" name="Id" id="pId" hidden> </div>');
              }
              else{
                $('#validate').modal('show');
                $('#modalSp').val(response.speciality);
                $('#modalDate').val(response.planDate);
                $('#modalTime').val(response.appTime);
                $('#modalId').val(response.id);
              }
              

            },
            error: function(response){
                
            }
            
          });
        })

        $(document).on('click','#payeApp',function(e){
            
            $('#payeAppModal').modal('show');
            var id = $(this).val();
            $.ajax({   /* to get patient infos */
            type: "GET",
            url:"{{ route('patientInfos' , '') }}"+'/'+id,
            success: function(response){
              
              $('#ppatientFName').val(response.patientFName);
                $('#ppatientLName').val(response.patientLName);
                $('#pspeciality').val(response.speciality);
                $('#pplanDateTime').val(response.planDate+" "+response.appTime);
                $('#pplanDoc').val(response.planDoc);
                $('#appId').val(response.id);
              console.log($('#appId').val());

            },
            error: function(response){
                
            }
            
          });
        })

        $(document).on('click','#downloadPDF',function(e){

            var id = $(pId).val()
            console.log(id);
            $.ajax({   /* to get patient infos */
            type: "GET",
            url:"{{Route('patientPDF','')}}"+'/'+id,
            success: function(response){
                
            },
            error: function(response){
                
            }
            
          
          });
        })

        $(document).on('click','#saveDesc',function(e){
            var id = $(pId).val();
            var desc = $('#description').val();
            var data = {
                'desc':desc,
            }
            console.log(data)
            $.ajax({   /* to get patient infos */
            type: "PUT",
            url:"{{ route('patientDesc' , '') }}"+'/'+id,
            data:data,
            dataType: "json",
            success: function(response){
                
                swal({
                icon: "success",
                });

            },
            error: function(response){
                
            }


            });
        })


        $(document).on('click','#appDelete',function(e){
            $('#deletAppModal').modal('show');
            var id= $(this).val();
            $('#deleteApp').val(id) ;
        })

        $(document).on('click','#deleteApp',function(e){
            e.preventDefault();
            var id = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var data = {
                'Id':id,
            };
            console.log(data);
            $.ajax({   /* to get patient infos */
            type: "PUT",
            url:"{{ route('appDelete') }}",
            data:data,
            dataType: "json",
            success: function(response){
                
                if(response.message=='send'){
                    $('#deletAppModal').modal('hide'); 
                    swal("réussir !", "envoyer a les responsable", "info");
                }
                
            },
            error: function(response){
                $('#deletAppModal').modal('hide'); 
                swal("réussir !", "envoyer a les responsable", "info");
            }

            });
            
        })

        $(document).on('click','#saveDesc',function(e){
            var id = $(pId).val();
            var desc = $('#description').val();
            var data = {
                'desc':desc,
            }
            console.log(data)
            $.ajax({   /* to get patient infos */
            type: "PUT",
            url:"{{ route('patientDesc' , '') }}"+'/'+id,
            data:data,
            dataType: "json",
            success: function(response){
                
                swal({
                icon: "success",
                });

            },
            error: function(response){
                
            }


            });
        })

        $(document).on('click','#totalP',function(e){
            medicament = parseFloat($("#medicamentP").val());
            consultation = parseFloat($("#consulteP").val());
            var total =   +  medicament + consultation ;
            $("#totalP").val(parseFloat(total))   ;
            
        })


    })
</script>
                
@endsection
