<template>
    <van-nav-bar
            v-bind:title="title"
            v-bind:left-text="left_text"
            v-bind:right-text="right_text"
            v-bind:left-arrow="left_arrow"
            v-bind:z-inde="z_index"
            v-bind:fixed="fixed"
            v-bind:border="border"
            @click-left="onClickLeft"
            @click-right="onClickRight"
    >
        <van-icon v-if="icon_name" v-bind:name="icon_name" slot="right" />
    </van-nav-bar>
</template>

<script>
    import { NavBar,Icon } from 'vant'
    export default {
        name: "navbar",
        props:{
            title: {
                type:String,
                default: '标题'
            },
            left_text: {
                type: String,
                default: '返回'
            },
            right_text: {
                type: String,
                default: '按钮'
            },
            left_arrow: {
                type: Boolean,
                default: true
            },
            click_left: {
                default: null
            },
            click_right: {
                default: null
            },
            fixed: {
                type: Boolean,
                default: true,
            },
            border: {
                type: Boolean,
                default: true
            },
            z_index: {
                type: Number,
                default: 1
            },
            icon_name:{
                type: String,
                default: ''
            }
        },
        components:{
            [NavBar.name]:NavBar,
            [Icon.name]: Icon
        },
        created(){
          console.log(this.title)
        },
        methods:{
            onClickLeft(){
                if(this.click_left){
                    this.click_left();
                }
            },
            onClickRight(){
                if(this.click_right){
                    this.click_right();
                }
            }
        }
    }
</script>

<style scoped>
    .van-nav-bar{
        height: 12vw;
    }
    .van-nav-bar__title,.van-nav-bar__left,.van-nav-bar__right{
        line-height: 12vw !important;
    }
</style>