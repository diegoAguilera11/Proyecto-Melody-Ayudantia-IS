
// Obtener referencias a los elementos del DOM
let select = document.getElementById('chartType');
let chartContainer = document.getElementById('chartContainer');
let ctx = document.getElementById('myChart');
let chartHTML = document.getElementById('chart');
let spinner = document.getElementById('spinner');

let chart = null;

// Función para generar el gráfico según la selección del <select>
function generateChart() {
    // Obtener el valor seleccionado del <select>
    let selectedValue = select.value;
    // console.log(selectedValue);
    // Eliminar el gráfico existente si lo hay
    // console.log(chart);
    if (chart) {
        chart.destroy();
        chartHTML.hidden = true;
    }

    // Generar el nuevo gráfico según el valor seleccionado
    if (selectedValue === 'bar-concerts') {
        // spinner.hidden = false;
        // Realizamos una solicitud Fetch para obtener el listado de conciertos con su total vendido
        fetch('/all-concert-sales')
            .then(response => response.json())
            .then(data => {

                const concerts = data
                // console.log(concerts);

                const labels = concerts.map(concert => concert.name)
                const values = concerts.map(concert => {
                    if (concert.detail_order_sum_total) {
                        return parseInt(concert.detail_order_sum_total)
                    }
                    return 0
                })
                // console.log(labels);
                // console.log(values);

                // Crea el contexto del gráfico
                // const ctx = document.getElementById('myChart');

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
    } else if (selectedValue === 'pie-payment') {

        chart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ["India", "China", "US", "Canada"],
                datasets: [{
                    label: 'Monto Total Vendido',
                    data: [50, 55, 60, 33],
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
                    tooltip: {
                        enabled: true
                    },

                    datalabels: {
                        // Esta función la utilizamos para cambiar los valores que se muestran en las etiquetas de datos del gráfico.
                        formatter: (value, ctx) => {
                            // CTX: Es el contexto del gráfico en el que se está generando la etiqueta de datos, en este caso un gráfico Pie.
                            // Value viene a ser el valor del dato en el que se encuentra iterando el grafico de chartJS
                            // console.log(value);
                            console.log(ctx.chart.data.datasets[0].data);
                            // Nos permite acceder a los valores numéricos de los datos asociados al primer conjunto de datos
                            const datapoints = ctx.chart.data.datasets[0].data;
                            function sumaTotal(total, datapoint) {
                                return total + datapoint
                            }
                            // Se calcula el 100% obteniendo el valor de todos los datos.
                            // El método recuce permite sumar todos los valores de la matriz datapoints y calcular el valor total.
                            const porcentajeTotal = datapoints.reduce(sumaTotal, 0);

                            // Calculamos el porcentaje del valor actual dividiendo el valor por el total y luego multiplicándolo por 100.
                            // .toFixed(1) redondea el resultado a un decimal.
                            const valorPorcentaje = (value / porcentajeTotal * 100).toFixed(1);
                            // return valorPorcentaje;

                            // Creamos un array con dos elementos que contiene el valor original del dato precedido por el '$' y el valor del porcentaje seguido de '%`
                            const despliegue = [`$${value}`, `${valorPorcentaje}%`]
                            return despliegue;
                        }
                    }
                },
                animation: {
                    duration: 0,// Establece la duración de la animación en 0 (sin animación)
                }
            },
            // Especificamos el plugin ChartDataLabels a utilizar
            plugins: [ChartDataLabels]
        });

        chartHTML.hidden = false;
    }
}

// Evento de cambio en el <select>
select.addEventListener('change', generateChart);

// Generar el gráfico inicialmente
generateChart();
