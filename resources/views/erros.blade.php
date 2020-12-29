@if ($errors->any())
    <div class="alert alert-danger"> {{-- se existir algum erro, exibe essa div
        --}}
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
