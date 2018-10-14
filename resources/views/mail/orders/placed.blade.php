@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            Orite Copier and Supplies
        @endcomponent
    @endslot
{{-- Body --}}
    <h1><strong>Hello,</strong> <span>{{ $customer->first_name . ' ' . $customer->last_name }}</span></h1>
    Thank you for shopping with us!

    Your orders:
    @foreach($orders as $order)
    {{ explode('splitHere', $order->name)[0] . '    x' . $order->quantity }} - {{ 'Php ' . number_format($order->quantity * $order->price, 2) }}
    @endforeach

    Total: {{ 'Php ' . number_format($total, 2) }}
    
    Have been received and is undergoing verification. we will send you a notification once the verification is done. Thank you for shopping!
{{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset
{{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        @endcomponent
    @endslot
@endcomponent