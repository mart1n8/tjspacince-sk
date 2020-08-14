@if(session('succeed'))
    <div class="alert alert-success alert-dismissible fade show" style="margin:10px" role="succeed">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
        {{ session('succeed') }}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" style="margin:10px" role="danger">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
        {{ session('error') }}
    </div>
@endif
