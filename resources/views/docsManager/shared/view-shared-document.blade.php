@extends("/layout/general-layout")
@section('content')
           
                    <div class="text-center">
                    <h1>Dream Text Editor</h1>
                    <h3>Shared Document - View Mode</h3>
                    <br/><br/>
                    </div>
                    <a href="/" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Back to Welcome Page</a>
                    <br/><br/>
                    <div class="card">
                        <h5 class="card-header">{{ $doc->doc_title }}</h5>
                        <div class="card-body">
                            <p class="card-text">{!! $doc->doc_content !!}</p>
                        </div>
                    </div>
            <br><br>
        </div>
@endsection
