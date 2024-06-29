<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.2/axios.min.js"></script>
<script src="https://unpkg.com/html5-qrcode"></script>

<script>
    let isProcessing = false;
    let transactionId = null;
    const html5QrCode = new Html5Qrcode("qr");
    const paymentCreateCard = document.getElementById('payment-create-card');
    const paymentQRCard = document.getElementById('payment-qr-card');
    const paymentCompleteCard = document.getElementById('payment-complete-card');
    const paymentSuccessCard = document.getElementById('payment-success-card');
    const paymentFailCard = document.getElementById('payment-fail-card');

    document.getElementById('generate-payment').addEventListener('click', function() {
        document.getElementById('amount-text').innerText = document.getElementById('amount').value;
        hide(paymentCreateCard);
        // show(paymentCompleteCard);
        show(paymentQRCard);
        startScan();
    });

    document.getElementById('complete-payment').addEventListener('click', function (){
        completePayment();
    });

    const show = element => element.style.display = 'block';
    const hide = element => element.style.display = 'none';

    const startScan = () => {
        Html5Qrcode.getCameras().then(devices => {
            if (devices && devices.length) {
                const config = {fps: 100, qrbox: {width: 370, height: 450}};
                html5QrCode.start({facingMode: "environment"}, config, (decodedText) => {
                    if(!isProcessing) {
                        isProcessing = true;
                        const {fr: payer_id} = JSON.parse(decodedText);
                        generatePayment(payer_id);
                    }
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

            hide(paymentQRCard);
            show(paymentCompleteCard);

        } catch (e) {
            console.log({e})
        } finally {
            html5QrCode.stop();
        }
    }

    const getPinCode = () => {
        let pinCode = '';
        document.querySelectorAll('.pin-code-inputs input').forEach(input => pinCode += input.value);
        return pinCode;
    }

    const completePayment = async () => {
        try {
            const response = await axios.post(`/transactions/${transactionId}/complete`, {pin_code: getPinCode()});
            hide(paymentCompleteCard);
            show(paymentSuccessCard);

            console.log({response})
        } catch (e) {
            hide(paymentCompleteCard);
            show(paymentFailCard);
            console.log({e})
        }
    }

    document.querySelectorAll('.pin-code-inputs input').forEach(input => {
        input.addEventListener('input', () => {
            if(input.value.length === 1 && input.nextElementSibling?.tagName === 'INPUT') {
                input.nextElementSibling.focus();
            }
        });
    });

</script>
