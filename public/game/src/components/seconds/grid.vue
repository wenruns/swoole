<template>
    <div class="grid-boxes-component" :style="'padding: 0px '+borderSpace+';'">
        <div v-for="(item, index) in options" v-bind:key="index" :class="item.notShow?'':'one-grid-box'" :style="styles" @click="clickModel(item)">
            <van-image
                    v-if="!item.notShow"
                    :src="item.icon"
                    width="50%"
                    :round="round"
            >
                <template v-slot:error>
                    <van-icon name="photo-o"></van-icon>
                </template>
                <template v-slot:loading>
                    <van-loading type="spinner"></van-loading>
                </template>
            </van-image>
            <div v-if="!item.notShow" :style="textStyle" class="text-box">{{item.text}}</div>
        </div>
    </div>
</template>

<script>
    import { Image, Loading, Icon } from 'vant'

    export default {
        name: "grid",
        components: {
            [Image.name]: Image,
            [Loading.name]: Loading,
            [Icon.name]: Icon,
        },
        props: {
            col: {
                type: Number,
                default: 2,
            },
            radius: {
                type: String,
                default: '2vw',
            },
            borderSpace: {
                type: String,
                default: '2%'
            },
            gridSpace: {
                type: Number,
                default: 4
            },
            round: {
                type: Boolean,
                default: true
            },
            bgColor: {
                type: String,
                default: 'white'
            },
            textStyle: {
                type: String,
                default: '',
            },
            options: {
                type: [Array],
                default: function () {
                    return [
                        {
                            icon: 'https://img.tukuppt.com//png_preview/00/12/74/AV16X5bTXi.jpg!/fw/780',
                            text: '模块1',
                            to: '/',
                            url: 'http://www.baidu.com',
                        },
                        {
                            icon: 'https://img.tukuppt.com//png_preview/00/12/74/AV16X5bTXi.jpg!/fw/780',
                            text: '模块2',
                            to: '',
                            url: '',
                        },
                        {
                            icon: 'https://img.tukuppt.com//png_preview/00/12/74/AV16X5bTXi.jpg!/fw/780',
                            text: '模块3',
                            to: '',
                            url: 'bb',
                        },
                        {
                            icon: 'https://img.tukuppt.com//png_preview/00/12/74/AV16X5bTXi.jpg!/fw/780',
                            text: '模块4',
                            to: '',
                            url: '',
                        },
                        {
                            icon: 'https://img.tukuppt.com//png_preview/00/12/74/AV16X5bTXi.jpg!/fw/780',
                            text: '模块5',
                            to: '',
                            url: '',
                        },
                        {
                            icon: 'https://img.tukuppt.com//png_preview/00/12/74/AV16X5bTXi.jpg!/fw/780',
                            text: '模块6',
                            to: '',
                            url: '',
                        }
                    ];
                }
            }

        },
        data(){
            return {
                styles: '-webkit-border-radius: '+this.radius+';-moz-border-radius: '+this.radius+';border-radius: '+this.radius+';background:'+this.bgColor+';',
            }
        },
        created() {
            let len = this.col - this.options.length%this.col;
            for(let i = 0; i < len; i++){
                let a = {
                    notShow: true,
                }
                this.options.push(a);
            }
            this.styles += 'width: '+((100 / this.col) - this.gridSpace)+'%; margin-bottom: '+this.gridSpace+'%;';
        },
        methods:{
            clickModel(item){
                if(item.to){
                    this.$router.push({path: item.to});
                }else if(item.url){
                    window.location.href = item.url;
                }
            }
        }
    }
</script>

<style scoped>
    .grid-boxes-component{
        display: flex;
        flex-flow: wrap;
        justify-content: space-around;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    .one-grid-box{
        padding: 2vw 0px;
    }
    .text-box{
        color: black;
    }
</style>