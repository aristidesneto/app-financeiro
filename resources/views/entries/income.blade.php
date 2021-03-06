<form class="form-horizontal mt-4 submitForm" method="post" action="{{ route('entry.store') }}">
    @csrf
    <input type="hidden" name="type" value="income">

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Categoria</label>
        <div class="col-sm-10">
            <select class="form-control select2" name="category_id" style="width: 100%;" id="categoriesIncome" required>
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
        <label class="col-sm-2 col-form-label">Referente</label>
        <div class="col-sm-4">
            <input type="text" name="start_date" class="form-control datepicker-month" required>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-2"></div>
        <div class="col-md-10">
            <div class="icheck-primary d-inline">
                <input type="checkbox" name="is_recurring" value="1" id="checkboxIncome">
                <label for="checkboxIncome">
                    Lançamento recorrente
                </label>
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
