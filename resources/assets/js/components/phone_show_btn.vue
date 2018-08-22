<template>
    <div class="phone__block">
        <p class="btn btn_theme_usual">
            <i class="fa fa-phone"></i>
            <slot name="phone-number">
                <span class="phone-number__short">+7 (777)</span>
                <a class="phone-number__show">
                    Показать номер
                </a>
            </slot>
        </p>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                count: 0
            }
        }
    }
</script>

<style scoped>

</style>