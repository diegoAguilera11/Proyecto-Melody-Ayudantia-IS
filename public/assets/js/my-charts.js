// Obtener referencias a los elementos del DOM
let select = document.getElementById('chartType');
let chartContainer = document.getElementById('chartContainer');
let ctx = document.getElementById('myChart');
let chartHTML = document.getElementById('chart');

let chart = null;

// Función para generar el gráfico según la selección del <select>
function generateChart() {
    // Obtener el valor seleccionado del <select>
    let selectedValue = select.value;
    console.log(selectedValue);
    // Eliminar el gráfico existente si lo hay
    console.log(chart);
    if (chart) {
        chart.destroy();
        chartHTML.hidden = true;
    }

    // Generar el nuevo gráfico según el valor seleccionado
    if (selectedValue === 'bar-concerts') {
        // Realizamos una solicitud Fetch para obtener el listado de conciertos con su total vendido
        fetch('/all-concert-sales')
            .then(response => response.json())
            .then(data => {

                const concerts = data
                console.log(concerts);

                const labels = concerts.map(concert => concert.name)
                const values = concerts.map(concert => {
                    if (concert.detail_order_sum_total) {
                        return parseInt(concert.detail_order_sum_total)
                    }
                    return 0
                })
                console.log(labels);
                console.log(values);

                // Crea el contexto del gráfico
                // const ctx = document.getElementById('myChart');

                // Crea el gráfico de barras
                chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: values,
                            backgroundColor: [
                                'rgba(251, 77, 66, 0.25)',
                                'rgba(4, 101, 255, 0.25)',
                                'rgba(255, 209, 3, 0.25)',
                                'rgba(255, 1, 190,0.25)',
                                'rgba(0, 212, 161, 0.25)'
                            ],
                            borderWidth: 3
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        responsive: true,
                        scales: {
                            x: {
                                ticks: {
                                    autoSkip: false,
                                    maxRotation: 0,
                                    minRotation: 0
                                }
                            },
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                chartHTML.hidden = false;
            })
            .catch(error => {
                console.error('Error al obtener el listado de conciertos:', error);
            });
    } else if (selectedValue === 'bar-payment') {
        // spinner.hidden = false;
        // Realizamos una solicitud fetch para obtener los datos realacionados a los detalles de orden
        fetch('/all-detail-orders')
            .then(response => response.json())
            .then(data => {

                const detail_orders = data
                // console.log(detail_orders);

                // Crea un objeto para almacenar las sumas totales por método de pago
                const paymentTotals = {
                    'Efectivo': 0,
                    'Transferencia': 0,
                    'Débito': 0,
                    'Crédito': 0,
                };

                //  Calculamos la suma total por cada método de pago
                detail_orders.forEach(detail => {
                    let paymentMethod = detail.payment_method;
                    const total = detail.total;

                    switch (paymentMethod) {
                        case 1:
                            paymentMethod = 'Efectivo'
                            break;

                        case 2:
                            paymentMethod = 'Transferencia'
                            break;

                        case 3:
                            paymentMethod = 'Débito'
                            break;

                        case 4:
                            paymentMethod = 'Crédito'
                            break;
                    }

                    // console.log(paymentMethod);

                    paymentTotals[paymentMethod] += total
                });

                // Extrae las etiquetas y los valores de las sumas totales por método de pago
                const labels = Object.keys(paymentTotals);
                const values = Object.values(paymentTotals);

                // console.log(labels);
                // console.log(values);

                // Crea el contexto del gráfico
                // const ctx = document.getElementById('myChart2');

                // Crea el gráfico de barras
                chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Monto Total Vendido',
                            data: values,
                            backgroundColor: [
                                'rgba(251, 77, 66, 0.25)',
                                'rgba(4, 101, 255, 0.25)',
                                'rgba(255, 209, 3, 0.25)',
                                'rgba(255, 1, 190,0.25)',
                                'rgba(0, 212, 161, 0.25)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
                chartHTML.hidden = false;
            })
            .catch(error => {
                console.error('Error al obtener el listado de conciertos:', error);
            });
    }
}

// Evento de cambio en el <select>
select.addEventListener('change', generateChart);

// Generar el gráfico inicialmente
generateChart();
