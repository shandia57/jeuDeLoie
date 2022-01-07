export class Player {

    #id
    #username;
    #role;
    #points = 0;
    #maxPoints = 48;
    #players = [];
    #maxPlayers = 6;
    #currentIndexPlayer = 0;
    #numberOfActuelPlayers;
    #statePlaying = true;


    constructor(username, role) {
        this.setUsername(username);
        this.setRole(role);
    }

    setId(id) {
        this.#id = id;
    }

    getId() {
        return this.#id;
    }

    setUsername(username) {
        this.#username = username;
    }

    getUsername() {
        return this.#username;
    }

    setRole(role) {
        this.#role = role;
    }

    getRole() {
        return this.#role;
    }

    addPoints(points) {
        if (this.#points + points > this.#maxPoints) {
            this.#points = this.#maxPoints;
        } else {
            this.#points += points;
        }
    }
    removePoints(points) {
        if (this.#points > points) {
            this.#points -= points;
        } else {
            this.#points = 0;
        }
    }
    resetPoints() {
        this.#points = 0;
    }

    resetAllPoints() {
        for (let i = 0; i < this.#players.length; i++) {
            this.#players[i].#points = 0;
        }
    }

    getPoints() {
        return this.#points;
    }

    getMaxPoints() {
        return this.#maxPoints;
    }


    setPlayers(player) {
        this.#players.push(player);
    }

    getPlayers() {
        return this.#players;
    }

    getMaxPlayers() {
        return this.#maxPlayers;
    }

    getNumberPlayer() {
        return this.#players.length;
    }

    getSinglePlayer(index) {
        return this.#players[index];;
    }

    IncrementCurrentIndexPlayer() {
        this.#currentIndexPlayer === this.#players.length - 1 ? this.#currentIndexPlayer = 0 : this.#currentIndexPlayer += 1;
    }

    getCurrentIndexPlayer() {
        return this.#currentIndexPlayer;
    }

    getCurrentPlayer() {
        return this.#players[this.#currentIndexPlayer];
    }

    setNumberOfActuelPlayers(number) {
        this.#numberOfActuelPlayers = number;
    }

    getNumberOfActuelPlayers() {
        return this.#numberOfActuelPlayers;
    }

    controlPointsOfTheCurrentPlayer() {
        return this.#points === this.#maxPoints;
    }

    setStatePlaying() {
        this.#statePlaying = !this.#statePlaying;
    }

    getStatePlaying() {
        return this.#statePlaying;
    }

    resetAllStatePlaying() {
        for (let i = 0; i < this.#players.length; i++) {
            this.#players[i].#statePlaying = true;
        }
    }

    findUserWithUsername(username) {
        for (let i = 0; i < this.#players.length; i++) {
            if (this.#players[i].getUsername() === username) {
                this.#players = this.#players.filter(value => value !== this.#players[i]);
                console.log(this.#players);
            }
        }
    }
}
