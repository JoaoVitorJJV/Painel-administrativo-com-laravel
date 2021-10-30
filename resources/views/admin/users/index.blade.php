@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <h1>
        Meus usuários
        <a href="{{ route('user.create')}}" class="btn btn-sm btn-success">+ Novo</a>
    </h1>
@endsection

@section('content')
    @if(session('warning'))
        <div class="alert alert-success alert-dismissible">
                <h6>
                    <i class="icon fas fa-check"></i>
                    {{session('warning')}}
                </h6>
        </div>
    @endif

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <tr>
                <thead>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Ações</th>
                </thead>
            </tr>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <a href="{{ route('user.edit', ['user'=>$user->id]) }}" class="btn btn-info btn-sm">Editar</a>
                            @if($loggedId !== intval($user->id))
                                <form method="POST" action="{{ route('user.destroy', ['user'=>$user->id]) }}" class="d-inline" onsubmit="return confirm('Tem certeza, mano?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Excluir</button>
                                </form>
                            @endif
                            @if($loggedId !== intval($user->id))
                                @if($user->admin === 0)
                                    <a class="btn btn-warning btn-sm" href="{{route('user.define.admin', ['user'=>$user->id])}}">Definir Admin</a>
                                @endif    
                            @endif
                            @if($loggedId !== intval($user->id))
                                @if($user->admin === 1)
                                    <a class="btn btn-danger btn-sm" href="{{route('user.remove.admin', ['user'=>$user->id])}}">Remover Admin</a>
                                @endif    
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
{{$users->links('pagination::bootstrap-4')}}

@endsection