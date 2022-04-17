<template>
    <div>
        <div class="text-center">
            <a href="/search" class="btn btn-primary m-1">بحث</a>
            <a href="/content" class="btn btn-primary m-1">العلاج</a>
            <a href="/volunteer" class="btn btn-primary m-1">متطوع</a>
        </div>
        <div>
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">اضافة/صرف علاج</h5>
            </div>
            <div class="modal-body">

                <input type="text" class="form-control my-2" placeholder="الاسم" v-model="medicine.name">
                <input type="number" class="form-control my-2" placeholder="الكمية" v-model="medicine.quantity">
                <input type="month" class="form-control my-2" v-model="medicine.exp">
                <input type="text" class="form-control my-2" placeholder="المكان" v-model="medicine.position">
                <input type="text" class="form-control my-2" placeholder="المواد الفعالة" v-model="medicine.actives">


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#giveModal">صرف</button>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">اضافة</button>
            </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">اضافة علاج</h5>
        </div>
        <div class="modal-body">
            تاكيد اضافة:
            <br>
            <table class="table">
            <thead class="table-success">
                <tr>
                <th scope="col">الاسم</th>
                <th scope="col">الكمية</th>
                <th scope="col">التاريخ</th>
                <th scope="col">المكان</th>
                <th scope="col">المواد الفعالة</th>
                </tr>
            </thead>
            <tbody>
                <tr >
                <td>{{ medicine.name }}</td>
                <td>{{ medicine.quantity }}</td>
                <td>{{ medicine.exp }}</td>
                <td>{{ medicine.position }}</td>
                <td>{{ medicine.actives }}</td>
                </tr>
            </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>
            <button type="button" class="btn btn-primary" @click="addParts">اضافة</button>
        </div>
        </div>
    </div>
    </div>
    <div class="modal fade" id="giveModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">صرف علاج</h5>
        </div>
        <div class="modal-body">
            تاكيد الصرف:
            <br>
            <table class="table">
            <thead class="table-danger">
                <tr>
                <th scope="col">الاسم</th>
                <th scope="col">الكمية</th>
                <th scope="col">التاريخ</th>
                <th scope="col">المكان</th>
                <th scope="col">المواد الفعالة</th>
                </tr>
            </thead>
            <tbody>
                <tr >
                <td>{{ medicine.name }}</td>
                <td>{{ medicine.quantity }}</td>
                <td>{{ medicine.exp }}</td>
                <td>{{ medicine.position }}</td>
                <td>{{ medicine.actives }}</td>
                </tr>
            </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>
            <button type="button" class="btn btn-primary" @click="giveParts">صرف</button>
        </div>
        </div>
    </div>
    </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            medicine:{
                name:'',
                quantity:'',
                exp:'',
                position:'',
                actives:'',
            },
            resp:[]
        }
    },
    methods: {
        
        addParts(){
            this.medicine.name=this.medicine.name.toLowerCase();
            this.medicine.position=this.medicine.position.toLowerCase();
            this.medicine.actives=this.medicine.actives.toLowerCase();
            this.medicine.exp+='-01';
            axios.post('../api/addparts',this.medicine).then(response=>{
                this.resp=response.data;
            });
            this.medicine.exp='';
        },
        giveParts(){
            this.medicine.name=this.medicine.name.toLowerCase();
            this.medicine.position=this.medicine.position.toLowerCase();
            this.medicine.actives=this.medicine.actives.toLowerCase();
            this.medicine.exp+='-01';
            axios.post('../api/giveparts',this.medicine).then(response=>{
                this.resp=response.data;
            });
            this.medicine.exp='';
        },
    },
}
</script>