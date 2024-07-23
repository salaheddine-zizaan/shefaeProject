@extends('layouts.Dashboard')

@section('content')


<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

<div class="modal-dialog  modal-lg mt-5" style="background-color: #eee; padding:1rem; border-radius:10px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel" style="user-select: none;">paiement de consultation</h1>
                        </div>
                        <div class="modal-body">

                            <form action="" id="ajout_vidange">
                            <div class="container text-center">

                                <div class="row g-3 mb-3">

                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="floatingInputGrid" name="patientLName" readonly required>
                                            <label for="floatingInputGrid">Nom</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="floatingInputGrid" name="patientFName" readonly required>
                                            <label for="floatingInputGrid">Prenom</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="floatingInputGrid" name="patientSexe" readonly required>
                                            <label for="floatingInputGrid">sexe</label>
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="row g-3 mb-3">

                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="floatingInputGrid" name="planDoc" readonly required>
                                            <label for="floatingInputGrid">dr.</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="datetime" class="form-control" id="floatingInputGrid" name="planDateTime" readonly required>
                                            <label for="floatingInputGrid">date et heure</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="floatingInputGrid" name="speciality" readonly required>
                                            <label for="floatingInputGrid">specialite</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="row g-3 mb-3">

                                    
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" id="floatingInputGrid" name="prix"  required>
                                            <label for="floatingInputGrid">consultation (DH)</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="number" min="0" class="form-control" id="floatingInputGrid" name="prixTTC" required>
                                            <label for="floatingInputGrid">medicament (DH)</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating">
                                            <input type="number" min="0" class="form-control" id="floatingInputGrid" name="prixTTC" required>
                                            <label for="floatingInputGrid">Total a payer (DH)</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="row g-3 mb-3">

                                    
                                    <div class="col-lg">
                                        <div class="form-floating">
                                            <textarea type="text" class="form-control" id="floatingInputGrid" name="description" required></textarea>
                                            <label for="floatingInputGrid">description</label>
                                        </div>
                                </div>

                                </div>

                                
                                

                                <div class="modal-footer mt-4">
                                    <button type="submit" class="btn btn-primary" id="saveBtn">Enregistrer</button>
                                </div>
                                </div>

                            </form>
                            


                        </div>
                    </div>
                </div>





                <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>               


<script>

    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        



})

</script>
    
@endsection
