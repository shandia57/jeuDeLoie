import { Player } from "./Player.js";
export class JeuDeLoie extends Player {

    #endGameWithNumberPlayer = 1;

    #answers = [];
    #questionsLevel1 = [];
    #questionsLevel2 = [];
    #questionsLevel3 = [];
    #questionsLevel4 = [];
    #questionsLevel5 = [];
    #questionsLevel6 = [];

    getEndGameWithNumberPlayer() {
        return this.#endGameWithNumberPlayer;
    }

    setAnswers(answers) {
        this.#answers = answers;
    }

    getAnswers() {
        return this.#answers;
    }

    findGoodAnswer() {
        for (let i = 0; i < this.#answers.length; i++) {
            if (this.#answers[i].valid === 1) {
                return this.#answers[i].answer;
            }
        }
    }

    isAGoodAnser(userAnswer, goodAnser) {
        return userAnswer.trim() === goodAnser.trim();
    }

    // QUESTIONS 1
    setQuestionsLevel1(questions) {
        this.#questionsLevel1 = questions;
    }

    getQuestionsLevel1() {
        return this.#questionsLevel1;
    }

    // QUESTIONS 2
    setQuestionsLevel2(questions) {
        this.#questionsLevel2 = questions;
    }

    getQuestionsLevel2() {
        return this.#questionsLevel2;
    }

    // QUESTIONS 3
    setQuestionsLevel3(questions) {
        this.#questionsLevel3 = questions;
    }

    getQuestionsLevel3() {
        return this.#questionsLevel3;
    }

    // QUESTIONS 4
    setQuestionsLevel4(questions) {
        this.#questionsLevel4 = questions;
    }

    getQuestionsLevel4() {
        return this.#questionsLevel4;
    }

    // QUESTIONS 5
    setQuestionsLevel5(questions) {
        this.#questionsLevel5 = questions;
    }

    getQuestionsLevel5() {
        return this.#questionsLevel5;
    }


    // QUESTIONS 6
    setQuestionsLevel6(questions) {
        this.#questionsLevel6 = questions;
    }

    getQuestionsLevel6() {
        return this.#questionsLevel6;
    }

    /////// END QUESTIONS



    getSingleQuestion(index, arrayQuestions) {
        return arrayQuestions[index];
    }

    removeSingleQuestion(index, arrayQuestions) {
        return arrayQuestions.filter(value => arrayQuestions.indexOf(value) !== index);
    }


    getRandomIndex(max) {
        return Math.floor(Math.random() * max);
    }

    getQuestionsWithLevel(levelQuestion) {
        switch (levelQuestion.trim().toLowerCase()) {
            case "vert":
                return this.getQuestionsLevel1();
            case "jaune":
                return this.getQuestionsLevel2();
            case "bleu":
                return this.getQuestionsLevel3();
            case "orange":
                return this.getQuestionsLevel4();
            case "rouge":
                return this.getQuestionsLevel5();
            case "noir":
                return this.getQuestionsLevel6();
        }
    }

    getNumberPointsToAttribute(levelQuestion) {
        switch (levelQuestion.trim().toLowerCase()) {
            case "vert":
                return 1;
            case "jaune":
                return 2;
            case "bleu":
                return 3;
            case "orange":
                return 4;
            case "rouge":
                return 5;
            case "noir":
                return 6;
        }
    }

    removeTheQuestion(levelQuestion, index) {
        switch (levelQuestion.trim().toLowerCase()) {
            case "vert":
                this.#questionsLevel1 = this.#questionsLevel1.filter(value => this.#questionsLevel1.indexOf(value) !== index);
                break;
            case "jaune":
                this.#questionsLevel2 = this.#questionsLevel2.filter(value => this.#questionsLevel2.indexOf(value) !== index);
                break;
            case "bleu":
                this.#questionsLevel3 = this.#questionsLevel3.filter(value => this.#questionsLevel3.indexOf(value) !== index);
                break;
            case "orange":
                this.#questionsLevel4 = this.#questionsLevel4.filter(value => this.#questionsLevel4.indexOf(value) !== index);
                break;
            case "rouge":
                this.#questionsLevel5 = this.#questionsLevel5.filter(value => this.#questionsLevel5.indexOf(value) !== index);
                break;
            case "noir":
                this.#questionsLevel6 = this.#questionsLevel6.filter(value => this.#questionsLevel6.indexOf(value) !== index);
                break;
        }
    }
}
