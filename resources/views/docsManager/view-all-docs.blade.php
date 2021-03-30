@extends("/layout/general-layout")
@section('content')
    
            
            <h1 class="text-center">Dream Text Editor</h1>
            <h3 class="text-center">All Documents</h3>
            <a href="/" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Back to Welcome Page</a>
            
            <!-- Search bar -->
            <form method="post" action="/docsManager/search">
            @csrf
                <div class="input-group mt-3 mb-3">
                    <input type="text" class="form-control" placeholder="Search" name="search">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Submit</button>
                    </div>
                </div>
            </form>
            <!-- table start -->
            <table class="table table-hover table-dark align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Docs Title</th>
                    <th>Created Date</th>
                    <th>Modified Date</th>
                    <th colspan="2">Action</th>
                    <th>Accessibility</th>
                </tr>
                <thead>
                <tbody>
                @if (sizeof($allDocs) == 0)
                    <div class="alert alert-danger alert-dismissible text-center fade-in">
                        <a href="#" class="close inline" data-dismiss="alert" aria-label="close">&times;</a>
                        <p class="mb-0">No Record Found</p>
                    </div>
                @else
                    @php
                        $counter = 1;
                    @endphp
                    @foreach($allDocs as $doc)
                    <tr>
                        <td>{{($loop->index + 1)}}</td>
                        <td>{{$doc->doc_title}}</td>
                        <td>{{$doc->created_at}}</td>
                        <td>{{$doc->updated_at}}</td>
                        <td><a href="update-doc/{{$doc->id}}">Update</td>
                        <td><a href="delete-doc/{{$doc->id}}">Delete</td>
                        <td>
                        <div class="row">
                            <div class="dropdown show mr-2">
                                <a class="btn btn-info dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ $doc->doc_accessibility }}
                                </a>


                                <div id="accessibility" name="accessibility" class="dropdown-menu" aria-labelledby="accessibility">
                                    <a class="dropdown-item" value="Private" href="/shared/update-accessibility/Private/{{ $doc->id }}">Private</a>
                                    <a class="dropdown-item" value="Viewed By Other" href="/shared/update-accessibility/Viewed By Other/{{ $doc->id }}">Viewed By Other</a>
                                    <a class="dropdown-item" value="Edited By Other" href="/shared/update-accessibility/Edited By Other/{{ $doc->id }}">Edited By Other</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @if($doc->doc_accessibility != "Private")
                            <div class="input-group mb-3 mr-2">
                                <input type="text" class="form-control copy-value" value="{{$doc->doc_access_code}}" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button value="@php echo $counter++; @endphp"  class="btn btn-outline-secondary bg-light copy" type="button">Copy</button>
                                </div>
                            </div>
                        </div>
                            @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
                
            <!-- table end -->
            <br><br>
        </div>
       <script>
            $(document).ready(function(){
                $(".copy").click(function(){
                    var val = $(this).val();
                    var doc_code = document.getElementsByClassName("copy-value")[val-1];
                    doc_code.select();
                    doc_code.setSelectionRange(0, 50)
                    document.execCommand("copy");
                    alert("Access Code Copied!");
                });
            });
        </script>
@endsection
