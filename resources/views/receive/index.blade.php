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
                        <div class="form-group">
                            <label class="form-label" for="amount">Amount:</label>
                            <strong id="amount-text"></strong> ₼
                        </div>
                        <button id="simulate">Simulate</button>
                        <div id="qr"></div>
                    </div>
                </div>
                <div class="card mt-5 bg-dark text-white" id="payment-complete-card">
                    <div class="card-header">
                        <h4>Pay with m10</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label" for="pin_code">Pin code</label>
                            <div class="input-group">
                                <input type="number" name="pin_code" id="pin_code" class="form-control" />
                                <span class="input-group-text" id="basic-addon2">₼</span>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button class="btn btn-primary" id="complete-payment">Complete payment</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <script>
        let isProcessing = false;
        let transactionId = null;
        const paymentCreateCard = document.getElementById('payment-create-card');
        const paymentProcessCard = document.getElementById('payment-process-card');
        const paymentCompleteCard = document.getElementById('payment-complete-card');

        document.getElementById('simulate').addEventListener('click', function() {
            generatePayment(1)
        });

        document.getElementById('generate-payment').addEventListener('click', function() {
            document.getElementById('amount-text').innerText = document.getElementById('amount').value;
            paymentCreateCard.style.display = 'none';
            paymentProcessCard.style.display = 'block';
            startScan();
        });

        document.getElementById('complete-payment').addEventListener('click', function (){
           completePayment();
        });

        const startScan = () => {
            const html5QrCode = new Html5Qrcode("qr");
            Html5Qrcode.getCameras().then(devices => {
                if (devices && devices.length) {
                    const config = {fps: 100, qrbox: {width: 250, height: 250}};
                    html5QrCode.start({facingMode: "environment"}, config, (decodedText) => {
                        if(isProcessing) return;
                        isProcessing = true;

                        const {fr: payer_id} = JSON.parse(decodedText);
                        generatePayment(payer_id);
                    });

                }
            }).catch(cameraError => {
                console.log('Kamera xətası: ' + cameraError?.toString());
            });
        }

        const generatePayment = async (payer_id) => {
            try {
                const response = await axios.post('{{route('transactions.generate')}}', {
                    payer_id,
                    amount: document.getElementById('amount').valueAsNumber,
                    type: 'payment'
                });

                transactionId = response.data.transaction_id;

                paymentProcessCard.style.display = 'none';
                paymentCompleteCard.style.display = 'block';

            } catch (e) {
                console.log({e})
            } finally {
                setTimeout(() => {
                    isProcessing = false;
                }, 1000)
            }
        }

        const completePayment = async () => {
            try {
                const response = await axios.post(`/transactions/${transactionId}/complete`, {
                    pin_code: document.getElementById('pin_code').valueAsNumber
                });
                console.log({response})
            } catch (e) {
                console.log({e})
            }
        }


    </script>
</x-app-layout>
