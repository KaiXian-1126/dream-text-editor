@extends("/layout/general-layout")
@section('content')
        
            <form method="POST" action="/shared/view-shared-doc">
                @csrf
                    <div class="text-center">
                        <h1>Dream Text Editor</h1>
                        <h3>Shared With Me</h3>
                        <br/><br/>
                    </div>
                    <a href="/" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Back to Welcome Page</a>
                    <br/><br/>

                   
                    <div class="card shared-doc-form">
                        <div class="card-body text-center">           
                            <p class="">Enter Shared Document Code</p>
                        </div>
                        <div class="card-body">            
                            <input type="text" name="doc-code" class="form-control text-center" placeholder="Access Code" aria-label="Access Code" aria-describedby="basic-addon1">
                        </div>
                        <div class="card-body text-center">
                            <input class="btn btn-light border border-dark" type="submit" value="Submit">
                        </div>
                    </div>
                    @if(session('message'))    
                    <div class="alert alert-danger alert-dismissible fade-in text-center mt-3">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <p class="mb-0">{{ session('message')}}</p>
                    </div>
                    @endif
                   
                        
                    
                  
                    
                    
            </form>
                <br><br>
            </div>
        </div>
@endsection
