@if(session('success'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    <strong> Success !</strong> {{session('success')}}
    </div>
    
    <script>
      $(".alert").alert();
    </script>
@endif
@if(session('danger'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    <strong> Oopsss !</strong> {{session('danger')}}
    <div class="card  mt-2" style="text-align:center;background:palegoldenrod;margin:0 auto;">
      <div class="card-header" style="background:coral;border:peru 1px solid;border-radius:10px;width:50%;margin:10px auto">
          <strong>Would you like to share your answer?</strong>
      </div>
      <div class="card-body" style="text-align:center">
          
          <a href="{{url('/login')}}" class="btn btn-outline-success">Are you a member? Login here</a>
          
          <a href="{{url('/register')}}" class="btn btn-outline-primary ">It is never too late to register here</a>
      </div>
      {{-- <div class="card-footer text-muted">
          Footer
      </div> --}}
  </div>
    </div>
    
    <script>
      $(".alert").alert();
    </script>
@endif