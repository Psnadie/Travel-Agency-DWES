@extends('template.base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detalle del usuario</div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>#</th>
                            <td>{{ $user->id }}</td>
                        </tr>
                        <tr>
                            <th>Nombre</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Rol</th>
                            <td>{{ $user->rol }}</td>
                        </tr>
                        <tr>
                            <th>Verificado</th>
                            <td>@if($user->hasVerifiedEmail()) ✓ Sí @else ✗ No @endif</td>
                        </tr>
                        <tr>
                            <th>Creado</th>
                            <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <a href="{{ route('user.index') }}" class="btn btn-secondary btn-sm">Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection