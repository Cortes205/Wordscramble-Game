<!-- 
    Login/Register form

    @author     Alan Cortes
    @version    1.0.0
-->
<template>
    <div>
        <el-form 
            ref="formRef" 
            :model="form" 
            :rules="formRules" 
            label-width="auto" 
            style="max-width: 600px"
        >
            <el-form-item label="Username" prop="username">
                <el-input v-model="form.username" />
            </el-form-item>
            <el-form-item label="Password" prop="password">
                <el-input v-model="form.password" type="password" />
            </el-form-item>
            <el-form-item v-if="registerMode" label="Confirm Password" prop="confirmPassword">
                <el-input v-model="form.confirmPassword" type="password" />
            </el-form-item>
        </el-form>

        <div class="button-container">
            <el-button v-loading="loggingIn" :disabled="loggingIn" @click="close">Cancel</el-button>
            <el-button v-loading="loggingIn" type="info" :disable="loggingIn" @click="registerMode = !registerMode">{{ registerMode ? "Use Existing" : "Register" }}</el-button>
            <el-button v-loading="loggingIn" type="primary" @click="onSubmit">{{ registerMode ? "Create Account" : "Sign In" }}</el-button>
        </div>
    </div>
</template>

<script setup>
import { ref, getCurrentInstance, reactive } from "vue"

const { proxy } = getCurrentInstance()

const props = defineProps({
    _csrfToken: {
        type: String,
        required: true,
    },
})

const emit = defineEmits(["close"])
const registerMode = ref(false)
const loggingIn = ref(false)

const form = reactive({
    username: "",
    password: "",
    confirmPassword: "",
})
const formRef = ref(null)
const formRules = reactive({
    username: [
        { required: true, message: "Please input a username", trigger: "blur" },
        { min: 4, message: "Length should be more than 4 characters", trigger: "blur" },
    ],
    password: [
        { required: true, message: "Please input a password", trigger: "blur" },
    ],
    confirmPassword: [
        { required: true, message: "Please confirm your password", trigger: "blur" },
    ],
})

function onSubmit() {
    if (loggingIn.value) {
        return
    }

    formRef.value.validate(valid => {
        if (valid) {
            loggingIn.value = true

            const url = "/jax/user/" + (registerMode.value ? "register" : "login")

            proxy.$ajax
                .post(url, { _csrfToken: props._csrfToken, credentials: form })
                .then(res => {
                    close()
                    location.reload()
                })
                .catch(err => {
                    ElMessageBox.alert(
                        err.response?.data?.message ?? err.message ?? "Request Failed", 
                        "Error", 
                    {
                        confirmButtonText: "Ok",
                    })
                })
                .finally(() => {
                    loggingIn.value = false
                })
        }
    })
}

function close() {
    emit("close")
}
</script>

<style scoped>
.button-container {
    text-align: right;
}
</style>