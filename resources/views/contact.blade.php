<!-- resources/views/contact.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Contactez-nous</h1>
    <p>
        Vous pouvez nous joindre par e-mail à <strong>contact@akom.cm</strong> ou nous écrire directement via ce formulaire :
    </p>

    <form action="#" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nom" class="form-label">Nom :</label>
            <input type="text" id="nom" name="nom" class="form-control">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email :</label>
            <input type="email" id="email" name="email" class="form-control">
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">Message :</label>
            <textarea id="message" name="message" rows="4" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Envoyer</button>
    </form>
</div>
@endsection
