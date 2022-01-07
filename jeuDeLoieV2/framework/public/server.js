const express = require('express');
const app = express();
const http = require('http').createServer(app);
const io = require('socket.io')(http);
const port = process.env.PORT || 3000;



let userConnected = [];
let GameMaster = [];
let playerAllowed = [];
let playerCollor = [];
let colorToSend = "";
let players = [];
let MAXPLAYERS = null;
let currentPlayer = 0
let goodAnswer = "";
let level = "";
let indexQuestion = 0;
let boolRestartGame = [];
let compteur = 0;




io.on('connection', (socket) => {
    console.log('a user connected');

    socket.on('chat message', (msg) => {
        io.emit('chat message', msg);
    });


    socket.emit("init", socket.id);

    socket.on("playersList", (players) => {
        playerAllowed = players[0];
        playerCollor = players[1];
        console.log("players allowed", playerAllowed);
    })

    socket.on("GameMaster", (GM) => {
        GameMaster = GM;
    })

    socket.on("control user", (username) => {
        socket.emit("control user", playerAllowed.includes(username))
    })

    socket.on("is user connected", (username) => {
        if (userConnected.includes(username)) {
            socket.emit("responseUser", [true, "Cet utilisateur est déjà connecté"])
        } else {
            for (let i = 0; i < playerCollor.length; i++) {
                if (username !== "GameMaster" && username === playerCollor[i].username) {
                    colorToSend = playerCollor[i].color;
                }
            }
            socket.emit("responseUser", [false, username, colorToSend])
        }
    })


    socket.on("players", (player) => {
        players.push(
            {
                "id": player[0],
                "username": player[1],
                "color": player[2],
                "points": 0,
                "rank": 6
            }
        );
        userConnected.push(player[1]);
        io.emit("players connected", players.length);
        if (players.length === MAXPLAYERS) {
            for (let i = 0; i < players.length; i++) {
                players[i].rank = MAXPLAYERS;
            }
            io.emit("startGame", [true, players, players[currentPlayer].id, playerCollor]);
        }
    })

    socket.on("numberMaxPlayers", (numberMax) => {
        MAXPLAYERS = numberMax;
        console.log("max players", MAXPLAYERS);
    })

    socket.on("getQuestionsAndAnswers", (questionsAnswers) => {
        goodAnswer = questionsAnswers[2];
        level = questionsAnswers[3];
        if (questionsAnswers[1].length > 1) {
            questionsAnswers.push(players[currentPlayer].id);

        } else {
            questionsAnswers.push(GameMaster[0]);
        }


        indexQuestion = questionsAnswers[4]; io.emit("answerToTheQuestion", questionsAnswers);
        console.log("Good answer : ", questionsAnswers[2])

    })



    socket.on("player answered", (answer) => {

        answer.push(players[currentPlayer].id);


        if (answer[1] === true) {
            io.emit("player answered", answer);
        } else {
            answer.push(goodAnswer);
            io.emit("player answered", answer);
        }
    })


    socket.on("endOfTurn", (newCurrentUser) => {
        currentPlayer = newCurrentUser;
        io.emit("newTurn", [players[currentPlayer].id, level, indexQuestion]);

    })


    socket.on("endOfGame", (conf) => {
        boolRestartGame.push(conf);
        if (boolRestartGame.length === players.length) {
            let newArrayBool = boolRestartGame.filter((value) => {
                return value[0] === true;
            }).length
            if (newArrayBool === players.length) {
                currentPlayer = conf[1];
                boolRestartGame = [];
                console.log("Restart the game")
                io.emit("restart", players[currentPlayer].id);
            } else {
                console.log("End game")
                io.emit("stopGame", false);
            }
        }
    })

    socket.on('disconnect', (client) => {
        console.log('user disconnected : ', socket.id);

        for (let i = 0; i < players.length; i++) {
            if (players[i].id === socket.id) {
                var myIndex = userConnected.indexOf(players[i].username);

                if (myIndex !== -1) {
                    userConnected.splice(myIndex, 1);
                }
                io.emit("user disconnected", players[i].username);
                if (players[i].id === players[currentPlayer].id) {
                    io.emit("switch player turn", true);
                }
                players = players.filter(value => value !== players[i]);
                io.emit("players connected", players.length);



            }
        }
    });

    socket.on("switch player turn", (index) => {
        currentPlayer = index;

        compteur++;
        if (compteur === players.length) {
            io.emit("newTurn", [players[currentPlayer].id, level, indexQuestion]);
            compteur = 0;
        }

    })


});


http.listen(port, () => {
    console.log("Server running on port ", port);
})

