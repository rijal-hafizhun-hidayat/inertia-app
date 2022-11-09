<template>
    <canvas id="myChart" width="400" height="400"></canvas>
    <p>{{ gender }}</p>
</template>

<script>
import Chart from 'chart.js/auto';
import { onMounted } from '@vue/runtime-core';

export default {
    name: 'Chart',
    props: {
        gender: Array
    },
    setup(props){
        onMounted(() => {
            
            const ctx = document.getElementById('myChart');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Red', 'Blue'],
                    datasets: [{
                        label: '# of Votes',
                        data: props.gender,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)'
                        ],
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

            myChart
        })
    }
}
</script>