<div class="row">
    {{-- HIDDEN INPUT --}}
    <input type="hidden" name="project_id" value="{{$payment->project_id ?? null}}">
    <div class="col-lg-12">
        <label for="payment">Payment</label>
        <div class="input-group">
            <span class="input-group-text">{{config('adminetic.currency_symbol','Rs.')}}</span>
            <input type="number" name="payment" class="form-control" id="payment"
                value="{{$payment->payment ?? old('payment') ?? 0}}" placeholder="Payment" min="0"
                max="{{$payment->project->price - ($payment->project->paid_amount - $payment->payment)}}">
        </div>
    </div>
    <div class="col-lg-12">
        <div class="mt-3">
            <label for="payment_method">Payment Method</label>
            <div class="col">
                <div class="m-t-15 m-checkbox-inline custom-radio-ml">
                    <div class="form-check form-check-inline radio radio-primary">
                        <input class="form-check-input" id="bank" type="radio" name="payment_method" value="1"
                            {{isset($payemnt->payment_method) ? ($payment->getRawOriginal('payment_method') == 1 ? 'checked' : '') : 'checked'}}>
                        <label class="form-check-label mb-0" for="bank">Bank</label>
                    </div>
                    <div class="form-check form-check-inline radio radio-primary">
                        <input class="form-check-input" id="esewa" type="radio" name="payment_method" value="2"
                            {{isset($payemnt->payment_method) ? ($payment->getRawOriginal('payment_method') == 2 ? 'checked' : '') : ''}}>
                        <label class="form-check-label mb-0" for="esewa">e-Sewa</label>
                    </div>
                    <div class="form-check form-check-inline radio radio-primary">
                        <input class="form-check-input" id="khalti" type="radio" name="payment_method" value="3"
                            {{isset($payemnt->payment_method) ? ($payment->getRawOriginal('payment_method') == 3 ? 'checked' : '') : ''}}>
                        <label class="form-check-label mb-0" for="khalti">Khalti</label>
                    </div>
                    <div class="form-check form-check-inline radio radio-primary">
                        <input class="form-check-input" id="imepay" type="radio" name="payment_method" value="4"
                            {{isset($payemnt->payment_method) ? ($payment->getRawOriginal('payment_method') == 4 ? 'checked' : '') : ''}}>
                        <label class="form-check-label mb-0" for="imepay">IMEPay</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-adminetic-edit-add-button :model="$payment ?? null" name="Payment" />