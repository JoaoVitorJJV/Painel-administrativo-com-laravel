@extends('adminlte::page')

@section('title', 'Páginas')

@section('content_header')
    <h1>
       Páginas
        <a href="{{ route('page.create')}}" class="btn btn-sm btn-success">+ Nova</a>
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
                    <th width="50">ID</th>
                    <th>Nome</th>
                    <th width="200">Ações</th>
                </thead>
            </tr>
            <tbody>
                @foreach($pages as $page)
                    <tr>
                        <td>{{$page->id}}</td>
                        <td>{{$page->title}}</td>
                        <td>
                            <a href="" target="_blank" class="btn btn-success btn-sm">Ver</a>
                            <a href="{{ route('page.edit', ['page'=>$page->id]) }}" class="btn btn-info btn-sm">Editar</a>
                            <form method="POST" action="{{ route('page.destroy', ['page'=>$page->id]) }}" class="d-inline" onsubmit="return confirm('Tem certeza, mano?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
{{$pages->links('pagination::bootstrap-4')}}

@endsection