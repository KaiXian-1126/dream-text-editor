@extends("/layout/general-layout")
@section('content')
            <form method="POST" action="/docsManager/save-updated-doc/{{ $doc->id }}">
                @csrf
                    <div class="text-center">
                    <h1>Dream Text Editor</h1>
                    <h3>Shared Document - Edit Mode</h3>
                    <br/><br/>
                    </div>
                    <a href="/" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Back to Welcome Page</a>
                    <br/><br/>
                    <div class="text-center">
                    <input style="border-bottom: 2px solid grey" value="{{ $doc->doc_title }}" class="text-center border-bottom" type="text" name="doc_title" placeholder="Doc Title" required/>
                    </div>
                    <div style="margin:50px 50px; border: 10px solid black;">
                    <textarea name="doc_content" style="border: 10px solid black;">{{ $doc->doc_content }}</textarea>
                    </div>
                        
                        <div class="text-center">
                        <input class="btn btn-outline-secondary" type="submit" value="Submit">
                        </div>
                        
                    
                    
                </form>
            <br><br>
        </div>
@endsection
