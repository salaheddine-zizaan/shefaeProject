@extends('layouts.Dashboard')



@section('content')
<div class="container">
  <div class="row">
      <div class="col-md-12">
          <div class="table-wrapper">
              <div class="table-titel">
              
                  <div class="row">
                  
                      <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
                          <h2 class="ml-lg-2">@can('isAdmin') Gestion des @endcan médecins</h2>
                      </div>
                      @can('isAdmin')
                      <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center ">
                          <a href="#" class="btn btn-primary btn-group" data-bs-toggle="modal" data-bs-target="#addEmloyeeModal" >
                              <span class="material-icons-sharp">&#xE147;</span>
                              <span>ajouter un medecin </span>
                          </a>
                          <a href="#" class="btn success btn-group" data-bs-toggle="modal" data-bs-target="#addspecialityModal">
                              <span class="material-icons-sharp">&#xE147;</span>
                              <span>ajouter une spécialité</span>
                          </a>
                          
                      </div>
                      @endcan
                  </div>
                  
              </div>
              <table class="table table table-striped table-hover" >
                  <thead>
                      <tr>
                          <th>Nom</th>
                          <th>Prenom</th>
                          <th>spécialité</th>
                          <th>contact</th>
                      @can('isAdmin')
                          <th>actions</th>
                      @endcan
                      </tr>
                  </thead>
                  <tbody>
                  @foreach($docs as $doc)
                      <tr>
                                  <td>{{$doc['DocLName']}}</td>
                                  <td>{{$doc['DocFName']}}</td>
                                  <td>{{$doc['speciality']}}</td>
                                  <td>{{$doc['contact']}}</td>
                                  <input type="hidden" id="editDocid" value="{{$doc['id']}}">
                                  @can('isAdmin')

                                  <div class="actions">
                                  <th>
                                    <div class="row " >
                                    <div class="col" >
                                    <button href="#"  data-bs-toggle="modal" data-bs-target="#editDocModal" id="editDoc" value="{{$doc['id']}}">
                                      <span class="material-icons-sharp" data-toggle="tooltip" title="edit">&#xE254;</span>
                                    </button>
                                    </div>

                                    <div class="col">
                                    <button href="#" class="toDelete" id="toDelete" data-bs-toggle="modal" data-bs-target="#deletEmloyeeModal" value="{{$doc['id']}}">
                                        <span class="material-icons-sharp" data-toggle="tooltip" title="delet">&#xE872;</span>
                                    </button>
                                    </div>
                                    </div>
                                  </th>
                                  @endcan
                                  </div>
                              </tr>            
                  @endforeach
                      
                  </tbody>
              </table>
              <div class="clearfix">
                  <ul class="pagination">
                      <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                      <li class="page-item active"><a class="page-link" href="#">1</a></li>
                      <li class="page-item "><a class="page-link" href="#">2</a></li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
              </div>
              
                  <!-- ADD doctor modal start -->
                  <div class="modal fade" tabindex="-1" id="addEmloyeeModal"  role="dialog">
                      <div class="modal-dialog" role="document">

                        <div class="modal-content text-center">

                          <div class="modal-header">
                            <h5 class="modal-title">ajouter un medecin</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>

                            <div class="modal-body">
                              <form action="{{ route('doctors.addDoc') }}" method="POST" style="display: block;">
                              {{csrf_field()}}




                              
                              <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="" name="DocLName" required>
                                <label for="floatingInput">Nom</label>
                              </div>

                              <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="" name="DocFName" required>
                                <label for="floatingInput">Prenom</label>
                              </div>

                              <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingPassword" placeholder="" name="contact" required  >
                                <label for="floatingPassword">contact</label>
                              </div>

                              <div class="form-floating mb-3">
                                <select name="speciality" class="form-control" id="speciality" required>
                                  @foreach($speciality as $sp)
                                    <option >{{$sp['speciality']}}</option>
                                  @endforeach
                                </select>

                                <label for="floatingPassword">Specialité</label>
                              </div>

                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-bs-dismiss="modal">Annuler</button>
                              <button type="submit" class="btn btn-success">Ajouter</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    
                  <!-- ADD doctor modal end -->


                  <!-- ADD specialty modal start -->
                  <div class="modal fade" tabindex="-1" id="addspecialityModal"  role="dialog">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">ajouter une specialite</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form action="{{ route('planning.addSpeciality') }}" method="POST">
                            {{csrf_field()}}
                              <div class="form-group " style="width: 100%;">
                                  <label for="speciality">Nom de nouveau spécialité</label>
                                  <input type="text" class="form-control" name="speciality" id="speciality" required>
                                  <label for="specialities">specialite déjà existant:</label>
                                  <select name="specialities" class="form-control" id="DocName">
                                      @foreach($speciality as $sp)
                                        <option >{{$sp['speciality']}}</option>
                                      @endforeach
                                  </select>
                              </div>
                            
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-success">Ajouter</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    
                  <!-- ADD specialty modal end -->

                  <!-- EDIT modal start -->
                  <div class="modal fade " tabindex="-1" id="editDocModal" role="dialog">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">modifier le medecin</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <form action="{{ url('dashboard/updateDoc') }}" method="POST">
                          {{csrf_field()}}
                          @method('PUT')
                          <div class="modal-body">
                              <div class="form-group">
                                  <input type="hidden" class="form-control" id="editid" name="editid" required>
                                  <label for="">Nom</label>
                                  <input type="text" class="form-control" id="editLName" name="editLName" required>
                                  <label for="">prenom</label>
                                  <input type="text" class="form-control" id="editFName" name="editFName" required>
                                  <label for="">contact</label>
                                  <input type="tel" class="form-control" id="editContact"  name="editContact" required>
                                  <label for="speciality">specialite:</label>
                                  <select name="speciality" class="form-control" id="editSpeciality" >
                                      @foreach($speciality as $sp)
                                        <option >{{$sp['speciality']}}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-success editDoc">sauvegarde</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    
                  <!-- EDIT modal end -->

                  <!-- DELET modal start -->
                    <div class="modal fade" tabindex="-1" id="deletEmloyeeModal" role="dialog">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">supprimer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <input type="hidden" id="idToDelete">
                              
                              <p class="text-danger">vous voulez supprimer le medecin ?</p>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-bs-dismiss="modal">Annuler</button>
                              <button type="button" class="btn btn-success" id="deleteDoc">supprimer</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                  <!-- DELET modal end -->
              

          </div>
      </div>
  </div>
  </div>

               
                <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>               

                <script>
                  $(document).ready(function() {
                    $(document).on('click','#editDoc',function(e){
                      e.preventDefault();
                      var id = $(this).val();
                      $.ajax({
                        type: "GET",
                        url:"{{ route('doctors.editDoc' , '') }}"+'/'+id,
                        success: function(response){
                          $('#editLName').val(response.DocLName);
                          $('#editFName').val(response.DocFName);
                          $('#editContact').val(response.contact);
                          $('#editSpeciality').val(response.speciality);
                          $('#editid').val(response.id);

                        }


                      });

                    })

                    $(document).on('click','#toDelete',function(e){
                      e.preventDefault();
                      var id = $(this).val();
                      $('#idToDelete').val(id);
                      
                      

                    })

                    $(document).on('click','#deleteDoc',function(e){
                      e.preventDefault();
                      var id = $('#idToDelete').val();
                      $.ajaxSetup({
                          headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          }
                      });
                      $.ajax({
                        type: "DELETE",
                        url:"{{ route('doctors.deleteDoc' , '') }}"+'/'+id,
                        success: function(response){
                          $('#deletEmloyeeModal').modal('hide');   
                          swal("réussir !", "medecin supprimer!", "success");
                                    setTimeout("location.reload(true);", 1000);                     

                        }


                      });

                    })
                  })


                  
                </script>
@endsection
