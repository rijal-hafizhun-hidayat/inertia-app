<template>
    <Nav />
    <div class="container mt-5">
        <div v-if="$page.props.flash.message" class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $page.props.flash.message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <Link class="btn btn-primary mb-3" href="create">Tambah</Link>
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Kelamin</th>
                            <th scope="col">No Telepon</th>
                            <th scope="col">Kepala Keluarga</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Tanggal Lahir</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="( dat, index ) in data" :key="dat.id">
                            <th scope="row">{{ index+1 }}</th>
                            <td>{{ dat.nama }}</td>
                            <td v-if="dat.gender == 1">Laki-laki</td>
                            <td v-else>Perempuan</td>
                            <td>{{ dat.no_tlp }}</td>
                            <td>{{ dat.kk }}</td>
                            <td>{{ dat.alamat }}</td>
                            <td>{{ dat.tanggal_lahir }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <button class="btn btn-danger" @click="destroy(dat.id)">Hapus</button>
                                    <Link class="btn btn-warning" :href="`/post/${dat.id}`">Edit</Link>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <canvas id="myChart" width="400" height="400"></canvas>
    </div>
</template>

<script>

import { Link } from '@inertiajs/inertia-vue3'
import { onMounted } from '@vue/runtime-core'
import Nav from './components/Nav.vue'
import NProgress from 'nprogress'
import { Inertia } from '@inertiajs/inertia'
import Chart from 'chart.js/auto';

export default {
    name: 'Index',
    components: {
        Link,
        Nav
    },
    props: {
        data: Array // <- nama props yang dibuat di controller saat parsing data
    },

    setup(){
        onMounted(() => {
            Inertia.on('start', () => NProgress.start())
            Inertia.on('finish', () => NProgress.done())

            
            const ctx = document.getElementById('myChart');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
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

        function destroy(id){
            Inertia.delete(`/post/${id}`)
        }

        return{
            destroy
        }
    }

}
</script>

<style scoped>

</style>