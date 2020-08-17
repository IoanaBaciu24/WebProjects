function getLoggedBoyes(callbackFunction) {
    console.log("func1");
    $.getJSON(
        "gameController",
        {action: "getLogged"},
    callbackFunction
    );
    console.log("func2");

}

function clean(whomst) {
    $.getJSON(
        "gameController",
        {action: "clean", whomst: whomst}
    );
}


function checkStatus(callbackFunction) {
    $.getJSON(
        "gameController",
        {action: "getResult"},
        callbackFunction
    );


}

function sendAMove(player, move, callbackFunction) {
    console.log("si aici");
    $.getJSON(
        "gameController",
        {action: "placeMove", position: move, player: player},
        callbackFunction
    );

}

function getTable(callbackFunction) {
    $.getJSON(
        "gameController",
        {action: "getTable"},
        callbackFunction
    );

}

function getPlayer(uname, callbackFunction) {

    $.getJSON(
        "gameController",
        {action: "getPlayer", uname: uname},
        callbackFunction
    );
}

function getTurn(player, callbackFunction) {
    $.getJSON(
      "gameController",
        {action: "getTurn", player: player},
        callbackFunction
    );





}