<template>
    <div class="content-box bottom13">
        <merchant v-if="isMerchant"></merchant>
        <technician v-else></technician>
    </div>
</template>

<script>
    import merchant from '@/components/seconds/merchant';
    import technician from '@/components/seconds/technician';
    import navbar from '@/components/seconds/navbar';
    export default {
        name: 'HelloWorld',
        components:{
            merchant,
            technician,
            navbar,
        },
        props: {
            msg: String
        },
        data(){
            return {
                isMerchant: true,
            }
        },
        beforeCreate() {
        },
        methods:{
        }
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
