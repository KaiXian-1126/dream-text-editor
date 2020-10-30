@extends("/layout/general-layout")
@section('content')
    
            
            <h1 class="text-center">Dream Text Editor</h1>
            <h3 class="text-center">All Documents</h3>
            <a style="margin-left: 50px; padding: 10px;" href="/">Back to Welcome Page</a>
            <br><br><br>
            <table class="table table-hover table-dark align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Docs Title</th>
                    <th>Created Date</th>
                    <th>Modified Date</th>
                    <th colspan="2">Action</th>
                </tr>
                <thead>
                <tbody>
                @foreach($allDocs as $doc)
                <tr>
                    <td>{{($loop->index + 1)}}</td>
                    <td>{{$doc->doc_title}}</td>
                    <td>{{$doc->created_at}}</td>
                    <td>{{$doc->updated_at}}</td>
                    <td><a href="update-doc/{{$doc->id}}">Update</td>
                    <td><a href="delete-doc/{{$doc->id}}">Delete</td>
                </tr>
                @endforeach
                </tbody>
            </table>
                
            
            <br><br>
        </div>
@endsection