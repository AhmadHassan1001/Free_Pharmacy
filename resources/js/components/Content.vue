<template>
    <div>
        
        <nav class="navbar navbar-light bg-light">
        <div class="container">
            <img src="/imgs/ehsan.png" alt="" width="60" height="60" class="rounded-circle">
            <div class="text-center">
                <a href="/search" class="btn btn-primary m-1">بحث</a>
                <a href="/content" class="btn btn-primary m-1">العلاج</a>
                <a href="/volunteer" class="btn btn-primary m-1">متطوع</a>
            </div>
        </div>
        </nav>

        <div class="m-3">
            <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                <th scope="col">مسلسل</th>
                <th scope="col">الاسم</th>
                <th scope="col">الكمية</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(medicine,index) in medicines" :key="medicine.id">
                <th scope="row">{{index+1}}</th>
                <td><a :href="'/content/' + medicine.id" style="text-decoration: none;"> {{ medicine.name }}</a></td>
                <td>{{ medicine.quantity }}</td>
                </tr>
            </tbody>
            </table>
        </div>
        

        

        
    </div>
</template>


<script>
export default {
    data(){
        return{
            medicine:{
                id:'',
                name:'',
                quantity:'',
            },
            medicines:{},
        }
    },
    methods: {
        
        getMedicens(){
            axios.get('../api/getmedicines').then(response=>{
                this.medicines=response.data.data;
            })
        }
    },
    created(){
        this.getMedicens();
    }
}
</script>

