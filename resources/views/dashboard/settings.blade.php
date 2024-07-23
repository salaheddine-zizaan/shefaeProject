@extends('layouts.Dashboard')

@section('content')

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />


<div class="container float-left">
    <div class="row justify-content-center">
       
            

        <div class="col">
            <div class="row">
                <div class="col-4">
            <h3 class="my-4">Liste des utilisateurs</h3>
                </div>
                <div class="col">
            <button type="button" class=" my-4 btn btn-primary" data-bs-target="#modalConfirmationphp artisan ">
                            {{ __('Ajouter') }}
                        </button>
                </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>prenom</th>
                    <th>loign</th>
                    <th>Rôle</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                
                    <tr>
                    <td>mohamed</td>
                    <td>andalosi</td>
                    <td>andalosi12</td>
                    <td>responsable</td>
                    <td>
                    <div class="d-inline-flex">
                    <a  class="btn btn-primary btn-sm me-2">
                        <i class="fa fa-info " style="color: white; padding:3px;"></i>
                    </a>
                    <a  class="btn btn-danger btn-sm"
                    data-bs-toggle="modal" data-bs-target="#modalConfirmation">
                        <i class="fa fa-trash " style="color: white; padding:3px;"></i>
                    </a>       
                    </div>



                            
                    </td>
                    </tr>
                    <tr>
                    <td>amina</td>
                    <td>torabi</td>
                    <td>amitor12</td>
                    <td>secretaire</td>
                    <td>
                    <div class="d-inline-flex">
                    <a  class="btn btn-primary btn-sm me-2">
                        <i class="fa fa-info " style="color: white; padding:3px;"></i>
                    </a>
                    <a  class="btn btn-danger btn-sm"
                    data-bs-toggle="modal" data-bs-target="#modalConfirmation">
                        <i class="fa fa-trash " style="color: white; padding:3px;"></i>
                    </a>       
                    </div>



                            
                    </td>
                    </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
                
    </div>




        <!-- Modal d'ajoute -->
        <div class="modal fade" id="modalConfirmation" tabindex="-1" aria-labelledby="modalConfirmationLabel" aria-hidden="true" >
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="modalConfirmationLabel">Confirmation </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form method="POST" action="{{ route('settings.addUser') }}">
            <div class="container">
                @csrf

                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                    <div class="col">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('username') }}</label>

                    <div class="col">
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="role" class="col-md-4 col-form-label text-md-end">role</label>

                    <div class="col">
                        <select class="form-select" aria-label="Default select example" id="role" name="role" required autofocus>
                            <option value="admin" >responsable</option>
                            <option value="secretariat" >secretariat</option>
                        </select>
                        
                            
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                    <div class="col">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                    <div class="col">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Ajouter') }}
                        </button>
                    </div>
                </div>
                </div>
            </form>
                </div>
               
            
        </div>


        <!-- Modal de confirmation de suppression -->
        <div class="modal fade" id="modalConfirmation" tabindex="-1" aria-labelledby="modalConfirmationLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="modalConfirmationLabel">Confirmation de suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                Êtes-vous sûr(e) de vouloir supprimer cet élément ?
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form action="supprimer.php" method="POST">
                    <input type="hidden" name="id" value="">
                    <a class="btn btn-danger">Supprimer</a>
                </form>
                </div>
            </div>
            </div>
        </div>
  

@endsection
