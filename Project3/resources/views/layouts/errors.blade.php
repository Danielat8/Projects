@if ($errors->any())
<div class="alert alert-danger d-flex align-items-center mb-4" role="alert" style="margin-top: 60px;">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Error:">
        <use xlink:href="#exclamation-triangle-fill"></use>
    </svg>
    <div>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif