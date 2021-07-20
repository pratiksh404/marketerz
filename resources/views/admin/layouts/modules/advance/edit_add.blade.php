<div class="row">
    {{-- Hidden Input --}}
    <input type="hidden" name="client_id" value="{{$client->id ?? $advance->client_id ?? null}}">
    <div class="col-lg-12">
        <div class="mb-3">
            <label for="amount">Advance Amount</label>
            <div class="input-group">
                <span class="input-group-text">{{config('adminetic.currency_symbol','Rs.')}}</span>
                <input type="number" name="amount" id="amount" class="form-control" min="0"
                    value="{{$advance->amount ?? old('amount') ?? 0}}" placeholder="Advance Amount">
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <div class="mb-3">
            <label for="remark">Remark</label>
            <textarea name="remark" id="heavytexteditor" cols="30" rows="10">
                                                            @isset($advance->remark)
                                                                {!! $advance->remark !!}
                                                            @endisset
                                                        </textarea>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <div class="mt-3">
            <label for="payment_method">Payment Method</label>
            <div class="col">
                <div class="m-t-15 m-checkbox-inline custom-radio-ml">
                    <div class="form-check form-check-inline radio radio-primary">
                        <input class="form-check-input" id="bank" type="radio" name="payment_method" value="1"
                            {{isset($advance->payment_method) ? ($advance->getRawOriginal('payment_method') == 1 ? 'checked' : '') : 'checked'}}>
                        <label class="form-check-label mb-0" for="bank">Bank</label>
                    </div>
                    <div class="form-check form-check-inline radio radio-primary">
                        <input class="form-check-input" id="esewa" type="radio" name="payment_method" value="2"
                            {{isset($advance->payment_method) ? ($advance->getRawOriginal('payment_method') == 2 ? 'checked' : '') : ''}}>
                        <label class="form-check-label mb-0" for="esewa">e-Sewa</label>
                    </div>
                    <div class="form-check form-check-inline radio radio-primary">
                        <input class="form-check-input" id="khalti" type="radio" name="payment_method" value="3"
                            {{isset($advance->payment_method) ? ($advance->getRawOriginal('payment_method') == 3 ? 'checked' : '') : ''}}>
                        <label class="form-check-label mb-0" for="khalti">Khalti</label>
                    </div>
                    <div class="form-check form-check-inline radio radio-primary">
                        <input class="form-check-input" id="imepay" type="radio" name="payment_method" value="4"
                            {{isset($advance->payment_method) ? ($advance->getRawOriginal('payment_method') == 4 ? 'checked' : '') : ''}}>
                        <label class="form-check-label mb-0" for="imepay">IMEPay</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-adminetic-edit-add-button :model="$advance ?? null" name="Advance Payment" />