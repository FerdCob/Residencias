document.addEventListener('DOMContentLoaded', function () {
    // Obtener la URL desde el atributo data-url del canvas
    const canvas = document.getElementById('graficoResiduos');
    const datosUrl = canvas.getAttribute('data-url'); // Lee la URL

    fetch(datosUrl)
        .then(response => response.json())
        .then(data => {
            const ctx = canvas.getContext('2d');
            new Chart(ctx, {
                type: 'bar', // Cambiar a 'line', 'pie', etc. según el gráfico deseado
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            enabled: true,
                        },
                    },
                },
            });
        })
        .catch(error => {
            console.error('Error al obtener los datos:', error);
        });
});
