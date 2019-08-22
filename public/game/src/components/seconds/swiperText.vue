<template>
    <div class="swipe-text-box">
        <ul :style="'height: '+height+';'">
            <template v-for="(item, index) in options">
                <li v-bind:key="index" :class="class_name" :style="'height: '+li_height(0)+';line-height:' + li_height(0)+';top:'+(li_height(1)*(index))+li_height(2)+';'+item.style" :data-index="index" :data-flag="index">
                    <span :style="item.left.style">{{item.left.text}}</span>
                    <span :style="item.center.style">{{item.center.text}}</span>
                    <span :style="item.right.style">{{item.right.text}}</span>
                </li>
            </template>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "swiperText",
        props: {
            row: {
                type: Number,
                default: 3,
            },
            height: {
                type: String,
                default: '20vw'
            },
            autoplay: {
                type: Number,
                default: 1000
            },
            speed: {
                type: Number,
                default: 500
            },
            list: {
                type: [Array, Object],
                default: function () {
                    return [
                        {
                            left: {
                                text: 'ab**',
                                style: '',
                            },
                            center: {
                                text: '嘎嘎嘎嘎嘎',
                                style: '',
                            },
                            right: {
                                text: '123123',
                                style: ''
                            },
                            style: ''
                        },
                        {
                            left: {
                                text: 'ab**',
                                style: '',
                            },
                            center: {
                                text: '嘎嘎嘎嘎嘎',
                                style: '',
                            },
                            right: {
                                text: '123123',
                                style: ''
                            },
                            style: ''
                        },
                        {
                            left: {
                                text: 'ab**',
                                style: '',
                            },
                            center: {
                                text: '嘎嘎嘎嘎嘎',
                                style: '',
                            },
                            right: {
                                text: '123123',
                                style: ''
                            },
                            style: ''
                        }
                    ]
                }
            }
        },
        data(){
            return {
                handle: null,
                options: [],
                index: 0,
                class_name: '',
                windowIsOnFocus: true
            }
        },
        created(){
            this.class_name = 'swipe-text-box-'+Math.round(Math.random()*10000);
            let i = 0, j = 0;
            for(; i <= this.row; i++, j++){
                if(j >= this.list.length){
                    j = 0;
                }
                this.options.push(this.list[j]);
            }
            this.index = j;
        },
        mounted() {
            let _this = this;
            let lis = document.querySelectorAll('.swipe-text-box .'+this.class_name);
            let hiddenProperty = 'hidden' in document ? 'hidden' :
                'webkitHidden' in document ? 'webkitHidden' :
                    'mozHidden' in document ? 'mozHidden' :
                        null;
            // 不同浏览器的事件名
            let visibilityChangeEvent = hiddenProperty.replace(/hidden/i, 'visibilitychange');
            document.addEventListener(visibilityChangeEvent, () => {
                if (!document[hiddenProperty]) {
                    _this.windowIsOnFocus = true;
                    // document.title = '页面激活';
                }else{
                    _this.windowIsOnFocus = false;
                    // document.title='页面非激活';
                }
            });
            lis.forEach(function (item) {
                item.addEventListener('transitionend', function () {
                    if(item.dataset.flag == (_this.row)){
                        item.style.transition = '';
                        item.style.top = (Number(this.dataset.flag)) * _this.li_height(1) + _this.li_height(2);
                        if(_this.index >= _this.list.length){
                            _this.index = 0;
                        }
                        _this.options[item.dataset.index] = _this.list[_this.index];
                        _this.index++;
                        _this.$forceUpdate();
                    }

                })
            })
            this.handle = setInterval(function () {
                if(_this.windowIsOnFocus){
                        lis.forEach(function (item) {
                        item.style.transition = 'all '+_this.speed+'ms';
                        item.style.top = _this.li_height(1)*(item.dataset.flag-1)+_this.li_height(2);
                        item.dataset.flag--;
                        if(item.dataset.flag < 0){
                            item.dataset.flag = _this.row;
                        }
                    })
                }
            }, this.autoplay+this.speed)
        },
        beforeDestroy(){
            clearInterval(this.handle)
        },
        methods:{
            li_height(flag = 0){
                let h = /([0-9]+)(\S+)/.exec(this.height);
                let lh = h[1];
                let px = h[2];
                if(flag == 0){
                    return lh/this.row + px;
                }else if(flag == 1){
                    return lh/this.row;
                }else{
                    return px;
                }
            },
        }
    }
</script>

<style scoped>
    .swipe-text-box{
        padding: 2vw;
    }
    ul{
        position: relative;
    }
    ul,li{
        width: 100%;
        list-style: none;
        overflow: hidden;
        text-overflow: ellipsis;
        /*text-overflow-ellipsis: '...';*/
    }
    li{
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: absolute;
        will-change: transition;
    }
</style>