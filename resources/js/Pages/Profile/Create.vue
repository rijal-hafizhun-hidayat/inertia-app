<template>
    <Nav />
    <div class="container">
        <div class="card mt-5">
            <div class="card-body">
                <form @submit.prevent="save">
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama:</label>
                        <div class="col-sm-10">
                            <input type="text" v-model="data.nama" class="form-control" :class="errors.nama ? 'is-invalid' : ''" name="nama" id="nama">
                            <div v-if="errors.nama" class="invalid-feedback">
                                {{ errors.nama }}
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="gender" class="col-sm-2 col-form-label">Gender:</label>
                        <div class="col-sm-10">
                            <select class="form-select" :class="errors.gender ? 'is-invalid' : ''" v-model="data.gender" name="gender" id="gender" aria-label="Default select example">
                                <option disabled selected value="">Open this select menu</option>
                                <option value="1">Laki-laki</option>
                                <option value="2">Perempuan</option>
                            </select>
                            <div v-if="errors.gender" class="invalid-feedback">
                                {{ errors.gender }}
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="no_tlp" class="col-sm-2 col-form-label">No Telepon:</label>
                        <div class="col-sm-10">
                            <input type="text" v-model="data.no_tlp" v-on:keypress="NumbersOnly" class="form-control" :class="errors.no_tlp ? 'is-invalid' : ''" name="no_tlp" id="no_tlp">
                            <div v-if="errors.no_tlp" class="invalid-feedback">
                                {{ errors.no_tlp }}
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="kk" class="col-sm-2 col-form-label">Kepala Keluarga:</label>
                        <div class="col-sm-10">
                            <input type="text" v-model="data.kk" class="form-control" :class="errors.kk ? 'is-invalid' : ''" name="kk" id="kk">
                            <div v-if="errors.kk" class="invalid-feedback">
                                {{ errors.kk }}
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" :class="errors.alamat ? 'is-invalid' : ''" v-model="data.alamat" name="alamat" id="alamat" rows="3"></textarea>
                            <div v-if="errors.alamat" class="invalid-feedback">
                                {{ errors.alamat }}
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir:</label>
                        <div class="col-sm-10">
                            <input type="date" v-model="data.tanggal_lahir" class="form-control" :class="errors.tanggal_lahir ? 'is-invalid' : ''" name="tanggal_lahir" id="tanggal_lahir">
                            <div v-if="errors.tanggal_lahir" class="invalid-feedback">
                                {{ errors.tanggal_lahir }}
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="gambar" class="col-sm-2 col-form-label">Gambar:</label>
                        <div class="col-sm-10">
                            <input type="file" name="gambar" :class="errors.gambar ? 'is-invalid' : ''" @input="data.gambar = $event.target.files[0]" id="gambar" accept="image/png, image/jpeg">
                            <div v-if="errors.gambar" class="invalid-feedback">
                                {{ errors.gambar }}
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import Nav from './components/Nav.vue'
import NProgress from 'nprogress'
import { Inertia } from '@inertiajs/inertia'
import { onMounted, reactive } from '@vue/runtime-core'
import { useForm, usePage } from '@inertiajs/inertia-vue3'
import Swal from 'sweetalert2'

export default {
    components: { Nav },
    name: 'Create',
    props: {
        errors: Object,
    },

    setup(props){
        const data = useForm({
            nama: '',
            gender: '',
            no_tlp: '',
            kk: '',
            alamat: '',
            gambar: '',
            tanggal_lahir: ''
        })

        onMounted(() => {
            Inertia.on('start', () => NProgress.start())
            Inertia.on('finish', () => NProgress.done())
        })

        function save(){
            data.post('/post', data)
        }

        function NumbersOnly(evt) {
            
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
                evt.preventDefault();;
            } else {
                return true;
            }
        }

        return{
            data, save, NumbersOnly
        }
    }
    
}
</script>

<style scoped>
    
</style>