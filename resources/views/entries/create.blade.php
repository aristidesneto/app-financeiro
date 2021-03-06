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

                    <div class="card-body">

                        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-content-below-expense-tab" data-toggle="pill" href="#custom-content-below-expense" role="tab" aria-controls="custom-content-below-expense" aria-selected="true">Despesas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-below-income-tab" data-toggle="pill" href="#custom-content-below-income" role="tab" aria-controls="custom-content-below-income" aria-selected="false">Receitas</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="custom-content-below-tabContent">
                            <div class="tab-pane fade show active" id="custom-content-below-expense" role="tabpanel" aria-labelledby="custom-content-below-expense-tab">
                                @include('entries.expense')
                            </div>
                            <div class="tab-pane fade" id="custom-content-below-income" role="tabpanel" aria-labelledby="custom-content-below-income-tab">
                                @include('entries.income')
                            </div>
                        </div>

                    </div>

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
