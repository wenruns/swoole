<template>
    <div class="content-box bottom13">
        <van-swipe :autoplay="3000">
            <van-swipe-item v-for="(item, index) in images" :key="index">
                <a :href="item.url ? item.url : 'javascript:void(0)'">
                    <img class="swiper-image" :src="item.img_src" alt="">
                </a>
            </van-swipe-item>
        </van-swipe>
        <van-notice-bar
                :text="notice_content"
                left-icon="volume-o"
        />
        <div class="pride-box">
            <div class="pride-title">最新中奖榜</div>
            <swiper-text :list="options"></swiper-text>
        </div>
        <div class="game">
            <div class="game-title">热门游戏</div>
            <div class="game-list-box">
                <div class="one-game-box" @click="toGame1">
                    <div class="one-game-left one-game-info">
                        <div class="game-name-box">大富科技</div>
                        <div class="game-tips-box">距离下次开奖剩余</div>
                        <div class="game-time-box">12:12</div>
                    </div>
                    <div class="one-game-right"></div>
                </div>
                <div class="one-game-box" @click="toGame2">
                    <div class="one-game-left"></div>
                    <div class="one-game-right one-game-info">
                        <div class="game-name-box">卓翼科技</div>
                        <div class="game-tips-box">等待开奖中</div>
                        <div class="game-time-box">{{timeCount()}}:12</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { Swipe, SwipeItem, NoticeBar } from 'vant'
    import swiperText from '@/components/seconds/swiperText'
    export default {
        name: 'home',
        components:{
            swiperText,
            [Swipe.name]: Swipe,
            [SwipeItem.name]: SwipeItem,
            [NoticeBar.name]: NoticeBar,
        },
        data(){
            return {
                options:[
                    {
                        left: {
                            text: '红行**',
                            style: 'font-size:4vw !important;'
                        },
                        center: {
                            text: '购买大富科技',
                            style: 'font-size:4vw !important;'
                        },
                        right: {
                            text: '喜中100.01',
                            style: 'color:red;font-size: 4vw !important;'
                        },
                    },
                    {
                        left: {
                            text: '小溪**',
                            style: 'font-size:4vw !important;'
                        },
                        center: {
                            text: '购买科技以强',
                            style: 'font-size:4vw !important;'
                        },
                        right: {
                            text: '喜中100.01',
                            style: 'color:red;font-size:4vw !important;'
                        }
                    },
                    {
                        left: {
                            text: '吸血**',
                            style: 'font-size:4vw !important;'

                        },
                        center: {
                            text: '购买嘻嘻嘻',
                            style: 'font-size:4vw !important;'

                        },
                        right: {
                            text: '喜中100.01',
                            style: 'color:red;font-size:4vw !important;'
                        }
                    },
                    {
                        left: {
                            text: '青溪**',
                            style: 'font-size:4vw !important;'

                        },
                        center: {
                            text: '购买双宿双飞',
                            style: 'font-size:4vw !important;'

                        },
                        right: {
                            text: '喜中100.01',
                            style: 'color:red;font-size:4vw !important;'
                        }
                    }
                ],
                notices: [
                    "通知内容山东矿机了大姐夫打卡的，看到了放款山东矿机思科的螺丝孔拉开距离卡快递费就连狂阶地方",
                    "通知内容山东矿机了大姐夫打卡的，看到了放款山东矿机思科的螺丝孔拉开距离卡快递费就连狂阶地方",
                    "通知内容山东矿机了大姐夫打卡的，看到了放款山东矿机思科的螺丝孔拉开距离卡快递费就连狂阶地方",
                ],
                images: [
                    {
                        url: '',
                        img_src: 'https://img.yzcdn.cn/vant/apple-1.jpg',
                    },
                    {
                        url: '',
                        img_src: 'https://img.yzcdn.cn/vant/apple-2.jpg'
                    }
                ],
                next_time: {
                    game1: 123,
                    game2: 1234
                }
            }
        },
        created(){
            this.timeCount(133);
        },
        methods:{
            toGame1(){

            },
            toGame2(){

            },
            timeCount(time, flag=0){
                if(flag == 0){
                    let h = Math.floor(time/3600);
                    return h;
                }
                let m = Math.floor(time/60);
                if(flag == 1){
                    return m;
                }
                let s = (time%3600)%60;
                return s;
            }
        },
        computed:{
            notice_content(){
                let notices_str = '';
                this.notices.forEach(function (item, index) {
                    notices_str += (index+1) + '、' + item + ' ';
                })
                return notices_str;
            }
        }
    }
</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .swiper-image{
        height: 40vw;
        width: 100vw;
    }
    .pride-box{
        background: white;
    }
    .pride-title,.game-title{
        height: 10vw;
        line-height: 10vw;
        color: red;
    }
    .game-list-box{
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
    }
    .one-game-box{
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 90vw;
        height: 40vw;
        background: red;
        -webkit-border-radius: 2vw;
        -moz-border-radius: 2vw;
        border-radius: 2vw;
        margin-bottom: 3vw;
        color: white;
    }
    .one-game-left,.one-game-right{
        text-align: left;
    }
    .one-game-right{
    }
    .one-game-info{
        width: 50vw;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        padding: 3vw;
    }
    .game-name-box{
        font-size: 10.5vw !important;
        font-weight: bold;
    }
    .one-game-right .game-name-box{
        text-align: right;
    }
    .game-tips-box{
        font-size: 4.5vw !important;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        padding: 1vw 2vw;
    }
    .game-time-box{
        font-size: 4.5vw !important;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        padding: 1vw 2vw;
    }
    .one-game-right .game-tips-box,.one-game-right .game-time-box{
        padding: 1vw 4vw;
    }
</style>
