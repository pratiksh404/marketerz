<div class="row">
    <div class="col-lg-6">
        <div class="mb-2">
            <label for="particular">Particular</label>
            <div class="input-group">
                <input type="text" name="particular" id="particular" class="form-control"
                    value="{{$expense->particular ?? old('particular')}}" placeholder="Particular">
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-2">
            <label for="amount">Expense Amount</label>
            <div class="input-group">
                <span class="input-group-text">{{config('adminetic.currency_symbol','Rs.')}}</span>
                <input type="number" name="amount" id="amount" class="form-control"
                    value="{{$expense->amount ?? old('amount')}}" placeholder="Expense Amount">
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="mt-3">
            <label for="payment_method">Payment Method</label>
            <div class="col">
                <div class="m-t-15 m-checkbox-inline custom-radio-ml">
                    <div class="form-check form-check-inline radio radio-primary">
                        <input class="form-check-input" id="bank" type="radio" name="payment_method" value="1"
                            {{isset($expense->payment_method) ? ($expense->getRawOriginal('payment_method') == 1 ? 'checked' : '') : 'checked'}}>
                        <label class="form-check-label mb-0" for="bank">Bank</label>
                    </div>
                    <div class="form-check form-check-inline radio radio-primary">
                        <input class="form-check-input" id="esewa" type="radio" name="payment_method" value="2"
                            {{isset($expense->payment_method) ? ($expense->getRawOriginal('payment_method') == 2 ? 'checked' : '') : ''}}>
                        <label class="form-check-label mb-0" for="esewa">e-Sewa</label>
                    </div>
                    <div class="form-check form-check-inline radio radio-primary">
                        <input class="form-check-input" id="khalti" type="radio" name="payment_method" value="3"
                            {{isset($expense->payment_method) ? ($expense->getRawOriginal('payment_method') == 3 ? 'checked' : '') : ''}}>
                        <label class="form-check-label mb-0" for="khalti">Khalti</label>
                    </div>
                    <div class="form-check form-check-inline radio radio-primary">
                        <input class="form-check-input" id="imepay" type="radio" name="payment_method" value="4"
                            {{isset($expense->payment_method) ? ($expense->getRawOriginal('payment_method') == 4 ? 'checked' : '') : ''}}>
                        <label class="form-check-label mb-0" for="imepay">IMEPay</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <label for="remark">Remark</label>
        <textarea name="remark" id="heavytexteditor" cols="30" rows="10" class="heavytexteditor">
            @isset($expense->remark)
                {!! $expense->remark !!}
            @endisset
        </textarea>
    </div>
</div>
<x-adminetic-edit-add-button :model="$expense ?? null" name="Expense" />