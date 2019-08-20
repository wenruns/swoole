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
            <van-swipe style="height: 10vw;" vertical :autoplay="3000" :show-indicators="false">
                <van-swipe-item class="pride-one-box">
                    <div class="pride-one-box">
                        <span>程序**</span>
                        <span>购买大富科技</span>
                        <span>喜中1002.00</span>
                    </div>
                </van-swipe-item>
                <van-swipe-item class="pride-one-box">
                    <div class="pride-one-box">
                        <span>程序**</span>
                        <span>购买大富科技</span>
                        <span>喜中1002.00</span>
                    </div>
                </van-swipe-item>
            </van-swipe>
        </div>
    </div>
</template>

<script>
    import { Swipe, SwipeItem, NoticeBar } from 'vant'
    export default {
        name: 'home',
        components:{
            [Swipe.name]: Swipe,
            [SwipeItem.name]: SwipeItem,
            [NoticeBar.name]: NoticeBar,
        },
        data(){
            return {
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
                ]
            }
        },
        beforeCreate() {
        },
        methods:{
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
    .pride-title{
        height: 10vw;
        line-height: 10vw;
        color: red;
    }
    .pride-one-box{
        display: flex;
        justify-content: space-between;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        padding: 0px 2vw;
        height: 10vw !important;
        line-height: 10vw;
    }
</style>
