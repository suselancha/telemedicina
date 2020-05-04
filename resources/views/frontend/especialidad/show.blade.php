 <div class="service-area area-padding-top">
        <div class="container">            
            <div class="row">
            @foreach ($especialidades as $especialidad)
                <div class="col-md-6 col-lg-4">
                <strong>{{ $especialidad->nombre }}</strong>
                        <ul class="list-group list-group-flush">
                        @foreach ($especialidad->users as $e)
                            <li class="list-group-item">- {{ $e->name }}</li>
                        @endforeach
                        </ul>
                </div>
            @endforeach
            </div>
        </div>
    </div>    