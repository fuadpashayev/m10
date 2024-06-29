<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-5 bg-dark text-white" id="payment-create-card">
                    <div class="card-header">
                        <h4>Pay with m10</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label" for="amount">Amount</label>
                            <div class="input-group">
                                <input type="number" name="amount" id="amount" class="form-control" placeholder="0.00" />
                                <span class="input-group-text" id="basic-addon2">₼</span>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button class="btn btn-primary" id="generate-payment">Generate payment</button>
                        </div>
                    </div>
                </div>
                <div class="card mt-5 bg-dark text-white" id="payment-process-card">
                    <div class="card-header">
                        <h4>Pay with m10</h4>
                    </div>
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="amount">Amount:</label>
                            <strong id="amount-text"></strong> ₼
                        </div>
                        <video id="qr"></video>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <script>

        const paymentCreateCard = document.getElementById('payment-create-card');
        const paymentProcessCard = document.getElementById('payment-process-card');

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('generate-payment').addEventListener('click', function() {
                document.getElementById('amount-text').innerText = document.getElementById('amount').value;
                paymentCreateCard.style.display = 'none';
                paymentProcessCard.style.display = 'block';
            });
        });

        const html5QrCode = new Html5Qrcode("qr");
        Html5Qrcode.getCameras().then(devices => {
            if (devices && devices.length) {
                const config = {fps: 100, qrbox: {width: 250, height: 250}};
                html5QrCode.start({facingMode: "environment"}, config, (decodedText) => {
                   console.log({decodedText});
                });

            }
        }).catch(cameraError => {
            console.log('Kamera xətası: ' + cameraError?.toString());
        });

    </script>
</x-app-layout>
