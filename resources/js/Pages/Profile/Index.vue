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
        <Chart :gender="count" :key="componentKey"/>
    </div>
</template>

<script>

import { Link } from '@inertiajs/inertia-vue3'
import { onMounted, ref } from '@vue/runtime-core'
import Nav from './components/Nav.vue'
import NProgress from 'nprogress'
import { Inertia } from '@inertiajs/inertia'
import Chart from './components/Chart.vue'

export default {
    name: 'Index',
    components: {
        Link,
        Nav,
        Chart
    },
    props: {
        data: Array,
        count: Array
    },
    

    setup(props){
        
        const componentKey = ref(0);
        const forceRerender = () => {
            componentKey.value += 1;
        };

        onMounted(() => {
            Inertia.on('start', () => NProgress.start())
            Inertia.on('finish', () => NProgress.done())
            console.log(componentKey.value)
        })

        function destroy(id){
            Inertia.delete(`/post/${id}`)
        }

        return{
            componentKey, forceRerender, destroy
        }
    }

}
</script>

<style scoped>

</style>