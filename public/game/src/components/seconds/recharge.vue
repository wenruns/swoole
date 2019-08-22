<template>
    <div class="recharge-content">
        <div class="qrcode-box">
            <div v-if="payType=='银联充值'" class="qrcode-sub-box">
                <div class="union-pay">
                    <span>卡号：请联系今日客服</span>
                    <span class="copy-btn">复制</span>
                </div>
                <div class="union-pay">
                    <span>姓名：请联系今日客服</span>
                    <span class="copy-btn">复制</span>
                </div>
                <div class="union-pay">
                    <span>开户行：请联系今日客服</span>
                    <span class="copy-btn">复制</span>
                </div>
            </div>
            <div v-else>
                <van-image src="https://img.yzcdn.cn/vant/cat.jpeg" width="40vw" height="40vw">
                    <template v-slot:error>
                        <van-icon name="photo-o" size="15vw"></van-icon>
                    </template>
                    <template v-slot:loading>
                        <van-loading type="spinner" size="20" />
                    </template>
                </van-image>
                <div class="qrcode-tips-box">长按保存二维码后转账</div>
            </div>
        </div>
        <div class="info-box">
            <van-field :placeholder="holder" readonly></van-field>
            <van-field placeholder="请输入充值金额" label="金额" label-class="align-left" label-width="25vw"></van-field>
            <van-field v-if="payType=='银联充值'" label="使用新卡支付" is-link readonly label-width="25vw" @click="clickRight"></van-field>
            <van-field v-else placeholder="请输入用户名" label="用户名" label-class="align-left" label-width="25vw"></van-field>
            <van-field placeholder="请输入ID账号" label="备注" label-class="align-left" label-width="25vw"></van-field>
            <button class="submit-btn">提交</button>
        </div>
    </div>
</template>

<script>
    import { Field, Image, Loading, Icon } from 'vant'
    export default {
        name: "recharge",
        props:{
            payType: {
                type: String,
                default: '支付宝',
            },
        },
        data(){
            return {
                holder: '支付宝信息'
            }
        },
        components: {
            [Field.name]: Field,
            [Image.name]: Image,
            [Loading.name]: Loading,
            [Icon.name]: Icon,
        },
        mounted() {
            switch (this.payType) {
                case '微信':
                    this.holder = '微信支付信息';
                    break;
                case 'QQ支付':
                    this.holder = 'QQ支付信息';
                    break;
                case '银联充值':
                    this.holder = '银联充值信息';
                    break;
                default:
                    this.holder = '支付宝信息'
            }
            document.querySelector('.submit-btn').addEventListener('touchstart',function (e) {
                e.target.classList.add('submit-btn-active');
            })
            document.querySelector('.submit-btn').addEventListener('touchend',function (e) {
                e.target.classList.remove('submit-btn-active');
            })
        },
        methods:{
            clickRight(){
                console.log('cccc')
            }
        }
    }
</script>

<style scoped>
    .qrcode-box{
        height: 50vw;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .qrcode-tips-box{
        font-size: 2vw;
        color: #999;
    }
    .submit-btn{
        margin: 5vw;
        width: 70vw;
        height: 10vw;
        border: 0px;
        background: -webkit-linear-gradient(left, #E88745, #E24845); /* Safari 5.1 to 6.0 */
        background: -o-linear-gradient(left, #E88745, #E24845); /* Opera 11.1 to 12.0 */
        background: -moz-linear-gradient(left, #E88745, #E24845); /* Firefox 3.6 to 15 */
        background: linear-gradient(left, #E88745, #E24845); /* 标准语法 */
        color: white;
        letter-spacing: 3px;
        -webkit-border-radius: 1vw;
        -moz-border-radius: 1vw;
        border-radius: 1vw;
        -webkit-box-shadow: 0px 1px 1px 1px #D4D1CB;
        -moz-box-shadow: 0px 1px 1px 1px #D4D1CB;
        box-shadow: 0px 1px 1px 1px #D4D1CB;
    }
    .submit-btn-active{
        -webkit-box-shadow: 0px 1px 3px 2px #D4D1CB;
        -moz-box-shadow: 0px 1px 3px 2px #D4D1CB;
        box-shadow: 0px 1px 2px 3px #D4D1CB;
    }
    .qrcode-sub-box{
        width: 100%;
    }
    .union-pay{
        display: flex;
        justify-content: space-between;
        padding: 10px 16px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    .copy-btn{
        color: red;
        cursor: pointer;
    }
</style>