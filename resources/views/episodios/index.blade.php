@extends('layout')

@section('cabecalho')
    Episódios
@endsection

@section('conteudo')
   
    @include('mensagem', ['mensagem' => $mensagem])

    <form action="/temporadas/{{ $temporadaId }}/episodios/assistir" method="POST">
        @csrf
        <ul class="list-group">
            @foreach ($episodios as $episodio)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Episódio {{ $episodio->numero }}
                    {{-- para receber em forma de array --}}
                    <input type="checkbox" name="episodios[]" {{-- se o episodio foi
                        assistido, marca como checked --}} value="{{ $episodio->id }}"
                        {{ $episodio->assistido ? 'checked' : '' }}>
                </li>
            @endforeach
        </ul>

        <button class="btn btn-primary mt-2 mb-2">Salvar</button>
    </form>
@endsection
