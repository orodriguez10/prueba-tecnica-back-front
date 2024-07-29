<template>
    <div class="content-image"><img src="/logoAmazon.png" alt=""></div>
    <Form ref="form" @submit="registerUser">
        <div class="card">
            <h1>Crear cuenta</h1>
            <label>Tu nombre</label>
            <Field v-slot="{ field, errorMessage }" name="nombre" label="Nombre" rules="required|max:60">
                <input v-model="modelRegister.name" type="text" v-bind="field" >
                <p v-if="errorMessage?.length" class="error"v-bind="field" > {{  errorMessage }}</p>
                {{ errorMessage }}
            </Field>
    
            <label>Correo electrónico</label>
            <Field v-slot="{ field, errorMessage }" name="email" label="Email" rules="required|email">
                <input v-model="modelRegister.email" type="email" v-bind="field">
                <p v-if="errorMessage?.length" class="error" v-bind="field"> {{  errorMessage }}</p>
            </Field>
    
            <label>Contraseña</label>
            <Field v-slot="{ field, errorMessage }" name="password" label="Password" rules="required|min:6|max:12">
                <input v-model="modelRegister.password" v-bind="field" type="password" placeholder="Debe tener al menos 6 caracteres">
                <p v-if="errorMessage?.length" class="error" v-bind="field" > {{  errorMessage }}</p>
            </Field>
            <p class="alert"> <i>i</i> La contraseña debe contener al menos seis caracteres</p>
    
            <label>Vuelve a escribir la contraseña</label>
            <Field v-slot="{ field, errorMessage }" name="confirmaPassword" label="confirmaPassword" rules="confirmed:@password">
                <input v-model="modelRegister.confirmPassword" v-bind="field" type="password">
                <p v-if="errorMessage?.length" class="error" v-bind="field" > {{  errorMessage }}</p>
            </Field>
    
            <button type="submit">Crear tu cuenta de Amazon</button>
    
            <p class="disclaimer">
                Al crear una cuenta, aceptas las
                <a href="www.google.com">Condiciones de Uso</a> y el
                <a href="www.google.com">Aviso de Privacidad</a> de amazon.
            </p>
    
            <hr>
    
            <p class="disclaimer">¿Ya tienes una cuenta? <a href="www.google.com"> Iniciar sesión </a></p>
        </div>
    </Form>
</template>

<script setup>
import { ref } from 'vue';
import { Form, Field } from 'vee-validate';
import { request } from './plugins/http.js'
import * as Service from './register.service.js'


const modelRegister = ref({
    name: '',
    email: '',
    password: '',
    confirmPassword: ''
})

const form = ref()

async function registerUser(_, { resetForm }) {
    try {
        const { data, error } = await request(() => Service.RegisterUser(modelRegister.value))
        if(!error) {
            resetForm()
            clean()
        }
    } catch (error) {
        console.error({ error });
    }
}

function saveProduct() {
    console.log("hgonoa,;fmda");
}

function clean() {
    modelRegister.value = {
        name: '',
        email: '',
        password: '',
        confirmPassword: ''
    }
}


</script>


<style scoped>
.content-image {
    display: flex;
    justify-content: center;
    margin-bottom: 10px;
}

img {
    width: 110px;
    height: 41px;
    object-fit: cover;
    object-position: center;
}

.card {
    display: flex;
    flex-direction: column;
    justify-content: left;
    width: 348px;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 14px 18px;
}

h1 {
    margin: 0px;
    font-size: 28px;
    font-weight: 600;
}

label {
    font-weight: 800;
    font-size: 14px;
    margin-top: 10px;
}

input {
    height: 30px;
    padding: 0px 5px;
}

.error {
    color: #ff0000;
    font-size: 11px;
    margin: 0px;
}

.alert {
    font-size: 12px;
    margin-top: 3px;
}

i {
    font-weight: 700;
    font-size: 15px;
    color: #0073ff;
}

button {
    margin-top: 10px;
    height: 36px;
    font-weight: 600;
    background: linear-gradient(to bottom, #ffe357, #ffd500);
    border: 1px solid #7b7b7b;
    cursor: pointer;
}

.disclaimer {
    font-size: 12px;
    margin-top: 13px;
}

hr {
    background: transparent;
    width: 100%;
    border-top: 1px solid #e7e7e7
}

a {
    color: #0066c0;
}
</style>
