<template>
  <div id="app">
    <div class="main">
      <transition :name="transitionName">
        <router-view></router-view>
      </transition>
    </div>
    <van-tabbar v-model="active">
      <van-tabbar-item icon="home-o">首页</van-tabbar-item>
      <van-tabbar-item icon="search">搜索</van-tabbar-item>
      <van-tabbar-item icon="setting-o">设置</van-tabbar-item>
      <van-tabbar-item icon="friends-o">好友</van-tabbar-item>
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
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  height: 100vh;
}
.van-tabbar{
  height: 15vw;
}
*{
  font-size: 4vw !important;
  background: #F0F8FF;
}
.van-tabbar-item__icon .van-icon{
  font-size: 5vw !important;
}
</style>
