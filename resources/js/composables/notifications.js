/**
 * Util script for Notification requests
 * 
 * @author      Alan Cortes
 * @version     1.0.0
 */

import { ref } from "vue"

export const perPage = 5

export function getUserNotifications($ajax, page, onSuccess = (res) => {}, onFail = () => {}, loadingRef = ref(null)) {
    if (!$ajax) {
        throw new Error("Missing $ajax object")
    }

    loadingRef.value = true

    $ajax({
            method: "get",
            url: "/jax/notification/user",
            params: {
                page: page,
                limit: perPage,
            }
        })
        .then(res => {
            onSuccess(res)
        })
        .catch(err => {
            ElMessageBox.alert(
                err.response?.data?.message ?? err.message ?? "Request Failed", 
                "Error", 
            {
                confirmButtonText: "Ok",
            })
            onFail()
        })
        .finally(() => {
            loadingRef.value = false
        })
}