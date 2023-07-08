@extends('layouts.app')

@section('title')
    Recaudación
@endsection

@push('chart')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('content')
    <label for="chartType" class="block mb-2 text-sm font-medium text-white">Seleccione un tipo de gráfico</label>
    <select id="chartType"
        class="max-w-sm my-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
        <option value="bar-concerts">Total Vendido Por Concierto</option>
        <option value="bar-payment">Total Vendido Por Método de Pago</option>
    </select>

    <div id="chartContainer">
        <div id="chart" class="w-full max-w-2xl mx-auto bg-white border border-gray-200 rounded-lg shadow" hidden>
            <canvas id="myChart"></canvas>
        </div>
    </div>
@endsection


@section('script')
    <script src="{{ asset('assets/js/my-charts.js') }}"></script>
@endsection
