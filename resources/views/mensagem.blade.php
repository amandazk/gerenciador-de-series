 {{-- se a variável mesagem não estiver vazia, mostro a class --}}
@if (!empty($mensagem))
    <div class="alert alert-success">
        {{ $mensagem }}
    </div>
@endif
