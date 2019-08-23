<template>
    <div class="grid-boxes-component" :style="'padding: 0px '+borderSpace+';'">
        <div v-for="(item, index) in options" v-bind:key="index" :class="item.notShow?'':'one-grid-box'" :style="styles" >
            <van-image
                    v-if="!item.notShow"
                    :src="item.icon"
                    width="50%"
            >
                <template v-slot:error>
                    <van-icon name="photo-o"></van-icon>
                </template>
                <template v-slot:loading>
                    <van-loading type="spinner"></van-loading>
                </template>
            </van-image>
            <div v-if="!item.notShow">{{item.text}}</div>
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
                default: 4,
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
            options: {
                type: [Array],
                default: function () {
                    return [
                        {
                            icon: 'https://img.tukuppt.com//png_preview/00/12/74/AV16X5bTXi.jpg!/fw/780',
                            text: 'dd',
                            to: '',
                            url: 'ss',
                        },
                        {
                            icon: 'https://img.tukuppt.com//png_preview/00/12/74/AV16X5bTXi.jpg!/fw/780',
                            text: 'ff',
                            to: '',
                            url: 'ss',
                        },
                        {
                            icon: 'https://img.tukuppt.com//png_preview/00/12/74/AV16X5bTXi.jpg!/fw/780',
                            text: 'dd',
                            to: '',
                            url: 'bb',
                        },
                        {
                            icon: 'https://img.tukuppt.com//png_preview/00/12/74/AV16X5bTXi.jpg!/fw/780',
                            text: 'ss',
                            to: '',
                            url: '',
                        },
                        {
                            icon: 'https://img.tukuppt.com//png_preview/00/12/74/AV16X5bTXi.jpg!/fw/780',
                            text: 'ff',
                            to: '',
                            url: 'ff',
                        },
                        {
                            icon: 'https://img.tukuppt.com//png_preview/00/12/74/AV16X5bTXi.jpg!/fw/780',
                            text: 'ss',
                            to: '',
                            url: '',
                        }
                    ];
                }
            }

        },
        data(){
            return {
                styles: '-webkit-border-radius: '+this.radius+';-moz-border-radius: '+this.radius+';border-radius: '+this.radius+';'
            }
        },
        created() {
            console.log(this.col - this.options.length%this.col)
            for(let i = 0; i < (this.col - this.options.length%this.col); i++){
                let a = new Array();
                a.noShow = true;
                this.options.push(a);
            }
            console.log(this.options);
            this.styles += 'width: '+((100 / this.col) - this.gridSpace)+'%; margin-bottom: '+this.gridSpace+'%;';
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
        background: red;

    }
</style>