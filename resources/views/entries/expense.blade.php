<form class="form-horizontal mt-4 submitForm" method="post" action="{{ route('entry.store') }}">
    @csrf
    <input type="hidden" name="type" value="expense">

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Categoria</label>
        <div class="col-sm-10">
            <select class="form-control select2" name="category_id" style="width: 100%;" id="categoriesExpense" required>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Descrição</label>
        <div class="col-sm-10">
            <input type="text" name="title" class="form-control" placeholder="Descrição" required>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Valor</label>
        <div class="col-sm-4">
            <input type="text" name="amount" class="form-control money" required>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Data de Vencimento</label>
        <div class="col-sm-4">
            <input type="text" name="due_date" id="due_date" class="form-control datepicker">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-2"></div>
        <div class="col-md-5">
            <div class="icheck-primary d-inline">
                <input type="checkbox" name="is_recurring" value="1" checked id="checkIsRecurring" onclick="toggle_div(this, 'divSelectBankAccount', true);" >
                <label for="checkIsRecurring">
                    Lançamento recorrente
                </label>
            </div>

            <div id="divSelectBankAccount" style="display: none" class="mt-4">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Conta bancária</label>
                    <div class="col-sm-8">
                        <select class="form-control select2" name="bank_account_id" style="width: 100%;" disabled id="selectBankAccount">
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="icheck-primary d-inline">
                <input type="checkbox" value="1" id="checkPaymentCreditCard" onclick="toggle_div(this, 'divSelectCreditCard');" >
                <label for="checkPaymentCreditCard">
                    Pago com cartão de crédito
                </label>
            </div>

            <div id="divSelectCreditCard" class="mt-4" style="display: none">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Cartão</label>
                    <div class="col-sm-8">
                        <select class="form-control select2" name="credit_card_id" style="width: 100%;" disabled id="selectCreditCard">
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Núm de Parcelas</label>
                    <div class="col-sm-8">
                        <input type="text" name="parcel" value="1" class="form-control only-numbers" minlength="1" maxlength="3" id="parcel">
                    </div>
                </div>
            </div>
        </div>
    </div>





    <div class="form-group row">
        <label class="col-sm-2 col-form-label"></label>
        <div class="col-sm-4">
            <button type="submit" class="btn btn-info">Cadastrar</button>
        </div>
    </div>

</form>
