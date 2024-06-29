<div class="container payment-result-card" id="payment-{{$type}}-card">
    <div class="header">
        <img src="{{asset('icons/back.png')}}" alt="" />
    </div>

    <div class="body">
        <div class="body-header">
            <img src="{{asset('icons/logo.png')}}" alt="" />
        </div>

        <div class="payment-result">
            <div class="result-icon">
                <img src="{{asset("icons/$type.png")}}" alt="">
            </div>
            <div class="result-title">{{$type === 'success' ? 'Completed' : 'Failed'}}!</div>
            @if($type === 'success')
                <div class="result-desc">Your payment has been successfully processed</div>
            @else
                <div class="result-desc">Your payment is failed</div>
            @endif
        </div>

        <button class="btn" id="complete-payment">Home Page</button>
    </div>
</div>
