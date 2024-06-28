<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-5" id="payment-create-card">
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
                <div class="card mt-5" id="payment-process-card">
                    <div class="card-header">
                        <h4>Pay with m10</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            @csrf
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const paymentCreateCard = document.getElementById('payment-create-card');
        const paymentProcessCard = document.getElementById('payment-process-card');

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('generate-payment').addEventListener('click', function() {
                this.style.display = 'none';
                document.getElementById('payment-process-card').style.display = 'block';
            });
        });
    </script>
</x-app-layout>
