@if (isset($shortDescription) && isset($longDescription))
    <div class="container position-relative">
        <h2 class="section-title mb-4 text-primary">Описание</h2>
        <div class="d-flex flex-column">
            <div>
                {!! $shortDescription !!}
            </div>

            <a class="text-primary mt-2" data-bs-toggle="collapse" href="#fullDescription" role="button"
                aria-expanded="false" aria-controls="fullDescription">
                Читать полностью
            </a>

            <div class="collapse mt-2" id="fullDescription">
                <div class="card card-body border-0 p-0">
                    {!! $longDescription !!}
                </div>
            </div>
        </div>
    </div>
@endif
