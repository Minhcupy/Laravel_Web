@component('mail::message')
# Hóa đơn của bạn

Cảm ơn bạn đã đặt hàng tại **Mimi Shop**. Dưới đây là thông tin đơn hàng của bạn:

**Mã đơn hàng:** {{ $order->id }}  
**Ngày:** {{ $order->created_at->format('d/m/Y H:i') }}  
**Tổng:** {{ number_format($order->total, 0, ',', '.') }} VNĐ

@component('mail::table')
| Sản phẩm | Giá | Số lượng | Thành tiền |
|----------|-----|----------|------------|
@foreach($order->items as $item)
| {{ $item->product->name }} | {{ number_format($item->price,0,',','.') }} | {{ $item->quantity }} | {{ number_format($item->price * $item->quantity,0,',','.') }} |
@endforeach
@endcomponent

Cảm ơn bạn đã mua sắm!  
**Mimi Shop**
@endcomponent
