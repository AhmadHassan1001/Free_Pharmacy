<template >
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

        <h3 class="m-3 fs-1">{{ name }}</h3>
        <hr class="bg-primary border-2 border-top border-primary">
        <div class="m-3">
            <dl class="row">
            <dt class="col-sm-3">المواد الفعالة:</dt>
            <dd class="col-sm-9">{{ actives }}</dd>
            <dt class="col-sm-3">الكمية:</dt>
            <dd class="col-sm-9">{{quantity}}</dd>
            </dl>
        </div>

        <div class="m-3">
            <table class="table table-striped m-3">
            <thead class="table-primary">
                <tr>
                <th scope="col">مسلسل</th>
                <th scope="col">الكمية</th>
                <th scope="col">تاريخ الصلاحية</th>
                <th scope="col">المكان</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(part,index) in parts" :key="part.id">
                <th scope="row">{{ index+1 }}</th>
                <td>{{ part.Quantity }}</td>
                <td v-if="Date.now() > new Date(part.EXP)" class="bg-danger">{{ part.EXP }}</td>
                <td v-else>{{ part.EXP }}</td>
                <td>{{ part.position }}</td>
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
            part:{
                id:'',
                Quantity:'',
                position:'',
                EXP:'',
            },
            parts:{},
            name:'',
            quantity:'',
            actives:'',
        }
    },
    props: {
        id: { type: String, required: true }
    },
    methods: {
        
        getParts(){
            axios.get('../api/getparts/'+this.id).then(response=>{
                this.parts=response.data.data.parts;
                this.name=response.data.data.name;
                this.quantity=response.data.data.quantity;
                this.actives=response.data.data.active_ingredient;
            })
        }
    },
    created(){
        this.getParts();
    }
}
</script>

