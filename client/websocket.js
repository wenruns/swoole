const myWebsocket = function ({
    host,
    onOpen = null,
    onMessage = null,
    onClose = null,
    onError = null
}) {

    this.fd = null;
    this.send = function (data) {
        if(typeof data == 'array' || typeof data == 'object'){
            data = JSON.stringify(data);
        }
        this.fd.send(data);
    }

    this.close = function () {
        this.fd.close();
    }

    var openCallback = (evt) => {
        if(this._open){
            this._open(evt, this);
        }
    }
    var messageCallback = (evt) => {
        if(this._message){
            this._message(evt, this);
        }
    }
    var closeCallback = (evt) => {
        if(this._close){
            this._close(evt, this);
        }
    }
    var errorCallback = (evt) => {
        if(this._error){
            this._error(evt, this);
        }
    }
    var init = () => {
        this._host= host;
        this._open = onOpen;
        this._message = onMessage;
        this._close = onClose;
        this._error = onError;
    }
    var create = () => {
        init();
        this.fd = new WebSocket(this._host);
        this.fd.onopen = openCallback;
        this.fd.onmessage = messageCallback;
        this.fd.close = closeCallback;
        this.fd.onerror = errorCallback;
    }

    create();
}

// var i = 0;
// while(i<60){



    // console.log('i='+i);
//     i++;
// }

// export default websocket;
