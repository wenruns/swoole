<template>
    <div class="content-box bottom13">
        <div class="header-box">
            <div class="setting-box">
                <van-icon name="setting-o" size="5vw" style="margin-right: 2.5vw;" color="white"></van-icon>
            </div>
            <div class="user-info">
                <div class="user-image">
                    <van-image
                            src="https://ss1.bdstatic.com/70cFuXSh_Q1YnxGkpoWK1HF6hhy/it/u=1700741544,1951185347&fm=26&gp=0.jpg"
                            width="18vw"
                            height="18vw"
                            round
                    >
                        <template v-slot:error>
                            <van-icon name="photo-o" size="10vw"></van-icon>
                        </template>
                        <template v-slot:loading>
                            <van-loading type="spinner" size="6vw"></van-loading>
                        </template>
                    </van-image>
                </div>
                <div class="user-name">WFL文</div>
                <div class="user-ID">ID:123123</div>
            </div>
            <div class="remain-box">
                <div class="remain-show">
                    <div class="remain-title">余额</div>
                    <div class="remain-num">0.00</div>
                </div>
                <div class="van-hairline--left middle-box"></div>
                <div class="remain-show">
                    <div class="remain-title">今日盈亏</div>
                    <div class="remain-num">0.00</div>
                </div>
            </div>
        </div>
        <div class="grid-box">
            <grid :options="grid_options"></grid>
        </div>
    </div>
</template>

<script>
    import { Icon, Image, Loading } from 'vant'
    import grid from '@/components/seconds/grid'
    export default {
        name: "center",
        components:{
            grid,
            [Icon.name]: Icon,
            [Image.name]: Image,
            [Loading.name]: Loading,
        },
        data(){
            return {
				grid_options: [
					{
						icon: 'https://img.tukuppt.com//png_preview/00/12/74/AV16X5bTXi.jpg!/fw/780',
						text: '活动大厅',
						to: '',
						url: 'http://www.baidu.com',
					},
					{
						icon: 'https://img.tukuppt.com//png_preview/00/12/74/AV16X5bTXi.jpg!/fw/780',
						text: '消息中心',
						to: '',
						url: 'http://www.baidu.com',
					},
					{
						icon: 'https://img.tukuppt.com//png_preview/00/12/74/AV16X5bTXi.jpg!/fw/780',
						text: '账单明细',
						to: '',
						url: 'http://www.baidu.com',
					},
					{
						icon: 'https://img.tukuppt.com//png_preview/00/12/74/AV16X5bTXi.jpg!/fw/780',
						text: '我要分享',
						to: '',
						url: 'http://www.baidu.com',
					},
					{
						icon: 'https://img.tukuppt.com//png_preview/00/12/74/AV16X5bTXi.jpg!/fw/780',
						text: '关于我们',
						to: '',
						url: 'http://www.baidu.com',
					},
					{
						icon: 'https://img.tukuppt.com//png_preview/00/12/74/AV16X5bTXi.jpg!/fw/780',
						text: '推出登录',
						to: '',
						url: 'http://www.baidu.com',
					}
				]
            }
        },
        beforeCreate() {
        }
    }
</script>

<style scoped>
    .header-box{
        height: 60vw;
        background-image: url("../assets/bj1.jpg");
        background-size: 100% 100%;
        position: relative;
    }
    .setting-box{
        text-align: right;
        height: 16vw;
        line-height: 26vw;
    }
    .user-name{
        margin-top: 1vw;
    }
    .user-name,.user-ID{
        color: white;
        line-height: 6vw;
    }

    .remain-box{
        position: absolute;
        top: 85%;
        width: 92vw;
        left: 4vw;
        height: 15vw;
        background: white;
        -webkit-border-radius: 1.5vw;
        -moz-border-radius: 1.5vw;
        border-radius: 1.5vw;
        display: flex;
        align-items: center;
    }
    .middle-box{
        height: 50%;
    }
    .remain-show{
        width: 50%;
        line-height: 6vw;
    }
    .remain-title{
        color: #C9C7C8;
        font-size: 3.7vw;
    }

    .grid-box{
        padding-top: 10vw;
    }
</style>