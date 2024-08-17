@extends('layout')

@section('content')

  <div>
    <a href="{{ url('customers/create') }}" class="btn btn-primary float-end"><i class="bx bx-plus"></i>New</a>
    <h4 class="fw-bold py-3 mb-2">Customers</h4>
  </div>

  <div class="card p-3">
    <!-- <h5 class="card-header">Table Basic</h5> -->
    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Full Name</th>
            <th>E-mail</th>
            <th>Phone</th>
            <th>Zip code</th>
            <th>Birth month</th>
            <th>Birth day</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
        @foreach($data as $customer)
          <tr>
            <td><strong>{{ $customer->name }}</strong></td>
            <td>{{ $customer->email }}</td>
            <td>{{ $customer->phone }}</td>
            <td>{{ $customer->zipcode }}</td>
            <td>{{ $months[$customer->birthmonth - 1] }}</td>
            <td>{{ $customer->birthday }}</td>
            <td>
              @if($customer->status)
                <span class="badge bg-label-success me-1">Active</span>
              @else
                <span class="badge bg-label-danger me-1">Inactive</span>
              @endif 
            </td>
            <td>
              <a href="#" class="btn btn-outline-dark btn-sm btn-show" title="Detail customer" data-value="{{ $customer->id }}">
                <i class="bx bx-search"></i>
              </a>
              <a href="{{ url('customers/'.$customer->id.'/edit') }}" class="btn btn-outline-dark btn-sm" title="Edit customer">
                <i class="bx bx-pencil"></i>
              </a>
              <form action="{{ url('customers/'.$customer->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                @if($customer->status)
                  <button type="submit" class="btn btn-outline-dark btn-sm" title="Inactivate customer" onclick="return confirm('Are you sure you want to inactivate this customer?')">
                    <i class="bx bx-trash"></i>
                  </button>
                @else
                  <button type="submit" class="btn btn-outline-dark btn-sm" title="Activate customer" onclick="return confirm('Are you sure you want to activate this customer?')">
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

  <div class="modal fade" id="customerModal" tabindex="-1" aria-labelledby="customerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="customerModalLabel">Customer details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="table table-striped">
            <tr>
              <th>Name:</th>
              <td><span id="customerName"></span></td>
            </tr>
            <tr>
              <th>Email:</th>
              <td><span id="customerEmail"></span></td>
            </tr>
            <tr>
              <th>Phone:</th>
              <td><span id="customerPhone"></span></td>
            </tr>
            <tr>
              <th>Birth Day:</th>
              <td><span id="customerBirthDay"></span></td>
            </tr>
            <tr>
              <th>Birth Month:</th>
              <td><span id="customerBirthMonth"></span></td>
            </tr>
            <tr>
              <th>Zipcode:</th>
              <td><span id="customerZipcode"></span></td>
            </tr>
            <tr>
              <th>Status:</th>
              <td><span id="customerStatus"></span></td>
            </tr>
            <tr>
              <th>Created at:</th>
              <td><span id="customerCreatedAt"></span></td>
            </tr>
            <tr>
              <th>Last update:</th>
              <td><span id="customerUpdatedAt"></span></td>
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
        
        months = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];
        
        customer = $(this).data('value');

        $.ajax({
          url : "customers/" + customer,
          method : 'GET',
          success : function(data){
            $('#customerName').text(data.customer.name);
            $('#customerEmail').html('<a style="text-decoration:underline" href="mailto:'+data.customer.email+'">'+data.customer.email+'</a>');
            $('#customerPhone').html('<a href="tel:'+data.customer.phone+'">'+data.customer.phone+'</a>');
            $('#customerBirthDay').text(data.customer.birthday);
            $('#customerBirthMonth').text(months[data.customer.birthmonth-1]);
            $('#customerZipcode').text(data.customer.zipcode);

            if(data.customer.status)
              $('#customerStatus').html('<span class="badge bg-label-success me-1">Active</span>');
            else
              $('#customerStatus').html('<span class="badge bg-label-danger me-1">Inactive</span>');

            var options = { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric', timeZoneName: 'short' };
            var date = new Date(data.customer.created_at);
            var date2 = new Date(data.customer.updated_at);
            var formatted_date = date.toLocaleDateString('en-US', options);
            var formatted_date2 = date2.toLocaleDateString('en-US', options);

            $('#customerCreatedAt').text(formatted_date);
            $('#customerUpdatedAt').text(formatted_date2);
            
            $("#customerModal").modal("toggle");
          }
        });

      });
    });
  </script>
@stop