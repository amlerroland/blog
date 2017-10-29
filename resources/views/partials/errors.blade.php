@if(session('success'))
    <hr>
    <div class="alert alert-success alert-dismissible" id="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <hr>
    <div class="alert alert-danger alert-dismissible" id="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ session('error') }}
    </div>
@endif