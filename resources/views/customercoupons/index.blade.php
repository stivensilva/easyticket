@extends('layout')

@section('content')

  <div>
    <h4 class="fw-bold py-3 mb-2">Customer coupons</h4>
  </div>

  <div class="card p-3">
    <!-- <h5 class="card-header">Table Basic</h5> -->
    <div class="table-responsive text-nowrap">
      <table class="table table-hover ">
        <thead>
          <tr>
            <th>Customer</th>
            <th>Coupon</th>
            <th>Redemption date</th>
            <th>Employee</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
        @foreach($data as $coupon)
          <tr>
            <td><strong>{{ $coupon->customer->name }}</strong></td>
            <td>{{ $coupon->coupon->promotion }}</td>
            <td>{{ $coupon->redemptiondate ? $coupon->redemptiondate : "Unredeemed yet" }}</td>
            <td>{{ isset($coupon->user->name) ? $coupon->user->name : '' }}</td>
            <td>
              @if($coupon->status == 1)
                <span class="badge bg-label-success me-1">Active</span>
              @elseif($coupon->status == 2)
                <span class="badge bg-label-info me-1">Pending</span>
              @elseif($coupon->status == 3)
                <span class="badge bg-label-warning me-1">Expired</span>
              @elseif($coupon->status == 4)
                <span class="badge bg-label-primary me-1">Redeemed</span>
              @else
                <span class="badge bg-label-danger me-1">Inactive</span>
              @endif 
            </td>
            <td>
              <a href="javascript:void(0);" class="btn btn-outline-dark btn-sm btn-show" title="Detail coupon" data-value="{{ $coupon->coupon_id }}">
                <i class="bx bx-search"></i>
              </a>
              
              <!--@if($coupon->status != 3 AND $coupon->status != 4)-->
              <!--  <form action="{{ url('customer-coupons/'.$coupon->id) }}" method="POST" class="d-inline">-->
              <!--      @csrf-->
              <!--      @method('DELETE')-->
              <!--      @if($coupon->status)-->
              <!--        <button type="submit" class="btn btn-outline-dark btn-sm" title="Inactivate coupon" onclick="return confirm('Are you sure you want to inactivate this coupon?')">-->
              <!--          <i class="bx bx-trash"></i>-->
              <!--        </button>-->
              <!--      @else-->
              <!--        <button type="submit" class="btn btn-outline-dark btn-sm" title="Activate coupon" onclick="return confirm('Are you sure you want to activate this coupon?')">-->
              <!--          <i class="bx bx-recycle"></i>-->
              <!--        </button>-->
              <!--      @endif-->
              <!--  </form>-->
              <!--@endif-->
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <div class="modal fade" id="couponModal" tabindex="-1" aria-labelledby="couponModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="couponModalLabel">coupon details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="coupon" style="text-align:center">
            <p id="couponProduct" style="font-size:38px; font-weight:bold; position: relative; top: 30px; color:#000"></p>
            <p id="couponPromotion" style="font-size:60px; font-weight:bold; position: relative; color:red; margin-bottom: -10px; margin-top: -5px;"></p>
            <p style="font-size:18px; margin-bottom:5px">
              <strong>From </strong><span id="couponStartdate"></span>  
              <strong>to </strong><span id="couponEnddate"></span>
            </p>
            <p id="couponStatus" style="font-size: 36px"></p>
          </div>

          <!-- <table class="table table-striped">
            <tr>
              <th>Product:</th>
              <td><span id="couponProduct"></span></td>
            </tr>
            <tr>
              <th>Promotion:</th>
              <td><span id="couponPromotion"></span></td>
            </tr>
            <tr>
              <th>Start date:</th>
              <td><span id="couponStartdate"></span></td>
            </tr>
            <tr>
              <th>End date:</th>
              <td><span id="couponEnddate"></span></td>
            </tr>
            <tr>
              <th>Status:</th>
              <td><span id="couponStatus"></span></td>
            </tr>
            <tr>
              <th>Created at:</th>
              <td><span id="couponCreatedAt"></span></td>
            </tr>
            <tr>
              <th>Last update:</th>
              <td><span id="couponUpdatedAt"></span></td>
            </tr>
          </table> -->
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
      
        coupon = $(this).data('value');
        btn = $(this);

        $.ajax({
          url : "coupons/" + coupon,
          method : 'GET',
          success : function(data){
            $('#couponProduct').text(data.coupon.product.name);
            $('#couponPromotion').text(data.coupon.promotion);
            $('#couponStartdate').text(data.coupon.startdate);
            $('#couponEnddate').text(data.coupon.enddate);
          
            var statusText = btn.closest('tr').find('span.badge').prop('outerHTML');
          
            console.log(statusText);
          
             $('#couponStatus').html(statusText);
          
            // if(data.coupon.status == 1)
            //   $('#couponStatus').html('<span class="badge bg-label-success me-1">Active</span>');
            // else if(data.coupon.status == 2)
            //   $('#couponStatus').html('<span class="badge bg-label-info me-1">Pending</span>');
            // else if(data.coupon.status == 3)
            //   $('#couponStatus').html('<span class="badge bg-label-warning me-1">Expired</span>');
            // else if(data.coupon.status == 4)
            //   $('#couponStatus').html('<span class="badge bg-label-primary me-1">Redeemed</span>');
            // else
            //   $('#couponStatus').html('<span class="badge bg-label-danger me-1">Inactive</span>');
             

            var options = { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric', timeZoneName: 'short' };
            var date = new Date(data.coupon.created_at);
            var date2 = new Date(data.coupon.updated_at);
            var formatted_date = date.toLocaleDateString('en-US', options);
            var formatted_date2 = date2.toLocaleDateString('en-US', options);

            $('#couponCreatedAt').text(formatted_date);
            $('#couponUpdatedAt').text(formatted_date2);
            
            $("#couponModal").modal("toggle");
          }
        });

      });
    
    });

  </script>
@stop