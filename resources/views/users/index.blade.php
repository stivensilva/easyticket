@extends('layout')

@section('content')

  <div>
    <a href="{{ url('users/create') }}" class="btn btn-primary float-end"><i class="bx bx-plus"></i>New</a>
    <h4 class="fw-bold py-3 mb-2">Users</h4>
  </div>

  <div class="card p-3">
    <!-- <h5 class="card-header">Table Basic</h5> -->
    <div class="table-responsive text-nowrap">
      <table class="table table-hover ">
        <thead>
          <tr>
            <th>Full Name</th>
            <th>E-mail</th>
            <th>Role</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
        @foreach($data as $user)
          <tr>
            <td><strong>{{ $user->name }}</strong></td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>
              @if($user->status)
                <span class="badge bg-label-success me-1">Active</span>
              @else
                <span class="badge bg-label-danger me-1">Inactive</span>
              @endif 
            </td>
            <td>
              <a href="#" class="btn btn-outline-dark btn-sm btn-show" title="Detail user" data-value="{{ $user->id }}">
                <i class="bx bx-search"></i>
              </a>
              <a href="{{ url('users/'.$user->id.'/edit') }}" class="btn btn-outline-dark btn-sm" title="Edit user">
                <i class="bx bx-pencil"></i>
              </a>
              <form action="{{ url('users/'.$user->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                @if($user->status)
                  <button type="submit" class="btn btn-outline-dark btn-sm" title="Inactivate user" onclick="return confirm('Are you sure you want to inactivate this user?')">
                    <i class="bx bx-trash"></i>
                  </button>
                @else
                  <button type="submit" class="btn btn-outline-dark btn-sm" title="Activate user" onclick="return confirm('Are you sure you want to activate this user?')">
                    <i class="bx bx-recycle"></i>
                  </button>
                @endif
              </form>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="userModalLabel">User details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="table table-striped">
            <tr>
              <th>Name:</th>
              <td><span id="userName"></span></td>
            </tr>
            <tr>
              <th>E-mail:</th>
              <td><span id="userEmail"></span></td>
            </tr>
            <tr>
              <th>Role:</th>
              <td><span id="userRole"></span></td>
            </tr>
            <tr>
              <th>Status:</th>
              <td><span id="userStatus"></span></td>
            </tr>
            <tr>
              <th>Created at:</th>
              <td><span id="userCreatedAt"></span></td>
            </tr>
            <tr>
              <th>Last update:</th>
              <td><span id="userUpdatedAt"></span></td>
            </tr>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

@stop

@section('scripts')

  <script>
  
    $(document).ready(function(){

      $('body').on('click', '.btn-show', function(){
      
        user = $(this).data('value');

        $.ajax({
          url : "users/" + user,
          method : 'GET',
          success : function(data){
            $('#userName').text(data.user.name);
            $('#userEmail').html('<a style="text-decoration:underline" href="mailto:'+data.user.email+'">'+data.user.email+'</a>');
            $('#userRole').text(data.user.role);

            if(data.user.status)
              $('#userStatus').html('<span class="badge bg-label-success me-1">Active</span>');
            else
              $('#userStatus').html('<span class="badge bg-label-danger me-1">Inactive</span>');

            var options = { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric', timeZoneName: 'short' };
            var date = new Date(data.user.created_at);
            var date2 = new Date(data.user.updated_at);
            var formatted_date = date.toLocaleDateString('en-US', options);
            var formatted_date2 = date2.toLocaleDateString('en-US', options);

            $('#userCreatedAt').text(formatted_date);
            $('#userUpdatedAt').text(formatted_date2);
            
            $("#userModal").modal("toggle");
          }
        });

      });
    
    });

  </script>
@stop