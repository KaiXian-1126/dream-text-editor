@extends("/layout/general-layout")
@section('content')
                <form method="POST" action="/docsManager/save-new-doc">
                @csrf
                    <div class="text-center">
                    <h1>Dream Text Editor</h1>
                    <h3>New Document</h3>
                    <br/><br/>
                    </div>
                    <a href="/" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Back to Welcome Page</a>
                    <br/><br/>
                    <div class="text-center">
                        <input style="border-bottom: 2px solid grey" class="border-bottom" type="text" name="doc_title" placeholder="Doc Title" required/>
                        <br>
                        <br>
                        <input style="border-bottom: 2px solid grey" class="border-bottom" type="text" name="doc_owner" placeholder="Owner" value="{{$username}}" required disabled/>
                    </div>
                    <div style="margin:50px 50px; border: 10px solid black;">
                        <textarea name="doc_content" style="border: 10px solid black;"></textarea>
                    </div>
                        
                        <div class="text-center">
                        <input class="btn btn-outline-secondary" type="submit" value="Submit">
                        </div>
                        
                    
                    
                </form>
                <br><br>
@endsection
