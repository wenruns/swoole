<template>
  <div id="app">
    <div class="main">
      <transition :name="transitionName">
        <router-view></router-view>
      </transition>
    </div>
    <van-tabbar v-model="active" v-if="show_tabbar" safe-area-inset-bottom @change="tabbarChange">
        <van-tabbar-item v-for="(item, index) in tabbar" :to="item.path" v-bind:key="index" :icon="item.icon">{{item.text}}</van-tabbar-item>
    </van-tabbar>

  </div>
</template>

<script>
import {Tabbar, TabbarItem} from 'vant'
export default {
  name: 'app',
  components: {
    [Tabbar.name]: Tabbar,
    [TabbarItem.name]: TabbarItem
  },
  data(){
    return {
      transitionName: '',
      active: 0,
      show_tabbar: true,
      tabbar: [
        {
          path: '/',
          icon: 'home-o',
          text: '主页'
        },
        {
          path: '/order',
          icon: 'balance-o',
          text: '充值'
        },
        {
          path: '/prod',
          icon: 'service-o',
          text: '客服'
        },
        {
          path: '/center',
          icon: 'friends-o',
          text: '我的'
        }
      ]
    }
  },
  mounted(){
    this.$nextTick(function(){
		let active = localStorage.getItem('tabbar-active');
		if(active){
		  this.active = Number(active);
		  this.$router.push(this.tabbar[active].path);
		}
	});
  },
  methods:{
    tabbarChange(){
      localStorage.setItem('tabbar-active', this.active)
    }
  },
  watch:{
    $route(to, from) {
      if (to.meta.index > from.meta.index) {
        this.transitionName = "slide-left";
      } else {
        this.transitionName = "slide-right";
      }
    }
  }
}
</script>

<style>
    *{
        padding: 0px;
        margin: 0px;
        list-style: none;
        border-spacing: 0px;
        font-size: 4vw;
        font-family: 'Avenir', Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
  #app {
    text-align: center;
    color: #2c3e50;
    height: 100vh;
    background: #F0F8FF;
  }
  .main{
    position: fixed;
    top: 0px;
    left: 0px;
    width: 100vw;
    height: 100vh;
    overflow: auto;
  }
  .slide-left-enter,.slide-right-leave-to{
    /*opacity: 0;*/
    /*filter: opacity(0);*/
    -webkit-transform: translate(100%, 0);
    -moz-transform: translate(100%, 0);
    -ms-transform: translate(100%, 0);
    -o-transform: translate(100%, 0);
    transform: translate(100%, 0);
    will-change: transform;
  }
  .slide-right-enter-to,.slide-left-enter-to{
    -webkit-transform: translate(0, 0);
    -moz-transform: translate(0, 0);
    -ms-transform: translate(0, 0);
    -o-transform: translate(0, 0);
    transform: translate(0, 0);
  }
  .slide-left-leave,.slide-right-leave{
    -webkit-transform: translate(0, 0);
    -moz-transform: translate(0, 0);
    -ms-transform: translate(0, 0);
    -o-transform: translate(0, 0);
    transform: translate(0, 0);
    will-change: transform;
  }
  .slide-left-enter-active,.slide-left-leave-active,.slide-right-enter-active,.slide-right-leave-active{
    transition: all 300ms;
    position: fixed;
    top: 0px;
    width: 100vw;
    height: 100vh;
  }
  .slide-right-enter,.slide-left-leave-to{
    -webkit-transform: translate(-100%, 0);
    -moz-transform: translate(-100%, 0);
    -ms-transform: translate(-100%, 0);
    -o-transform: translate(-100%, 0);
    transform: translate(-100%, 0);
  }

  .content-box{
    position: fixed;
    height: 100vh;
    width: 100vw;
    left: 0px;
    top: 0px;
    overflow: auto;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
  }
  .top12{
    padding-top: 12vw;
  }

  .bottom13{
    padding-bottom: 13vw;
  }

  .align-left{
    text-align: left;
  }
  .van-tabbar{
    height: 13vw;
  }

  .van-tabbar-item__icon .van-icon{
    font-size: 5vw !important;
  }

  .van-notice-bar__wrap,.van-notice-bar{
    height: 10vw !important;
    line-height: 10vw !important;
  }

  .van-cell{
    line-height: 6vw !important;
  }
  .van-cell__left-icon, .van-cell__right-icon{
    font-size: 4vw;
  }
</style>
