// var ws = new WebSocket("ws://127.0.0.1:9502");
// console.log(ws)
// ws.onopen = function (evt) {
//     console.log('Connection open...', evt);
//     ws.send('Hello WebSocket!');
// }
//
// ws.onmessage = function (evt) {
//     console.log("received:"+evt.data)
// }
//
// ws.onclose = function (evt) {
//     console.log('close..', evt)
// }
//
// ws.onerror = function (evt) {
//     console.log('err', evt)
// }


var wsServer = 'ws://127.0.0.1:9502';
var websocket = new WebSocket(wsServer);
console.log(websocket)
websocket.onopen = function (evt) {
    console.log("Connected to WebSocket server.");
};

websocket.onclose = function (evt) {
    console.log("Disconnected");
};

websocket.onmessage = function (evt) {
    console.log('Retrieved data from server: ' + evt.data);
};

websocket.onerror = function (evt, e) {
    console.log('Error occured: ' + evt.data);
};