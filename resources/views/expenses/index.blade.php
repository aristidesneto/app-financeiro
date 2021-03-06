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
                        <h5 class="m-0">Visualizar despesas fixas e cartões</h5>
                    </div>
                    <div class="card-body table-responsive mt-2">

                        <span id="pagination"></span>

                        {{-- <ul class="pagination pagination-month justify-content-center">
                            <li class="page-item"><a class="page-link" href="#">«</a></li>
                            @for ($i = 1; $i <= 12; $i++)
                                <li class="page-item" id="{{ 'month-'.$i }}">
                                    <a class="page-link" style="cursor: pointer;" data-month="{{ $year.'/'.$i }}">
                                        <p class="page-month">{{ shortMonths($i) }}</p>
                                        <p class="page-year">{{ $year }}</p>
                                    </a>
                                </li>
                            @endfor
                            <li class="page-item"><a class="page-link" style="cursor: pointer;" data-month="{{ $year + 1 }}">»</a></li>
                        </ul> --}}

                        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-content-below-expense-tab" data-toggle="pill" href="#custom-content-below-expense" role="tab" aria-controls="custom-content-below-expense" aria-selected="true">Despesas Mensais</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-below-income-tab" data-toggle="pill" href="#custom-content-below-income" role="tab" aria-controls="custom-content-below-income" aria-selected="false">Despesas com cartão</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="custom-content-below-tabContent">
                            <div class="tab-pane fade show active mt-4" id="custom-content-below-expense" role="tabpanel" aria-labelledby="custom-content-below-expense-tab">
                                @include('expenses.expense-fixed')
                            </div>
                            <div class="tab-pane fade mt-4" id="custom-content-below-income" role="tabpanel" aria-labelledby="custom-content-below-income-tab">
                                @include('expenses.expense-cards')
                            </div>
                        </div>

                      </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
