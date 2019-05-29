@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Error!</h4>
        @foreach ($errors->all() as $error)
            <li> {{ $error }}</li>
        @endforeach
    </div>
@endif
@if (\Session::has('alert-dialog'))
    <div class="alert alert-{{session('alert-dialog')['type']}}" role="alert">
        <h4 class="alert-heading">{{ session('alert-dialog')['title'] }}</h4>
            <li> {{ session('alert-dialog')['message'] }}</li>
    </div>

@endif
