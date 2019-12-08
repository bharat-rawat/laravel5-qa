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
    </div>
    
    <script>
      $(".alert").alert();
    </script>
@endif