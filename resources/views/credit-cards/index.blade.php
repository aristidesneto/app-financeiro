@extends('layouts.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Cartão de Crédito</h1>
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
            <div class="col-lg-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="m-0">Cadastrar cartão de crédito</h5>
                    </div>
                    <div class="card-body table-responsive mt-2">

                        <form class="form-horizontal mt-4 submitForm" action="{{ route('credit-card.store') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nome</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" placeholder="Identificação do cartão" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Número</label>
                                <div class="col-sm-10">
                                    <input type="text" name="number" class="form-control" maxlength="4" placeholder="Os 4 últimos números do cartão" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Melhor data para compra</label>
                                <div class="col-sm-10">
                                    <input type="text" name="best_date" class="form-control" maxlength="2" placeholder="Melhor dia para comprar" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Dia de vencimento</label>
                                <div class="col-sm-10">
                                    <input type="text" name="due_date" class="form-control" maxlength="2" placeholder="Dia de vencimento do cartão" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Limite</label>
                                <div class="col-sm-10">
                                    <input type="text" name="limit" class="form-control money" placeholder="Valor limite do cartão" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-info">Cadastrar</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="m-0">Gerenciar cartões</h5>
                    </div>
                    <div class="card-body table-responsive mt-2">
                        <table class="table table-hover table-striped table-sm expenseTable">
                            <thead>
                                <tr>
                                    <th>Cartão</th>
                                    <th>Número</th>
                                    <th>Melhor data</th>
                                    <th>Vencimento</th>
                                    <th>Limite</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($credit_cards as $card)
                                    <tr>
                                        <td>{{ $card->name }}</td>
                                        <td>{{ $card->number }}</td>
                                        <td>{{ $card->best_date }}</td>
                                        <td>{{ $card->due_date }}</td>
                                        <td>{{ $card->limit }}</td>
                                    </tr>
                                @empty

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
