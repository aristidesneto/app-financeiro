@extends('layouts.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Despesas</h1>
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

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="m-0">Despesas do mês de Fevereiro/2021</h5>
                        <span id="total"></span>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover" id="expenseTable">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Categoria</th>
                              <th>Descrição</th>
                              <th>Data Vencimento</th>
                              <th>Valor</th>
                            </tr>
                          </thead>
                          <tbody id="expenseData">
                              <tr>
                                  <td><span>Carregando...</span></td>
                              </tr>
                          </tbody>
                        </table>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
