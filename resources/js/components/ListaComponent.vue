<template>
    <div>
        <br>
            <h1 class="text-center">Lista filtrada por nombre y cédula</h1>
        <hr>
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                <th scope="col">Id</th>
                <th scope="col" >Nombre</th>
                <th scope="col">Cédula</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="pers in personas" :key="pers.id">
                    <th scope="row">{{pers.id}}</th>
                    <td>{{pers.nombre}}</td>
                    <td>{{pers.cedula}}</td>
                </tr>
            </tbody>
        </table>

    </div>
</template>

<script>
export default{
    data(){
        return{
            personas:[],
        }
    },
    methods:{
        async listar(){
            const res=await axios.get('/registros');
            this.personas=res.data;
        },
    },

    created(){
        this.listar();
    },
}
</script>
