<div class="card-header">
    <div class="flex justify-between items-center">
        <h4 class="inline-block">Dashboard</h4>
    </div>
    <div class="card-body">
        <div class="w-full">
            <!-- Cards -->
            <div class="grid gap-6 mb-4 md:grid-cols-2 xl:grid-cols-4">
                <!-- Card -->
                <a href="/usuarios" class="block p-4 bg-indigo-500 rounded-lg shadow-xs transform transition-all hover:scale-105 hover:bg-indigo-800">
                    <div class="flex items-center">
                        <div class="p-3 mr-4 bg-white rounded-full">
                            <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="mb-2 text-base font-medium text-white">
                                Usuarios
                            </p>
                            <p class="text-xl font-semibold text-white">
                                {{$users}}
                            </p>
                        </div>
                    </div>
                </a>
                <!-- Card -->
                <a href="/tractores" class="block p-4 bg-red-500 rounded-lg shadow-xs transform transition-all hover:scale-105 hover:bg-red-800">
                    <div class="flex items-center">
                        <div class="p-3 mr-4 bg-white rounded-full">
                            <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.15 8a2 2 0 0 0-1.72-1H15V5a1 1 0 0 0-1-1H4a2 2 0 0 0-2 2v10a2 2 0 0 0 1 1.73 3.49 3.49 0 0 0 7 .27h3.1a3.48 3.48 0 0 0 6.9 0 2 2 0 0 0 2-2v-3a1.07 1.07 0 0 0-.14-.52zM15 9h2.43l1.8 3H15zM6.5 19A1.5 1.5 0 1 1 8 17.5 1.5 1.5 0 0 1 6.5 19zm10 0a1.5 1.5 0 1 1 1.5-1.5 1.5 1.5 0 0 1-1.5 1.5z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="mb-2 text-base font-medium text-white">
                                Tractores
                            </p>
                            <p class="text-xl font-semibold text-white">
                                {{$tractors}}
                            </p>
                        </div>
                    </div>
                </a>
                <!-- Card -->
                <a href="/cajas" class="block p-4 bg-teal-500 rounded-lg shadow-xs transform transition-all hover:scale-105 hover:bg-teal-800">
                    <div class="flex items-center">
                        <div class="p-3 mr-4 bg-white rounded-full">
                            <svg class="w-6 h-6 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M21.993 7.95a.96.96 0 0 0-.029-.214c-.007-.025-.021-.049-.03-.074-.021-.057-.04-.113-.07-.165-.016-.027-.038-.049-.057-.075-.032-.045-.063-.091-.102-.13-.023-.022-.053-.04-.078-.061-.039-.032-.075-.067-.12-.094-.004-.003-.009-.003-.014-.006l-.008-.006-8.979-4.99a1.002 1.002 0 0 0-.97-.001l-9.021 4.99c-.003.003-.006.007-.011.01l-.01.004c-.035.02-.061.049-.094.073-.036.027-.074.051-.106.082-.03.031-.053.067-.079.102-.027.035-.057.066-.079.104-.026.043-.04.092-.059.139-.014.033-.032.064-.041.1a.975.975 0 0 0-.029.21c-.001.017-.007.032-.007.05V16c0 .363.197.698.515.874l8.978 4.987.001.001.002.001.02.011c.043.024.09.037.135.054.032.013.063.03.097.039a1.013 1.013 0 0 0 .506 0c.033-.009.064-.026.097-.039.045-.017.092-.029.135-.054l.02-.011.002-.001.001-.001 8.978-4.987c.316-.176.513-.511.513-.874V7.998c0-.017-.006-.031-.007-.048zm-10.021 3.922L5.058 8.005 7.82 6.477l6.834 3.905-2.682 1.49zm.048-7.719L18.941 8l-2.244 1.247-6.83-3.903 2.153-1.191zM13 19.301l.002-5.679L16 11.944V15l2-1v-3.175l2-1.119v5.705l-7 3.89z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="mb-2 text-base font-medium text-white">
                                Cajas
                            </p>
                            <p class="text-xl font-semibold text-white">
                                {{$boxes}}
                            </p>
                        </div>
                    </div>
                </a>
                <!-- Card -->
                <a href="/viajes" class="block p-4 bg-violet-600 rounded-lg shadow-xs transform transition-all hover:scale-105 hover:bg-violet-800">
                    <div class="flex items-center">
                        <div class="p-3 mr-4 bg-white rounded-full">
                            <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11h-6V8h6a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H5L2 5l3 3h6v3H5a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h6v5h2v-5h6l3-3-3-3z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="mb-2 text-base font-medium text-white">
                                Viajes
                            </p>
                            <p class="text-xl font-semibold text-white">
                                {{$travels}}
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div class="bg-gray-100 rounded-lg overflow-hidden md:col-span-2">
                    <canvas id="myChart1" class="w-full"></canvas>
                </div>
                <div class="bg-gray-100 rounded-lg overflow-hidden md:col-span-2">
                    <canvas id="myChart2" class="w-full"></canvas>
                </div>
                <div class="bg-gray-100 rounded-lg overflow-hidden md:col-span-1">
                    <canvas id="myChart3" class="w-full"></canvas>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-gray-100 rounded-lg overflow-hidden md:col-span-2">
                    <canvas id="myHorizontalBarChart" class="w-full"></canvas>
                </div>
                <div class="bg-gray-100 rounded-lg overflow-hidden md:col-span-2">
                    <canvas id="myBubbleChart"></canvas>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    window.addEventListener('resize', function() {
        myChart2.resize(); // Redimensiona el gráfico
    });
    const ctx1 = document.getElementById('myChart1');
    const jTravelsMonth =
        <?php echo $travelsMonth ?>;

    new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: jTravelsMonth.label,
            datasets: [{
                label: '# de Viajes',
                data: jTravelsMonth.data,
                borderWidth: 1
            }]
        },

        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<script>
    const ctx2 = document.getElementById('myChart2');
    const jExpenseData = <?php echo $expenseData ?>;

    new Chart(ctx2, {
        type: 'line',
        data: {
            labels: jExpenseData.label,
            datasets: [{
                borderColor: '#FF5733',
                backgroundColor: '#FF5733',
                label: 'Gastos',
                data: jExpenseData.data,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<script>
    const ctx3 = document.getElementById('myChart3');
    const jRolesData =
        <?php echo $rolesData ?>;
    new Chart(ctx3, {
        type: 'doughnut',
        data: {
            labels: jRolesData.label,
            datasets: [{
                label: '# de usuarios',
                data: jRolesData.data,
                borderWidth: 1
            }]
        },
        title: {
            display: true,
            text: 'Tipos de usuarios'
        }
    });
</script>
<script>
    var ctx4 = document.getElementById('myHorizontalBarChart').getContext('2d');
    const jkiloData =
        <?php echo $kiloData ?>;
    var myHorizontalBarChart = new Chart(ctx4, {
        type: 'bar',
        data: {
            labels: jkiloData.label,
            datasets: [{
                label: 'Kilometraje',
                data: jkiloData.data,
                backgroundColor: 'rgba(255, 99, 132, 0.6)', // Color de las barras
                borderColor: 'rgba(255, 99, 132, 1)', // Borde de las barras
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y',
            scales: {
                x: {
                    beginAtZero: true // Empezar el eje X desde 0
                }
            }
        }
    });
</script>
<script>
    window.addEventListener('resize', function() {
        myBubbleChart.resize(); // Redimensiona el gráfico
    });
    const data = {
        labels: <?php echo json_encode($labels); ?>,
        datasets: [{
            label: 'Camiones',
            data: <?php echo json_encode($chartData); ?>,
            backgroundColor: 'rgba(89,0,172, 0.6)', // Color de las burbujas
            borderColor: 'rgba(89,0,172, 1)', // Borde de las burbujas
            borderWidth: 1
        }]
    };

    const config = {
        type: 'bubble',
        data: data,
        options: {
            scales: {
                x: {
                    type: 'linear', // Tipo de escala para el eje X (lineal)
                    position: 'bottom', // Posición del eje X (abajo)
                    title: {
                        display: true,
                        text: 'Kilometraje recorrido' // Título del eje X
                    },
                    beginAtZero: true // Empezar el eje X desde 0
                },
                y: {
                    type: 'linear', // Tipo de escala para el eje Y (lineal)
                    position: 'left', // Posición del eje Y (izquierda)
                    title: {
                        display: true,
                        text: 'Días del viaje' // Título del eje Y
                    },
                    beginAtZero: true // Empezar el eje Y desde 0
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Gráfico de Burbujas' // Título del gráfico
                }
            }
        }
    };

    var ctx = document.getElementById('myBubbleChart').getContext('2d');
    var myBubbleChart = new Chart(ctx, config);
</script>