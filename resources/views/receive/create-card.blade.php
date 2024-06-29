<div class="container" id="payment-create-card">
    <div class="header">
        <img src="{{asset('icons/back.png')}}" alt="" />
    </div>

    <div class="body">
        <div class="body-header">
            <img src="{{asset('icons/logo.png')}}" alt="" />
            <div class="title">Payment</div>
        </div>

        <div id="payment-icon">
            <img src="{{asset('icons/payment-icon.png')}}" alt="">
        </div>

        <div class="form">
            <label for="amount">Amount</label>
            <div class="input-group">
                <input type="number" id="amount" autocomplete="off"/>
                <span>₼</span>
            </div>
        </div>

        <button class="btn" id="generate-payment">Generate Payment</button>
    </div>
</div>
