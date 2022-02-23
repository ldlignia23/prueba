<template>
    <div>
        <br>
        <h1 class="text-center">Registrar Persona</h1>
        <hr>

        <!-- Button to Open the Modal --> 
        <button @click="modificar=false; abrirModal();" type="button" class="btn btn-primary my-4">
        Nuevo
        </button>

        <!-- The Modal -->
        <div class="modal" :class="{mostrar:modal}">
        <div class="modal-dialog">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">{{tituloModal}}</h4>
                <button @click="cerrarModal();" type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                    <div class="my-4"> 
                        <label for="nombre">Nombre</label>
                        <input v-model="persona.nombre" type="text" class="form-control" id="nombre" placeholder="Ingrese su nombre">     
                    </div>
                    <div class="my-4">
                        <label for="edad">Edad</label>
                        <input v-model="persona.edad" type="text" class="form-control" id="edad" placeholder="Ingrese su edad">     
                    </div>
                    <div class="my-4">
                        <label for="cedula">Cédula</label>
                        <input v-model="persona.cedula" type="text" class="form-control" id="cedula" placeholder="Ingrese su cédula">     
                    </div>
                    <div class="my-4">
                        <label for="correo">Correo Electrónico</label>
                        <input v-model="persona.correo" type="text" class="form-control" id="correo" placeholder="Ingrese su correo electrónico" required>     
                    </div>
                    <div class="my-4">
                        <label for="contrasena">Contraseña</label>
                        <input v-model="persona.contrasena" type="text" class="form-control" id="contrasena" placeholder="Ingrese su contraseña">     
                    </div>
                    <div class="my-4"> 
                        <label for="foto">Foto</label>
                        <input v-model="persona.foto" type="text" class="form-control" id="foto" placeholder="Ingrese la dirección url de la foto">     
                    </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <div>
                    <button @click="cerrarModal();" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button @click="guardar();" type="submit" class="btn btn-success" data-dismiss="modal">Guardar</button>
                </div>
                
            </div>

            </div>
        </div>
        </div>

        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                <th scope="col">Id</th>
                <th scope="col" >Nombre</th>
                <th scope="col" >Edad</th>
                <th scope="col">Cédula</th>
                <th scope="col" >Correo Electrónico</th>
                <th scope="col" >Contraseña</th>
                <th scope="col" >Foto</th>
                <th scope="col" colspan="2" class="text-center">Acción</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="pers in personas" :key="pers.id">
                <th scope="row">{{pers.id}}</th>
                <td>{{pers.nombre}}</td>
                <td>{{pers.edad}}</td>
                <td>{{pers.cedula}}</td>
                <td>{{pers.correo}}</td>
                <td>{{pers.contrasena}}</td>
                <td><img :src="pers.foto" class="card-img-top" alt="..."></td>
                <td>
                    <button @click="modificar=true; abrirModal(pers);" class="btn btn-warning">Editar</button>
                </td>
                <td>
                    <button @click="eliminar(pers.id)" class="btn btn-danger">Eliminar</button>
                </td>
                </tr>
            </tbody>
        </table>

    </div>
</template>

<script>
export default{
    data(){
        return{
            persona:{
                nombre:'',
                edad:'',
                cedula:'',
                correo:'',
                contrasena:'',
                foto:'',
            },
            id:0,
            modificar:true,
            modal:0,
            tituloModal:'',
            personas:[],
        }
    },
    methods:{
        async listar(){
            const res=await axios.get('/registros');
            this.personas=res.data;
        },
         async eliminar(id){
            const res=await axios.delete('/registros/'+id);
            this.listar();
        },
        async guardar(id){
            if(this.modificar){
                const res=await axios.put('/registros/'+this.id,this.persona);
            }else{
                const res=await axios.post('/registros', this.persona);
            }
            this.cerrarModal();
            this.listar();
        },
        abrirModal(data={}){
            this.modal=1;
            if(this.modificar){
                this.id=data.id,
                this.tituloModal="Modificar Persona";
                this.persona.nombre=data.nombre;
                this.persona.edad=data.edad;
                this.persona.cedula=data.cedula;
                this.persona.correo=data.correo;
                this.persona.contrasena=data.contrasena;
                this.persona.foto=data.foto;

            }else{
                this.id=0,
                this.tituloModal="Registrar Persona";
                this.persona.nombre='';
                this.persona.edad='';
                this.persona.cedula='';
                this.persona.correo='';
                this.persona.contrasena='';
                this.persona.foto='';
            }
        },
        cerrarModal(){
            this.modal=0;
            
        },
    },

    created(){
        this.listar();
    },
}
</script>

<style>
.mostrar{
    display: list-item;
    opacity: 98%;
    background: rgb(77, 65, 65);
}
</style>
