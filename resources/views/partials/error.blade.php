@if(session()->has('error'))
    <div class="alert alert-dismissable alert-danger fade show text-center ml-3 mr-3">
        <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>
            {{ session()->get('error') }}
        </strong>
    </div>
@endif