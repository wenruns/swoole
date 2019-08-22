<template>
    <div class="content-box bottom13">
        <div class="header-box">充值</div>
        <div class="body-box">
            <div class="way-box">
                <span data-step="1">选择支付方式</span>
                <span data-step="2">付款</span>
                <span data-step="3">客服审核</span>
                <span data-step="4">充值成功</span>
            </div>
            <div class="recharge-content-box">
                <div class="way-title-box">选择支付方式</div>
                <van-tabs v-model="active" animated line-width="20vw">
                    <van-tab title="支付宝">
                        <recharge payType="支付宝"></recharge>
                    </van-tab>
                    <van-tab title="微信">
                        <recharge payType="微信"></recharge>
                    </van-tab>
                    <van-tab title="QQ支付">
                        <recharge payType="QQ支付"></recharge>
                    </van-tab>
                    <van-tab title="银联充值">
                        <recharge payType="银联充值"></recharge>
                    </van-tab>
                </van-tabs>
            </div>
        </div>
    </div>
</template>

<script>
    import { Tab, Tabs } from 'vant'
    import recharge from '@/components/seconds/recharge'
    export default {
        name: "order",
        components:{
            [Tab.name]:Tab,
            [Tabs.name]:Tabs,
            recharge
        },
        data(){
            return {
                active: 0
            }
        },
    }
</script>

<style scoped>
    .header-box{
        background: #FE4648;
        width: 100vw;
        height: 18vw;
        line-height: 25vw;
        color: white;
        font-size: 4.5vw !important;
        position: fixed;
        top: 0px;
        left: 0px;
    }
    .body-box{
        margin-top: 18vw;
    }
    .way-box{
        height: 10vw;
        line-height: 10vw;
    }
    .way-box span{
        font-size: 3vw;
    }
    .way-box span:before{
        content: attr(data-step);
        display: inline-block;
        width: 4vw;
        height: 4vw;
        line-height: 4vw;
        -webkit-border-radius: 4vw;
        -moz-border-radius: 4vw;
        border-radius: 4vw;
        font-size: 3vw;
        background: #EECA54;
        color: white;
        margin: 0px 1.3vw;
    }
    .way-box span:nth-child(1):before{
        margin-left: 0px;
    }
    .recharge-content-box{
        width: 92vw;
        margin: auto;
        background: white;
        -webkit-border-radius: 1.5vw;
        -moz-border-radius: 1.5vw;
        border-radius: 1.5vw;
        box-shadow: 0px 0px 1px 1px #E3E3E5;
        -webkit-box-shadow: 0px 0px 1px 1px #E3E3E5;
        -moz-box-shadow: 0px 0px 1px 1px #E3E3E5;
    }
    .way-title-box{
        height: 10vw;
        line-height: 10vw;
        text-align: left;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        padding-left: 4vw;
    }

</style>