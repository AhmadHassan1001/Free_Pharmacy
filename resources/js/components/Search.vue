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

        

        <div class="text-center col-6 m-3">
            <input v-if="searchtype<'2'" type="text" class="form-control" id="floatingInput" placeholder="كلمات البحث"  v-model="searchwords">
            <input v-if="searchtype=='3'" type="text" class="form-control" id="floatingInput" placeholder="كلمات البحث" disabled>
            <input v-if="searchtype=='2'" type="month" class="form-control" id="dateInput" v-model="searchdate">

            
            <div class="row">
                <div class="form-check col-3">
                <input class="form-check-input" type="radio" name="searchradios" id="nameradio" v-model="searchtype" value="0">
                <label class="form-check-label" for="nameradio">
                    بالاسم
                </label>
                
                </div>
                <div class="form-check col-3">
            
                <input class="form-check-input" type="radio" name="searchradios" id="activesradio" v-model="searchtype" value="1">
                <label class="form-check-label" for="activesradio">
                    بالمادة الفعالة
                </label>
                </div>
                <div class="form-check col-3">
            
                <input class="form-check-input" type="radio" name="searchradios" id="expdate" v-model="searchtype" value="2">
                <label class="form-check-label" for="expdate">
                    بتاريخ الصلاحية
                </label>
                </div>
                <div class="form-check col-3">
            
                <input class="form-check-input" type="radio" name="searchradios" id="exp" v-model="searchtype" value="3">
                <label class="form-check-label" for="exp">
                    المنتهي الصلاحية
                </label>
                </div>
            </div>
            
            
            <button type="button" class="btn btn-primary col-6" @click="getResults">بحث</button>
        </div>
        
        <div v-if="restype<'2'" class="m-3">
            <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                <th scope="col">مسلسل</th>
                <th scope="col">الاسم</th>
                <th scope="col">الكمية</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(resultmed,index) in results" :key="resultmed.id">
                <th scope="row">{{index+1}}</th>
                <td><a :href="'/content/' + resultmed.id" style="text-decoration: none;"> {{ resultmed.name }}</a></td>
                <td>{{ resultmed.quantity }}</td>
                </tr>
            </tbody>
            </table>
        </div>
        <div v-else class="m-3">
            <table class="table table-striped m-3">
            <thead class="table-primary">
                <tr>
                <th scope="col">مسلسل</th>
                <th scope="col">الاسم</th>
                <th scope="col">الكمية</th>
                <th scope="col">تاريخ الصلاحية</th>
                <th scope="col">المكان</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(resultpart,index) in results" :key="resultpart.id">
                <th scope="row">{{ index+1 }}</th>
                <td>{{ resultpart.name }}</td>
                <td>{{ resultpart.Quantity }}</td>
                <td v-if="Date.now() > new Date(resultpart.EXP)" class="bg-danger">{{ resultpart.EXP }}</td>
                <td v-else>{{ resultpart.EXP }}</td>
                <td>{{ resultpart.position }}</td>
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
            resultmed:{
                id:'',
                name:'',
                quantity:'',
            },
            resultpart:{
                id:'',
                name:'',
                Quantity:'',
                position:'',
                EXP:'',
            },
            results:{},
            searchtype:'0',
            restype:'',
            searchdate:'',
            searchwords:'',
        }
    },
    methods: {
        
        getMedicinesByActives(){
            axios.get('../api/getmedicinesbyactives?actives='+this.searchwords.toLowerCase()).then(response=>{
                this.results=response.data.data;
            })
        },
        getMedicineByName(){
            axios.get('../api/getmedicinebyname?name='+this.searchwords.toLowerCase()).then(response=>{
                this.results=response.data.data;
            })
        },
        getPartsByEXP(){
            axios.get('../api/getpartsbyexp?date='+this.searchdate+'-01').then(response=>{
                this.results=response.data.data;
            })
        },
        getPartsExpired(){
            axios.get('../api/getpartsexpired').then(response=>{
                this.results=response.data.data;
            })
        },
        getResults(){
            this.results=[];
            this.restype=this.searchtype;
            if(this.restype==0){
                this.getMedicineByName();
            }else if(this.restype==1){
                this.getMedicinesByActives();
            }else if(this.restype==2){
                this.getPartsByEXP();
            }else if(this.restype==3){
                this.getPartsExpired();
            }else{
                this.getMedicineByName();
            }
        }
    },
}
</script>

