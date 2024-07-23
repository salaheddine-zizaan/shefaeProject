@extends('layouts.Dashboard')

@section('content')

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

<div class="row  d-flex justify-content-center">
    <div class="appInput col-3 ">
        <div class="form-group">
            <select class="select mr-2" id="spChoose" id='rvSp' name="major" id="major" required>
            <option value="" selected>specialite</option>
            @foreach($speciality as $sp)
            <option value="{{$sp['speciality']}}" id="spChoose">{{$sp['speciality']}}</option>
            @endforeach

            </select>
        </div>
    </div>

    <div class="appInput col-3 ">
        <div class="form-group">
            <input class="ml-2" type="date" placeholder="date" id="dateInput" required >
        </div>
    </div>
    
</div>


<div class="container-tabs">
    <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
    <li class="nav-item">
        <button class="nav-link " id="time" data-toggle="tab" value="8:00"  role="tab" aria-controls="tabContent-9am" >8:00</button>
    </li>
    <li class="nav-item">
        <button class="nav-link " id="time" data-toggle="tab" value="9:00"  role="tab" aria-controls="tabContent-9am" >9:00</button>
    </li>
    <li class="nav-item">
        <button class="nav-link" id="time" data-toggle="tab" value="10:00"  role="tab" aria-controls="tabContent-10am" >10:00</button>
    </li>
    <li class="nav-item">
        <button class="nav-link" id="time" data-toggle="tab" value="11:00"  role="tab" aria-controls="tabContent-11am" >11:00</button>
    </li>
    <li class="nav-item">
        <button class="nav-link" id="time" data-toggle="tab" value="12:00"  role="tab" aria-controls="tabContent-12am" >12:00</button>
    </li>
    <li class="nav-item">
        <button class="nav-link" id="time" data-toggle="tab" value="13:00"  role="tab" aria-controls="tabContent-13am" >13:00</button>
    </li>
    <li class="nav-item">
        <button class="nav-link" id="time" data-toggle="tab" value="14:00"  role="tab" aria-controls="tabContent-14am" >14:00</button>
    </li>
    <li class="nav-item">
        <button class="nav-link" id="time" data-toggle="tab" value="15:00"  role="tab" aria-controls="tabContent-15am" >15:00</button>
    </li>
    <li class="nav-item">
        <button class="nav-link" id="time" data-toggle="tab" value="16:00"  role="tab" aria-controls="tabContent-16am" >16:00</button>
    </li>
    <li class="nav-item">
        <button class="nav-link" id="time" data-toggle="tab" value="17:00"  role="tab" aria-controls="tabContent-17am" >17:00</button>
    </li>
    <li class="nav-item">
        <button class="nav-link" id="time" data-toggle="tab" value="18:00"  role="tab" aria-controls="tabContent-18am" >18:00</button>
    </li>
    </ul>
    <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="tabContent-8am" role="tabpanel" aria-labelledby="tab-8am">
        <ul class="list-group appsTable">
        <li class="list-group-item demande">
            <div class="row ">
            choisir une specialite et une date
            </div>
        </li>
        </ul>
    </div>
    
</div> 


<!-- informations modal -->

<div class="modal fade" id="infosModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">info</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="patientInfoBody">
        
      </div>
      <div class="modal-footer" style="display: inline-block;">
        <button type="button" id="saveDesc" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-primary" id="downloadPDF"> telecharger pdf </button>
      </div>
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>               

<div class="modal fade"  id="validate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " style="max-width: 40rem">
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">prenez se rendez-vous</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="{{ url('appointment/AppSave/') }}" method="POST">
      {{csrf_field()}}
       @method('PUT')
            <div class="form-group mb-2">
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
    </div>
  </div>
</div>

<!-- DELET modal start -->
<div class="modal fade" tabindex="-1" id="deletAppModal" role="dialog">
    <div class="modal-dialog" role="document">
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

<!-- ffacture modal start -->


<div class="modal fade" id="payeAppModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

<div class="modal-dialog  modal-lg mt-5" style=" max-width: 50rem;  padding:1rem; border-radius:10px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel" style="user-select: none;">paiement de consultation</h1>
                        </div>
                        <div class="modal-body">

                            <form >

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
                                            <input type="number" class="form-control" id="consulteP" id="floatingInputGrid" name="consulteP" readonly  required>
                                            <label for="floatingInputGrid">consultation (DH)</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="number" min="0" class="form-control" id="medicamentP" id="floatingInputGrid" name="medicamentP" readonly required>
                                            <label for="floatingInputGrid">medicament (DH)</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="number" min="0" class="form-control" id="totalP" id="floatingInputGrid" name="totalP" readonly required>
                                            <label for="floatingInputGrid">Total a payer (DH)</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="row g-3 mb-3">

                                    
                                    <div class="col-lg">
                                        <div class="form-floating">
                                            <textarea type="text" class="form-control" id="floatingInputGrid" name="pdescription" id="pdescription" readonly required></textarea>
                                            <label for="floatingInputGrid">description</label>
                                        </div>
                                    </div>

                                </div>

                                
                                

                                <div class="modal-footer">
                                    <input type="number"  class="form-control" id="appId" id="floatingInputGrid" name="appId" hidden required>
                                    <button type="button" class="btn btn-primary" id="saveFacPdf">telecharger pdf</button>
                                </div>
                                </div>

                            </form>
                            


                        </div>
                    </div>
                </div>
</div>

<!-- facture modal  end -->

<script>

    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var time = $('.default').val();

        $(document).on('click','#time',function(e){
/*             this.classList.add("active");
 */            for(var i=0;i<10;i++){
                $('.demande').remove();
                }

            for(var i=0;i<10;i++){
                $('.appsShowed').remove();

            }

            var sp = $('#spChoose').val();
            var date =  $('#dateInput').val();
            time = $(this).val();
            console.log(time);
            console.log(sp);
            console.log(date)
            $.ajax({   /* to get patient infos */
            type: "GET" ,
            url: '/appointment/appsShow/'+sp+'/'+date+'/'+time,
            success: function(response){
                console.log(response);

                $.each(response,function(key,item){
                    if(item.appStatus=="disponible" && item.planDate>=item.toDay && item.appTime<item.toTime){
                        $('.appsTable').append('<li class="list-group-item appsShowed"><div class="container"><div class="row "><div class="col-2">'+item.appTime+'</div><div class="col-2">'+item.patientFName+' '+item.patientLName+'</div><div class="col-2">'+item.appType+'</div><div class="col-2">  DR. '+item.planDoc+'</div><div class="col-2">'+item.patientContact+'</div> </div></div></li>');

                    }
                    if(item.appStatus=="disponible" && item.planDate==item.toDay && item.appTime>item.toTime){
                        $('.appsTable').append('<li class="list-group-item appsShowed"><div class="container"><div class="row "><div class="col-2">'+item.appTime+'</div><div class="col-2">'+item.patientFName+' '+item.patientLName+'</div><div class="col-2">'+item.appType+'</div><div class="col-2">  DR. '+item.planDoc+'</div><div class="col-2">'+item.patientContact+'</div><div class="col"> <button type="button" class="dropdown-item  text-primary" id="patientInfos" value="'+item.id+'" href="#"><i class="fa fa-plus mr-1"></i> </button></div> </div></div></li>');

                    }
                    if(item.appStatus=="payer"){
                        $('.appsTable').append('<li class="list-group-item appsShowed"><div class="container"><div class="row "><div class="col-2">'+item.appTime+'</div><div class="col-2">'+item.patientFName+' '+item.patientLName+'</div><div class="col-2">'+item.appType+'</div><div class="col-2">  DR. '+item.planDoc+'</div><div class="col-2">'+item.patientContact+'</div><div class="col"> <button type="button" class="dropdown-item  text-primary" id="factureInfos" value="'+item.id+'" href="#"><i class="fa fa-file mr-1"></i> </button></div> </div></div></li>');
                    }
                    if(item.appStatus=="reserver" || item.appStatus=="valider"){
                        $('.appsTable').append('<li class="list-group-item appsShowed"><div class="container"><div class="row "><div class="col-2">'+item.appTime+'</div><div class="col-2">'+item.patientFName+' '+item.patientLName+'</div><div class="col-2">'+item.appType+'</div><div class="col-2">  DR. '+item.planDoc+'</div><div class="col-2">'+item.patientContact+'</div><div class="col"> <button type="button" class="dropdown-item  text-primary" id="patientInfos" value="'+item.id+'" href="#"><i class="fa fa-info mr-1"></i> </button></div><div class="col"><button type="button" id="appDelete" class="dropdown-item text-danger" value="'+item.id+'" href="#"><i class="fa fa-trash mr-1"></i> </button></div></div> </div></li>');
                    }
                console.log(item.toTime);

                })
              
            },
            error: function(response){
                $('.appsTable').append('<li class="list-group-item demande text-danger"><div class="row " style="color:text-danger;">choisir une specialite et une date</div></li>');
                
            }
            
          });
        })




        $(document).on('click','#patientInfos',function(e){
            

            var id = $(this).val()

            $.ajax({   /* to get patient infos */
            type: "GET",
            url:"{{ route('patientInfos' , '') }}"+'/'+id,
            success: function(response){
              console.log(response);
              if(response.appStatus!='reserver' && response.appStatus!='valider' && response.appStatus!='payer'){
                $('#validate').modal('show');
                $('#modalSp').val(response.speciality);
                $('#modalDate').val(response.planDate);
                $('#modalTime').val(response.appTime);
                $('#modalId').val(response.id);
                }
              else{
                $('#infosModal').modal('show');
                $('#patientMore').remove();
                $('#patientInfoBody').append('<div id=\'patientMore\'> <ul class="list-group"> <li class="list-group-item">Nom :     '+response.patientFName+'</li> <li class="list-group-item">Prenom :     '+response.patientLName+'</li> <li class="list-group-item">Dr :     '+response.planDoc+'</li> <li class="list-group-item">Date de rv :     '+response.planDate+'   '+response.appTime+'</li> <li class="list-group-item">sexe : </li> <li class="list-group-item">Contact :     '+response.patientContact+'</li> <li class="list-group-item"> - '+response.appType +' '+response.appStatus+'</li> <div class="col-lg"><div class="form-floating"><textarea type="text" class="form-control" id="floatingInputGrid" id="description" name="desc" required>'+response.appDesc+'</textarea><label for="floatingInputGrid">description</label></div></div> </ul><input type="text" value="'+response.id+'" name="Id" id="pId" hidden> </div>');
              
              }
              $('#downloadPDF').val()=id;

            },
            error: function(response){
                
            }
            
          });
        })

        $(document).on('click','#factureInfos',function(e){
            

            var id = $(this).val()
            $('#payeAppModal').modal('show');

            $.ajax({   /* to get patient infos */
            type: "GET",
            url:"{{ route('factureInfos' , '') }}"+'/'+id,
            success: function(response){
              console.log(response.fac.pDescription);
                $('#ppatientFName').val(response.app.patientFName);
                $('#ppatientLName').val(response.app.patientLName);
                $('#pspeciality').val(response.app.speciality);
                $('#pplanDateTime').val(response.app.planDate+" "+response.app.appTime);
                $('#pplanDoc').val(response.app.planDoc);
                $('#totalP').val(response.fac.totalP);
                $('#medicamentP').val(response.fac.medicamentP);
                $('#consulteP').val(response.fac.consultationP);
                $('#pDescription').val(response.fac.pDescription);
                $('#appId').val(id);
                
             

            },
            error: function(response){
                
            }
            
          });
        })

        $(document).on('click','#saveFacPdf',function(e){

            var id = $("#appId").val()
            console.log(id);
            $.ajax({   /* to get patient infos */
            type: "GET",
            url:"{{Route('PdfFac','')}}"+'/'+id,
            success: function(response){
                
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
            $.ajax({   /* to get patient infos */
            type: "PUT",
            url:"{{ route('appDelete') }}",
            data:data,
            dataType: "json",
            success: function(response){
                if(response.message=='done'){
                $('#deletAppModal').modal('hide'); 
                swal("réussir !", "rendez-vous supprimer!", "success");
                }
                if(response.message=='send'){
                    $('#deletAppModal').modal('hide'); 
                    swal("réussir !", "envoyer a les responsable", "info");
                }
                if(response.message=='impossible'){
                    $('#deletAppModal').modal('hide'); 
                    swal("!", "impossible de supprimer se rendez-vous", "warning");
                }
                console.log(response)

            },
            error: function(response){
            }

            });
            
        })



    });

</script>

    
@endsection
