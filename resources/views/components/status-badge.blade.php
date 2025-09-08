@props(['status'])

@switch($status)
    @case('in_cart')   
        <span class="badge bg-secondary">Trong giỏ hàng</span> 
        @break
    @case('ordered')   
        <span class="badge bg-info">Đã đặt hàng</span> 
        @break
    @case('completed') 
        <span class="badge bg-success">Hoàn thành</span> 
        @break
    @case('cancelled') 
        <span class="badge bg-danger">Đã hủy</span> 
        @break
    @default           
        <span class="badge bg-dark">Không xác định</span>
@endswitch
