@extends('layouts.Dashboard')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
        <h1 class="h2 mb-0">SHEFAA</h1>
        <h2 class="h4 mb-0">Facture</h2>
        </div>
    </div>
    

    <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-8">


        <div class="card">
            <div class="card-body">
            <h5 class="card-title">Patient</h5>
            <p class="card-text">Nom : Jean Dupont</p>
            <p class="card-text">Date de naissance : 01/01/1970</p>
            <p class="card-text">Adresse : 123 Rue des Champs</p>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
            <h5 class="card-title">Consultation</h5>
            <p class="card-text">Date : 01/01/2023</p>
            <p class="card-text">Heure : 10:00</p>
            <p class="card-text">Médecin : Dr. Martin Durand</p>
            <p class="card-text">Prix : 50€</p>
            </div>
        </div>
        <div class="text-center mt-5">
            <button class="btn btn-primary" onclick="downloadInvoice()">Télécharger la facture</button>
        </div>
        </div>
    </div>
    </div>

    <script>
    function downloadInvoice() {
        window.print();
    }
    </script>
    <!-- Importation de jQuery et Bootstrap 5 JS -->
    @endsection
