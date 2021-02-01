@extends('layouts.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Lançamentos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Starter Page</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12">

                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Lançamentos de despesas e receitas</h3>
                    </div>

                    <form class="form-horizontal" method="post" action="{{ route('entry.store') }}" id="submitForm">
                        @csrf
                        <div class="card-body">
                            <!-- radio -->
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tipo</label>
                                <div class="col-sm-10">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary1" value="expense" name="type" checked>
                                        <label for="radioPrimary1">Despesa
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary2" value="income" name="type">
                                        <label for="radioPrimary2">Receita
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Categoria</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" name="category_id" style="width: 100%;" id="listCategory" required>
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

                                <label class="col-sm-2 col-form-label">Data de Vencimento</label>
                                <div class="col-sm-4">
                                    <input type="text" name="due_date" class="form-control datemask">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-2"></div>
                                <div class="col-md-10">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" name="is_recurring" value="1" checked id="checkboxPrimary1" onclick="toggle_visibility('paymentDiv');" >
                                        <label for="checkboxPrimary1">
                                            Lançamento recorrente
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div id="paymentDiv" style="display: none">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Forma pagamento</label>
                                    <div class="col-sm-5">
                                        <select class="form-control select2" name="type_payment" style="width: 100%;" id="choosePayment">
                                            <option>Selecionar Pagamento</option>
                                            <option value="entries">Lançamento</option>
                                            <option value="credit-card">Cartão de crédito</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-5">
                                        <select class="form-control select2" name="payment" style="width: 100%;" disabled id="selectPayment">
                                            <option>Selecione a forma de pagamento</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Num Parcelas</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="parcel" value="1" class="form-control only-numbers" minlength="1" maxlength="3" id="parcel" disabled>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script>
        // function toggle_visibility(id) {
        //     let e = document.getElementById(id);
        //     if (e.style.display === "none") {
        //         e.style.display = "block";
        //     } else {
        //         e.style.display = "none";
        //     }
        // }
    </script>
@endpush
