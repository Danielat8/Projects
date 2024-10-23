@if(session('success'))
<div class="alert alert-success d-flex align-items-center mb-4" role="alert" style="margin-top: 60px;">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
        <use xlink:href="#check-circle-fill"></use>
    </svg>
    <div>
        {{ session('success') }}
    </div>
    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif