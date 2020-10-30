@extends("/layout/general-layout")
@section('content')
            <form method="POST" action="/docsManager/save-updated-doc/{{ $doc->id }}">
                @csrf
                    <div class="text-center">
                    <h1>Dream Text Editor</h1>
                    <h3>New Document</h3>
                    <br/><br/>
                    </div>
                    <a style="margin-left: 50px; padding: 10px;" href="/">Back to Welcome Page</a>
                    <br/><br/>
                    <div class="text-center">
                    <input style="border-bottom: 2px solid grey" value="{{ $doc->doc_title }}" class="text-center border-bottom" type="text" name="doc_title" placeholder="Doc Title" required/>
                        <br>
                        <br>
                        <input style="border-bottom: 2px solid grey" class="text-center border-bottom" type="text" value="{{$username}}" name="doc_owner" placeholder="Owner" disabled required/>
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
