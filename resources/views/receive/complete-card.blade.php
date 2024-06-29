<div class="container" id="payment-complete-card">
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
            <label for="amount">Amount: </label>
            <span><span id="amount-text"></span> ₼</span>
        </div>

        <div class="form">
            <div class="pin-code-inputs">
                <input type="password" maxlength="1" autocomplete="off">
                <input type="password" maxlength="1" autocomplete="off">
                <input type="password" maxlength="1" autocomplete="off">
                <input type="password" maxlength="1" autocomplete="off">
            </div>
        </div>

        <button class="btn" id="complete-payment">Complete Payment</button>
    </div>
</div>
