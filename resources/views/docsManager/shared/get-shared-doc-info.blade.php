@extends("/layout/general-layout")
@section('content')
    
            <form method="POST">
                @csrf
                    <div class="text-center">
                        <h1>Dream Text Editor</h1>
                        <h3>Shared With Me</h3>
                        <br/><br/>
                    </div>
                    <a style="margin-left: 50px; padding: 10px;" href="/">Back to Welcome Page</a>
                    <br/><br/>

                    <div class="">
                            <div class="row text-center">
                                <div class="col">
                                    <div class="">
                                        <p>Enter Shared Document Code</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row text-center mx-3">
                                <div class="col">
                                    <input type="text" name="doc-code" required/>
                                </div>
                            </div>
                        
                        <div class="text-center">
                            <input class="btn btn-outline-secondary" type="submit" value="Submit">
                        </div>
                    </div>    
                    
                    
            </form>
                <br><br>
        </div>
@endsection
